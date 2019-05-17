<?php

namespace App\Inspections;

use Exception;


class KeyHeldDown
{

  public function detect($body)
  {
    if (preg_match('/(.)\\1{4,}/',$body))
    {
        throw new Exception('Your reply contains spam');
    }

    if(preg_match('/Windows(?=95|98|NT|2000)|(\\s{2,})/',$body)){
        throw new Exception('Your reply contains spam');
    }

    if(preg_match('/\b([a-z]+)\1\b/',$body)){
        throw new Exception('Your reply contains spam');
    }
  }

}
