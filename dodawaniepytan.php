<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodawanie pytań</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Dodawanie pytań</h1>
    <div id="form">
        <form action="" method="post">
            <div id="pytania">
                <label for="tresc">Treść pytania:</label><br>
                <textarea name="tresc" id="tresc" required rows="5" cols="50"></textarea><br><br>
            </div>
            <div id="odpowiedzi">
                <div>
                    <label for="odpA">Odpowiedź A:</label><br>
                    <textarea type="text" name="odpA" id="odpA" required rows="5" cols="30"></textarea>
                </div>
                <div>
                    <label for="odpB">Odpowiedź B:</label><br>
                    <textarea type="text" name="odpB" id="odpB" required rows="5" cols="30"></textarea> 
                </div>
                <div>    
                    <label for="odpC">Odpowiedź C:</label><br>
                    <textarea type="text" name="odpC" id="odpC" required rows="5" cols="30"></textarea>
                </div>
                <div>    
                    <label for="odpD">Odpowiedź D:</label><br>
                    <textarea type="text" name="odpD" id="odpD" required rows="5" cols="30"></textarea>
                </div>
            </div><br>
            <div id="odpSettings">
                <label for="prawidlowa">Prawidłowa odpowiedź:</label>
                <select name="prawidlowa" id="prawidlowa">
                    <option value="0" id="">Odpowiedź A</option>
                    <option value="1">Odpowiedź B</option>
                    <option value="2">Odpowiedź C</option>
                    <option value="3">Odpowiedź D</option>
                </select>
                <br>
                <label for="ptk">Ilość punktów:</label>
                <select name="pkt" id="pkt">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
            <div id="przyciski">
                <button id="egzsubmit" type="submit">Zatwierdź</button>
                <button id="egzreset" type="reset">Wyczyść</button>
            </div>
        </form>
    </div>

    <?php
        if(isset($_POST['odpA'])){
            $odpowiedzi = array();
            $poprawnosc = array(0,0,0,0);
            $trescPytania = $_POST['tresc'];

            array_push($odpowiedzi, $_POST['odpA'], $_POST['odpB'], $_POST['odpC'], $_POST['odpD']);
            
            $poprawnosc[$_POST['prawidlowa']] = 1;
            $punktacja = $_POST['pkt'];
            
            $c = mysqli_connect("localhost", "root", "", "egzamin");

            mysqli_query($c, "INSERT INTO `pytania`(`id`, `tresc`, `punktacja`) VALUES (NULL,'$trescPytania','$punktacja')");
            $pytanie = mysqli_query($c, "SELECT MAX(id) FROM pytania;");
            $r = mysqli_fetch_array($pytanie);
            $idPytania = $r[0];

            for($i = 0; $i < 4; $i++){
                $poprawna = $poprawnosc[$i];
                $odpowiedz = $odpowiedzi[$i];
                
                mysqli_query($c, "INSERT INTO `odpowiedzi`(`id`, `id_pytania`, `tresc`, `poprawnosc`) VALUES (NULL, '$idPytania','$odpowiedz','$poprawna')");
            }
            
            mysqli_close($c);
            
        }
    ?>
</body>
</html>