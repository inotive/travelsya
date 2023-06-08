<?php

namespace App\Helpers;

class General
{
    public static function rp($val)
    {
        return "Rp " . number_format($val, 0, ",", ".");
    }
}
