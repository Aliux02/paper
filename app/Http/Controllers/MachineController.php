<?php

namespace App\Http\Controllers;

use \stdClass;
use App\Models\Order;
use App\Models\Machine;
use Illuminate\Http\Request;

class MachineController extends Controller
{

    public function moveElement() {


        $machines = Machine::all();
        // $orders = Order::all();


        $orders= Order::all()->sortBy('eil_nr');
        //dd($orders);
        for ($a = 0; $a < count($machines); $a++){
    
            $arr[$a]=array();
            
            for ($i = 0; $i < count($orders); $i++){

              if ($machines[$a]->id == $orders[$i]->machine_id){
                //dd($orders[$i]);
                array_push($arr[$a],$orders[$i]);

                }
            }
            usort($arr[$a], function($a, $b) {return strcmp($a->eil_nr, $b->eil_nr);});
             //dd($arr);
        }
        //dd($arr);


        if (isset($_GET['xxx']) && isset($_GET['eiles_nr'])) {

            //appending $new in our array 
            array_unshift($arr[$_GET['yyy']], $arr[$_GET['yyy']][$_GET['xxx']-1]);
            //now make it unique.
            //dd($arr);
            $temp = array_unique($arr[$_GET['yyy']]);
            $arr[$_GET['yyy']]=$temp;
            $arr[$_GET['yyy']]=array_values($arr[$_GET['yyy']]);

        } 
            
            for ($k = 0; $k< count($arr); $k++){
                
                for ($l = 0; $l < count($arr[$k]); $l++){
                    
                    $arr[$k][$l]->eil_nr=$l+1;
                    $arr[$k][$l]->save();
                }
                
            }
                  
    
    return redirect()->route('machine.index');
    //return view('machine.index',['machines'=>$machines,'orders'=>$orders,'doneOrders'=>$doneOrders,'arr'=>$arr]);
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





    for ($a = 0; $a < count($machines); $a++){
    
        $arr[$a]=array();
        for ($i = 0; $i < count($orders); $i++){
            // if ($orders[$i]->eil_nr>=0) {
            //     # code...
            // }
          if ($machines[$a]->id == $orders[$i]->machine_id){
          
            array_push($arr[$a],$orders[$i]);
            }
         
        }
        //dd($arr);

        for ($k = 0; $k< count($arr); $k++){
                
            for ($l = 0; $l < count($arr[$k]); $l++){

                if ($arr[$k][$l]->eil_nr>0) { 
                    $arr[$k][$l]->eil_nr=$arr[$k][$l]->eil_nr;
                }else{ ///&& status==2
                    $arr[$k][$l]->eil_nr=$l+1;
                    $arr[$k][$l]->save();
                }

            }
            
        }

        usort($arr[$a], function($a, $b) {return strcmp($a->eil_nr, $b->eil_nr);});
        //dd($arr);  
    }

    //dd($arr);
        //$arr[$_GET['yyy']][$_GET['xxx']]->save();
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
        $machine= new Machine();
        $machine->pavadinimas = $request->pavadinimas;
        $machine->tipas = $request->tipas;
        $machine->save();
        return redirect()->back();
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
