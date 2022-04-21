<?php

session_start();

if(isset($_POST['param1'])) {

    $conn = mysqli_connect("151.97.9.184", "dipaola_rino", "6761957918", "dipaola_rino");
    $user = mysqli_real_escape_string($conn, $_SESSION["username"]);
    $followed_user = mysqli_real_escape_string($conn, $_POST['param1']);
    if($user!==$followed_user)
    {
        $query = "insert into Follower(nome_utente, persona_seguita) values('".$user."', '".$followed_user."');";
        $res = mysqli_query($conn, $query);
        mysqli_close($conn);
        $result = "1";
    }
    else {
        $result = "0";
    }
    
    print_r(json_encode($result));

}

?>