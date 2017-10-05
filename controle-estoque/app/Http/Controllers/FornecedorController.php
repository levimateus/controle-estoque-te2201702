<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Fornecedor;
use App\Produto;
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
        return redirect('/fornecedor');
    }

    public function editar(Request $request){
        parent::validaLogin();
        $fornecedor = Fornecedor::find($request->id)->first();
        $fornecedor->nome = $request->nome;
        $fornecedor->cnpj = $request->cnpj;
        $fornecedor->endereco = $request->endereco;
        $fornecedor->save();
        return redirect('/fornecedor');
    }

    public function buscar(Request $request){
        parent::validaLogin();
        $fornecedor = DB::select('select * from fornecedores where nome like ?', ['%'.$request->nome.'%']);
        return view('fornecedor.pesquisa', compact('fornecedor'));    
    }

    public function deletar(Request $request){
        parent::validaLogin();
        $fornecedor = Fornecedor::where('id', $request->id)->first();
        $produtos = DB::select('select * from produtos where fornecedor_id = ?', [$request->id]);
        if(isset($produtos[0]->id)){
            return redirect('/fornecedor');
        }else{
            $fornecedor->delete();
            return redirect('/fornecedor');
        }
        
        
    }
}