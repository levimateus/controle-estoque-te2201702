<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Produto;

class ProdutoController extends Controller
{
    public function store(Request $request){
    	$produto = new Produto;

    	if(auth()->user() != null){
    		$produto->nome = $request->nome;
    		$produto->descricao = $request->descricao;
    		$produto->custo = $request->custo;
    		$produto->quantidade = $request->quantidade;
    		$produto->fornecedor_id = $request->fornecedor;
	    	

	    	$produto->save();
    		
    		return redirect('/');
    	}
    	else{
    		abort(403);
    	}

    }
}
