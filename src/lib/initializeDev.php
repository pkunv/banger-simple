<?php

require_once __DIR__ . '../inc/bootstrap.php';

function initializeDev()
{
  $configPath = PROJECT_ROOT_PATH . '/config.json';

  $dbPath = PROJECT_ROOT_PATH . '/dev/db';
  $appPath = PROJECT_ROOT_PATH . '/dev/app';
  $apiPath = PROJECT_ROOT_PATH . '/dev/api';

  $schemaPath = $dbPath . '/schema.json';
  $seedPath = $dbPath . '/seed.json';
  $dataPath = $dbPath . '/data.zip';

  $password = 'password';

  if (!is_dir($dbPath)) mkdir($dbPath);
  if (!is_dir($appPath)) mkdir($appPath);
  if (!is_dir($apiPath)) mkdir($apiPath);

  $configInitResult = initializeConfig($configPath);
  $dbInitResult = initializeDb($schemaPath, $seedPath, $dataPath, $password);

  echo $configInitResult['message'] . '<br>';
  echo $dbInitResult['message'] . '<br>';
}
