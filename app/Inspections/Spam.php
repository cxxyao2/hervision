<?php

namespace App\Inspections;

use Exception;


class Spam
{

    public $inspections = [
      InvalidKeywords::class,
      KeyHeldDown::class
    ];

    public function detect($body)
    {

      foreach($this->inspections as $inspection)
      {
        app($inspection)->detect($body);
      }
      return false;
    }


}
