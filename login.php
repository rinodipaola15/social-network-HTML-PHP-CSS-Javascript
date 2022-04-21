<?php


    session_start();
    if(isset($_SESSION["username"]) || isset($_COOKIE["username"]))
    {
        header("Location: home.php");
    }
    if(!isset($_SESSION["username"]) && isset($_COOKIE["username"])) {
        $_SESSION["username"]=$_COOKIE["username"];
    }

    if(isset($_POST["username"]) && 
       isset($_POST["password"]))
    {

        $conn = mysqli_connect("151.97.9.184", "dipaola_rino", "6761957918", "dipaola_rino");
        $username = mysqli_real_escape_string($conn, $_POST["username"]);
        $password = mysqli_real_escape_string($conn, $_POST["password"]);
        $query = "SELECT * FROM Utente WHERE nome_utente = '".$username."' AND password = '".$password."'";
        $res = mysqli_query($conn, $query);
        if(mysqli_num_rows($res) > 0)
        {       
            $_SESSION["username"] = $_POST["username"];
            if($_POST["checkbox"]=="1") {
                $expire = 31536000; //1 anno
                setcookie("username", $_POST["username"], time() + $expire);
            }
            header("Location: home.php");
            exit;
        }
        else
        {
            $errore = true;
        }
        mysqli_free_result($res);
        mysqli_close($conn);
    }

?>
<html>
    <head>
        <link rel='stylesheet' href='login.css'>
        <script src='login.js' defer></script>
        <meta charset="utf-8">
        <meta name="viewport"content="width=device-width, initial-scale=1">
    </head>
    <body> 
        <main>
            <form name='nome_form' method='post'>
                <p>
                    <label>Nome utente: <input type='text' name='username'></label>
                </p>
                <p>
                    <label>Password: <input type='password' name='password'></label>
                </p>
                <p>
                    <input type='submit' value='Login' id='input'>
                </p>
                <p>
                <label>Ricordami: <input type="checkbox" name="checkbox" value="1"></label>
                </p>
                <p id='registrazione'>
                    <span>
                        Non sei ancora registrato?
                    </span>
                    <a href="signup.php">Crea un account.</a>
                </p>
                <?php
                if(isset($errore))
                {
                    echo "<p class='errore'>";
                    echo "Credenziali non valide.";
                    echo "</p>";
                }
                ?>
                <div class='hidden' id='regolazione_div'><span>Compilare tutti i campi.</span></div>
            </form>
        </main>
    </body>
</html>