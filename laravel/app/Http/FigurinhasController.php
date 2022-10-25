<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class FigurinhasController extends Controller {

    function index(){

        $figurinhas = DB::select('select * from figurinhas;');

        return view('figurinhas.index', ['figurinhas' => $figurinhas]);
    }

    function create(){

        return view('figurinhas.create');
    }

    public function insert(Request $form){

        $figurinhas = new Figurinhas();

        $validar = $form->validate([
            'nome' => 'required',
            'dt_nasc' => 'required',
            'foto' => 'required|mimes:jpg,jpeg,png',
            'naturalidade' => 'required'
        ]);

        $nomeFoto = uniqid() . '.' . $form->foto->extension();
        Storage::putFileAs('public/fotos', $form->foto, $nomeFoto);

        $figurinhas->nome = $form->nome;
        $figurinhas->dt_nasc = $form->dt_nasc;
        $figurinhas->foto = $nomeFoto;
        $figurinhas->naturalidade = $form->naturalidade;

        $figurinhas->save();

        return redirect()->route('figurinhas');
    }
    
    public function show(Figurinhas $figurinhas){

        return view('figurinhas.figurinha', ['figurinas' => $figurinhas]);
    }

    public function edit(Figurinhas $figurinhas){

        return view('figurinhas.editar', ['figurinhas' => $figurinhas]);
    }

    public function update(Figurinhas $figurinhas, Request $form){

        if(isset($form->foto)){
            $validarFoto = $form->validate([
                'foto' => 'mimes:jpg,jpeg,png'
            ]);
            Storage::delete('public/fotos/'.$figurinhas->foto);
            $nomeFoto = uniqid() . '.' . $form->foto->extension();
            Storage::putFileAs('public/fotos', $form->foto, $nomeFoto);
            
            $figurinhas->foto = $nomeFoto;
        }
        $validar = $form->validate([
            'nome' => 'required',
            'dt_nasc' => 'required',
            'nacionalidade' => 'required'
        ]);

        $figurinhas->nome = $form->nome;
        $figurinhas->dt_nasc = $form->dt_nasc;
        $figurinhas->nacionalidade = $form->nacionalidade;

        $figurinhas->save();

        return redirect()->route('figurinhas.show', ['figurinhas' => $figurinhas]);
    }

    public function apagar(Figurinhas $figurinhas){

        return view('figurinhas.apagar', ['figurinhas' => $figurinhas]);
    }
    
    public function delete(Figurinhas $figurinhas){

        Storage::delete('public/fotos/'.$figurinhas->foto);
        $figurinhas->delete();

        return redirect()->route('figurinhas');
    }

}
