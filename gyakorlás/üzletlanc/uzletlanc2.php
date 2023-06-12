<?php
require 'db.php';
?>

<!DOCTYPE html>
<html>

    <head>
        <titile>Üzletlánc</title>
        <link rel = "stylesheet" href = "style.css" type = "text/css" />
    </head>

    <body>

        <h2>Név: Bottlik Jákim, Neptun kód: R8T2D3</h2>

        <?php if(!isset($_GET["fizetes"])): ?>

            <form href = "uzletlanc2.php" method = "get">
                <label for = "feltoltofizu">Adja meg az árufeltöltő fizetését!</label><br/>
                <input id = "feltoltofizu" type = "number" name = "fizetes"/>
                <input type = "submit"/>
            </form>

        <?php else:

            $link = getDB();
            $payment = mysqli_real_escape_string($link, $_GET["fizetes"]);
            $query = sprintf("SELECT f.nev as Árufeltöltő, count(k.id) as Boltszám, sum(k.terulet) as Terület
            FROM feltolto f LEFT JOIN kisbolt k on feltoltoid = f.id
            WHERE f.fizetes >= %s
            GROUP BY Árufeltöltő
            ORDER BY Árufeltöltő asc;", $payment);
            $result = mysqli_query($link, $query);
            mysqli_close($link);

            if($payment<100000):
            ?>

            <h3>Hiba!</h3>

            <?php else: ?>

            <table>
            <thead>
                <tr>
                    <th>Árufeltöltő</th>
                    <th>Boltok száma</th>
                    <th>Terület összege</th>
                </tr>
            </thead>

            <tbody>
            <?php while($row = mysqli_fetch_array($result)): ?>

                <tr>
                    <td><?=$row["Árufeltöltő"]?></td>
                    <td><?=$row["Boltszám"]?></td>
                    <td><?=$row["Terület"]?></td>
                </tr>
                
            <?php endwhile; ?>
            </tbody>
            </table>

        <?php endif; endif; ?>

        <a href = "insert.php">Új eladó hzzáadása</a>
    </body>
</html>