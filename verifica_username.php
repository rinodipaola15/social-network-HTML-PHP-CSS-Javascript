<?php

session_start();

    $conn = mysqli_connect("151.97.9.184", "dipaola_rino", "6761957918", "dipaola_rino");
    $user = mysqli_real_escape_string($conn, $_SESSION["username"]);
    $followed_user = mysqli_real_escape_string($conn, $_POST["param1"]);
    $query = "SELECT * FROM Follower WHERE nome_utente = '".$user."' AND persona_seguita = '".$followed_user."';";
    $res = mysqli_query($conn, $query);
    if(mysqli_num_rows($res) == 0)
        $result = "0";
    else 
        $result = "1";
    mysqli_close($conn);
    print_r(json_encode($result));

?>