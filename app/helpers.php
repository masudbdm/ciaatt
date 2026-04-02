<?php

use App\Models\WebsiteParameter;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Request;

//////For News

function getLang()
{
  if (Auth::check()) {
    $user = Auth::user();
    return $user->language;
  } elseif (Cookie::has('lang')) {
    return Cookie::get('lang');
  } else {
    return config('locale');
  }
}
function setLang($lang)
{
  Cookie::queue('lang', $lang, 1000000);
  if (Auth::check()) {
    $user = Auth::user();
    $user->language = $lang;
    $user->save();
  }
}
function langRoute($route)
{
  return route($route, ['lan' => getLang()]);
}


/**
 * Return sizes readable by humans
 */
function human_filesize($bytes, $decimals = 2)
{
  $size = ['B', 'kB', 'MB', 'GB', 'TB', 'PB'];
  $factor = floor((strlen($bytes) - 1) / 3);

  return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) .
    @$size[$factor];
}

/**
 * Is the mime type an image
 */
function is_image($mimeType)
{
  return starts_with($mimeType, 'image/');
}

// function human_time()
// {
//     $time = ['seconds', 'minutes', 'hours', 'days', 'months', 'years'];
//     $factor = floor()
// }
function timestamToTimeDiffarece($star_date, $end_date)
{

  $start =  Carbon::create($star_date);
  $end =  Carbon::create($end_date);
  $HourMunite = $end->diffInMinutes($start, true);
  $result = number_format((float)$HourMunite / 60, 2, '.', '');
  $cal = explode('.', $result);
  $final_result = $cal[0] . "hrs " . $cal[1] . "mins";
  return $final_result;
}
function timestamToHoursDiffarece($star_date, $end_date)
{
  $start =  Carbon::create($star_date);
  $end =  Carbon::create($end_date);
  $Hours = $end->diffInHours($start, true);
  return $Hours;
}
function editions()
{
  return explode(',', WebsiteParameter::first()->news_editions);
}
//SEO

function embededURL($url){
if (strpos($url,"watch?v=")) {
  return str_replace("watch?v=","embed/",$url);
}else {
  return $url;
}

}
function image_slug($text)
{
  $string = Str::slug($text);
  return $string;
}
function alt($text)
{
  if ($text) {
    $text = $text;
  } else {
    $text = 'Standard-News-CMS_MF';
  }
  $alt = explode('_', $text);
  return $alt[0];
  // return $string;
}

// SEO 

function custom_slug($text)
{
  $date = date('ynjGis');
  $string = str_slug($text);
  $rand = strtolower(str_random(8));
  $string = substr($string, 0, 100);
  return $date . '-' . $rand . '-' . $string;
}
function mySlug($text)
{
  $str = str_replace(' ', '-', $text);
  $smallLatter = strtolower($str);
  $string = substr($smallLatter, 0, 100);
  return $string;
}


function custom_name($text, $limit)
{
  if (strlen($text) > $limit) {
    return str_pad(substr($text, 0, ($limit - 2)), ($limit + 1), '.');
  } else {
    return $text;
  }
}

function custom_title($text, $limit)
{
  if (strlen($text) > $limit) {
    return substr($text, 0, $limit);
  } else {
    return $text;
  }
}

function new_slug($text = '')
{
  // $string = str_slug($text);
  // if($string){ 
  //   return $string; 
  // }else{ 

  //   // return strtolower(preg_replace('/\s+/u', '-', $text));
  //   return strtolower(preg_replace('/[\W\s\/]+/', '-', $text));
  //   # return preg_replace('/\s+/u', '-', trim($string));
  // }

  $text = $text ?: '-';

  $generator = new \Vnsdks\SlugGenerator\SlugGenerator;
  return $generator->generate($text);
}

function en2bnNumber($number)
{
  $search_array = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
  $replace_array = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
  $en_number = str_replace($search_array, $replace_array, $number);

  return $en_number;
}

function en2bnMonthName($name)
{
  $search_array = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
  $replace_array = array("জানুয়ারি", "ফেব্রুয়ারি", "মার্চ", "এপ্রিল", "মে", "জুন", "জুলাই", "আগস্ট", "সেপ্টেম্বর", "অক্টোবর", "নভেম্বর", "ডিসেম্বর");
  $result = str_replace($search_array, $replace_array, $name);

  return $result;
}

