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

    public static function countPoint($amount, $categoryid)
    {
        $point = \App\Models\Point::where('service_id', $categoryid)->first();

        return round(($amount / $point->multiple) * $point->value);
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

    public static function convertDateToIndo($date)
    {
        // Daftar nama bulan dan hari dalam bahasa Indonesia
        $months = [
            'January' => 'Januari',
            'February' => 'Februari',
            'March' => 'Maret',
            'April' => 'April',
            'May' => 'Mei',
            'June' => 'Juni',
            'July' => 'Juli',
            'August' => 'Agustus',
            'September' => 'September',
            'October' => 'Oktober',
            'November' => 'November',
            'December' => 'Desember'
        ];

        $days = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu'
        ];

        // Mengubah format tanggal ke dalam bahasa Indonesia
        $timestamp = strtotime($date);
        $day = date('l', $timestamp);  // Mendapatkan hari
        $month = date('F', $timestamp);  // Mendapatkan bulan
        $dateFormatted = date('d', $timestamp);  // Mendapatkan tanggal
        $year = date('Y', $timestamp);  // Mendapatkan tahun

        return [
            'hari' => $days[$day],
            'tanggal' => $dateFormatted,
            'bulan' => $months[$month],
            'tahun' =>$year
        ];
    }

    public static function convertShortDateToIndo($date)
    {
        // Daftar nama bulan dan hari dalam bahasa Indonesia
        $months = [
            'January' => 'Jan',
            'February' => 'Feb',
            'March' => 'Mar',
            'April' => 'Apr',
            'May' => 'Mei',
            'June' => 'Jun',
            'July' => 'Jul',
            'August' => 'Agus',
            'September' => 'Sep',
            'October' => 'Okt',
            'November' => 'Nov',
            'December' => 'Des'
        ];

        $days = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu'
        ];

        // Mengubah format tanggal ke dalam bahasa Indonesia
        $timestamp = strtotime($date);
        $day = date('l', $timestamp);  // Mendapatkan hari
        $month = date('F', $timestamp);  // Mendapatkan bulan
        $dateFormatted = date('d', $timestamp);  // Mendapatkan tanggal
        $year = date('Y', $timestamp);  // Mendapatkan tahun

        return [
            'hari' => $days[$day],
            'tanggal' => $dateFormatted,
            'bulan' => $months[$month],
            'tahun' =>$year
        ];
    }

    public static function getDateShortMonth($date){
        $data = General::convertShortDateToIndo($date);
        return $data['tanggal'] . ' ' . $data['bulan'] . ' ' . $data['tahun'];
    }

    public static function getDateShortDayMonth($date){
        $data = General::convertShortDateToIndo($date);

        return $data['tanggal'] . ' ' . $data['bulan'];
    }

    public static function getNextWeekdays($date): array
    {
        $tomorow = Carbon::parse(date('Y-m-d h:i:s', strtotime('+1 days', strtotime($date))));
        $weekdays = [];

        while (count($weekdays) < 7) {
            if ($tomorow->isWeekDay()) {
                $weekdays[] = $tomorow->format('Y-m-d');
            }
            $tomorow->addDay();
        }

        return $weekdays;
    }

    public static function getNextWeekends($date): array
    {
        $tomorow = Carbon::parse(date('Y-m-d h:i:s', strtotime('+1 days', strtotime($date))));
        $weekends = [];

        while (count($weekends) < 7) {
            if ($tomorow->isWeekEnd()) {
                $weekends[] = $tomorow->format('Y-m-d');
            }
            $tomorow->addDay();
        }

        return $weekends;
    }

    public static function isWeekEnd($date){
        return date('N', strtotime($date)) >= 6;
    }

    public static function isTomorow($date){
        return date('Y-m-d', strtotime('+1 days', strtotime($date))) == date('Y-m-d', strtotime(Carbon::tomorrow()));
    }

    public static function getCarbon($date){
        return Carbon::parse($date);
    }

    public static function addingDays($date, $long){
        return General::getCarbon($date)->addDays($long);
    }
}
