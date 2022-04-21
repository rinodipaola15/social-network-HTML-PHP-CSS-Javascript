<?php

session_start();

if(isset($_POST['id_post'])) {

    $conn = mysqli_connect("151.97.9.184", "dipaola_rino", "6761957918", "dipaola_rino");
    $user = mysqli_real_escape_string($conn, $_SESSION["username"]);
    $liked_post = mysqli_real_escape_string($conn, $_POST['id_post']);
    $query = "insert into Likes(nome_utente, post) values('".$user."', '".$liked_post."');";
    $res = mysqli_query($conn, $query);
    mysqli_close($conn);    

}

?>