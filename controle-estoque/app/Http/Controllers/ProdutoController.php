<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Produto;

class ProdutoController extends Controller
{
    public function index(){
        
        if(auth()->user() != null) return view('produto.index');
        else abort(403);
    }

    public function debitar(Request $request){

        if(auth()->user() != null){
            $produto = Produto::find($request->id);
            $produto->quantidade -= $request->quantidade;
            $produto->save();
            return redirect('/produtos');
        }
        else{
            abort(403);
        }
    }

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

    public function editar(Request $request){
        $produto = Produto::find($request->id);

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
