<?php

    //Declara les variables de connexió a les BBDD
    include "bdConf.php";
    

    try{
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

                try{
                    $res = mysqli_query($conn, $query);

                    if($res){
                        //controlem les files de la consulta.
                        if( mysqli_num_rows($res) > 0){
                        foreach($res as $current_user){
                                if($current_user["rol"] == "professor"){

                                    echo "Hola ". $current_user["name"]. ",  ets professor!! <br><br>"; 
                                    echo "La llista d'usuraris de la bases de dades és: <br>";

                                    mostrarUsuaris($conn);

                                }
                                else{
                                    echo "soc un alumne";
                                    ?><br>
                                    <?php
                                    echo "nom: " . $current_user["name"];
                                    ?><br>
                                    <?php
                                    echo "cognom: ". $current_user["surname"];
                                    ?><br>
                                    <?php
                                    echo "email: " . $current_user["email"];
                                    ?><br>
                                    <?php
                                }
                        }
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
                catch(Exception $e){
                    echo 'Error al fer la consulta: ',  $e->getMessage(), "\n";
                }
                finally{
                    //tanquem la connexió
                    mysqli_close($conn);
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
    }
    catch(Exception $e){
        echo 'Error de connexió: ',  $e->getMessage(), "\n";
    }
    


    //Funció per mostrar els usuaris
    function mostrarUsuaris($conn){
        $query = "SELECT * FROM `user`";

        $resultat = mysqli_query($conn, $query);

        foreach($resultat as $usr){
            echo "nom i cognom: " . $usr["name"] . " " . $usr["surname"];
            ?>
            <br>
            <?php
        } 
    }
?>