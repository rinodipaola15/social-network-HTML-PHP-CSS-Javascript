<?php

    session_start();

    if(isset($_SESSION["username"])) 
    {
        header("Location: home.php");
        exit;
    }


    function check_ext($tipo) {

        switch($tipo) {
            case "image/png": 
                return true;
                break;
            case "image/jpg":
                return true;
                break;
            case "image/jpeg":
                return true;
                break;
            case "image/gif":
                return true;
                break;
            default:
                return false;
                break;
        }
        
    }
        
    function get_ext($tipo) {
        
        switch($tipo) {
            case "image/png": 
                return ".png";
                break;
            case "image/jpg":
                return ".jpg";
                break;
            case "image/jpeg":
                return ".jpg";
                break;
            case "image/gif":
                return ".gif";
                break;
            default:
                return false;
                break;
        }
        
    }
        
    function get_error($tmp, $type, $size, $max_size) {
        
        if(!is_uploaded_file($tmp)) {
            //
        }
        if(!check_ext($type)) {
            //
        }
        if($size > $max_size) {
            //
        }
        
    }
        
    if(isset($_FILES['immagine_profilo'])) {

        $tmp = $_FILES['immagine_profilo']['tmp_name']; 
        $type = $_FILES['immagine_profilo']['type'];
        $size = $_FILES['immagine_profilo']['size'];
        
        $max_size = 5242880;
        $path = 'file';
        $folder = "file/"; 
        
        if(is_uploaded_file($tmp) && check_ext($type) && $size <= $max_size) {
        
            $ext = get_ext($type); 
            $name = time().rand(0,999); 
            $name = $name.$ext; 
            $name = $folder.$name; 
            
            if(move_uploaded_file($tmp, $name)) {
                //
            } else {
                //
            }

        } else {
            get_error($tmp, $type, $size, $max_size);
        }

    }
        
        
        
        
        
    if(isset($_SESSION["username"])) 
    {
        header("Location: home.php");
        exit;
    }
            
    if(isset($_POST["nome"]) && 
       isset($_POST["cognome"]) && 
       isset($_POST["email"]) && 
       isset($_POST["username"]) && 
       isset($_POST["password"]) && 
       isset($_POST["conferma_password"]) &&
       isset($_FILES['immagine_profilo']))
    {
        if(strlen($_POST["nome"])==0 || 
           strlen($_POST["cognome"])==0 || 
           strlen($_POST["email"])==0 ||
           strlen($_POST["username"])==0 || 
           strlen($_POST["password"])==0 || 
           strlen($_POST["conferma_password"])==0)
        {
            $errore_1 = true;
        }
        else 
        {
            if((strpos($_POST["email"], '@')) &&
               ($_POST["password"]==$_POST["conferma_password"]) &&
                (check_ext($type)) && 
                ($size <= $max_size))

            {
                $conn = mysqli_connect("151.97.9.184", "dipaola_rino", "6761957918", "dipaola_rino");
                $username = mysqli_real_escape_string($conn, $_POST["username"]);
                $nome = mysqli_real_escape_string($conn, $_POST["nome"]);
                $cognome = mysqli_real_escape_string($conn, $_POST["cognome"]);
                $email = mysqli_real_escape_string($conn, $_POST["email"]);
                $password = mysqli_real_escape_string($conn, $_POST["password"]);
                $immagine_profilo = mysqli_real_escape_string($conn, $name);
                $query = "SELECT * FROM Utente WHERE nome_utente = '".$username."'";
                $res = mysqli_query($conn, $query);
                if(mysqli_num_rows($res) == 0)
                {
                    $query = "INSERT INTO Utente(nome_utente, nome, cognome, email, password, immagine_profilo) values('".$username."', '".$nome."', '".$cognome."', '".$email."', '".$password."', '".$immagine_profilo."');";
                    $res = mysqli_query($conn, $query);
                    session_start();
                    $_SESSION["username"] = $_POST["username"];
                    header("Location: home.php");
                    exit;
                }
                else
                {
                    $errore_4 = true;
                }
                mysqli_free_result($res);
                mysqli_close($conn);
            }
            else 
            {
                if(!check_ext($type) || ($size > $max_size)) {
                    $errore_5=true;
                }
                if(!(strpos($_POST["email"], '@')))
                {
                    $errore_2 = true;
                }
                if($_POST["password"]!=$_POST["conferma_password"]) {
                    $errore_3 = true;
                }
            }
        }
    }
   
