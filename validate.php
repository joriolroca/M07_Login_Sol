<?php

    // Start the session
    session_start();

    //Declara les variables de connexió a les BBDD
    include "bdConf.php";

    $conn = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE, PORT);

    //Controlem que la connexió és correcte
    if($conn){
            
        //Controlem que els valors de post són correctes i diferents a null
        if(isset($_POST["email"]) && isset($_POST["psw"]))
        {
            
            $email = $_POST["email"];   
            $psw = $_POST["psw"];

            $query = "SELECT * FROM `user` WHERE email = '$email' and password = '$psw'";
            // echo $query;

            $res = mysqli_query($conn, $query);

            if($res){
                //controlem les files de la consulta.
                if( mysqli_num_rows($res) > 0){
                    $usr = mysqli_fetch_array($res);

                    $_SESSION["loggedIn"] = true;
                    $_SESSION["name"] = $usr["name"];
                    $_SESSION["user_id"] = $usr["user_id"];
                    $_SESSION["rol"] = $usr["rol"];

                    header("Location: init.php");
                }else{
                    //Si el login no és correcte pintem la pantalla del login
                    //i hi afegim el text "Els valors són incorrectes"
                    include "login.html";
                    echo "Login incorrecte";
                }
            }
            else{
                //Si el login no és correcte pintem la pantalla del login
                //i hi afegim el text "Els valors són incorrectes"
                include "login.html";
                echo "Login incorrecte";
            }

        }
        else{
            //Si el login no és correcte pintem la pantalla del login
            //i hi afegim el text "Els valors són incorrectes"
            include "login.html";
            echo "Login incorrecte";
        }

    }
    else{
        echo "Error en la connexió: " . mysqli_connect_error();
    }

    mysqli_close($conn);
?>