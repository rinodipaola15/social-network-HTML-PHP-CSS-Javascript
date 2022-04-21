<?php

    session_start();

    if(isset($_POST['testo']) &&
       $_POST['servizio']=='Spotify')
        {
            
        $client_id =     "a4978d11b19b4b13bf2e62587661ab92";
        $client_secret = "e2ce6c53371347678589a4cffbb6b236";

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://accounts.spotify.com/api/token");
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
        $headers = array("Authorization: Basic ".base64_encode($client_id.":".$client_secret));
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        curl_close($curl);
    
        $artist=$_POST['testo'];
        $token = json_decode($result)->access_token;
        $data = http_build_query(array("q" => $artist, "type" => "artist"));
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://api.spotify.com/v1/search?".$data);
        $headers = array("Authorization: Bearer ".$token);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        echo $result;
        curl_close($curl);

    }           


    if(isset($_POST['testo']) &&
    $_POST['servizio']=='Giphy')
    {
         
        $api_key = '2dCSCosTYAzfXbCgYZFql7BTJX3OD1IR';
        $file_value = urlencode($_POST['testo']);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://api.giphy.com/v1/gifs/search?api_key=".$api_key."&q=".$file_value."&limit=25&offset=0&rating=G&lang=en");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        echo $result;
        curl_close($curl);

    }  
    
    
    if(isset($_POST['testo']) &&
    $_POST['servizio']=='OpenMovieDatabase')
    {
         
        $api_key = 'f3856444';
        $file_value = urlencode($_POST['testo']);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "http://www.omdbapi.com/?apikey=".$api_key."&s=".$file_value."");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        echo $result;
        curl_close($curl);

    }  


    if(isset($_POST['testo']) &&
    $_POST['servizio']=='Jikan')
    {
         
        $file_value = urlencode($_POST['testo']);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://api.jikan.moe/v3/search/anime?q=".$file_value."");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        echo $result;
        curl_close($curl);

    }  



?>