<?php
header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');

error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once(__DIR__ . '/src/inc/bootstrap.php');

try {
  $buildResult = buildDev();
} catch (Exception $e) {
  echo $e->getMessage();
}

ob_start();

if ($buildResult['success']) {
  echo "Redirecting to the web app...";
  ob_end_clean();
  if (isset($_GET['redirect']) && ($_GET['redirect'] == 'true'))
    header("Location: index.html", true, 300);
  else
    echo file_get_contents(__DIR__ . '/index.html');
  //include(__DIR__ . '/index.html');
}
