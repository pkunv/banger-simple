<?php

/**
 * @param string $dataPath
 * @param string $dbPath
 * @return array
 */
function validateAndInsertDb($dataPath, $dbPath, $password)
{
  $data = json_decode(file_get_contents($dataPath), true);

  if ($data === NULL) return returnFn(false, 'Could not decode db file');

  $zip = new ZipArchive;
  $res = $zip->open($dbPath, ZipArchive::CREATE);
  if (!$res) return returnFn(false, 'Could not create zip file');

  $tableCount = count($data);

  for ($i = 0; $i < $tableCount; $i++) {
    $tableFields = $data[$i]['fields'];
    $tableName = $data[$i]['name'];
    $tableSeed = $data[array_search($tableName, array_column($data, 'table'))] ?? NULL;
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
}
