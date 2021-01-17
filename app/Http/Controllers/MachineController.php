<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Machine;
use Illuminate\Http\Request;

class MachineController extends Controller
{

    public function moveElement() {


        // $machines = Machine::all();
        // $orders = Order::all();

        
        // $doneOrders = Order::all()->where('status','=',1);
            
        
        // $b = [];
        // $arr= Order::all()->where('status','=',0);
        // $arr[]=$order;
        // foreach ($arr as $ar) {
        //     array_push($b, $ar);
        // }
        // if (isset($_GET['xxx']) && isset($_GET['eiles_nr'])) {
            
        //     $temp = $b[$_GET['xxx']];
        //     $b[$_GET['xxx']] = $b[$_GET['eiles_nr']];
        //     $b[$_GET['eiles_nr']] = $temp;
        // }
        //dd($b);

        //
        //return view('machine.index',['machines'=>$machines,'orders'=>$orders,'doneOrders'=>$doneOrders,'b'=>$b]);
        //return '<h1>machine</h1>';
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
        $orders= Order::all();

        //dd($orders);
        //priristi prie masinos id
        // for ($i=1; $i < count($orders); $i++) { 
        //     $orders[$i]->eil_nr=$i;
        //     $orders[$i]->save();
        //     //dd($zorders);
        // }
            // foreach ($machines as $machine) {
                // foreach ($orders as $order) {
                //     // if ($machine->id == $order->machine_id) {
                        
                //         $order->eil_nr=1;
                //         //dd($order->eil_nr);
                //         $order->save();
                //     }


            //     }
            // }



        // $arr[]=$order;
        // foreach ($orders as $order) {
        //     //array_push($b, $ar);

        //     /// su foru prasieit ir ikist i kaip eil_nr
        //     $order->eil_nr=$order->eil_nr;   
        //     $order->save();
        // }
        // if (isset($_GET['xxx']) && isset($_GET['eiles_nr'])) {
            
        //     $temp = $b[$_GET['xxx']];
        //     $b[$_GET['xxx']] = $b[$_GET['eiles_nr']];
        //     $b[$_GET['eiles_nr']] = $temp;
        // }





            
        

        return view('machine.index',['machines'=>$machines,'orders'=>$orders,'doneOrders'=>$doneOrders]);
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
