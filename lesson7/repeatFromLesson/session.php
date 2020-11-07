<?php
session_start();

session_regenerate_id();

//$_SESSION['login'] = 'admin';

echo $_SESSION['login'];