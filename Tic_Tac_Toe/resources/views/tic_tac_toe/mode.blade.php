<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mode de jeu – Tic Tac Toe</title>
    @vite(['resources/css/app.css'])
</head>
<body>

    <h1 class="ttt-title">Tic Tac Toe</h1>

    <div class="ttt-mode-card">
        <h2 class="ttt-mode-subtitle">Choisissez votre mode</h2>

        <form action="{{ route('jeu.mode') }}" method="POST" class="ttt-mode-form">
            @csrf

            <div class="ttt-field">
                <label class="ttt-label" for="mode">Mode de jeu</label>
                <div class="ttt-select-wrap">
                    <select class="ttt-select" name="mode" id="mode">
                        <option value="1">👤 1 Joueur (vs IA)</option>
                        <option value="2">👥 2 Joueurs</option>
                    </select>
                </div>
            </div>

            <div class="ttt-field">
                <label class="ttt-label" for="dernier_signe">Votre signe</label>
                <div class="ttt-sign-group">
                    <label class="ttt-sign-option">
                        <input type="radio" name="dernier_signe" value="X" checked>
                        <span class="ttt-sign mark-x">X</span>
                    </label>
                    <label class="ttt-sign-option">
                        <input type="radio" name="dernier_signe" value="O">
                        <span class="ttt-sign mark-o">O</span>
                    </label>
                </div>
            </div>

            <div class="ttt-reset">
                <button type="submit">Jouer →</button>
            </div>
        </form>
    </div>

</body>
</html>