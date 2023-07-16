<?php

namespace App\Traits;

trait IdentifierTrait
{

    public function check(string $url)
    {
        $pattern1 = '/^https:\/\/(www.)?digikala.com\/product\/(dkp-([\d]+))(\/([\d\w\%\-]+))?(\/)?/s';
        $pattern2 = '/^dkp-([\d]+)$/s';
        $pattern3 = '/^([\d]+)$/s';

        if (preg_match($pattern1, $url, $preg)) {
            return $preg[3];
        } elseif (preg_match($pattern2, $url, $preg)) {
            return $preg[1];
        } else if (preg_match($pattern3, $url, $preg)) {
            return $preg[0];
        } else {
            return false;
        }
    }


}
