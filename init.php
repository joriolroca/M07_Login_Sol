<?php

    // Start the session
    session_start();

    //Controlem les sessions per accedir a la pàgina
    if(isset($_SESSION["loggedIn"])){
        if(!$_SESSION["loggedIn"]){
            header("Location: login.html");
        }  
    }
    else{
        header("Location: login.html");
    }

    //Controlem les cookies per triar l'idioma segons si ho tenim guardat a la cookie o no
    if(isset($_COOKIE["lang"])){
        $idioma = $_COOKIE["lang"];
    }
    else{
        $idioma = "cat";
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
            if($idioma == "cat"){
                echo "Hola " . $_SESSION["name"] . ", ets un ". $_SESSION["rol"] ;
            }
            else if($idioma == "es") {
                echo "Hola " . $_SESSION["name"] . ", eres un ". $_SESSION["rol"] ;
            }
            else{
                echo "Hi " . $_SESSION["name"] . ", you are a ". $_SESSION["rol"] ;
            }
        ?>
    </h2>

    <?php 
        
        if($idioma == "cat"){
            ?>

            <a href="idioma.php?lang=cat" style="color:red">Cat</a>
            <a href="idioma.php?lang=es">Es</a>
            <a href="idioma.php?lang=en">En</a>
            <a href="delete.php">Eliminar</a>

            <?php
        }
        else if($idioma == "es") {
            ?>

            <a href="idioma.php?lang=cat">Cat</a>
            <a href="idioma.php?lang=es" style="color:red">Es</a>
            <a href="idioma.php?lang=en">En</a>
            <a href="delete.php">Eliminar</a>
            
            <?php
        }
        else{
            ?>

            <a href="idioma.php?lang=cat">Cat</a>
            <a href="idioma.php?lang=es">Es</a>
            <a href="idioma.php?lang=en" style="color:red">En</a>
            <a href="delete.php">Delete</a>
            
            <?php
        }
    ?>

    <br>
    <br>

    <?php 
    
    if($idioma == "cat"){
        ?>

    <a href="mostrarInfo.php?id=<?php echo $_SESSION["user_id"]?>">Mostrar informació</a>
    <a href="desconectar.php">Desconnectar</a>

        <?php
    }
    else if($idioma == "es") {
        ?>

    <a href="mostrarInfo.php?id=<?php echo $_SESSION["user_id"]?>">Mostrar información</a>
    <a href="desconectar.php">Desconnectar</a>
        
        <?php
    }
    else{
        ?>

    <a href="mostrarInfo.php?id=<?php echo $_SESSION["user_id"]?>">Show information</a>
    <a href="desconectar.php">Disconnect</a>
        
        <?php
    }
    
    ?>

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
                        <th>Nom</th>
                        <th>Cognom</th>
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