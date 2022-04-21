<?php

    session_start();
    if(!isset($_SESSION["username"]))
    {
        $errore_1=true;
        header("Location: login.php");
        exit;
    }

    if(isset($_POST["testo"])) {
        if(strlen($_POST["testo"])==0)
        {
            $errore_2=true;
        }
    }

?>

<html>
    <head>
    <link href="https://fonts.googleapis.com/css?family=Nanum+Gothic&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Forum|Quicksand|Roboto&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lora:400,400i|Open+Sans:400,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Forum&display=swap" rel="stylesheet">
        <meta charset="utf-8">
        <meta name="viewport"content="width=device-width, initial-scale=1">
        <link rel='stylesheet' href='search_people.css'>
        <script src='search_people.js' defer></script>
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
            <h1>
                <em>L'Ingegnere al tempo dei Social Network</em><br/>
                <strong>Suicide Engineering</strong><br/>
            </h1>
        </header>


        <main>
            <form id='form' name='nome_form' method='post'>
                <p>
                    Cerca un utente inserendo il suo username:
                </p>
                <p>
                    <input id='input_testo' type='text' name='testo'>
                </p>
                <p>
                    <input id='input_ricerca' type='submit' value='Cerca'>
                    <input id='all_users' type='submit' value='Visualizza tutti'>
                </p>
            </form>
        </main>

        <section id='search'>
        </section>


        <?php
            if(isset($errore_1))
            {
                echo "<p class='errore'>";
                echo "Sessione non attiva.";
                echo "</p>";
            }
            if(isset($errore_2))
            {
                echo "<p class='errore'>";
                echo "Inserimento non valido.";
                echo "</p>";
            }
        ?>

        <footer>
            <span>Powered by Rino Di Paola</span>
        </footer>
        

    </body>
</html>