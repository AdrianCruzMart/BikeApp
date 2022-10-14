<?php
session_start();
$_SESSION['usuario'] = true;
$url = '..?op=login&resultado=ok';
header('Location: ' . $url);