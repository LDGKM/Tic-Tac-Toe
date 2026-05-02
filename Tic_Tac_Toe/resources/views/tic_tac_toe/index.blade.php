<!DOCTYPE html>
<html>

<style>
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
</style>


<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Tic Tac Toe</title>
</head>
<body>
	@if($gagne != 'Victoire')
	<p>{{ $gagne }}</p>
	<table>
		@for($i=0;$i<3;$i++)
		<tr>
		@foreach($case[$i] as $key=>$value)
			<td>
				@if(!$value[0])
				<form action="{{ route('jeu.marquer') }}" method="POST">
				@csrf
				<a href=>
					<button type="submit" name="case" value="{{ $key }}">
					</button>
				</a>
				@else
				<p>{{$value[1]}}</p>
				@endif
				</form>
			</td>
		
		@endforeach
		</tr>
		@endfor
	</table>
	@else
	<p>{{ $gagne }}</p>
	@endif

	<form action="{{ route('jeu.reinitialiser') }}" method="POST">
		@csrf
		<button type="submit">Reinitialiser</button>
	</form>

</body>
</html>