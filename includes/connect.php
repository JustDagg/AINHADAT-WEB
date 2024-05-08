<?php
        $server = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'ainhadatstore';
        $connection = new mysqli($server, $username, $password, $database, 4306) or die("not 
        connected");
        // echo "connected"
?>