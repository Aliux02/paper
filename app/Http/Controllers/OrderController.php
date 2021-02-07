<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use App\Models\Order;
use App\Models\Orderinfo;
use Illuminate\Http\Request;
use Auth;

class OrderController extends Controller
{
    public function donePrint(Request $request)
    {
        $order = Order::find($request->id);
        $order->status=1;
        $order->machine_id=null;
        $order->update();
        
        $orderInfo = Orderinfo::where('order_id','=', $request->id)->first();
        
        $orderInfo->atspausdino=Auth::user()->name;
        $orderInfo->atspausdinta=$order->updated_at;
        $orderInfo->update();

        //return back();
        return redirect()->route('machine.moveElement');
    }
    public function rewind(Request $request, $doneOrder)
    {
        $order = Order::find($doneOrder);
        $order->status=2;
        $order->machine_id=$request->machine_id;
        $order->update();


        //return back();
        return redirect()->route('machine.moveElement');
    }
    public function doneRewind(Request $request)
    {
        $order = Order::find($request->id);
        $order->status=3;
        $order->machine_id=null;
        $order->update();

        $orderInfo = Orderinfo::where('order_id','=', $request->id)->first();
        
        $orderInfo->suvyniojo=Auth::user()->name;
        $orderInfo->suvyniota=$order->updated_at;
        $orderInfo->update();

        //return back();
        return redirect()->route('machine.moveElement');
    }
    public function donePacking(Request $request,$orderId)
    {
        $order = Order::find($orderId);
        $order->status=4;
        $order->machine_id=null;
        $order->dezes = $request->dezes;
        $order->update();

        $orderInfo = Orderinfo::where('order_id','=', $orderId)->first();
        
        $orderInfo->supakavo=Auth::user()->name;
        $orderInfo->supakuota=$order->updated_at;
        $orderInfo->update();

        return back();
    }
    public function toArchive(Request $request,$order)
    {
        $order = Order::find($order);
        $order->status=5;
        $order->pabaigimas=$order->pabaigimas;
        $order->velenas=$order->velenas;
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = new Order();
        $order->eil_nr = null;
        $order->uzsakovas = $request->uzsakovas;
        $order->pavadinimas = $request->pavadinimas;
        $order->ilgis = $request->ilgis;
        $order->plotis = $request->plotis;
        $order->medziaga = strtoupper($request->medziaga);;
        $order->klijai = $request->klijai;
        $order->eiles = $request->eiles;
        $order->spalva = $request->spalva;
        $order->machine_id = null;
        $order->status = 0;
        $order->dezes = 0;
        $order->velenas = $request->velenas;
        $order->pabaigimas = $request->pabaigimas;
        $order->kiekis = $request->kiekis;
        
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


        return redirect()->route('order.index');
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
        $order->eil_nr = null;
        $order->id = $order->id;
        $order->uzsakovas = $request->uzsakovas;
        $order->pavadinimas = $request->pavadinimas;
        $order->ilgis = $request->ilgis;
        $order->plotis = $request->plotis;
        $order->medziaga = strtoupper($request->medziaga);;
        $order->klijai = $request->klijai;
        $order->eiles = $request->eiles;
        $order->spalva = $request->spalva;
        $order->machine_id = $request->machine_id;
        $order->kiekis = $request->kiekis;
        $order->velenas = $request->velenas;
        
        $order->pabaigimas = $request->pabaigimas;
        //status
        if($request->dezes==null){$order->dezes=0;}
        if($request->machine_id==0){$order->machine_id=null;}
        $order->update();
        return redirect()->back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
