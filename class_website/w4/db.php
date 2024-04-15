<?php
$ini = parse_ini_file('dbconfig.ini');

$db = new PDO("mysql:host=" . $ini[''] . 
              ";port=" . $ini['port'] . 
              ";dbname=" . $ini['dbname'], 
              $ini['username'], 
              $ini['password']);

?>