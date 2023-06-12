<?php
function getDB() {
    $link = mysqli_connect("localhost","root","")
    or die("Nem sikerült kapcsolódni az adatbázishoz: " . mysqli_error());
    mysqli_select_db($link, "uzletlanc");
    mysqli_query($link, "set character_set_results = 'utf8'");
    return $link;}
?>
