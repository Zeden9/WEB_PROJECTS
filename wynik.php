<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wynik</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
        if(isset($_POST['check'])){    
            session_start();
            $n = $_SESSION['questionCount'];
            $sumaPkt = $_SESSION['sumaPkt'];
            $tresci = $_SESSION['pytania'];
            $odpowiedzi = $_SESSION['odpowiedzi'];
            $sumaOdp = $n+1;
            $zdobytePkt = 0;
            $wrong = array();
            for($i = 1; $sumaOdp != $i; $i++ ){
                $pytanie = "pyt".$i;
                $zdobytePkt += $_POST[$pytanie];
                if($_POST[$pytanie] == 0) array_push($wrong, $i);
            } 
            echo"
            <div id='summary'>Zdobyte punkty: $zdobytePkt/$sumaPkt </br>
            ";
            $wynik = $zdobytePkt/$sumaPkt*100;
            $wynik = number_format($wynik, 2);
            echo "<p>";
                if($wynik >= 50){
                    echo "Gratulacje, zdałeś egzamin z wynikiem $wynik%";
                }
                else echo "Niestety, nie udało Ci się zdać egzaminu. Twój wynik to $wynik%</div>";
                foreach($wrong as $i){
                    if($_POST[$pytanie] == 0){
                        $tresc = $tresci[$i];
                        $odp = $odpowiedzi[$i];
                        
                        echo "<div class='wrong'>
                        
                        <p style='color:white;'>Pytanie $i o treści <b>$tresc</b> zostało wykonanie błędnie</br>
                        Wybrana odpowiedź: 
                        Prawidłowa odpowiedź: <b>$odp</b>
                        </p></div>";
                    }
                } 

            echo "<div id='summary'><a href='egzamin.php'><button id='retry'>Wykonaj egzamin ponownie</button></a></div>";
        }
        else{
            echo "<div id='summary'>Nie wykonano testu.</div>";
        }
    ?>
</body>
</html>
