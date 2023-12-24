<?php
require_once(__DIR__ . '/returnFn.php');

/**
 * @param string $schemaPath
 * @return array
 */
function validateSchema($schemaPath)
{
  $supportedTypes = ["number", "string", "datetime", "boolean"];

  if (!file_exists($schemaPath)) return returnFn(false, 'Schema file does not exist');
  if (!$schemaFile = file_get_contents($schemaPath)) return returnFn(false, 'Could not read schema file');
  if (NULL == $schema = json_decode($schemaFile, true)) return returnFn(false, 'Could not decode schema file');

  $tableCount = count($schema);

  for ($i = 0; $i < $tableCount; $i++) {
    $tableFields = $schema[$i]['fields'];
    $tableName = $schema[$i]['name'];
    $fieldCount = count($tableFields);
    for ($k = 0; $k < $fieldCount; $k++) {
      // validation and sanitization
      if ($tableFields[$k]["name"] === NULL) return returnFn(false, 'Missing field name in table: ' . $tableName);
      if ($tableFields[$k]["type"] === NULL) return returnFn(false, 'Missing field type in table: ' . $tableName);
      if (!in_array($tableFields[$k]['type'], $supportedTypes)) return returnFn(false, 'Unsupported type: ' . $tableFields[$k]['type'] . ', in table: ' . $tableName . ', field: ' . $tableFields[$k]['name']);

      // default attributes
      $tableFields[$k]['required'] = $tableFields[$k]['required'] ?? false;
      $tableFields[$k]['auto_increment'] = $tableFields[$k]['auto_increment'] ?? false;
    }
    $schema[$i]['fields'] = $tableFields;
  }

  $schemaFile = fopen($schemaPath, 'w');
  fwrite($schemaFile, json_encode($schema));
  fclose($schemaFile);

  return returnFn(true, 'Schema file successfully initialized');
}
