<?php

namespace App\Http\Controllers;

use App\Http\Controllers\InfoController;
use App\Models\User;
use App\Models\Info;
use App\Models\Paper;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class PaperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $papers = Paper::all()->sortBy('medziaga');
        $klijai_arrs = [];
        $medz_arrs = [];
        foreach ($papers as $paper) {
            array_push($medz_arrs, $paper->medziaga);
            $medz_arrs = array_unique($medz_arrs);
            array_push($klijai_arrs, $paper->klijai);
            $klijai_arrs = array_unique($klijai_arrs);
        }
        return view('paper.index',['papers'=> $papers,'medz_arrs'=> $medz_arrs, 'klijai_arrs'=>$klijai_arrs]);
    }

    public function sort()
    {
        $papers = Paper::all()->sortBy('plotis');
        $medz_arrs = [];
        $klijai_arrs = [];
        foreach ($papers as $paper) {
            array_push($medz_arrs, $paper->medziaga);
            $medz_arrs = array_unique($medz_arrs);
            array_push($klijai_arrs, $paper->klijai);
            $klijai_arrs = array_unique($klijai_arrs);
        }
                
        $papers = Paper::where('medziaga','=',$_POST['medziaga'])->where('klijai','=',$_POST['klijai'])->get()->sortBy('plotis');

        if ($_POST['medziaga'] == '0' && $_POST['klijai'] == '0') {
            return redirect()->route('paper.index');
        }
        if (isset($_POST['medziaga']) && $_POST['klijai'] == '0') {
            $papers = Paper::where('medziaga','=',$_POST['medziaga'])->get()->sortBy('plotis');
            return view('paper.index',['papers'=> $papers,'medz_arrs'=> $medz_arrs,'klijai_arrs'=>$klijai_arrs]);
        }
        if (isset($_POST['klijai']) && $_POST['medziaga'] == '0') {
            $papers = Paper::where('klijai','=',$_POST['klijai'])->get()->sortBy('plotis');
            return view('paper.index',['papers'=> $papers,'medz_arrs'=> $medz_arrs,'klijai_arrs'=>$klijai_arrs]);
        }

        return view('paper.index',['papers'=> $papers,'medz_arrs'=> $medz_arrs,'klijai_arrs'=>$klijai_arrs]);
        //return redirect()->route('paper.index')->with(['papers'=> $papers,'medz_arrs'=> $medz_arrs]);
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
    {    //////validacija uzmirsta///////

        $papers = Paper::all();
        foreach ($papers as $paper) {
            if ($paper->ilgis==$request->ilgis &&
            $paper->plotis == $request->plotis &&
            $paper->medziaga == strtoupper($request->medziaga) &&
            $paper->klijai == $request->klijai
            ) {
                return redirect()->route('paper.index')->with('info_message','Toks popierius '.$paper->medziaga.' jau yra sandely');
            }
        }

        $validator = Validator::make($request->all(),
        [
            'ilgis' => ['required','integer','min:1','max:5000'],
            'plotis' => ['required','integer','min:1','max:500'],
            'medziaga' => ['required','min:1','max:64'],
            'klijai' => ['required','min:1','max:64'],
            'kiekis' => ['required','integer','min:0','max:1000'],
        ],
        [

            'ilgis.required' => 'Uzsakymo ilgis privalomas',
            'ilgis.integer' => 'Ilgis turi buti skaicius',
            'ilgis.min' => 'Ilgis negali buti mazesnis nei 1 metras',
            'ilgis.max' => 'Ilgis per didelis',

            'plotis.required' => 'Uzsakymo plotis privalomas',
            'plotis.integer' => 'Plotis turi buti skaicius',
            'plotis.min' => 'Plotis negali buti mazesnis nei 1 mm.',
            'plotis.max' => 'Plotis per didelis',

            'medziaga.required' => 'Uzsakymo medziaga privaloma',
            'medziaga.min' => 'Uzsakymo medziaga per trumpa',
            'medziaga.max' => 'Uzsakymo medziaga per ilga',

            'klijai.required' => 'Uzsakymo klijai privaloma',
            'klijai.min' => 'Uzsakymo klijai per trumpa',
            'klijai.max' => 'Uzsakymo klijai per ilga',


            'kiekis.required' => 'Uzsakymo kiekis privalomas',
            'kiekis.integer' => 'kiekis turi buti sveikas skaicius',
            'kiekis.min' => 'kiekis negali buti mazesnis nei 0',
            'kiekis.max' => 'kiekis per didelis',


        ]);
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        
        $paper = new Paper();
        $paper->ilgis = $request->ilgis;
        $paper->plotis = $request->plotis;
        $paper->medziaga = strtoupper($request->medziaga);
        $paper->klijai = $request->klijai;
        $paper->kiekis = $request->kiekis;






        $paper->save();
        
        return redirect()->route('paper.index')->with('success_message','Popierius'.$paper->medziaga.' idetas i sandeli');
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

        $validator = Validator::make($request->all(),
        [
            'ilgis' => ['required','integer','min:1','max:5000'],
            'plotis' => ['required','integer','min:1','max:500'],
            'medziaga' => ['required','min:1','max:64'],
            'klijai' => ['required','min:1','max:64'],
            'kiekis' => ['required','integer','min:0','max:1000'],
        ],
        [

            'ilgis.required' => 'Uzsakymo ilgis privalomas',
            'ilgis.integer' => 'Ilgis turi buti skaicius',
            'ilgis.min' => 'Ilgis negali buti mazesnis nei 1 metras',
            'ilgis.max' => 'Ilgis per didelis',

            'plotis.required' => 'Uzsakymo plotis privalomas',
            'plotis.integer' => 'Plotis turi buti skaicius',
            'plotis.min' => 'Plotis negali buti mazesnis nei 1 mm.',
            'plotis.max' => 'Plotis per didelis',

            'medziaga.required' => 'Uzsakymo medziaga privaloma',
            'medziaga.min' => 'Uzsakymo medziaga per trumpa',
            'medziaga.max' => 'Uzsakymo medziaga per ilga',

            'klijai.required' => 'Uzsakymo klijai privaloma',
            'klijai.min' => 'Uzsakymo klijai per trumpa',
            'klijai.max' => 'Uzsakymo klijai per ilga',


            'kiekis.required' => 'Uzsakymo kiekis privalomas',
            'kiekis.integer' => 'kiekis turi buti sveikas skaicius',
            'kiekis.min' => 'kiekis negali buti mazesnis nei 0',
            'kiekis.max' => 'kiekis per didelis',


        ]);
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

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
        $info->user_name = auth()->user()->name;
        $info->save();
        return redirect()->route('paper.index');
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
