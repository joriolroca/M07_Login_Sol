<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

        <?php
            include "bdConf.php";
            $conn = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE, PORT);
        ?>

        <?php

            //VARIABLES DEL POST
            $isActive = isset($_POST["isActive"]) ? $_POST["isActive"] : 0;
            $num = isset($_POST["num"]) ? $_POST["num"] : "";
            $name = isset($_POST["name"]) ? $_POST["name"] : "";
            $surn = isset($_POST["surn"]) ? $_POST["surn"] : "";
            $psw = isset($_POST["psw"]) ? $_POST["psw"] : "";
            $email = isset($_POST["email"]) ? $_POST["email"] : "";
            $rol = isset($_POST["rol"]) ? $_POST["rol"] : "";
        //LÒGICA DE LA PÀGINA

       

        if($conn){
            //La connexió és correcte

            //Construim la query
            $query = "INSERT INTO `user`(`user_id`, `name`, `surname`, `password`, `email`, `rol`, `actiu`) 
                    VALUES ($num,'$name','$surn','$psw','$email','$rol',$isActive); ";

            $result = mysqli_query($conn, $query);

            //tanquem la connexió
            mysqli_close($conn);

            //Controlem segons si el resultat és true o no.
            if($result){
                //si és correcte redireccionem a mostrar.php
                header('Location: mostrar.php');
            }
            else{
                echo "Error en la consulta de la query";
            }

        }
        else{

            //La connexió no és correcte.
            echo "Error al fer la connexió amb la BBDD: " + mysqli_connect_error();
        }
        ?>
</body>
</html>