function en2bnDate($date)
{
  // $date = date("l, j F Y");
  $engDATE = array(
    '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', 'January', 'February', 'March', 'April',
    'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December', 'Saturday', 'Sunday',
    'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'
  );
  $bangDATE = array(
    '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯', '০', 'জানুয়ারি', 'ফেব্রুয়ারি', 'মার্চ', 'এপ্রিল', 'মে',
    'জুন', 'জুলাই', 'আগস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর', 'শনিবার', 'রবিবার', 'সোমবার', 'মঙ্গলবার', '
বুধবার', 'বৃহস্পতিবার', 'শুক্রবার'
  );
  $convertedDATE = str_replace($engDATE, $bangDATE, $date);
  return "$convertedDATE";

  // {{date("d,M,y", strtotime("now"))}},  


}

//bangladate


function menuSubmenu($menu, $submenu)
{
  $request = request();
  $request->session()->forget(['lsbm', 'lsbsm']);
  $request->session()->put(['lsbm' => $menu, 'lsbsm' => $submenu]);
  return true;
}

function bdMobile($mobile)
{
  $number = trim($mobile);
  $c_code = '880';
  $cc_count = strlen($c_code);

  if (substr($number, 0, 2) == '00') {
    $number = ltrim($number, '0');
  }
  if (substr($number, 0, 1) == '0') {
    $number = ltrim($number, '0');
  }
  if (substr($number, 0, 1) == '+') {
    $number = ltrim($number, '+');
  }
  if (substr($number, 0, $cc_count) == $c_code) {
    $number = substr($number, $cc_count);
  }
  if (substr($c_code, -1) == 0) {
    $number = ltrim($number, '0');
  }
  $finalNumber = $c_code . $number;

  return $finalNumber;
}

function bdMobileWithCode($mobile)
{
  $number = trim($mobile);
  $c_code = '+880';
  $cc_count = strlen($c_code);

  if (substr($number, 0, 2) == '00') {
    $number = ltrim($number, '0');
  }
  if (substr($number, 0, 1) == '0') {
    $number = ltrim($number, '0');
  }
  if (substr($number, 0, 1) == '+') {
    $number = ltrim($number, '+');
  }
  if (substr($number, 0, $cc_count) == $c_code) {
    $number = substr($number, $cc_count);
  }
  if (substr($c_code, -1) == 0) {
    $number = ltrim($number, '0');
  }
  $finalNumber = $c_code . $number;

  return $finalNumber;
}

function bdMobileWithoutCode($mobile)
{
  $number = trim($mobile);
  $c_code = '0';
  $cc_count = strlen($c_code);
  if (substr($number, 0, 2) == '00') {
    $number = ltrim($number, '0');
  }
  if (substr($number, 0, 1) == '0') {
    $number = ltrim($number, '0');
  }
  if (substr($number, 0, 1) == '+') {
    $number = ltrim($number, '+');
  }
  if (substr($number, 0, $cc_count) == $c_code) {
    $number = substr($number, $cc_count);
  }
  if (substr($c_code, -1) == 0) {
    $number = ltrim($number, '0');
  }
  $finalNumber = $c_code . $number;
  return $finalNumber;
}

function smsUrl($to, $msg)
{
  $userId = config('parameter.smsUserId');
  $pass = config('parameter.smsPassword');
  $masking = config('parameter.MaskingID');

  // return "http://66.45.237.70/maskingapi.php?username={$userId}&password={$pass}&number={$to}&message={$msg}&senderid={$masking}";
  //   return "https://enterprise.messageanalytica.com/api/sms/v1/send?userid={$userId}&body={$msg}&recipient={$to}&sender={$masking}&password={$pass}";


  return "https://enterprise-api.messageanalytica.com/api/v1/channels/sms?apiKey=4F165DC3771A5ED45A3DA7FBC3F4&recipient={$to}&from=8809612737373&message={$msg}";
}

// https://enterprise.messageanalytica.com/api/sms/v1/send?userid=softcodeint@gmail.com&body=test&recipient=8801518643843&sender=8809612737373&password=newSSEE__2020

    //for custom package
    //https://github.com/gocanto/gocanto-pkg
    //https://laravel.com/docs/5.2/packages
    //http://stackoverflow.com/questions/19133020/using-models-on-packages
    //http://kaltencoder.com/2015/07/laravel-5-package-creation-tutorial-part-1/
    //http://laravel-recipes.com/recipes/50/creating-a-helpers-file
