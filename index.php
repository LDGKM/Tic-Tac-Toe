<?php
session_start();

if(!isset($_SESSION["grille"])){
    $_SESSION["grille"] = [
        ["","",""],
        ["","",""],
        ["","",""]
    ];
}

if(!isset($_SESSION["joueur"])){
    $_SESSION["joueur"] = 'X';
}

if(!isset($_SESSION['session'])){
    $_SESSION['etat'] = 'en cours';
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['caseJoue'])){
            $position= explode('-',$_POST['caseJoue']);
            $_SESSION['grille'][$position[0]][$position[1]]=$_SESSION['joueur'];
            $_SESSION["joueur"]=($_SESSION["joueur"] == 'X')? 'O':'X';
        }

        if(isset($_POST['reset'])){
            $_SESSION["grille"] = [
                ["","",""],
                ["","",""],
                ["","",""]
            ];
        }
}

function determinerEtat($tab){
    $n = count($tab);
    
    if(estVictoire($tab)){
        return ['or','Victoire'];
    }
    
    for($i = 0; $i < $n; $i++){
        for($j = 0; $j < $n; $j++){
            if(trim($tab[$i][$j]) == ''){
                return ['vert','En cours'];
            }
        }    
    }
    
    return ['marron','Egalité'];
}




function estVictoire($tab) {
    $n = count($tab);

    
    return false;
}


?>

<!DOCTYPE Html>
<html lang="fr">
    <head>
        <title>Tic Tac Toe</title>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>     

        <form action="" method="post">
            <p class=<?=determinerEtat($_SESSION['grille'])[0]?>>Etat de la partie en cours: <?= determinerEtat($_SESSION['grille'])[1]?></p>
            <table>
                <?php
                    for($i = 0; $i < 3; $i++){
                        echo "<tr>";
                        for($j = 0; $j < 3; $j++){
                            echo "<td>";
                            if($_SESSION["grille"][$i][$j]==""){
                            echo "<button type='submit' name='caseJoue' value='$i-$j'></button>";
                            }
                            else{
                                echo $_SESSION["grille"][$i][$j];
                            }
                            echo "</td>";
                        }
                        echo "</tr>";
                    }
                ?>
            </table>
            
            <button type="submit" name="reset">Recommencer</button>
        </form>
    </body>
</html>