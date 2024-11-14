<?php

namespace App\Helpers;

use App\Models\BusBooked;
use Carbon\Carbon;

class General
{
    public static function rp($val)
    {
        return "Rp " . number_format($val, 0, ",", ".");
    }
    function generateRandomString($length = 6)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $result = '';
        for ($i = 0; $i < $length; $i++) {
            $result .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $result;
    }

    public static function busAvailableTicket($collection, $date)
    {
        $date = Carbon::parse($date . ' ' . $collection['departure_time'])->format('Y-m-d H:i');

        $booked = BusBooked::where('bus_travel_has_bus_id', $collection['bus_travel_has_bus_id'])->where('departure_time', $date)->count();

        if (isset($collection['busTravel'])) {
            $available = $collection['busTravel']['number_seats'] - $booked;
        } else {
            $available = 0;
        }

        return $available;
    }
}
