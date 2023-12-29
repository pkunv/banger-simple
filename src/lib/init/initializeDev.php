<?php

require_once __DIR__ . '/../../inc/bootstrap.php';

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

  try {
    if (!is_dir($dbPath)) if (!mkdir($dbPath, 0777, true)) throw new Exception('Failed to create dev/db directory.');
    if (!is_dir($appPath)) if (!mkdir($appPath, 0777, true)) throw new Exception('Failed to create dev/app directory.');
    if (!is_dir($apiPath)) if (!mkdir($apiPath, 0777, true)) throw new Exception('Failed to create dev/api directory.');
  } catch (Exception $e) {
    return returnFn(false, 'Failed to initialize environment structure. Please check permissions to read/write operations to the project root directory.');
  }

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

  return returnFn(true, 'Initialized dev folders successfully.');
}
