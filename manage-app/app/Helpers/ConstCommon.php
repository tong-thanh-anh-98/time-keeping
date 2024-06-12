<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Contracts\Routing\UrlGenerator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Mail\SendLinkMail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;

class ConstCommon
{

    const ListTypeUser = ['user' => 1, 'admin' => 0];
    const TypeUser = 1;
    const TypeAdmin = 0;

    const MailAdmin = [];

    public static function addImageToStorage($file, $name)
    {
        $file->storeAs('images', $name, 'public');
    }
    public static function getLinkImageToStorage($name)
    {
        return url('storage/images/' . $name);
    }
    public static function delImageToStorage($name)
    {
        return Storage::delete('images/' . $name);
    }
    public static function getCurrentTime()
    {
        $now = Carbon::now();
        $now->setTimezone('Asia/Ho_Chi_Minh');
        return $now->format('Y-m-d') . '-' . $now->format('h-s-i');
    }
    public static function sendMail($email, $content)
    {
        $mail = new SendMail($content);
        return Mail::to(['duongvantuan1503@gmail.com', $email])->queue($mail);
    }
    public static function sendMailLinkPass($email, $content)
    {
        $mail = new SendLinkMail($content);
        return Mail::to(['duongvantuan1503@gmail.com', $email])->queue($mail);
    }

    public static function getListDateEcomecy()
    {
        $dateArray = [];

        $currentDatePrev = Carbon::now();
        for ($i = 1; $i <= 50; $i++) {
            $dateArray[] = $currentDatePrev->subDay()->format('Y-m-d');
        }

        $currentDatePlus = Carbon::now();
        for ($i = 1; $i <= 50; $i++) {
            $dateArray[] = $currentDatePlus->addDay()->format('Y-m-d');
        }

        sort($dateArray);
        return $dateArray;
    }

    public static function getSevenDayEconomiCalender()
    {
        // Lấy ngày hiện tại
        $currentDate = Carbon::now();
        $currentDate->setTimezone('Asia/Ho_Chi_Minh');
        // Trừ 2 ngày từ ngày hiện tại
        $startDate = $currentDate->subDays(2);

        // Tạo mảng chứa 7 ngày
        $dates = [];

        // Loop để thêm 7 ngày vào mảng
        for ($i = 0; $i < 7; $i++) {
            $dates[$i] = urlencode($startDate->format('Y/m/d'));
            $startDate->addDay();
        }
        return $dates;
    }

    public static function formatdateURL($date)
    {
        $dates = urlencode($date->format('Y/m/d'));
        return $dates;
    }

    public static function getLinkIMG($data)
    {
        $needle = 'http';
        $check = 1;

        if (!empty($data)) {
            if (strpos($data, $needle) !== false) {
                $check = 1;
            } else {
                $check = 0;
            }
            if ($check == 0) {
                return self::getLinkImageToStorage($data);
            }
        }
        return $data;
    }

    public static function formatTimeCmt($value)
    {
        $dateTime = Carbon::parse($value);
        $formattedDateTime = $dateTime->format('H:i:s d/m/Y');
        return $formattedDateTime;
    }

    public static function formatTimeblogSeconMinusHour($value)
    {
        $dateTime = Carbon::parse($value);
        $formattedDateTime = $dateTime->format('H:i:s');
        return $formattedDateTime;
    }
    public static function formatTimeblogDateMonth($value)
    {
        $dateTime = Carbon::parse($value);
        $formattedDateTime = $dateTime->format('d/m');
        return $formattedDateTime;
    }

    public static function limitString($string, $limit)
    {
        if (strlen($string) > $limit) {
            $string = substr(strip_tags($string), 0, $limit) . '...';
        }
        return $string;
    }
}
