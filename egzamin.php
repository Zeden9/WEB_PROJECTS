<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <link rel="stylesheet" href="style.css">
    <script src="main.js"></script>
</head>
<body>
    <form action="" method="post">

        <div id="exam">
            <?php
                $c = mysqli_connect("localhost", "root", "", "egzamin");
                $pytanie = "SELECT id, tresc, punktacja FROM `pytania` ORDER BY RAND()";
                $resultPytanie = mysqli_query($c, $pytanie);
                $n = 0;

                while($rp = mysqli_fetch_row($resultPytanie)){
                    $id = $rp[0];
                    $n++;
                    echo "
                        <div class='pytanie'>
                            <h4>$n.$rp[1] id:$id</h4>
                            <select name='pyt$n'>";
                    
                    $resultOdpowiedzi = mysqli_query($c, "SELECT id, tresc, poprawnosc, id_pytania FROM odpowiedzi WHERE id_pytania = $id ORDER BY RAND()");
                    while($ro = mysqli_fetch_row($resultOdpowiedzi)){
                        if($ro[2] == 1){
                            $popr = $rp[2];
                            $sumaPkt += $popr;
                        }
                        else $popr = 0;

                        echo"<option value='$popr'>$ro[1] $popr</option>";                            
                    }
                        
                    echo "</select></div>";

                }
            ?>
        </div>
        <button id="egzsubmit" name="check" value="submitted" type="submit">Zatwierdź odpowiedzi</button>
        <button id="egzreset" type="reload">Zresetuj egzamin</button>
        
    </form>

    <?php
        if(isset($_POST['check'])){
            $sumaOdp = $n+1;
            $zdobytePkt = 0;
            for($i = 1; $sumaOdp != $i; $i++ ){
                $pytanie = "pyt".$i;
                $zdobytePkt += $_POST[$pytanie];
            } 
            echo"
            <div id='summary'>Zdobyte punkty: $zdobytePkt/$sumaPkt </br>
            ";
            $wynik = $zdobytePkt/$sumaPkt*100;
            $wynik = number_format($wynik, 2);
                if($wynik >= 50){
                    echo "Gratulacje, zdałeś egzamin z wynikiem $wynik%";
                }
                else echo "Niestety, nie udało Ci się zdać egzaminu. Twój wynik to $wynik%";

            echo "</div>";
        };
    ?>
</body>
</html>