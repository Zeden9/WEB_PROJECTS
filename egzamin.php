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
    <form action="wynik.php" method="post">

        <div id="exam">
            <?php
                session_start();
                $c = mysqli_connect("localhost", "root", "", "egzamin");
                $pytanie = "SELECT id, tresc, punktacja FROM `pytania` ORDER BY RAND()";
                $resultPytanie = mysqli_query($c, $pytanie);
                $n = 0;
                
                $tresci = array("");
                $odpowiedzi = array("");
                while($rp = mysqli_fetch_row($resultPytanie)){
                    $id = $rp[0];
                    $n++;
                    $tresc = htmlspecialchars($rp[1]);
                    array_push($tresci, $tresc);
                    echo "
                        <div class='pytanie'>
                            <h4>$n.$tresc</h4>
                            <select name='pyt$n'>";
                    
                    $resultOdpowiedzi = mysqli_query($c, "SELECT id, tresc, poprawnosc, id_pytania FROM odpowiedzi WHERE id_pytania = $id ORDER BY RAND()");
                    while($ro = mysqli_fetch_row($resultOdpowiedzi)){
                        if($ro[2] == 1){
                            $popr = $rp[2];
                            $sumaPkt += $popr;
                            array_push($odpowiedzi, $ro[1]);
                        }
                        else $popr = 0;
                        $tresc = htmlspecialchars($ro[1]);
                        echo"<option value='$popr'>$tresc</option>";  
                        $j++;                          
                    }
                        
                    echo "</select></div>";

                }
                $_SESSION['questionCount'] = $n;
                $_SESSION['sumaPkt'] = $sumaPkt;
                $_SESSION['pytania'] = $tresci;
                $_SESSION['odpowiedzi'] = $odpowiedzi;
                mysqli_close($c);
            ?>
        </div>
        
        <button id="egzsubmit" name="check" value="submitted" type="submit">Zatwierdź odpowiedzi</button>
    </form>
</body>
</html>