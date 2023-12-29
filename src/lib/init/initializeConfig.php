<?php

function initializeConfig($path)
{
  $config = array(
    'appName' => 'My App',
    'appDescription' => 'My App Description',
    'appKeywords' => 'my,app,keywords',
    'appAuthor' => 'banger-simple',
    'appLang' => 'en',
  );

  $configFile = fopen($path, 'w');
  fwrite($configFile, json_encode($config));
  fclose($configFile);

  return returnFn(true, 'Config initialized');
}
