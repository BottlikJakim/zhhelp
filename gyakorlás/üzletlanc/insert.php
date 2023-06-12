<?php
require 'db.php';
if (isset($_GET["new"])){
    $link = getDB();
    if (isset($_GET["nev"]) && isset($_GET["kor"])){
        $neve = mysqli_real_escape_string($link, $_GET["nev"]);
        $kora = mysqli_real_escape_string($link, $_GET["kor"]);
        $query = sprintf("INSERT INTO elado (nev, kor) VALUES ('%s',%s);",$neve,$kora);
        mysqli_query($link, $query);
    }
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html>
    <head><title>Új eladó</title></head>
    <body>
        <form action="insert.php" method="get">
            <p>
                Név: <input type="text" name="nev" />    
            </p>
            <p>
                Kor: <input type="number" name="kor" />    
            </p>
            <p> 
                <input type="submit" value="Elküld" name="new" />
            </p>
        </form>
    </body>
</html>
