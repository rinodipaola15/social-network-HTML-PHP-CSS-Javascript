<?php

session_start();

    $conn = mysqli_connect("151.97.9.184", "dipaola_rino", "6761957918", "dipaola_rino");
    $query = "SELECT * FROM Post p join Utente u on p.creatore=u.nome_utente where p.creatore='".$_SESSION["username"]."' UNION (select * from Post p join Utente u on p.creatore=u.nome_utente where p.creatore in (select f.persona_seguita from Follower f join Utente u on f.nome_utente='".$_SESSION["username"]."')) order by data_e_ora DESC;";
    $res = mysqli_query($conn, $query);
    $posts = array();
    while($row = mysqli_fetch_assoc($res))
    {
        $posts[] = $row;
    }
    mysqli_free_result($res);
    mysqli_close($conn);
    echo json_encode($posts);

?>