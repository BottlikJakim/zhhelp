<?php
require 'db.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel = "stylesheet" type = "text/css" href = "style.css">
    </head>

    <body>
        <h2>Név,Neptun</h2>

        <?php if(!isset($_GET["movienum"])): ?>

            <form action = "actor.php", method = "get">
                <label for = "filmsofactor"> Adja meg a filmben szereplő színészek számát!</label><br/>
                <input id = "filmsofactor" type = "number" name = "movienum"/>
                <input type = "submit"/>
            </form>

        <?php else: 
            $link = getDB();
            $szam = mysqli_real_escape_string($link, $_GET["movienum"]);
            $query = sprintf("SELECT sz.nev as Színész, count(f.cím) as Filmszám
            FROM színész sz JOIN film f ON sz.id = színészid
            GROUP BY Színész
            HAVING Filmszám >= %s
            ORDER BY Színész asc;", $szam);
            $result = mysqli_query($link, $query);
            mysqli_close($link);   
        ?>

            <table>

                <thead>
                <tr>
                    <th>Színész</th>
                    <th>Filmek száma</th>
                </tr>
                </thead>

                <tbody>
                <?php while($row = mysqli_fetch_array($result)): ?>
                    <tr>
                        <td><?=$row["Színész"]?></td>
                        <td><?=$row["Filmszám"]?></td>
                    </tr>
                <?php endwhile; ?>
                </tbody>

            </table>

        <?php endif?>

    </body>
</html>