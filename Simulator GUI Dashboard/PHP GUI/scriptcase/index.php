<?php
    $url = strtr("http://".$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT']. $_SERVER['REQUEST_URI'], array('/index.php' => ""));
    header("Location: " . $url ."devel/iface/login.php" );
?>