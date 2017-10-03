<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Fornecedor;

class FornecedorController extends Controller
{
    public function index(){
        
        if(auth()->user() != null) return view('fornecedor.index');
        else abort(403);
    }

    public function store(Request $request){
    	$fornecedor = new Fornecedor;

    	if(auth()->user() != null){
    		$fornecedor->nome = $request->nome;
	    	$fornecedor->endereco = $request->endereco;
	    	$fornecedor->cnpj = $request->cnpj;

	    	$fornecedor->save();
    		
    		return redirect('/');
    	}
    	else{
    		abort(403);
    	}

    }

    
}