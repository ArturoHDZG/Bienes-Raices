<?php

class DatabaseConnectionException extends Exception
{
}

// DB connection
function connectionBD(): PDO
{
  $host = $_ENV['DB_HOST'];
  $dbname = $_ENV['DB_NAME'];
  $username = $_ENV['DB_USER'];
  $password = $_ENV['DB_PASS'];
  $dsn = "mysql:host=$host;dbname=$dbname";

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
