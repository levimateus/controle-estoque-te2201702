@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Páginas de fornecedores</h3>
    @foreach($fornecedores as $fornecedor)

	{{$fornecedor->nome}}<br>
	{{$fornecedor->cnpj}}<br>
	{{$fornecedor->endereco}}<br>

	@endforeach
</div>
@endsection
