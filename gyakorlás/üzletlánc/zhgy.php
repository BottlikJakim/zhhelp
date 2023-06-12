<?php
require 'gydb.php';
$link = getDB();
$result = mysqli_query($link, "SELECT feltolto.fizetes as Fizetés, feltolto.nev as Árufeltöltő, SUM(bolt.terulet) as Területösszeg, COUNT(bolt.id) as Boltszám
FROM bolt RIGHT JOIN feltolto ON feltoltoid = feltolto.id
GROUP BY Fizetés, Árufeltöltő
ORDER BY bolt.id;");
mysqli_close($link);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Üzletlánc</title>
    </head>
    <body>
        <h2>Név: Bottlik Jákim, Neptun kód: R8T2D3</h2>
        <?php if(!isset($_GET['fizetes'])) : ?>
            <form action = "zhgy.php" method = "get">
                <label for = "fizetes">Fizetés:</label>
                <input id = "fizetes" type = "number" name = "fizetes"/>
                </br>
                <input type = "submit" value = "Keresés"/>
        </form>
        <?php endif; ?>
        <table>
        <?php if(isset($_GET['fizetes'])) if($_GET['fizetes'] >= 100000): ?>
            <tr>
                <th>Árufeltöltő</th>
                <th>Boltok száma</th>
                <th>Terület összege</th>
            </tr>
            <?php while($row = mysqli_fetch_array($result)): if($_GET['fizetes'] < $row['Fizetés']): ?>
                <tr>
                    <td><?=$row["Árufeltöltő"]?></td>
                    <td><?=$row["Boltszám"]?></td>
                    <td><?=$row["Területösszeg"]?></td>
                </tr>

            <?php endif; endwhile;?>
          <?php else: if($_GET['fizetes'] < 100000): ?>  
            <h3>Hiba! A fizetésnek minimum 100000 Ft-ot kell megadni!</h3>
        <?php endif; endif; ?>
        </table>
        <p>
            <a href = "zhgy_insert.php">Új eladó hozzáadása</a>
        </p>
        
    </body>
</html>