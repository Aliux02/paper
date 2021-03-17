<?php

namespace App\Http\Controllers;


use App\Models\Machine;
use App\Models\Order;
use App\Models\Orderinfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;

class OrderController extends Controller
{



    public function donePrint(Request $request)
    {
        $request->validate(
            [
                'kiekis' => ['required','integer','min:1','max:1000000000'],
            ],
            [
                'kiekis.required' => 'Uzsakymo kiekis privalomas',
                'kiekis.integer' => 'kiekis turi buti sveikas skaicius',
                'kiekis.min' => 'kiekis negali buti mazesnis nei 1 pinigas',
                'kiekis.max' => 'kiekis per didelis',
            ]
        );
        $order = Order::find($request->id);
        $order->status=1;
        $order->kiekis = $request->kiekis;
        $order->machine_id=null;
        $order->update();
        
        $orderInfo = Orderinfo::where('order_id','=', $request->id)->first();
        
        $orderInfo->atspausdino=Auth::user()->name;
        $orderInfo->atspausdinta=$order->updated_at;
        $orderInfo->update();

        //return back();
        return redirect()->route('machine.moveElement')->with('success_message','Uzsakymas'.$order->pavadinimas.' padarytas');
    }
    public function rewind(Request $request, $doneOrder)
    {
        $request->validate(
            [
                'machine_id' => ['required','integer','min:1','max:10000'],
            ],
            [
                'machine_id.required' => 'Pasirinkite irengini',
                'machine_id.integer' => 'Irenginys turi buti sveikas skaicius',
                'machine_id.min' => 'Pasirinkite irengini',
                'machine_id.max' => 'Neturim tiek irenginiu',
            ]
        );
        $order = Order::find($doneOrder);
        $order->status=2;
        $order->machine_id=$request->machine_id;
        $order->update();


        //return back();
        return redirect()->route('machine.moveElement');
    }
    public function doneRewind(Request $request)
    {
        $request->validate(
            [
                'kiekis' => ['required','integer','min:1','max:1000000000'],
            ],
            [
                'kiekis.required' => 'Uzsakymo kiekis privalomas',
                'kiekis.integer' => 'Kiekis turi buti sveikas skaicius',
                'kiekis.min' => 'Kiekis negali buti mazesnis nei 1 ',
                'kiekis.max' => 'Kiekis per didelis',
            ]
        );
        $order = Order::find($request->id);
        $order->status=3;
        $order->kiekis = $request->kiekis;
        $order->machine_id=null;
        $order->update();

        $orderInfo = Orderinfo::where('order_id','=', $request->id)->first();
        
        $orderInfo->suvyniojo=Auth::user()->name;
        $orderInfo->suvyniota=$order->updated_at;
        $orderInfo->update();

        //return back();
        return redirect()->route('machine.moveElement')->with('success_message','Uzsakymas'.$order->pavadinimas.' padarytas ');
    }
    public function donePacking(Request $request,$orderId)
    {
        $request->validate(
            [
                'kiekis' => ['required','integer','min:1','max:1000000000'],
                'dezes' => ['required','integer','min:1','max:10000'],
            ],
            [
                'kiekis.required' => 'Uzsakymo kiekis privalomas',
                'kiekis.integer' => 'kiekis turi buti sveikas skaicius',
                'kiekis.min' => 'kiekis negali buti mazesnis nei 1 ',
                'kiekis.max' => 'kiekis per didelis',

                'dezes.required' => 'Iveskit deziu kieki',
                'dezes.integer' => 'Deziu kiekis turi buti sveikas skaicius',
                'dezes.min' => 'Supakuokit bent viena deze',
                'dezes.max' => 'deziu kiekis per didelis',
            ]
        );
        $order = Order::find($orderId);
        $order->status=4;
        $order->machine_id=null;
        $order->kiekis = $request->kiekis;
        $order->dezes = $request->dezes;
        $order->update();

        $orderInfo = Orderinfo::where('order_id','=', $orderId)->first();
        
        $orderInfo->supakavo=Auth::user()->name;
        $orderInfo->supakuota=$order->updated_at;
        $orderInfo->update();

        return back()->with('success_message','Uzsakymas '.$order->pavadinimas.' supakuotas');
    }
    public function toArchive(Request $request,$order)
    {
        //dd($order);
        $order = Order::find($order);
        $order->status=5;
        $order->machine_id=null;
        $order->update();
        return back();
    }

