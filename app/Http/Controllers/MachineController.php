<?php

namespace App\Http\Controllers;

use \stdClass;
use App\Models\Order;
use App\Models\Machine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MachineController extends Controller
{

    public function moveElement(Request $request) {


    $machines = Machine::all();

    $orders= Order::all()->sortBy('eil_nr');
    
    for ($a = 0; $a < count($machines); $a++){

        $arr[$a]=array();
        
        for ($i = 0; $i < count($orders); $i++){

            if ($machines[$a]->id == $orders[$i]->machine_id){
            array_push($arr[$a],$orders[$i]);
            }
        }
        usort($arr[$a], function($a, $b) {return  ($a->eil_nr < $b->eil_nr) ? -1 : 1;});
    }

    if (isset($_GET['xxx']) && isset($_GET['yyy'])) {
        $shemp=$arr[$_GET['yyy']][$_GET['xxx']-1]; 
        if ($_GET['xxx'] > $_GET['eil_nr']) {
            array_splice($arr[$_GET['yyy']], $_GET['eil_nr']-1, 0, [$shemp] );
            unset($arr[$_GET['yyy']][$_GET['xxx']]);
        }elseif($_GET['xxx'] < $_GET['eil_nr']){
            array_splice($arr[$_GET['yyy']], $_GET['eil_nr'], 0, [$shemp] );
            unset($arr[$_GET['yyy']][$_GET['xxx']-1]);
        }
        $arr[$_GET['yyy']]=array_values($arr[$_GET['yyy']]);
    } 

    for ($k = 0; $k< count($arr); $k++){
        
        for ($l = 0; $l < count($arr[$k]); $l++){
            
            $arr[$k][$l]->eil_nr=$l+1;
            $arr[$k][$l]->save();
        }
    }
    return redirect()->route('machine.index')->with('success_message','Uzsakymas padarytas/priskirtas');;
}


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $machines = Machine::all();
        // $orders = Order::all();

        
        $doneOrders = Order::all()->where('status','=',1);

        //$b = [];
        $orders= Order::all()->sortBy('eil_nr');

    $arr=[];

    for ($a = 0; $a < count($machines); $a++){
    
        $arr[$a]=array();
        for ($i = 0; $i < count($orders); $i++){
          if ($machines[$a]->id == $orders[$i]->machine_id){
          
            array_push($arr[$a],$orders[$i]);
            }
         
        }
        usort($arr[$a], function($a, $b) {return  ($a->eil_nr < $b->eil_nr) ? -1 : 1;});

        for ($k = 0; $k< count($arr); $k++){
            for ($l = 0; $l < count($arr[$k]); $l++){
                if ($arr[$k][$l]->eil_nr===null) {
                    $arr[$k][$l]->eil_nr=count($arr[$k]);
                    $arr[$k][$l]->save();
                    usort($arr[$k], function($a, $b) {return  ($a->eil_nr < $b->eil_nr) ? -1 : 1;});
                }else{
                    $arr[$k][$l]->eil_nr=$l+1;
                    $arr[$k][$l]->save();
                }

            }
            
        }
    }
        return view('machine.index',['machines'=>$machines,'orders'=>$orders,'doneOrders'=>$doneOrders,'arr'=>$arr]);
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


        $validator = Validator::make($request->all(),
        [
            'pavadinimas' => ['required','unique:machines','min:3','max:64'],
            'tipas' => ['required','min:1','max:64'],
            
        ],
        [
            'pavadinimas.required' => 'Masinos pavadinimas privalomas',
            'pavadinimas.unique' => 'Masinos pavadinimas turi buti unikalus',
  
        ]);
            if ($validator->fails()) {
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }


        $machine= new Machine();
        $machine->pavadinimas = $request->pavadinimas;
        $machine->tipas = $request->tipas;
        $machine->save();
        return redirect()->back()->with('success_message','Masina '.$machine->pavadinimas.' sekmingai prideta');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Machine  $machine
     * @return \Illuminate\Http\Response
     */
    public function show(Machine $machine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Machine  $machine
     * @return \Illuminate\Http\Response
     */
    public function edit(Machine $machine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Machine  $machine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Machine $machine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Machine  $machine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Machine $machine)
    {
        //
    }
}
