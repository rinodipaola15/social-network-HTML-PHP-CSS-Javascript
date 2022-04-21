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
        <link rel='stylesheet' href='create_post.css'>
        <script src='create_post.js' defer></script>
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
                <p>Cerca contenuto:</p>
                <input id='cerca_contenuto' type='text' name='testo'>
                <p>Scegli un servizio:</p>
                <p>
                    <select name='servizio'>
                            <option value='Spotify'>Spotify (Artisti musicali)</option>
                            <option value='Giphy'>Giphy (GIF)</option>
                            <option value='OpenMovieDatabase'>Open Movie Database (Film)</option>
                            <option value='Jikan'>Jikan (Anime)</option>
                    </select>
                </p>
                <p>
                    <input id='invia_dati' type='submit' value='Cerca'>
                </p>
            </form>
        </main>
        <div id='messaggio_errore' class='hidden'><span>Inserimento non valido!</span></div>


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


        <section name='invio' id="artist-view">
        </section>

        <section id="modal-view" class="hidden">
        </section>

        <form name='hidden_form' method='post' id='hidden_form'>
            <p id='title' class='hidden'>
            <label><span>Che titolo vuoi dare al post?</span>
                <input id='barra_testo' type='text' name='titolo'><input type='submit' value='Pubblica'>
            </label>
            </p>
            <div id='avviso_pubblicazione' class='hidden'><span>Post pubblicato con successo!</span></div>
        </form>

        <footer>
            <span>Powered by Rino Di Paola</span>
        </footer>

    </body>
</html>