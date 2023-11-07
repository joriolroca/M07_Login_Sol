<?php

    $lang = $_GET["lang"];
    echo $lang;

    setcookie("lang", $lang, time() + 60*10);

    header("Location: init.php");
?>