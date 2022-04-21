<?php

    session_start();
    if(!isset($_SESSION['username']))
    {
        $errore_1 = true;
        header("Location: login.php");
        exit;
    }
    
    $immagine_profilo=array();
    $conn = mysqli_connect("151.97.9.184", "dipaola_rino", "6761957918", "dipaola_rino");
    $username = mysqli_real_escape_string($conn, $_SESSION["username"]);
    $query = "SELECT * FROM Utente WHERE nome_utente = '".$username."'";
    $res = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($res);
    $immagine_profilo = $row['immagine_profilo'];
    if(strlen($immagine_profilo)>0)
        $url_valido=true;

?>

<html>
    <head>
        <title>Hw1</title>
        <link href="https://fonts.googleapis.com/css?family=Nanum+Gothic&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Forum|Quicksand|Roboto&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lora:400,400i|Open+Sans:400,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Forum&display=swap" rel="stylesheet">
        <meta charset="utf-8">
        <meta name="viewport"content="width=device-width, initial-scale=1">
        <link rel='stylesheet' href='home.css'>
        <script src='home.js' defer></script>
    </head>
    <body>
        <section id='credits'>
            <span id='author'>RINO DI PAOLA</span>
            <span id='designs'>designs</span>
        </section>
        <header>
            <div id='sfondo'>
            </div>
            <div id='overlay'>
            </div>
            <nav>
                <div id="logo">
                    Web Programmming - UNICT
                </div>
                <div id="links">
                    <a href="home.php">Home</a>
                    <a href="create_post.php">Nuovo post</a>
                    <a href="search_people.php">Ricerca utenti</a>
                    <a href="logout.php">Logout</a>
                </div>
            </nav>
            <div id='id1'>
                <span>
                    Benvenuto <?php echo $_SESSION["username"]; ?>!
                </span>
                <div id='id2'>
                    <img src=<?php if(isset($url_valido)) echo "'".$immagine_profilo."'"?>/>
                </div>
            </div>
            <h1>
                <em>L'Ingegnere al tempo dei Social Network</em><br/>
                <strong>Suicide Engineering</strong><br/>
            </h1>
        </header>
        <?php
            if(isset($errore_1))
            {
                echo "<p class='errore'>";
                echo "Sessione non attiva.";
                echo "</p>";
            }
        ?>
        <section id='post'>        
        </section>
        <footer>
            <span>Powered by Rino Di Paola</span>
        </footer>
        <section id="modal-view" class="hidden">
            <div class='div_modal'></div>
        </section>
    </body>
</html>