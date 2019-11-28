<?php
namespace App\Service;

class StringTool
{
    public function getUpperFirstName($string)
    {
      $stringReturn = ucfirst($string);

      return $stringReturn;

    }
}
