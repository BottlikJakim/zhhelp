<?php
if (isset($_GET["uj"])){
    require 'gydb.php';
    if(isset($_GET["fizetes"]) && isset($_GET["nev"])){
        $link = getDB();
        $nev = mysqli_real_escape_string($link, $_GET["nev"]);
        $kor = mysqli_real_escape_string($link, $_GET["fizetes"]);
        $query = sprintf("INSERT INTO feltolto (fizetes, nev) VALUES ('%s','%s');",$_GET["fizetes"],$_GET["nev"]);
        mysqli_query($link,$query);
        mysqli_close($link);
    }
}
?>

<!DOCTYPE html>     
<html>
    <head><title>Feltöltő</title></head>
    <body>
        <form action = "zhgy_insert.php" method = "get">
            <label for = "neve"> Az eladó neve:</label>
            <input id = "neve" type = "text" name = "nev"/><br/>
            <label for = "payment"> Az eladó fizetése:</label>
            <input id = "payment" type = "number" name = "fizetes"/><br/>
            <input type = "submit" value = "Hozzáadás" name="uj"/>
        </form>
        <a href = "zhgy.php">Vissza</a>
    </body>
</html>