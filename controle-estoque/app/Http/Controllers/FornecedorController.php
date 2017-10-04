<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Fornecedor;
use Illuminate\Support\Facades\DB;

class FornecedorController extends Controller
{
    public function index(){
        parent::validaLogin();
        $fornecedores = Fornecedor::all();
        return view('fornecedor.index', compact('fornecedores'));
    }

    public function store(Request $request){
        parent::validaLogin();
        $fornecedor = new Fornecedor;
        $fornecedor->nome = $request->nome;
        $fornecedor->endereco = $request->endereco;
        $fornecedor->cnpj = $request->cnpj;
        $fornecedor->save();
        return redirect('/');
    }

    public function editar(Request $request){
        parent::validaLogin();
        $fornecedor = Fornecedor::find($request->id)->first();
        $fornecedor->nome = $request->nome;
        $fornecedor->cnpj = $request->cnpj;
        $fornecedor->endereco = $request->endereco;
        $fornecedor->save();
        return redirect('/produtos');
    }

    public function buscar(Request $request){
        parent::validaLogin();
        $fornecedor = DB::select('select * from fornecedores where nome = ?', [$request->nome]);
        return view('fornecedor.pesquisa', compact('fornecedor'));    
    }

    public function deletar(Request $request){
        parent::validaLogin();
        $fornecedor = Fornecedor::find($request->id)->first();
        $fornecedor->delete();
        return redirect('/fornecedores');
    }
}