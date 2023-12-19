<?php

/**
 * @param boolean $result
 * @param string $message
 * @return array
 */
function returnFn($result, $message)
{
  $return = array(
    'success' => $result,
    'message' => ($result === true) ? 'BANG!: ' . $message : $message
  );
  return $return;
}
