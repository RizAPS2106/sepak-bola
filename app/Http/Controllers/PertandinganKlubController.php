<?php

namespace App\Http\Controllers;

use App\Models\Klub;
use App\Models\Pertandingan;
use Illuminate\Http\Request;

use App\Models\PertandinganKlub;
use Illuminate\Support\Facades\DB;

class PertandinganKlubController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $klub = new Klub();
        $klubData = $klub->all();

        return view('tambahpertandingan')->with('klubData', $klubData);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $klub = new Klub();
        $klubData = $klub->all();

        Pertandingan::create();

        $latest_pertandingan = Pertandingan::latest()->first();

        $latest_pertandingan_id = $latest_pertandingan;

        $pertandinganStore1 = $request->validate([
            'klub1' => 'required',
            'skor1' => 'required'
        ]);

        $pertandinganStore2 = $request->validate([
            'klub2' => 'required',
            'skor2' => 'required'
        ]);

        $pertandingans = PertandinganKlub::all();

        $matchEver = 0;

        foreach ($pertandingans as $pertandingan) {
            $matched1 = DB::table('pertandingan_klubs')
                ->select('*')
                ->where([['klub_id', $request->klub1], ['pertandingan_id', $pertandingan->pertandingan_id]])
                ->get();

            $matched2 = DB::table('pertandingan_klubs')
                ->select('*')
                ->where([['klub_id', $request->klub2], ['pertandingan_id', $pertandingan->pertandingan_id]])
                ->get();

            if (count($matched1) > 0 && count($matched2) > 0) {
                $matchEver += 1;
            }
        }

        if ($request->klub1 === $request->klub2) {
            return view('tambahpertandingan', ['error' => 'Harap pilih tim lain', 'klubData' => $klubData]);
        } else if ($matchEver > 1) {
            return view('tambahpertandingan', ['error' => 'Pertandingan sudah ada', 'klubData' => $klubData]);
        } else {
            $status1 = '';
            $status2 = '';
            if ($request->skor1 > $request->skor2) {
                $status1 = 'menang';
                $status2 = 'kalah';
            } else if ($request->skor1 < $request->skor2) {
                $status2 = 'menang';
                $status1 = 'kalah';
            } else {
                $status2 = 'seri';
                $status1 = 'seri';
            }
            PertandinganKlub::create([
                'klub_id' => $request->klub1,
                'gol' => $request->skor1,
                'bobol' => $request->skor2,
                'status' => $status1,
                'pertandingan_id' => $latest_pertandingan->id
            ]);
            PertandinganKlub::create([
                'klub_id' => $request->klub2,
                'gol' => $request->skor2,
                'bobol' => $request->skor1,
                'status' => $status2,
                'pertandingan_id' => $latest_pertandingan->id
            ]);

            return redirect('/')->with('completed', 'Klub telah tersimpan!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PertandinganKlub  $PertandinganKlub
     * @return \Illuminate\Http\Response
     */
    public function show(PertandinganKlub $PertandinganKlub)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PertandinganKlub  $PertandinganKlub
     * @return \Illuminate\Http\Response
     */
    public function edit(PertandinganKlub $PertandinganKlub)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PertandinganKlub  $PertandinganKlub
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PertandinganKlub $PertandinganKlub)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PertandinganKlub  $PertandinganKlub
     * @return \Illuminate\Http\Response
     */
    public function destroy(PertandinganKlub $PertandinganKlub)
    {
        //
    }
}
