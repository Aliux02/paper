<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function donePrint(Request $request)
    {
        $order = Order::find($request->id);
        $order->status=1;
        $order->machine_id=$request->machine_id;
        $order->update();
        return back();
    }
    public function rewind(Request $request, $doneOrder)
    {
        $order = Order::find($doneOrder);
        $order->status=2;
        $order->machine_id=$request->machine_id;
        $order->update();
        return back();
    }
    public function doneRewind(Request $request)
    {
        $order = Order::find($request->id);
        $order->status=3;
        $order->machine_id=null;
        $order->update();
        return back();
    }
    public function donePacking(Request $request,$order)
    {
        $order = Order::find($order);
        $order->status=4;
        $order->machine_id=null;
        $order->update();
        return back();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $machines = Machine::all();
        $orders = Order::all();
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
        $order->kiekis = $request->kiekis;
        
        $order->save();


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
        //status
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
