<?php
session_start();
unset($_SESSION['usuario']);
$url = '..?op=logout&resultado=ok';
header('Location: ' . $url);