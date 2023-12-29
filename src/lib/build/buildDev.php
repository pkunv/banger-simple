<?php
require_once PROJECT_ROOT_PATH  . "/src/lib/build/scriptInterpreter.php";

/**
 * Build dev environment
 *
 * @return array
 */
function buildDev()
{
  $config = json_decode(file_get_contents(PROJECT_ROOT_PATH . '/config.json'), true);
  if ($config === null) return returnFn(false, 'Config file not found');

  $mainTemplate = file_get_contents(PROJECT_ROOT_PATH . '/src/lib/main.template.html');
  if ($mainTemplate === false) return returnFn(false, 'Main template not found in /src directory');

  $randomString = bin2hex(random_bytes(3));

  $configFields = [
    "%APP_LANG%",
    "%APP_NAME%",
    "%APP_DESCRIPTION%",
    "%APP_AUTHOR%",
    "%APP_KEYWORDS%",
  ];

  $configValues = [
    $config["appLang"],
    $config["appName"],
    $config["appDescription"],
    $config["appAuthor"],
    $config["appKeywords"],
  ];

  $mainScript = [
    "content" => interpreteScript(file_get_contents(PROJECT_ROOT_PATH . '/dev/app/page.js'), 0),
    "fileName" => "main.js?no_cache=" . $randomString, // apply to html without cache
    "targetDevPath" => "./main.js"
  ];

  $mainPage = [
    // setting up main template with config metadata
    "content" => str_replace(
      [...$configFields, "%APP_MAIN_SCRIPT%"],
      [...$configValues, $mainScript['targetDevPath']],
      $mainTemplate
    ),
    "fileName" => "index.html",
    "targetDevPath" => PROJECT_ROOT_PATH . "/index.html"
  ];

  // put web app in root directory
  file_put_contents($mainPage["targetDevPath"], $mainPage["content"]);
  file_put_contents($mainScript["targetDevPath"], $mainScript["content"]);

  return returnFn(true, 'Dev environment built');
}