    public function archive()
    {
        
        $orders = Order::all()->where('status','=',5);
        return view('order.archive',['orders'=>$orders]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $machines = Machine::all();
        $orders = Order::all()->where('status','!=',5)->sortBy('pabaigimas');
        $ordersDonePacking = Order::all()->where('status','=',4);
        return view('order.index',['orders'=>$orders,'machines'=>$machines,'ordersDonePacking'=>$ordersDonePacking]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('order.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->merge(['ilgis'=> str_replace(',','.',$request->ilgis)]) ;
        $request->merge(['plotis'=> str_replace(',','.',$request->plotis)]) ;

        $validator = Validator::make($request->all(),
        [
            'uzsakovas' => ['required','min:2','max:64'],
            'pavadinimas' => ['required','min:1','max:64'],
            'kryptis' => ['required','min:1','alpha','max:1'],
            'ilgis' => ['required','numeric','min:1','max:500'],
            'plotis' => ['required','numeric','min:1','max:500'],
            'medziaga' => ['required','min:1','max:64'],
            'klijai' => ['required','min:1','max:64'],
            'eiles' => ['required','integer','min:1','max:20'],
            'spalva' => ['required','integer','min:0','max:64'],
            'velenas' => ['required','integer','min:1','max:200'],
            'pabaigimas' => ['required','date'],
            'kiekis' => ['required','integer','min:1','max:1000000000'],
            'pastabos' => ['min:0','max:4000'],
        ],
        [
            'uzsakovas.required' => 'Uzsakymo uzsakovas privalomas',
            'uzsakovas.min' => 'Uzsakymo uzsakovas per trumpas',
            'uzsakovas.max' => 'Uzsakymo uzsakovas per ilgas',

            'pavadinimas.required' => 'Uzsakymo pavadinimas privalomas',
            'pavadinimas.min' => 'Uzsakymo pavadinimas per trumpas',
            'pavadinimas.max' => 'Uzsakymo pavadinimas per ilgas',

            'kryptis.required' => 'Uzsakymo kryptis privaloma',
            'kryptis.min' => 'Uzsakymo kryptis per trumpa',
            'kryptis.max' => 'Uzsakymo kryptis per ilga',
            'kryptis.alpha' => 'Uzsakymo kryptis turi buti zodis',
            
            'ilgis.required' => 'Ilgis privalomas',
            'ilgis.numeric' => 'Ilgis turi buti skaicius',
            'ilgis.min' => 'Ilgis negali buti mazesnis nei 0.1mm.',
            'ilgis.max' => 'Ilgis per didelis',



            'plotis.required' => 'Uzsakymo plotis privalomas',
            'plotis.numeric' => 'Plotis turi buti skaicius',
            'plotis.min' => 'Plotis negali buti mazesnis nei 1 pinigas',
            'plotis.max' => 'Plotis per didelis',

            'medziaga.required' => 'Uzsakymo medziaga privaloma',
            'medziaga.min' => 'Uzsakymo medziaga per trumpa',
            'medziaga.max' => 'Uzsakymo medziaga per ilga',

            'klijai.required' => 'Uzsakymo klijai privaloma',
            'klijai.min' => 'Uzsakymo klijai per trumpa',
            'klijai.max' => 'Uzsakymo klijai per ilga',

            'eiles.required' => 'Uzsakymo eiles privalomas',
            'eiles.integer' => 'eiles turi buti skaicius',
            'eiles.min' => 'eiles negali buti mazesnis nei 1 pinigas',
            'eiles.max' => 'eiles per didelis',

            'spalva.required' => 'Uzsakymo spalva privalomas',
            'spalva.integer' => 'spalva turi buti skaicius',
            'spalva.min' => 'spalva negali buti mazesnis nei 1 pinigas',
            'spalva.max' => 'spalva per didelis',

            'velenas.required' => 'Uzsakymo velenas privalomas',
            'velenas.integer' => 'velenas turi buti skaicius',
            'velenas.min' => 'velenas negali buti mazesnis nei 1 pinigas',
            'velenas.max' => 'velenas per didelis',

            'pabaigimas.required' => 'Uzsakymo data privaloma',
            'pabaigimas.date' => 'Datos formatas',

            'kiekis.required' => 'Uzsakymo kiekis privalomas',
            'kiekis.integer' => 'kiekis turi buti sveikas skaicius',
            'kiekis.min' => 'kiekis negali buti mazesnis nei 1 pinigas',
            'kiekis.max' => 'kiekis per didelis',

            'pastabos.min' => 'Uzsakymo pastabos per trumpas',
            'pastabos.max' => 'Uzsakymo pastabos per ilgas',

        ]);
            if ($validator->fails()) {
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }


        $order = new Order();
        $order->eil_nr = null;
        $order->uzsakovas = ucfirst($request->uzsakovas);
        $order->pavadinimas = ucfirst($request->pavadinimas);
        $order->kryptis = strtoupper($request->kryptis);
        $order->ilgis = str_replace(',','.',$request->ilgis);
        $order->plotis = str_replace(',','.',$request->plotis);
        $order->medziaga = strtoupper($request->medziaga);
        $order->klijai = strtoupper($request->klijai);
        $order->eiles = $request->eiles;
        $order->spalva = $request->spalva;
        $order->machine_id = null;
        $order->status = 10;
        $order->dezes = 0;
        $order->velenas = $request->velenas;
        $order->pabaigimas = $request->pabaigimas;
        $order->kiekis = $request->kiekis;
        $order->pastabos = $request->pastabos;
        

        if($request->maketas===null){
            $order->maketas = 0;
            
        }else{
            if($request->has('naujoUzsMaketas')){

                $order->maketas=$request->naujoUzsMaketas;
                
            }else{
                $request->validate(
                    [
                        'maketas' => 'required|mimes:pdf|max:2048',
                    ],
                    [
                        'maketas.mimes' => 'Failas pturi but .pdf',
                    ]
                );
                $request->file('maketas');
                $file = $request->file('maketas');
                $fileName = $file->getClientOriginalName();

                $path = $file->storeAs('public', $fileName);
                $order->maketas = $fileName;
            }
        }

        $order->save();

        $orderInfo = new Orderinfo();
        
        $orderInfo->uzpilde = Auth::user()->name;
        $orderInfo->uzpildyta = $order->created_at;
        $orderInfo->atspausdino = 0;
        $orderInfo->atspausdinta = 0;
        $orderInfo->suvyniojo = 0;
        $orderInfo->suvyniota = 0;
        $orderInfo->supakavo = 0;
        $orderInfo->supakuota = 0;
        $orderInfo->order_id = $order->id;
        $orderInfo->save();

        

        return redirect()->route('order.index')->with('success_message','Uzsakymas '.$order->pavadinimas.' sekmingai pridetas');
    }

    public function printLayout(Order $order)
    {
        
        $path = $order->maketas;
        return view('order.printLayout',['path'=>$path]);
    }

    public function card(Order $order)
    {
        $order = Order::find($order->id);
        $machines = Machine::all();
        $path = $order->maketas;
        return view('order.orderCard',['order'=>$order,'machines'=>$machines, 'path'=>$path]);
    }
    public function storeFromArchive(Request $request, $order)
    {
        $order = Order::find($order);
        $machines = Machine::all();
        return view('order.storeFromArchive',['order'=>$order,'machines'=>$machines]);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $request->merge(['ilgis'=> str_replace(',','.',$request->ilgis)]) ;
        $request->merge(['plotis'=> str_replace(',','.',$request->plotis)]) ;
        $validator = Validator::make($request->all(),
        [
            'uzsakovas' => ['required','min:2','max:64'],
            'pavadinimas' => ['required','min:1','max:64'],
            'kryptis' => ['required','alpha','min:1','max:1'],
            'ilgis' => ['required','numeric','min:1','max:500'],
            'plotis' => ['required','numeric','min:1','max:500'],
            'medziaga' => ['required','min:1','max:64'],
            'klijai' => ['required','min:1','max:64'],
            'eiles' => ['required','integer','min:1','max:20'],
            'spalva' => ['required','integer','min:0','max:64'],
            'velenas' => ['required','integer','min:1','max:200'],
            'pabaigimas' => ['required','date'],
            'kiekis' => ['required','integer','min:1','max:1000000000'],
            'pastabos' => ['min:0','max:4000'],
        ],
        [
            'uzsakovas.required' => 'Uzsakymo uzsakovas privalomas',
            'uzsakovas.min' => 'Uzsakymo uzsakovas per trumpas',
            'uzsakovas.max' => 'Uzsakymo uzsakovas per ilgas',

            'pavadinimas.required' => 'Uzsakymo pavadinimas privalomas',
            'pavadinimas.min' => 'Uzsakymo pavadinimas per trumpas',
            'pavadinimas.max' => 'Uzsakymo pavadinimas per ilgas',

            'kryptis.required' => 'Uzsakymo kryptis privaloma',
            'kryptis.min' => 'Uzsakymo kryptis per trumpa',
            'kryptis.max' => 'Uzsakymo kryptis per ilga',
            'kryptis.alpha' => 'Uzsakymo kryptis turi buti zodis',

            'ilgis.required' => 'Ilgis privalomas',
            'ilgis.numeric' => 'Ilgis turi buti skaicius',
            'ilgis.min' => 'Ilgis negali buti mazesnis nei 0.1mm.',
            'ilgis.max' => 'Ilgis per didelis',



            'plotis.required' => 'Uzsakymo plotis privalomas',
            'plotis.numeric' => 'Plotis turi buti skaicius',
            'plotis.min' => 'Plotis negali buti mazesnis nei 1 pinigas',
            'plotis.max' => 'Plotis per didelis',

            'medziaga.required' => 'Uzsakymo medziaga privaloma',
            'medziaga.min' => 'Uzsakymo medziaga per trumpa',
            'medziaga.max' => 'Uzsakymo medziaga per ilga',

            'klijai.required' => 'Uzsakymo klijai privaloma',
            'klijai.min' => 'Uzsakymo klijai per trumpa',
            'klijai.max' => 'Uzsakymo klijai per ilga',

            'eiles.required' => 'Uzsakymo eiles privalomas',
            'eiles.integer' => 'eiles turi buti skaicius',
            'eiles.min' => 'eiles negali buti mazesnis nei 1 pinigas',
            'eiles.max' => 'eiles per didelis',

            'spalva.required' => 'Uzsakymo spalva privalomas',
            'spalva.integer' => 'spalva turi buti skaicius',
            'spalva.min' => 'spalva negali buti mazesnis nei 1 pinigas',
            'spalva.max' => 'spalva per didelis',

            'velenas.required' => 'Uzsakymo velenas privalomas',
            'velenas.integer' => 'velenas turi buti skaicius',
            'velenas.min' => 'velenas negali buti mazesnis nei 1 pinigas',
            'velenas.max' => 'velenas per didelis',

            'pabaigimas.required' => 'Uzsakymo data privaloma',
            'pabaigimas.date' => 'Datos formatas',

            'kiekis.required' => 'Uzsakymo kiekis privalomas',
            'kiekis.integer' => 'kiekis turi buti sveikas skaicius',
            'kiekis.min' => 'kiekis negali buti mazesnis nei 1 pinigas',
            'kiekis.max' => 'kiekis per didelis',

            'pastabos.min' => 'Uzsakymo pastabos per trumpas',
            'pastabos.max' => 'Uzsakymo pastabos per ilgas',

        ]);
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }


        $order->eil_nr = $order->eil_nr;
        $order->id = $order->id;
        $order->uzsakovas = ucfirst($request->uzsakovas);
        $order->pavadinimas = ucfirst($request->pavadinimas);
        $order->kryptis = strtoupper($request->kryptis);
        $order->ilgis = str_replace(',','.',$request->ilgis);
        $order->plotis = str_replace(',','.',$request->plotis);
        $order->medziaga = strtoupper($request->medziaga);
        $order->klijai = strtoupper($request->klijai);
        $order->eiles = $request->eiles;
        $order->spalva = $request->spalva;
        $order->machine_id = $request->machine_id;
        $order->kiekis = $request->kiekis;
        $order->velenas = $request->velenas;
        $order->pastabos = $request->pastabos;
        $order->maketas=$order->maketas;
        $order->status=0;
        $order->pabaigimas = $request->pabaigimas;
        if($request->dezes==null){$order->dezes=0;}
        if($request->machine_id==0){$order->machine_id=null;$order->eil_nr =null;$order->status=10;}
        $order->update();

        
        $orderInfo = Orderinfo::where('order_id','=', $order->id)->first();
        $orderInfo->uzpilde = Auth::user()->name;
        $orderInfo->uzpildyta = $order->updated_at;
        $orderInfo->update();
// dd($order);
        return redirect()->route('order.index')->
        withInput()->
        with('success_message','Uzsakymas '.$order->pavadinimas.' sekmingai pakeistas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('order.index');
    }
}
