<?php

    session_start();

    if(isset($_POST['testo']))
    {
        
        $conn = mysqli_connect("151.97.9.184", "dipaola_rino", "6761957918", "dipaola_rino");
        $ricerca_utente = mysqli_real_escape_string($conn, $_POST['testo']);
        $query = "SELECT * FROM Utente WHERE nome_utente='".$ricerca_utente."';";
        $res = mysqli_query($conn, $query);
        $utenti = array();
        while($row = mysqli_fetch_assoc($res))
        {
            $utenti[] = $row;
        }
        mysqli_free_result($res);
        mysqli_close($conn);
        echo json_encode($utenti);

    }           

?>