<!DOCTYPE html>
<html>
    <head>
        <title>Állatkert</title>
        <link rel = "stylesheet" href = "zh.css">
    </head>
    <body>
        <h1>Név: Bottlik Jákim, Neptun kód: R8T2D3</h1>
        <?php if(!isset($_GET["faj"])): ?>
            <form method = "get">
                <label for ="faj">Fajnév:</label>
                <input id = "faj" type = "text" name = "faj"/>
                <br/>
                <input type = "submit" value = "Keresés"/>
            </form>
        <?php endif; ?>
        <?php if(isset($_GET["faj"])): ?>
            <?php if($_GET["faj"]):?>
                <?php
                $link = mysqli_connect("localhost","root","")
                or die("Kapcsolódási hiba: " . mysqli_error());
                mysqli_select_db($link,"allatkert");
                mysqli_query($link,"set character_set_results = 'utf8'");
                $query = sprintf("SELECT allat.faj as Faj, allat.id as Azonosító, allat.nev as Név, MIN(gondozo.eletkor) as Legfiatalabb
                FROM allat join gondozza on allatid = allat.id
                join gondozo on gondozoid = gondozo.id
                GROUP BY Azonosító, Név, Faj
                ORDER BY Név asc;");
                $result = mysqli_query($link,$query);
                ?>
                <table>
                    <tr>
                        <th>Azonosító</th>
                        <th>Név</th>
                        <th>Legfiatalabb</th>
                    </tr>
                    <?php while ($row = mysqli_fetch_array($result)): ?>
                    <?php if ($row["Faj"]==$_GET["faj"]):?>
                        <tr>
                            <td><?php echo($row["Azonosító"]) ?></td>
                            <td><?=$row["Név"]?></td>
                            <td><?=$row["Legfiatalabb"]?></td>
                        </tr>
                    <?php endif; ?>
                    <?php endwhile; ?>
                </table>
            <?php else: ?>
                <h2 id = "hiba">Nics megadva állatfaj!</h2>
            <?php endif; ?>
        <?php endif; ?>
    </body>
</html>