<?php
require_once(__DIR__ . '/validate/validateSchema.php');

/**
 * @param string $schemaPath
 * @param string $seedPath
 * @param string $dbPath
 * @param string $password
 * @return array
 */
function createDb($schemaPath, $seedPath, $dbPath, $password)
{

  if (validateSchema($schemaPath)['success'] === false) return returnFn(false, 'Could not setup schema');
  $schema = json_decode(file_get_contents($schemaPath), true);

  $seed = json_decode(file_get_contents($seedPath), true);
  if ($seed === NULL) return returnFn(false, 'Could not decode seed file');

  $zip = new ZipArchive;
  $res = $zip->open($dbPath, ZipArchive::CREATE);
  if (!$res) return returnFn(false, 'Could not create zip file');

  $tableCount = count($schema);

  for ($i = 0; $i < $tableCount; $i++) {
    $tableFields = $schema[$i]['fields'];
    $tableName = $schema[$i]['name'];
    $tableSeed = $seed[array_search($tableName, array_column($seed, 'table'))] ?? NULL;
    $tableValues = array();

    // TODO: type checking according to schema
    if ($tableSeed !== NULL) {
      foreach ($tableSeed['rows'] as $row) {
        array_push($tableValues, $row);
      }
    }
    $zip->addFromString($tableName . '.json', json_encode($tableValues));
    $zip->setEncryptionName($tableName . '.json', ZipArchive::EM_AES_256, $password);
  }

  $zip->close();

  return returnFn(true, 'Database initialized');
}
