<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Pasta;
use App\Models\Playlist;
use Illuminate\Http\Request;
use Session;

class PastaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pasta = Playlist::simplepaginate(5);
        return view('playlist.index',array('pasta' => $pasta,'busca'=>null));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if ((Auth::check()) && (Auth::user()->isAdmin())) {
            return view('playlist.create');
        } else {
            return redirect('login');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ((Auth::check()) && (Auth::user()->isAdmin()) || (Auth::user()->isAdmin())) {
            $this->validate($request,[
                'nome' => 'required|min:3'
            ]);
            $pasta = new Pasta();
            $pasta->nome = $request->input('nome');
            $pasta->user_id = Auth::id();
            if($pasta->save()) {
                if($request->hasFile('foto')){
                    $imagem = $request->file('foto');
                    $nomearquivo = md5($pasta->id).".".$imagem->getClientOriginalExtension();
                    $request->file('foto')->move(public_path('.\img\livros'),$nomearquivo);
                }
                return redirect('playlist');
            }
        } else {
            return redirect('login');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pasta  $pasta
     * @return \Illuminate\Http\Response
     */
    public function show(Pasta $pasta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pasta  $pasta
     * @return \Illuminate\Http\Response
     */
    public function edit(Pasta $pasta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pasta  $pasta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pasta $pasta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ((Auth::check()) && (Auth::user()->isAdmin())) {
            $pasta = Playlist::find($id);
            if (isset($request->foto)) {
            unlink($request->foto);
            }
            $pasta->delete();
            Session::flash('mensagem','Pasta Excluído com Sucesso');
            return redirect(url('playlist/'));
        } else {
            return redirect('login');
        }
    }
}
