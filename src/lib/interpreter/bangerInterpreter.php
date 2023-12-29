<?php
require_once __DIR__ . "/fetch.php";

/**
 * Interprete .banger SSR generator script
 * 
 * Function takes .banger file from first argument, interpretes it and returns modified
 * HTML file provided in second argument.
 * 
 * @param string $srcBangerFile
 * @param string $srcHtmlFile
 * @param integer $mode
 * @return string
 */
function interpreteBanger($srcBangerFile, $srcHtmlFile, $mode = 0)
{
  // divide script to single functions by semicolon
  $script = explode(";", file_get_contents($srcBangerFile));
  $scriptFunctionsCount = count($script);

  for ($i = 0; $i < $scriptFunctionsCount; $i++) {
  }
}
