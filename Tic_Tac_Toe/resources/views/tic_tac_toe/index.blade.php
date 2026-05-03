<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tic Tac Toe</title>
    @vite(['resources/css/app.css'])
</head>
<body>

    <h1 class="ttt-title">Tic Tac Toe</h1>


    <p class="ttt-status {{ str_contains($gagne,'Victoire') ? 'victoire' : '' }}">
        {{ $gagne }}
    </p>

    @if(!str_contains($gagne,"Victoire"))
    <div class="ttt-scene">
        <table class="ttt-board">
            @for($i = 0; $i < 3; $i++)
            <tr>
                @foreach($case[$i] as $key => $value)
                <td>
                    @if(!$value[0])
                        <form action="{{ route('jeu.marquer') }}" method="POST">
                            @csrf
                            <button type="submit" name="case" value="{{ $key }}"></button>
                        </form>
                    @else
                        <p class="mark-{{ strtolower($value[1]) }}">{{ $value[1] }}</p>
                    @endif
                </td>
                @endforeach
            </tr>
            @endfor
        </table>
    </div>
    @endif

    <div class="ttt-reset">
        <form action="{{ route('jeu.reinitialiser') }}" method="POST">
            @csrf
            <button type="submit">↺ Réinitialiser</button>
        </form>
        <a href="{{ route('jeu.depart') }}">
            <button>Changer Mode</button>
        </a>
    </div>

</body>
</html>