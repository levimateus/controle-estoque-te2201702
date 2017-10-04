@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Páginas de produtos</h3>
    @foreach($produtos as $produto)

	{{$produto->nome}}<br>
	{{$produto->descricao}}<br>
	{{$produto->custo}}<br>
	{{$produto->quantidade}}<br>

	@endforeach
</div>
@endsection
