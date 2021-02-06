<?php

use App\Models\AdminNotification;
use App\Models\App;
use App\Models\CMS;
use App\Models\LoanNotification;
use App\Models\Review;
use App\Models\UserLoanDetail;
use App\Models\WebSetting;
use Illuminate\Support\Facades\Auth;

/**
 * -------------------------------------------------------
 * | Date format                                         |
 * |                                                     |
 * | @param  object/array $request                       |
 * | @return data                                        |
 * -------------------------------------------------------
 */
function formatDate($date)
{
    return $date ? $date->format(config('dateFormats.formates.DATE')) : '';
}

/**
 * -------------------------------------------------------
 * | current date                                        |
 * |                                                     |
 * | @param  object/array $request                       |
 * | @return data                                        |
 * -------------------------------------------------------
 */
function getCurrentDate()
{
    return Carbon\Carbon::now();
}

/**
 * -------------------------------------------------------
 * | Date parse                                          |
 * |                                                     |
 * | @param  object/array $request                       |
 * | @return data                                        |
 * -------------------------------------------------------
 */
function parseDate($date, $dateFormat = null)
{
    $dateFormat = (isset($dateFormat)) ? $dateFormat : 'Y-m-d H:i:s';
    $dateObj = \Carbon\Carbon::parse($date);
    $formatedDate = $dateObj->format($dateFormat);

    return $formatedDate;
}

/**
 * -------------------------------------------------------
 * | String to json                                      |
 * |                                                     |
 * | @param  object/array $request                       |
 * | @return data                                        |
 * -------------------------------------------------------
 */
function stringToJson($string)
{
    return json_encode(json_decode($string));
}

/**
 * -------------------------------------------------------
 * | array to string                                     |
 * |                                                     |
 * | @param  object/array $request                       |
 * | @return data                                        |
 * -------------------------------------------------------
 */
function arrayToString($data)
{
    return implode(', ', $data);
}

/**
 * -------------------------------------------------------
 * | Get Fist word                                       |
 * |                                                     |
 * | @param  object/array $request                       |
 * | @return data                                        |
 * -------------------------------------------------------
 */
function getFirstWord(string $string)
{
    $result = strstr($string, ' ', true);

    return $result !== false ? $result : $string;
}

/**
 * -------------------------------------------------------
 * | Remove mull from array                              |
 * |                                                     |
 * | @param  object/array $request                       |
 * | @return data                                        |
 * -------------------------------------------------------
 */
function removeNullFromArray($arr)
{
    return $arr = array_map(function ($v) {
        return (is_null($v)) ? "" : $v;
    }, $arr);
}

/**
 * -------------------------------------------------------
 * | Validate valid url string                           |
 * |                                                     |
 * | @param  string $request                             |
 * | @return data                                        |
 * -------------------------------------------------------
 */
function validURL($string)
{
    if (filter_var($string, FILTER_VALIDATE_URL)) {
        return true;
    } else {
        return false;
    }
}

/**
 * -------------------------------------------------------
 * | Print data with pre tag                             |
 * |                                                     |
 * | @param  string $request                             |
 * | @return data                                        |
 * -------------------------------------------------------
 */
function pre($value)
{
    echo '<pre>';
    print_r($value);
    echo '</pre>';die;
}

/**
 * -------------------------------------------------------
 * | Dump data with pre tag                              |
 * |                                                     |
 * | @param  string $request                             |
 * | @return data                                        |
 * -------------------------------------------------------
 */
function dmp($value)
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';die;
}

/**
 * -------------------------------------------------------
 * | Short long content                                  |
 * |                                                     |
 * | @param  string $request                             |
 * | @return data                                        |
 * -------------------------------------------------------
 */
function shorter($input, $length)
{
    // No need to trim, already shorter than trim length
    if (strlen($input) <= $length) {
        return $input;
    }

    // Find last space within length
    $last_space = strrpos(substr($input, 0, $length), ' ');
    if (!$last_space) {
        $last_space = $length;
    }

    $trimmed_text = substr($input, 0, $last_space);

    // Add ellipses (...)
    $trimmed_text .= ' ...';

    return $trimmed_text;
}

/**
 * -------------------------------------------------------
 * | change array key name without changing order        |
 * |                                                     |
 * | @param  string $request                             |
 * | @return data                                        |
 * -------------------------------------------------------
 */
function replace_key($arr, $oldkey, $newkey)
{
    if (array_key_exists($oldkey, $arr)) {
        $keys = array_keys($arr);
        $keys[array_search($oldkey, $keys)] = $newkey;
        return array_combine($keys, $arr);
    }
    return $arr;
}

/**
 * -------------------------------------------------------
 * | change multiple array key name without              |
 * | changing order                                      |
 * |                                                     |
 * | @param  string $request                             |
 * | @return data                                        |
 * -------------------------------------------------------
 */
