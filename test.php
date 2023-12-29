<?php


$txt = '[
  {
    "function": "fetch",
    "url": "api/index.php",
    "targetSelector": "body",
    "mapData": [{ "content": "p" }]
  }
]';


$generator = json_decode($txt, true);
$generatorInstancesCount = count($generator);

for ($i = 0; $i < $generatorInstancesCount; $i++) {

  if ($generator[$i]["function"] == "fetch") {
    $url = $generator[$i]["url"];
    // if script is executed with CLI
    if (php_sapi_name() == "cli") {
      $requestScheme = "http";
      $serverName = "localhost";
      $dir = explode('/', $_SERVER['PWD']);
      // remove every element from array before "banger-simple"
      while (array_shift($dir) != "htdocs") {
        continue;
      }
      $subDirectory = "/" . implode("/", $dir);
    } else {
      $serverName = $_SERVER['SERVER_NAME'];
      $requestScheme = $_SERVER['REQUEST_SCHEME'];
      $subDirectory = dirname($_SERVER['PHP_SELF']);
    }
    $url = "$requestScheme://$serverName$subDirectory/dev/$url";

    $curl = curl_init();
    $c = curl_init($url);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
    $page = curl_exec($c);
    curl_close($c);

    $data = json_decode($page, true);
    // find in subfunctions "showInHTML"
    $targetSelector = $generator[$i]["targetSelector"];
    // html generation
    $html = "";
    foreach ($data as $element) {
      $selector = array_search($targetSelector, array_values($generator[$i]["mapData"]));
      print_r($selector);
      //$html .= "<$targetSelector>" . $element[$targetSelector] . "</$targetSelector>";
    }
  }
  /*
  foreach($subfunctions as $subfunction) {
    $functionName = getFunctionName($subfunction);
    $functionArgs = string_between($subfunction, '("', '")');
    if ($functionName == "mapEveryArrayElement") {
      $data = array_map(fn ($element) => array_map(fn ($key) => $element[$key], explode(",", $functionArgs)), $data);
    } else if ($functionName == "showInHTML") {
      $html = "";
      foreach ($data as $element) {
        $html .= "<$functionArgs>" . $element[$functionArgs] . "</$functionArgs>";
      }
      echo $html;
    }
  }
  */
}
