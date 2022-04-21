<?php

    if(isset($_POST["username"]))
        {
            $conn = mysqli_connect("151.97.9.184", "dipaola_rino", "6761957918", "dipaola_rino");
            $username = mysqli_real_escape_string($conn, $_POST["username"]);
            $query = "SELECT * FROM Utente WHERE nome_utente = '".$username."'";
                $res = mysqli_query($conn, $query);
                if(mysqli_num_rows($res) == 0)
                    $var=0;
                else
                    $var=1;
            mysqli_free_result($res);
            mysqli_close($conn);
            echo json_encode($var);
        }               

?>