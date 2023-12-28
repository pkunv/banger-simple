<?php

/**
 * @param boolean $result
 * @param string $message
 * @return array
 */
function returnFn($result, $message)
{
  $eol = php_sapi_name() === 'cli' ? PHP_EOL : '<br>';
  $return = array(
    'success' => $result,
    'message' => ($result === true) ? 'BANG!: ' . $message . $eol : "ERROR: " . $message . $eol
  );
  if (!$result) throw new Exception("ERROR: " . $message . $eol);
  return $return;
}
