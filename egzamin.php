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
        <!-- <div class="pytanie">
            <h3>Treść pytania</h3>
            <button type="button" onclick="check(id); this.onclick=null" id="A" class="answer" name="">Odpowiedz</button><br>
            <button type="button" onclick="" id="B" class="answer" name="">Odpowiedz</button><br>
            <button type="button" onclick="" id="C" class="answer" name="">Odpowiedz</button><br>
            <button type="button" onclick="" id="D" class="answer" name="">Odpowiedz</button><br>
        </div> -->
        <div id="exam">
            <?php
                $c = mysqli_connect("localhost", "root", "", "egzamin");
                $q = "SELECT pytania.id, pytania.tresc, pytania.punktacja, odpowiedzi.tresc, odpowiedzi.poprawnosc, odpowiedzi.id_pytania FROM `pytania` JOIN odpowiedzi ON pytania.id = odpowiedzi.id_pytania";
                $pytanie = "SELECT id, tresc, punktacja FROM `pytania`";
                $resultPytanie = mysqli_query($c, $pytanie);
                $n = 1;

                while($rp = mysqli_fetch_row($resultPytanie)){
                    $n = 1;
                    $id = $rp[0];
                    echo "
                        <div class='pytanie'>
                            <h4>$n.$rp[1] id:$id</h4>
                            <select>";
                        $n++;
                        $resultOdpowiedzi = mysqli_query($c, "SELECT id, tresc, poprawnosc, id_pytania FROM odpowiedzi WHERE id_pytania = $id");
                        while($ro = mysqli_fetch_row($resultOdpowiedzi)){
                            echo"<option value='$ro[2]'>$ro[1]</option>";                            
                        }
                        
                        echo "</select></div>";

                }

                // while($rp = mysqli_fetch_row($resultPytanie)){    
                //     $i = 0;
                //     echo "<div class='pytanie'>
                //     <h4>$n.$rp[0]:</h4>
                //     <select>";
                //     $n++;
                //     while($ro = mysqli_fetch_row($resultOdpowiedzi)){ 
                //         $i++;
                //         echo"<option value='$ro[1]'>$ro[0]</option>";
                //         if($i==4) break; 
                //     }
                //     echo"</select></div>";
                // }
            ?>
        </div>
        <button class ="egzbutton" id="egzsubmit" type="submit">Zatwierdź odpowiedzi</button>
        <button class ="egzbutton" id="egzreset" type="reset">Zresetuj egzamin</button>
    </form>
</body>
</html>