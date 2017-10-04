@foreach($produtos as $produto)
	{{$produto->nome}}<br>
	{{$produto->descricao}}<br>
	{{$produto->custo}}<br>
	{{$produto->quantidade}}<br>
@endforeach