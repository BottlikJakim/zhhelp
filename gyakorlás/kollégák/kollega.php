<?php
require "db.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Kollégák</title>
        <link rel = "stylesheet" href = "style.css" type = "text/css" />
    </head>
    <body>
        <h2>Név: Bottlik Jákim, Neptun kód: R8T2D3</h2>
        <?php if (!isset($_GET["roomnum"])): ?>

            <form action = "kollega.php" method = "get">
                <label for = "szsz">Válasszon szobaszámot!</label><br/>
                <select id = "szsz" name = "roomnum">
                    <option value = "QB226">QB226</option>
                    <option value = "QB207">QB207</option>
                </select><br/>
                <input type = "submit" value = "választ"/>
            </form>

        <?php else: 
            $link= getDB();
            $szoba = mysqli_real_escape_string($link, $_GET["roomnum"]);
            $query = sprintf("SELECT c.nev as Kolléga,  t.num as Telefon
            FROM colleague c JOIN szoba sz ON c.szobaid = sz.id JOIN tel t ON c.telefonid = t.id
            WHERE sz.szam = '%s'
            ORDER BY Kolléga asc;", $szoba);
            $result = mysqli_query($link, $query);
            mysqli_close($link);
        ?>

            <table>
            <thead>
            <tr>
                <th>Név</th>
                <th>Mellék</th>
            </tr>
            </thead>
            <tbody>
            <?php while($row = mysqli_fetch_array($result)): ?>
                <tr>
                    <td><?=$row["Kolléga"]?></td>
                    <td><?=$row["Telefon"]?></td>
                </tr>
            <?php endwhile; ?>
            </tbody>
            </table>

        <?php endif; ?>
    </body>
</html>