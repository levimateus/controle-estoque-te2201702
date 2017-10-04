@extends('layouts.app')
@section('pageTitle', 'Gerenciar produtos')
@section('content')
<div class="container">
    <h2>Gerenciar produtos</h2>

	<div class="row">
	<h3 style="float: left; line-height: 18px">Produtos:</h3>
	<button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#novo_produto" href="" style="float: right; margin-bottom: 6px">
		<i class="fa fa-plus" aria-hidden="true"></i>
	</button>
	<a href="/produto" style="float: right; margin-right: 6px; margin-bottom: 6px">
		<button class="btn btn-primary btn-lg" >
			<i class="fa fa-refresh" aria-hidden="true">
			</i>
		</button>
	</a>
	</div>
    <div class="row">
		<table class="table">
			<tr>
				<th>Nome</th>
				<th>Descrição</th>
				<th>Custo</th>
				<th>Quantidade</th>
				<th colspan="2">Ações</th>
			</tr>
			@foreach($produtos as $produto)
			<tr>
				<td>{{$produto->nome}}</td>
				<td>{{$produto->descricao}}</td>
				<td>{{$produto->custo}}</td>
				<td>{{$produto->quantidade}}</td>
				<td>
					<form action="#">
						<input type="hidden" value="{{$produto->id}}">
						<input type="submit" value="Editar">
					</form>
				</td>
				<td>
					<form action="#">
						<input type="hidden" value="{{$produto->id}}">
						<input type="submit" value="Deletar">
					</form>
				</td>
			</tr>
			@endforeach
		</table>
	</div>

	<div class="modal fade" id="novo_produto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Novo produto</h4>
				</div>
				<form action="produto/inserir" method="post">
					<div class="modal-body">
						<div class="form-group">
							<label>Nome</label>
							<input type="text" name="nome" class="form-control" placeholder="Nome" autofocus>
							<label>Descrição</label>
							<input type="text" name="descricao" class="form-control" placeholder="Descrição">
							<label>Custo</label>
							<input type="text" name="custo" class="form-control" placeholder="Custo">
							<label>Quantidade</label>
							<input type="number" name="quantidade" min="0" class="form-control">
							<label>Fornecedor</label>
							<select name="cars" name="fornecedor" class="form-control">
								@foreach($fornecedores as $fornecedor)
								<option value="{{$fornecedor->id}}">{{$fornecedor->nome}} ({{$fornecedor->cnpj}})</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
						<input type="submit" class="btn btn-primary" value="Confirmar">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