?>

<html>
    <head>
        <link rel='stylesheet' href='signup.css'>
        <script src='signup.js' defer></script>
        <meta charset="utf-8">
        <meta name="viewport"content="width=device-width, initial-scale=1">
    </head>
    <body>
        <main>

            <form name='nome_form' method='post' enctype="multipart/form-data">
                <p>
                    <label>Nome: <input type='text' name='nome' value=<?php if(isset($errore_5) || isset($errore_1) || isset($errore_2) || isset($errore_3) || isset($errore_4)) echo $_POST["nome"]?>></label>
                </p>
                <p>
                    <label>Cognome: <input type='text' name='cognome' value=<?php if(isset($errore_5) || isset($errore_1) || isset($errore_2) || isset($errore_3) || isset($errore_4)) echo $_POST["cognome"]?>></label>
                </p>
                <p>
                    <label>Email: <input type='text' name='email' value=<?php if(isset($errore_5) || isset($errore_1) || isset($errore_2) || isset($errore_3) || isset($errore_4)) echo $_POST["email"]?>></label>
                </p>
                <p>
                    <label>Nome utente: <input type='text' name='username' value=<?php if(isset($errore_5) || isset($errore_1) || isset($errore_2) || isset($errore_3) || isset($errore_4)) echo $_POST["username"]?>></label>
                </p>
                <p>
                    <label>Password: <input type='password' name='password' value=<?php if(isset($errore_5) || isset($errore_1) || isset($errore_2) || isset($errore_3) || isset($errore_4)) echo $_POST["password"]?>></label>
                </p>
                <p>
                    <label>Conferma password: <input type='password' name='conferma_password' value=<?php if(isset($errore_5) || isset($errore_1) || isset($errore_2) || isset($errore_3) || isset($errore_4)) echo $_POST["conferma_password"]?>></label>
                </p>
                <p>
                    <label>Immagine del profilo:&nbsp;<input type="file" id='input_img' value="scegli immagine" name="immagine_profilo"></label>
                </p>
                <p>
                    &nbsp;<input type='submit' value='Sign up' id='input'>
                </p>
                <p id='login'>
                    <span>
                        Sei già registrato? Effettua il
                    </span>
                    <a href="login.php"> login.</a>
                </p>
                <?php
                if(isset($errore_5))
                {
                    echo "<p class='load_img'>";
                    echo "Caricamento dell'immagine non riuscito";
                    echo "</p>";
                }
                ?>
                <div class='div hidden' id='div1'><span>Compilare tutti i campi.</span></div>
                <div class='div hidden' id='div2'><span>Nome utente non disponibile.</span></div>
                <div class='div hidden' id='div3'><span>Email non valida.</span></div>
                <div class='div hidden' id='div4'><span>Le password inserite non coincidono.</span></div>
            </form>

	          
        </main>



        <?php
            if(isset($errore_1))
            {
                echo "<p class='errore'>";
                echo "Devi compilare tutti i campi.";
                echo "</p>";
            }
            if(isset($errore_2))
            {
                echo "<p class='errore'>";
                echo "Email non valida.";
                echo "</p>";
            }
            if(isset($errore_3))
            {
                echo "<p class='errore'>";
                echo "Le password inserite non coincidono.";
                echo "</p>";
            }
            if(isset($errore_4))
            {
                echo "<p class='errore'>";
                echo "Nome utente non disponibile.";
                echo "</p>";
            }
        ?>
        
        
    </body>
</html>
