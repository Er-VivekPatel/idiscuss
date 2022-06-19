<?php 
session_start();

echo "loging out please wait..";
session_destroy();
header("Location:/Forum");
?>