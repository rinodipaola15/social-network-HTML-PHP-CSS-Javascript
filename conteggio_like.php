<?php

session_start();

    $conn = mysqli_connect("151.97.9.184", "dipaola_rino", "6761957918", "dipaola_rino");
    $id_post = mysqli_real_escape_string($conn, $_POST["id_post"]);
    $query = "SELECT * FROM Likes WHERE post = '".$id_post."';";
    $res = mysqli_query($conn, $query);
    mysqli_close($conn);
    print_r(mysqli_num_rows($res));
    
?>