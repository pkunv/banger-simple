<?php

require_once __DIR__ . '/../inc/bootstrap.php';

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

  if (!is_dir($dbPath)) mkdir($dbPath, 0777, true);
  if (!is_dir($appPath)) mkdir($appPath, 0777, true);
  if (!is_dir($apiPath)) mkdir($apiPath, 0777, true);

  $configInitResult = initializeConfig($configPath);
  $dbInitResult = initializeDb($schemaPath, $seedPath, $dataPath, $password);

  // copy boilerplate
  file_put_contents(
    $appPath . '/page.js',
    file_get_contents(PROJECT_ROOT_PATH . '/src/dev-dir-structure-helper/app/page.js')
  );

  file_put_contents(
    $apiPath . '/index.php',
    file_get_contents(PROJECT_ROOT_PATH . '/src/dev-dir-structure-helper/api/index.php')
  );

  header("Location: dev.php", true);
  sleep(0.5);
  echo $configInitResult['message'];
  echo $dbInitResult['message'];
}
