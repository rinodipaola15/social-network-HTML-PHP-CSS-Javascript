<?php

    session_start();
        
    $conn = mysqli_connect("151.97.9.184", "dipaola_rino", "6761957918", "dipaola_rino");
    $post = mysqli_real_escape_string($conn, $_POST["id_post"]);
    $query = "SELECT * FROM Likes l join Utente u on l.nome_utente=u.nome_utente where l.post='".$post."';";
    $res = mysqli_query($conn, $query);
    $utenti = array();
    while($row = mysqli_fetch_assoc($res))
    {
        $utenti[] = $row;
    }
    mysqli_free_result($res);
    mysqli_close($conn);
    echo json_encode($utenti);

?>