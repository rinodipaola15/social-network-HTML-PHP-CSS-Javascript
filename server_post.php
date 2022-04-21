<?php

session_start();

if(isset($_POST['param1']) &&
   isset($_POST['param2'])) {

    $conn = mysqli_connect("151.97.9.184", "dipaola_rino", "6761957918", "dipaola_rino");
    $username = mysqli_real_escape_string($conn, $_SESSION["username"]);
    $url_img = mysqli_real_escape_string($conn, $_POST['param1']);
    $titolo = mysqli_real_escape_string($conn, $_POST['param2']);
    $query = "insert into Post(creatore, titolo, url_immagine, data_e_ora) values('".$username."', '".$titolo."', '".$url_img."', now());";
    $res = mysqli_query($conn, $query);
    mysqli_free_result($res);
    mysqli_close($conn);
}

?>


