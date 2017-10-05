@extends('layouts.app')
@section('pageTitle', 'Gerenciar produtos')
@section('content')
<div class="container">

	<div class="row">
	<h3 style="float: left; margin-top: 8px">
		Gerenciar produtos:
	</h3>	
	<button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#novo_produto" href="" style="float: right; margin-bottom: 6px">
		<i class="fa fa-plus" aria-hidden="true"></i>
	</button>
	<a href="/produto" style="float: right; margin-right: 6px; margin-bottom: 10px">
		<button class="btn btn-primary btn-lg" >
			<i class="fa fa-refresh" aria-hidden="true"></i>
		</button>
	</a>
	
	</div>
    <div class="row">
	<div class="input-group">
		<input type="text" class="form-control" placeholder="Procursr...">
		<span class="input-group-btn">
			<form action="">
				{{ csrf_field()}}
				<input type="submit" class="btn btn-default" type="button" value="Pesquisar">
			</form>

		</span>
	</div>
		<table class="table">
			<tr>
				<th>Nome</th>
				<th>Descrição</th>
				<th>Custo</th>
				<th>Quantidade</th>
				<th colspan="3">Ações</th>
			</tr>
			@foreach($produtos as $produto)
			<tr>
				<td>{{$produto->nome}}</td>
				<td>{{$produto->descricao}}</td>
				<td>R${{$produto->custo}}</td>
				<td>{{$produto->quantidade}}</td>
				<td>
					<form action="#">
					{{ csrf_field() }}
						<input type="hidden" value="{{$produto->id}}">
						<input type="submit" value="Dar baixa" class="btn btn-info">
					</form>
				</td>
				<td>
					<form action="#">
					{{ csrf_field() }}
						<input type="hidden" value="{{$produto->id}}">
						<input type="submit" value="Editar" class="btn btn-warning">
					</form>
				</td>
				<td>
					<form action="#">
					{{ csrf_field() }}
						<input type="hidden" value="{{$produto->id}}">
						<input type="submit" value="Deletar" class="btn btn-danger">
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
					<h3 class="modal-title" id="myModalLabel">Cadastrar novo produto</h3>
				</div>
				<form action="produto/inserir" method="post">
				{{ csrf_field() }}
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
							<select name="fornecedor" class="form-control">
								<option value="" selected>Selecione</option>

								@foreach($fornecedores as $fornecedor)
								<option value="{{$fornecedor->id}}">
									{{$fornecedor->nome}} ({{$fornecedor->cnpj}})
								</option>
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

	<div class="modal fade" id="novo_produto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h3 class="modal-title" id="myModalLabel">Editar produto</h3>
				</div>
				<form action="produto/editar" method="post">
				{{ csrf_field() }}
					<div class="modal-body">
						<div class="form-group">
							<input type="hidden" name="id" value="">
							<label>Nome</label>
							<input type="text" name="nome" class="form-control" placeholder="Nome" autofocus>
							<label>Descrição</label>
							<input type="text" name="descricao" class="form-control" placeholder="Descrição">
							<label>Custo</label>
							<input type="text" name="custo" class="form-control" placeholder="Custo">
							<label>Quantidade</label>
							<input type="number" name="quantidade" min="0" class="form-control">
							<label>Fornecedor</label>
							<select name="fornecedor" class="form-control">
								<option value="" selected>Selecione</option>

								@foreach($fornecedores as $fornecedor)
								<option value="{{$fornecedor->id}}">
									{{$fornecedor->nome}} ({{$fornecedor->cnpj}})
								</option>
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
