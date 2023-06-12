<?php

class DatabaseConnectionException extends Exception
{
}

// DB connection
function connectionBD(): PDO
{
  $dsn = 'mysql:host=localhost;dbname=tico_casas_db';
  $username = 'root';
  $password = 'root';

  try {
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $e) {
    throw new DatabaseConnectionException('Error de conexión: ' . $e->getMessage());
  }

  return $db;
}

function checkConnection(PDO $db): void
{
  try {
    $db->query('SELECT 1');
  } catch (PDOException $e) {
    throw new DatabaseConnectionException('Error al verificar la conexión: ' . $e->getMessage());
  }
}
