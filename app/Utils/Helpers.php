<?php

use App\Constants\Common;
use App\Constants\User as ConstantsUser;
use App\Models\User;
use Carbon\Carbon;

if (!function_exists('getUsername')) {

    function getUsername(User|null $user)
    {
        if ($user === null) {
            return "Unknown";
        }
        return $user->first_name . ' ' . $user->last_name;
    }
}

if (!function_exists('getTime')) {
    function getTime($date)
    {
        $d1 = Carbon::parse($date);
        $d2 = Carbon::now();

        $diffInMinutes = $d1->diffInMinutes($d2); //23
        $diffInHours   = $d1->diffInHours($d2); //8
        $diffInDays    = $d1->diffInDays($d2); //21
        $diffInMonths  = $d1->diffInMonths($d2); //4
        $diffInYears   = $d1->diffInYears($d2); //1

        if ($diffInYears >= 1) {
            return addSIfMany($diffInYears, 'year');
        } else if ($diffInMonths >= 1) {
            return addSIfMany($diffInMonths, 'month');
        } else if ($diffInDays >= 1) {
            return addSIfMany($diffInDays, 'day');
        } else if ($diffInHours >= 1) {
            return addSIfMany($diffInHours, 'hour');
        } else if ($diffInMinutes >= 1) {
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
    function getS3Url(?string $url): string
    {
        if ($url == null) {
            return "https://www.smartdatajob.com/images/joomlart/demo/default.jpg";
        } else if (str_contains($url, 'http')) {
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

if (!function_exists('handleShowVideoLink')) {
    function handleShowVideoLink(?string $url)
    {
        if (str_contains($url, 'videos/')) {
            $link = Common::S3_ROOT . $url;
        } else {
            $link = Common::YOUTUBE_EMBED . $url;
        }
        return $link;
    }
}

if (!function_exists('calPercent')) {

    function calPercent(int $first, int $second)
    {
        if ($second == 0) {
            return 0;
        } else {
            return round($first / $second * 33.3, 2);
        }
    }
}

if (!function_exists('showStatusUser')) {
    function showStatusUser(null| string $statusUser)
    {
        $status = [
            ConstantsUser::ACTIVE_STATUS =>  ConstantsUser::ACTIVE_STATUS,
            ConstantsUser::BLOCKED_STATUS => ConstantsUser::BLOCKED_STATUS,
            null => ConstantsUser::ACTIVE_STATUS
        ];
        return $status[$statusUser];
    }
}
