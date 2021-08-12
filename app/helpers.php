<?php


use App\Models\User;
use App\Utils\Charts\Chart;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\ArrayToXml\ArrayToXml;


function active_class($path, $active = 'active') {
  return call_user_func_array('Request::is', (array)$path) ? $active : '';
}

function is_active_route($path) {
  return call_user_func_array('Request::is', (array)$path) ? 'true' : 'false';
}

function show_class($path) {
  return call_user_func_array('Request::is', (array)$path) ? 'show' : '';
}

if (!function_exists('can')) {
    function can($permissions)
    {
        return current_user()->isAbleTo($permissions);
    }
}

if (!function_exists('money')) {
    function money($amount, $abs = true)
    {
        if ($abs) {
            return "Tsh. " . number_format(abs($amount));
        } else
            return "Tsh. " . number_format($amount);
    }
}


if (!function_exists('fmoney')) {
    function fmoney($amount, $abs = true)
    {
        if ($abs) {
            return number_format(abs($amount));
        } else
            return number_format($amount);
    }
}

if (!function_exists('fdate')) {
    function fdate($date)
    {
        return Carbon::parse($date)->format(config('app.date_format'));
    }
}

if (!function_exists("phonef")) {
    function phonef($phone_number)
    {
        return "255" . substr($phone_number, -9);
    }
}

if (!function_exists("phone_e")) {
    function phone_e($phone_number)
    {
        return "(+)$phone_number";
    }
}

if (!function_exists("edate")) {
    function edate($date)
    {
        return $date->setTimezone('Africa/Nairobi')->format('d/m/Y H:m:i');
    }
}

if (!function_exists("formdate")) {
    function formdate($date)
    {
        return $date->format('Y-m-d');
    }
}

if (!function_exists("date_range")) {
    function date_range()
    {
        $from = request()->from ? Carbon::parse(request()->from) : Carbon::parse("first day of this month at midnight");
        $to = request()->to ? Carbon::parse(request()->to) : Carbon::parse("last day of this month at midnight")->addSeconds(59)->addMinutes(59)->addHours(23);;
        return ["from" => $from, "to" => $to];
    }
}

if (!function_exists("upload_base64_image")) {
    function upload_base64_image($file, $string)
    {
        $imageData = base64_decode($string);
    }
}

if (!function_exists("current_user")) {
    function current_user(): User
    {
        $user = Auth::user();
        return $user;
    }
}

if (!function_exists("pdf")) {
    function pdf()
    {
        $pdf = app()->make("dompdf.wrapper");
        return $pdf;
    }
}

// requires laravel charts installation
if (!function_exists("chart")) {
    // function chart(Chart $chart){
    //     return $chart->build();
    // }
}

if (!function_exists("isEmail")) {
    function isEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) ? true : false;
    }
}

if (!function_exists("pageSize")) {
    function pageSize()
    {
        $pageSize = request()->has("size") ? request()->size : config("app.pagination_size");
        return $pageSize;
    }
}

/*
* For reference this is example format of URLbase64data
* "data:image/jpeg;base64,/9j/4AAQSkZJRgABA_ _ _"
**/
if (!function_exists("decodeBase64URL")) {
    function decodeBase64URL($string)
    {
        $file_type = Str::between($string, 'data:', '/');
        $image_type = Str::between($string, '/', ';');
        $data_format = Str::between($string, ';', ',');
        $base64_string = substr($string, strpos($string, ",") + 1);

        return array(
            'status' => true,
            'file_type' => $file_type,
            'image_type' => $image_type,
            'image_ext' => '.' . $image_type,
            'data_format' => $data_format,
            'base64_string' => $base64_string
        );
    }
}

/**
 * Upload base64File
 */
if (!function_exists("uploadBase64File")) {
    function uploadBase64File($string, $storage_folder, $prefix = "img")
    {
        $data = decodeBase64URL($string);
        $name = $storage_folder . "/" . uniqid($prefix) . $data["image_ext"];
        if (Storage::put($name, base64_decode($data["base64_string"]))) {
            return $name;
        }
        return false;
    }
}

if(!function_exists("res")){
    function res($data,  $success = true, $message = null){

        if($message == null)
            $message = $success? "Request successful": "Request unsuccessful";

        return [
            "message"=> $message,
            "success"=> $success,
            "data"=> $data
        ];
    }
}