function recursive_change_key($arr, $set)
{
    if (is_array($arr) && is_array($set)) {
        $newArr = array();
        foreach ($arr as $k => $v) {
            $key = array_key_exists($k, $set) ? $set[$k] : $k;
            $newArr[$key] = is_array($v) ? recursive_change_key($v, $set) : $v;
        }
        return $newArr;
    }
    return $arr;
}

/**
 * -------------------------------------------------------
 * | Date format for API Time diff.                      |
 * |                                                     |
 * | @param  object/array $request                       |
 * | @return data                                        |
 * -------------------------------------------------------
 */
function apiTimeDiffFormatDate($date)
{
    return $date ? $date->format(config('dateFormats.formates.API_DATE_Time')) : '';
}

/**
 * -------------------------------------------------------
 * | Date format for API Time diff.                      |
 * |                                                     |
 * | @param  object/array $request                       |
 * | @return data                                        |
 * -------------------------------------------------------
 */
function apiReviewFormatDate($date)
{
    return $date ? $date->format(config('dateFormats.formates.API_REVIEW_DATE')) : '';
}


/**
 * -------------------------------------------------------
 * | Get settings data                                     |
 * |                                                     |
 * | @return array                                       |
 * -------------------------------------------------------
 */
function getWebSetting()
{
    $setting = WebSetting::first();
    return @$setting;
}

function monthList()
{
    $months = [
        '' => "Select Month",
        1 => "January",
        2 => "February",
        3 => "March",
        4 => "April",
        5 => "May",
        6 => "June",
        7 => "July",
        8 => "August",
        9 => "September",
        10 => "October",
        11 => "November",
        12 => "December",
    ];

    return $months;
}

function dateList(){
    $days = [];
    $days[''] = 'Select Date';
    for ($i = 1; $i <= 31; $i++) {
        if ($i <= 9) {
            $days[$i] = '0'.$i;
        } else {
            $days[] = $i;
        }
    }
    return $days;
}
/**
 * -------------------------------------------------------
 * | Convert date into timestamp                         |
 * |                                                     |
 * -------------------------------------------------------
 */
function timeStampConverter($date) 
{
    return strtotime($date);
}

/**
 * get favicon
 *
 * @return void
 */
function favicon()
{
    $webSetting = WebSetting::first();
    if ($webSetting) {
        return $webSetting->image_names;
    }
    return asset('');
}

/**
 * get favicon
 *
 * @return void
 */
function logo()
{
    $webSetting = WebSetting::first();
    if ($webSetting) {
        return $webSetting->image_names;
    }
    return asset('images/logo.png');
}

/**
 * get favicon
 *
 * @return void
 */
function video()
{
    $webSetting = WebSetting::first();
    if ($webSetting) {
        return $webSetting->video_names;
    }
    return asset('images/video.mp4');
}

/**
 * Show year dropdown
 * @return Array
 */
function yearList(){
    $years= []; 
    for($i=1; $i <= 5;$i++){
        $years[$i] = $i.' Year';
    }
    return ['' => __('formname.select_type',['type'=>'Year'])]+$years;
}

/**
 * web setting
 * @return Array
 */
function setting(){
    $setting = WebSetting::first();
    return @$setting;
}

/**
 * status list
 *
 * @return void
 */
function statusList()
{
    return [
        '' => 'Select',
        'active' => 'Active',
        'inactive' => 'Inactive',
    ];
}
function months(){
    return [
        12 => '12 Months[1 Year]',
        24 => '24 Months[2 Year]',
        36 => '36 Months[3 Year]',
        48 => '48 Months[4 Year]',
        60 => '60 Months[5 Year]',
    ];
}

function appList(){
    $appList = App::active()->orderBy('id','asc')->get();
    if($appList == null){
        $appList =[];
    }
    return @$appList;
}
function reviews(){
    $review = Review::active()->get();
    return $review;
}
function loanNotificationlist(){
    $notification =LoanNotification::whereType(1)->whereUserId(Auth::id())->whereIsRead(0)->orderBy('id','desc')->get();
    return $notification;
}

function earningNotificationlist(){
    $notification =LoanNotification::whereType(2)->whereUserId(Auth::id())->whereIsRead(0)->orderBy('id','desc')->get();
    return $notification;
}

function privacyPolicy(){
    $content = CMS::wherePageSlug('privacy-policy')->first();
    return @$content->page_content;
}
function termAndCondition(){
    $content = CMS::wherePageSlug('terms-conditions')->first();
    return @$content->page_content;
}

function generateStudentNo()
{
    $last = 12;
    $lastStudent = UserLoanDetail::orderBy('id', 'desc')->where('auto_account_number','!=',null)->first();
    if ($lastStudent) {
        $lastStudentId = $lastStudent->auto_account_number;
        $newStudentNo = $lastStudentId + 1;
    } else {
        $newStudentNo = date('Ymd').$last;
    }
    // dd($newStudentNo);
    return $newStudentNo;
}