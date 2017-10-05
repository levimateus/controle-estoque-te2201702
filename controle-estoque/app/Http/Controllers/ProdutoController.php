<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Produto;
use App\Fornecedor;
use Illuminate\Support\Facades\DB;

class ProdutoController extends Controller
{
    public function index(){
        parent::validaLogin();
        $produtos = Produto::all();
        $fornecedores = Fornecedor::orderBy('nome', 'DESC')->get();
        return view('produto.index', compact('produtos', 'fornecedores'));
    }
    
    public function buscar(Request $request){
        parent::validaLogin();
        $produto = DB::select('select * from produtos where nome like ?', ['%'.$request->nome.'%']);
        return view('produto.pesquisa', compact('produto'));
    }

    public function debitar(Request $request){
        parent::validaLogin();
        $produto = Produto::find($request->id);
        $produto->quantidade -= $request->quantidade;
        $produto->save();
        return redirect('/produto');
    }

    public function store(Request $request){
        parent::validaLogin();
        $produto = new Produto;
        $produto->nome = $request->nome;
        $produto->descricao = $request->descricao;
        $produto->custo = $request->custo;
        $produto->quantidade = $request->quantidade;
        $produto->fornecedor_id = $request->fornecedor;
        $produto->save();
        return redirect('/produto');
    }

    public function editar(Request $request){
        parent::validaLogin();
        $produto = Produto::find($request->id);
        $produto->nome = $request->nome;
        $produto->descricao = $request->descricao;
        $produto->custo = $request->custo;
        $produto->quantidade = $request->quantidade;
        $produto->fornecedor_id = $request->fornecedor;
        $produto->save();
        return redirect('/produto');
    }

    public function listarPorFornecedor($id){
        parent::validaLogin();
        $produtos = DB::select('select * from produtos where fornecedor_id = ?', [$id]);
        return view('teste', compact('produtos'));
    }
}
