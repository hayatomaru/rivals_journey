<?php

require_once('../config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $_SESION = [];

  if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 86400, '/');
  }

  session_destroy();

}

header('Location: ' . SITE_URL);
