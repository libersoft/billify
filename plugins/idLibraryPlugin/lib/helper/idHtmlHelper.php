<?php

function blankSpaceIfNull($value) {
  if (is_null($value)) {
    return '&nbsp;';
  }
  return $value;
}

?>
