<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EkskulRequest;
use App\Ekskul;
use Session;

class EkskulController extends Controller
{ 
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $ekskul_list = Ekskul::all();
        return view('ekskul.index', compact('ekskul_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ekskul.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EkskulRequest $request)
    {
        Ekskul::create($request->all());
        Session::flash('flash_message', 'Data ekskul telah berhasil disimpan.');
        return redirect('ekskul');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ekskul  $ekskul
     * @return \Illuminate\Http\Response
     */
    public function show(Ekskul $ekskul)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ekskul  $ekskul
     * @return \Illuminate\Http\Response
     */
    public function edit(Ekskul $ekskul)
    {
        return view('ekskul.edit', compact('ekskul'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ekskul  $ekskul
     * @return \Illuminate\Http\Response
     */
    public function update(EkskulRequest $request, Ekskul $ekskul)
    {
        $ekskul->update($request->all());
        Session::flash('flash_message', 'Data ekskul telah berhasil diupdate.');
        return redirect('ekskul');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ekskul  $ekskul
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ekskul $ekskul)
    {
        $ekskul->delete();
        Session::flash('flash_message', 'Data '.$ekskul->nama_ekskul.' telah berhasil dihapus.');
        Session::flash('penting', true);
        return redirect('ekskul');
    }
}
