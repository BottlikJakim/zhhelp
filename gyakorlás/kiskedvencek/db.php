<?php
function getDB() {
    $link = mysqli_connect("localhost", "root", "")
    or die("Kapcsolódási hiba: " . mysqli_error());
    mysqli_select_db($link, "kiskedvenc");
    mysqli_query($link, "set character_set_results='utf8'");
    return $link;
}
?>