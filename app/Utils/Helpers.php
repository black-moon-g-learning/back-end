<?php

use App\Constants\Common;
use App\Models\User;

if (!function_exists('getUsername')) {

    function getUsername(User $user)
    {
        return $user->first_name . ' ' . $user->last_name;
    }
}

if (!function_exists('getTime')) {
    function getTime($date)
    {
        $d1 = new DateTime($date);
        $d2 = new DateTime(now()->format("Y-m-d h:i:s"));

        $interval = $d1->diff($d2);
        $diffInMinutes = $interval->i; //23
        $diffInHours   = $interval->h; //8
        $diffInDays    = $interval->d; //21
        $diffInMonths  = $interval->m; //4
        $diffInYears   = $interval->y; //1

        if ($diffInYears >= 1) {
            return addSIfMany($diffInYears, 'year');
        } else if ($diffInMonths > 1) {
            return addSIfMany($diffInMonths, 'month');
        } else if ($diffInDays > 1) {
            return addSIfMany($diffInDays, 'day');
        } else if ($diffInHours > 1) {
            return addSIfMany($diffInHours, 'hour');
        } else if ($diffInMinutes > 1) {
            return addSIfMany($diffInMinutes, 'minute');
        } else {
            return 'now';
        }
    }
}

if (!function_exists('addSIfMany')) {

    function addSIfMany($number, $string)
    {
        if ($number == 1) {
            return $number . ' ' . $string .  ' ago';
        }
        return $number . ' ' . $string . 's' .  ' ago';
    }
}

if (!function_exists('convertTimeFromDB')) {
    function convertTimeFromDB(int $time): string
    {
        return (int)($time / 60) . ' : ' . (int)($time % 60);
    }
}

if (!function_exists('getS3Url')) {
    function getS3Url(string $url): string
    {
        if (str_contains($url, 'http')) {
            return $url;
        }
        return Common::S3_ROOT . $url;
    }
}

if (!function_exists('handleLongText')) {
    function handleLongText(?string $text, int $length = 40)
    {
        if (strlen($text) > $length) {
            return substr($text, 0, $length) . '...';
        }
        return $text;
    }
}
