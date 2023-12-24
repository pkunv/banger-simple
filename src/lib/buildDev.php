<?php

/**
 * Build dev environment
 *
 * @return array
 */
function buildDev()
{
  $htmlTemplate = file_get_contents(PROJECT_ROOT_PATH . '/src/lib/main.template.html');
  $config = json_decode(file_get_contents(PROJECT_ROOT_PATH . '/config.json'), true);
  $randomString = random_bytes(3);

  $mainScriptFilename = "main.js";
  $mainPageFilename = "index.html";

  $mainScriptSrcPath = PROJECT_ROOT_PATH . '/dev/app/page.js';
  $mainScriptDevPath = PROJECT_ROOT_PATH . '/' . $mainScriptFilename;
  $mainPageDevPath = PROJECT_ROOT_PATH . '/' . $mainPageFilename;

  // create main page with default config.json metadata values
  $mainPage = str_replace(["%APP_LANG%", "%APP_NAME%", "%APP_DESCRIPTION%", "%APP_AUTHOR%", "%APP_VERSION%", "%APP_MAIN_SCRIPT%"], [$config["appLang"], $config["appName"], $config["appDescription"], $config["appKeywords"], $config["appLang"], $mainScriptFilename . "?no_cache=" . bin2hex($randomString)], $htmlTemplate);

  $mainScript = str_replace('api', './dev/api', file_get_contents($mainScriptSrcPath));

  // put web app in root directory
  file_put_contents($mainPageDevPath, $mainPage);
  file_put_contents($mainScriptDevPath, $mainScript);

  return returnFn(true, 'Dev environment built');
}
