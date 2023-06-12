<?php
require 'db.php';
$link = getDB();
mysqli_close($link);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Kiskedvencek</title>
        <link type = "text/css" href = "style.css" rel = "stylesheet" />
    </head>
    <body>
        <h2>Név: Bottlik Jákim, Neptun kód: R8T2D3</h2>

        <?php if (!isset($_GET["faj"])): ?>
        <form action = "kiskedvenc.php" method = "get">
            <label for = "species">Állatfaja:</label><br/>
            <select id = "species" name = "faj">
                <option value = "kutya"> Kutya </option>
                <option value = "macska"> Macska </option>
            </select>
            <input type = "submit" value = "keres"/>
        </form>
        <?php else:
            $link = getDB();
            $faj = mysqli_real_escape_string($link,$_GET["faj"]);
            $query = sprintf("SELECT feed.eledel as Ételek, count(animal.faj) as Állatszám
            FROM pet join animal on fajid = animal.id join kedvence on petid = pet.id right join feed on feedid = feed.id
            WHERE animal.faj = '%s'
            GROUP BY Ételek
            ORDER BY Ételek asc;", $faj);
            $result = mysqli_query($link, $query);
            mysqli_close($link);
        ?>
        <table>
            <thead>
            <tr>
                <th>Étel</th>
                <th>Állatok száma</th>
            </tr>
            </thead>
            
            <?php while($row = mysqli_fetch_array($result)): ?>
            <tr>
                <td><?=$row["Ételek"]?></td>
                <td><?=$row["Állatszám"]?></td>
            </tr>
            <?php endwhile; ?>
        </table>      
        <?php endif; ?>
    </body>
</html>