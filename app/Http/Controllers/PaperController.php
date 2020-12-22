<?php

namespace App\Http\Controllers;

use App\Models\Info;
use App\Models\Paper;
use Illuminate\Http\Request;

class PaperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $papers = Paper::all()->sortBy('medziaga')->sortBy('medziaga');

        $medz_arrs = [];
        foreach ($papers as $paper) {
            array_push($medz_arrs, $paper->medziaga);
            $medz_arrs = array_unique($medz_arrs);
        }
       //dd($medz_arrs);
        return view('paper.index',['papers'=> $papers,'medz_arrs'=> $medz_arrs]);
    }

    public function sort()
    {
        $papers = Paper::all()->sortBy('plotis');
        $medz_arrs = [];
        foreach ($papers as $paper) {
            array_push($medz_arrs, $paper->medziaga);
            $medz_arrs = array_unique($medz_arrs);
        }

        $papers = Paper::where('medziaga','=',$_GET['medziaga'])->get()->sortBy('plotis');

        if ($_GET['medziaga'] == '0') {
            return redirect()->route('paper.index');
        }
        
        return view('paper.index',['papers'=> $papers,'medz_arrs'=> $medz_arrs]);
        //return redirect()->route('paper.index');
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
        $paper = new Paper();
        $paper->ilgis = $request->ilgis;
        $paper->plotis = $request->plotis;
        $paper->medziaga = strtoupper($request->medziaga);;
        $paper->klijai = $request->klijai;
        $paper->kiekis = $request->kiekis;
        $paper->save();

        $info = new Info();
        $info->kiekis = $paper->kiekis;
        $info->modifikuota = $paper->updated_at;
        $info->paper_id = $paper->id;
        $info->save();
        return redirect()->route('paper.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Paper  $paper
     * @return \Illuminate\Http\Response
     */
    public function show(Paper $paper)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Paper  $paper
     * @return \Illuminate\Http\Response
     */
    public function edit(Paper $paper)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Paper  $paper
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paper $paper)
    {
        $paper->id = $paper->id;
        $paper->ilgis = $request->ilgis;
        $paper->plotis = $request->plotis;
        $paper->medziaga = strtoupper($request->medziaga);;
        $paper->klijai = $request->klijai;
        $paper->kiekis = $request->kiekis;
        $paper->update();

        $info = new Info();
        $info->kiekis = $paper->kiekis;
        $info->modifikuota = $paper->updated_at;
        $info->paper_id = $paper->id;
        $info->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Paper  $paper
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paper $paper)
    {
        $paper->delete();
        return redirect()->back();
    }
}
