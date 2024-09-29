<?php

namespace Helper {

  class InputHelper
  {
    static function input(string $info): string
    {
      // info : ISI. karena tidak EOL
      echo "$info : ";
      $result = fgets(STDIN);
      return trim($result);
      
    }
  }
}