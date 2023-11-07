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
    <h2>
        <?php
            echo "Hola " . $_SESSION["name"] . ", ets un ". $_SESSION["rol"] ;
        ?>
    </h2>

    <a href="mostrarInfo.php?id=<?php echo $_SESSION["user_id"]?>">Mostrar informació</a>
    <a href="desconectar.php">Desconnectar</a>

    <br>
    <br>

    <?php

        //Controlem si a la session ens han enviat un alumne o professor
        if(isset($_SESSION["rol"])){
            if($_SESSION["rol"] == "professor"){

                $usuaris = getUsuaris();

                ?>
                <table style="border: 1px solid black">
                    <tr>
                        <th>Nobre</th>
                        <th>Apellido</th>
                        <th>Email</th>
                    </tr>
                    <?php 
                    foreach ( $usuaris as $val){
                        ?>
                        <tr>
                            <td><?php echo $val["name"]; ?></td>
                            <td><?php echo $val["surname"]; ?></td>
                            <td><?php echo $val["email"]; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
               <?php
            }  
        }

        //funció per mostrar la informació per pantalla
        function getUsuaris(){

            include "bdConf.php";

            $conn = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE, PORT);

            //Controlem que la connexió és correcte
            if($conn){

                $query = "SELECT * FROM `user`";          
                $res = mysqli_query($conn, $query);   
            }
            mysqli_close($conn);

            return $res;
        }

    ?>

    

</body>
</html>