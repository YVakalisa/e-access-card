<?php
ini_set('display_errors','On');
error_reporting(E_ALL);
SESSION_START();

echo $_SESSION['name'].'<br>';
echo $_SESSION['sname'];

?>