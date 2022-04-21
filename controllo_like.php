<?php

session_start();

    $conn = mysqli_connect("151.97.9.184", "dipaola_rino", "6761957918", "dipaola_rino");
    $user = mysqli_real_escape_string($conn, $_SESSION["username"]);
    $id_post = mysqli_real_escape_string($conn, $_POST["id_post"]);
    $query = "SELECT * FROM Likes WHERE nome_utente = '".$user."' AND post = ".$id_post.";";
    $res = mysqli_query($conn, $query);
    if(mysqli_num_rows($res) == 0)
        $result = "0";
    else 
        $result = "1";
    mysqli_close($conn);
    print_r($result);

?>