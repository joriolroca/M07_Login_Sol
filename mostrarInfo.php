<?php

    // Start the session
    session_start();

    if(isset($_SESSION["loggedIn"])){
        if(!$_SESSION["loggedIn"]){
            header("Location: login.html");
        }  
    }
    else{
        header("Location: login.html");
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h1> Informació detallada de l'usuario</h1>
   
    <?php

        //Agafem el valor del GET

        $user_id = $_GET["id"];

        include "bdConf.php";

        $conn = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE, PORT);

        //Controlem que la connexió és correcte
        if($conn){

            $query = "SELECT * FROM `user` where user_id= $user_id";          
            $res = mysqli_query($conn, $query);   


            if( mysqli_num_rows($res) > 0){
                $usr = mysqli_fetch_array($res);

                echo "Id usuari: ". $usr["name"];
                ?> 
                    <br>
                <?php
                echo "Nom: ". $usr["name"];
                ?>
                    <br>
                <?php
                echo "Cognom: ". $usr["name"];
                ?>
                    <br>
                <?php
                echo "Email: ". $usr["name"];
                ?>
                    <br>
                <?php
                echo "Rol: ". $usr["name"];
                ?>
                    <br>
                <?php
                echo "Actiu: ". $usr["name"];
                ?>
                    <br>
                <?php

            }
            else{
                echo "No hi ha informació";
            }
        }
        mysqli_close($conn);

    ?>
    <br>

    <a href="init.php">TORNAR</a>
    
</body>
</html>