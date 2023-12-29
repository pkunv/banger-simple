<?php
require_once(__DIR__ . '/src/inc/bootstrap.php');

error_reporting(E_ALL);
ini_set('display_errors', 'On');

try {
  $initResult = initializeDev();
} catch (Exception $e) {
  echo $e->getMessage();
}

if ($initResult['success']) {
  header("Location: dev.php", true, 300);
}
