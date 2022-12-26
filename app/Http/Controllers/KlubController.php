<?php

namespace App\Http\Controllers;

use App\Models\klub;
use Illuminate\Http\Request;
use App\Models\PertandinganKlub;
use App\Models\Klub as ModelsKlub;
use Illuminate\Support\Facades\DB;

class KlubController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $klub = new ModelsKlub();

        $klubData = $klub->all();

        $pertandingan = new PertandinganKlub();

        $pertandinganData = $pertandingan
            ->selectRaw('*, count(*) as totalMatch, sum(gol) as totalGol, sum(bobol) as totalBobol')
            ->groupBy('klub_id')
            ->get();

        foreach ($pertandinganData as $data) {
            $dataMenangs = DB::table('pertandingan_klubs')
                ->select('*')
                ->groupBy('klub_id')
                ->where('status', 'menang')
                ->get();
            $dataSeris = DB::table('pertandingan_klubs')
                ->select('*')
                ->groupBy('klub_id')
                ->where('status', 'seri')
                ->get();
            $dataKalahs = DB::table('pertandingan_klubs')
                ->select('*')
                ->groupBy('klub_id')
                ->where('status', 'kalah')
                ->get();

            $pertandinganData->total_menang = count($dataMenangs);
            $pertandinganData->total_seri = count($dataSeris);
            $pertandinganData->total_kalah = count($dataKalahs);
        }

        return view('home', ['klubData' => $klubData, 'pertandinganData' => $pertandinganData]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tambahklub');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $storeData = $request->validate([
            'nama' => 'required|unique:klubs',
            'kota' => 'required|unique:klubs',
        ]);

        ModelsKlub::create($storeData);

        return redirect('/')->with('completed', 'Klub telah tersimpan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\klub  $klub
     * @return \Illuminate\Http\Response
     */
    public function show(klub $klub)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\klub  $klub
     * @return \Illuminate\Http\Response
     */
    public function edit(klub $klub)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\klub  $klub
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, klub $klub)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\klub  $klub
     * @return \Illuminate\Http\Response
     */
    public function destroy(klub $klub)
    {
        //
    }
}
