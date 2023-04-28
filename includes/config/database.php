<?php

function connectionBD() : mysqli
{
  $db = mysqli_connect('localhost', 'root', 'root', 'tico_casas_db');

  if (!$db) {
    echo 'Error de conexión';
    exit;
  }

  return $db;
}
