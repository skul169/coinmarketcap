<?php

namespace App\Http\Controllers;

use App\Bank;
use App\PayType;
use App\UserAds;
use App\Http\Requests\Request;
use App\Product;
use App\Reminder;
use App\Tranaction;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\User;
use View;
use Log;

abstract class Controller extends BaseController {

    use DispatchesCommands,
        ValidatesRequests;

    public function getBtcToVatCurrency($code) {
        $curency = \App\Currency::where('code', '=', $code)->first();
        if ($curency == null) {
            return null;
        }
        return $curency->rate;
    }
    public static function getCurrencyToVatByLanguage($lang) {
        $curency = \App\Currency::where('lang', '=', $lang)->first();
        if ($curency == null) {
            return null;
        }
        return $curency;
    }
    
    public static function Mail($template,$formData,$email,$subject){
        try {
            Mail::send($template, $formData, function ($message) use ($email,$subject){
                $message->from(config('mail.from.address'), config('mail.from.name'));
                $message->to($email)->subject($subject);
            });
        } catch (Exception $ex) {
            Log::error($ex);
            return Redirect::back()->withErrors(array('error-email' => 'Error email...!'))->withInput();
        }
    }

    public function createGreatNotification($user){

        $name = strtolower($user->username);
        if($user->username == 'admin' || $user->username == 'top' || $user->username == 'tingup'){
            return;
        }
        $avatarUrl = url('img/avatar.png');
        $levelUrl =  url('img/Up'.$user->level.'.png');
        if($user->avatar){
            $avatarUrl = url('uploads/images/avatar/').$user->avatar;
        }
        $title = 'Congratulation to <b>'.$user->username.'</b> <img src="'.$avatarUrl.'" class="img-circle" width="60" alt="User Image"> level up to <img src="'.$levelUrl.'" class="img-circle" width="60" alt="User Image">';
        Controller::createNotification(array(
            'title' => $title,
            'user_id' => $user->id,
            'content' => $title,
            'type' => Notification::TYPE_GREAT_NOTIFICATION
        ), null);
    }
    
    

    public function checksponsor($userid) {
        $sponsor =User::find($userid)->sponsor_id;
        return $sponsor;
    }

    
    public function checkactive($sponsorid) {

        $check = false;
        $active = Tranaction::where('sender_id',$sponsorid)
            ->where('paytype_id',PayType::TYPE_REFER)->first();

        if($active!=null)
        {
            $check = true;
        }
        return $check;
    }
    public static function sendMail($users, $title, $content){
        //send email thông báo
        foreach ($users as $aUser) {
            if (!$aUser->email) {
                continue;
            }
            Mail::send('emails.common', ['content' => $content], function($message) use($aUser, $title) {
                $message->from(config('mail.from.address'), config('mail.from.name'));
                $message->to($aUser->email, $aUser->email)->subject($title);
            });
        }
    }
   

    public function __construct() {
        $background = $this->getConfigByKey('BANNER');
        $logo = $this->getConfigByKey('LOGO');
        View::share('background', $background);
        View::share('logo', $logo);
      
    }

    public function getApproveUsers() {
        $users = \App\User::query()
                ->select('users.*')
                ->distinct()
                ->join('role_user', 'users.id', '=', 'role_user.user_id')
                ->join('permission_role', 'role_user.role_id', '=', 'permission_role.role_id')
                ->join('permissions', 'permissions.id', '=', 'permission_role.permission_id')
                ->where('permissions.name', 'approve-btc-manager')
                ->get();
        return $users;
    }
    /* Get Key trong bang config */

    public static function getConfigByKey($key) {
        $config = \App\Config::where('key', '=', $key)->first();
        if ($config == null) {
            return null;
        }
        return $config->value;
    }

    /* Get ID trong bang Pay_type */

    public function getPaytypeCode($key) {
        $paytype = \App\PayType::where('code', '=', $key)->first();
        if ($paytype == null) {
            return null;
        }
        return $paytype->id;
    }

    /*  Creat Transaction */

    public function createTransaction($data) {
        $transaction = array();
        foreach ($data as $index => $value) {
            $transaction[$index] = $value;
        }

        return Tranaction::create($transaction);
    }
    
    /* Delete Record Reminder */

    public function deleteComplete($user_id) {
        $Reminder = Reminder::where('user_id', '=', $user_id);
        $Reminder->delete();
    }

    public $color = array
        (
        '1' => 'aqua',
        '2' => 'green',
        '3' => 'yellow',
        '4' => 'red',
        '5' => 'brown',
        '6' => 'orange',
        '7' => 'purple',
        '8' => 'tokenk',
    );
    public $boxcolor = array
        (
        '1' => 'box-primary',
        '2' => 'box-danger',
        '3' => 'box-success',
        '4' => '',
        '5' => 'box-danger',
        '6' => 'box-success',
        '7' => 'box-primary',
        '8' => '',
    );

    /* Convert Timestamp to datetimestring */

    public function datetimestring($timestamp) {
        $datetimestring = date('Y-m-d H:i:s', $timestamp);

        return $datetimestring;
    }

    /* Get Country */

    public $countries = array
        (
        'AF' => 'Afghanistan',
        'AX' => 'Aland Islands',
        'AL' => 'Albania',
        'DZ' => 'Algeria',
        'AS' => 'American Samoa',
        'AD' => 'Andorra',
        'AO' => 'Angola',
        'AI' => 'Anguilla',
        'AQ' => 'Antarctica',
        'AG' => 'Antigua And Barbuda',
        'AR' => 'Argentina',
        'AM' => 'Armenia',
        'AW' => 'Aruba',
        'AU' => 'Australia',
        'AT' => 'Austria',
        'AZ' => 'Azerbaijan',
        'BS' => 'Bahamas',
        'BH' => 'Bahrain',
        'BD' => 'Bangladesh',
        'BB' => 'Barbados',
        'BY' => 'Belarus',
        'BE' => 'Belgium',
        'BZ' => 'Belize',
        'BJ' => 'Benin',
        'BM' => 'Bermuda',
        'BT' => 'Bhutan',
        'BO' => 'Bolivia',
        'BA' => 'Bosnia And Herzegovina',
        'BW' => 'Botswana',
        'BV' => 'Bouvet Island',
        'BR' => 'Brazil',
        'IO' => 'British Indian Ocean Territory',
        'BN' => 'Brunei Darussalam',
        'BG' => 'Bulgaria',
        'BF' => 'Burkina Faso',
        'BI' => 'Burundi',
        'KH' => 'Cambodia',
        'CM' => 'Cameroon',
        'CA' => 'Canada',
        'CV' => 'Cape Verde',
        'KY' => 'Cayman Islands',
        'CF' => 'Central African Republic',
        'TD' => 'Chad',
        'CL' => 'Chile',
        'CN' => 'China',
        'CX' => 'Christmas Island',
        'CC' => 'Cocos (Keeling) Islands',
        'CO' => 'Colombia',
        'KM' => 'Comoros',
        'CG' => 'Congo',
        'CD' => 'Congo, Democratic Republic',
        'CK' => 'Cook Islands',
        'CR' => 'Costa Rica',
        'CI' => 'Cote D\'Ivoire',
        'HR' => 'Croatia',
        'CU' => 'Cuba',
        'CY' => 'Cyprus',
        'CZ' => 'Czech Republic',
        'DK' => 'Denmark',
        'DJ' => 'Djibouti',
        'DM' => 'Dominica',
        'DO' => 'Dominican Republic',
        'EC' => 'Ecuador',
        'EG' => 'Egypt',
        'SV' => 'El Salvador',
        'GQ' => 'Equatorial Guinea',
        'ER' => 'Eritrea',
        'EE' => 'Estonia',
        'ET' => 'Ethiopia',
        'FK' => 'Falkland Islands (Malvinas)',
        'FO' => 'Faroe Islands',
        'FJ' => 'Fiji',
        'FI' => 'Finland',
        'FR' => 'France',
        'GF' => 'French Guiana',
        'PF' => 'French Polynesia',
        'TF' => 'French Southern Territories',
        'GA' => 'Gabon',
        'GM' => 'Gambia',
        'GE' => 'Georgia',
        'DE' => 'Germany',
        'GH' => 'Ghana',
        'GI' => 'Gibraltar',
        'GR' => 'Greece',
        'GL' => 'Greenland',
        'GD' => 'Grenada',
        'GP' => 'Guadeloupe',
        'GU' => 'Guam',
        'GT' => 'Guatemala',
        'GG' => 'Guernsey',
        'GN' => 'Guinea',
        'GW' => 'Guinea-Bissau',
        'GY' => 'Guyana',
        'HT' => 'Haiti',
        'HM' => 'Heard Island & Mcdonald Islands',
        'VA' => 'Holy See (Vatican City State)',
        'HN' => 'Honduras',
        'HK' => 'Hong Kong',
        'HU' => 'Hungary',
        'IS' => 'Iceland',
        'IN' => 'India',
        'ID' => 'Indonesia',
        'IR' => 'Iran, Islamic Republic Of',
        'IQ' => 'Iraq',
        'IE' => 'Ireland',
        'IM' => 'Isle Of Man',
        'IL' => 'Israel',
        'IT' => 'Italy',
        'JM' => 'Jamaica',
        'JP' => 'Japan',
        'JE' => 'Jersey',
        'JO' => 'Jordan',
        'KZ' => 'Kazakhstan',
        'KE' => 'Kenya',
        'KI' => 'Kiribati',
        'KR' => 'Korea',
        'KW' => 'Kuwait',
        'KG' => 'Kyrgyzstan',
        'LA' => 'Lao People\'s Democratic Republic',
        'LV' => 'Latvia',
        'LB' => 'Lebanon',
        'LS' => 'Lesotho',
        'LR' => 'Liberia',
        'LY' => 'Libyan Arab Jamahiriya',
        'LI' => 'Liechtenstein',
        'LT' => 'Lithuania',
        'LU' => 'Luxembourg',
        'MO' => 'Macao',
        'MK' => 'Macedonia',
        'MG' => 'Madagascar',
        'MW' => 'Malawi',
        'MY' => 'Malaysia',
        'MV' => 'Maldives',
        'ML' => 'Mali',
        'MT' => 'Malta',
        'MH' => 'Marshall Islands',
        'MQ' => 'Martinique',
        'MR' => 'Mauritania',
        'MU' => 'Mauritius',
        'YT' => 'Mayotte',
        'MX' => 'Mexico',
        'FM' => 'Micronesia, Federated States Of',
        'MD' => 'Moldova',
        'MC' => 'Monaco',
        'MN' => 'Mongolia',
        'ME' => 'Montenegro',
        'MS' => 'Montserrat',
        'MA' => 'Morocco',
        'MZ' => 'Mozambique',
        'MM' => 'Myanmar',
        'NA' => 'Namibia',
        'NR' => 'Nauru',
        'NP' => 'Nepal',
        'NL' => 'Netherlands',
        'AN' => 'Netherlands Antilles',
        'NC' => 'New Caledonia',
        'NZ' => 'New Zealand',
        'NI' => 'Nicaragua',
        'NE' => 'Niger',
        'NG' => 'Nigeria',
        'NU' => 'Niue',
        'NF' => 'Norfolk Island',
        'MP' => 'Northern Mariana Islands',
        'NO' => 'Norway',
        'OM' => 'Oman',
        'PK' => 'Pakistan',
        'PW' => 'Palau',
        'PS' => 'Palestinian Territory, Occupied',
        'PA' => 'Panama',
        'PG' => 'Papua New Guinea',
        'PY' => 'Paraguay',
        'PE' => 'Peru',
        'PH' => 'Philiptokenes',
        'PN' => 'Pitcairn',
        'PL' => 'Poland',
        'PT' => 'Portugal',
        'PR' => 'Puerto Rico',
        'QA' => 'Qatar',
        'RE' => 'Reunion',
        'RO' => 'Romania',
        'RU' => 'Russian Federation',
        'RW' => 'Rwanda',
        'BL' => 'Saint Barthelemy',
        'SH' => 'Saint Helena',
        'KN' => 'Saint Kitts And Nevis',
        'LC' => 'Saint Lucia',
        'MF' => 'Saint Martin',
        'PM' => 'Saint Pierre And Miquelon',
        'VC' => 'Saint Vincent And Grenadines',
        'WS' => 'Samoa',
        'SM' => 'San Marino',
        'ST' => 'Sao Tome And Principe',
        'SA' => 'Saudi Arabia',
        'SN' => 'Senegal',
        'RS' => 'Serbia',
        'SC' => 'Seychelles',
        'SL' => 'Sierra Leone',
        'SG' => 'Singapore',
        'SK' => 'Slovakia',
        'SI' => 'Slovenia',
        'SB' => 'Solomon Islands',
        'SO' => 'Somalia',
        'ZA' => 'South Africa',
        'GS' => 'South Georgia And Sandwich Isl.',
        'ES' => 'Spain',
        'LK' => 'Sri Lanka',
        'SD' => 'Sudan',
        'SR' => 'Suriname',
        'SJ' => 'Svalbard And Jan Mayen',
        'SZ' => 'Swaziland',
        'SE' => 'Sweden',
        'CH' => 'Switzerland',
        'SY' => 'Syrian Arab Republic',
        'TW' => 'Taiwan',
        'TJ' => 'Tajikistan',
        'TZ' => 'Tanzania',
        'TH' => 'Thailand',
        'TL' => 'Timor-Leste',
        'TG' => 'Togo',
        'TK' => 'Tokelau',
        'TO' => 'Tonga',
        'TT' => 'Trinidad And Tobago',
        'TN' => 'Tunisia',
        'TR' => 'Turkey',
        'TM' => 'Turkmenistan',
        'TC' => 'Turks And Caicos Islands',
        'TV' => 'Tuvalu',
        'UG' => 'Uganda',
        'UA' => 'Ukraine',
        'AE' => 'United Arab Emirates',
        'GB' => 'United Kingdom',
        'US' => 'United States',
        'UM' => 'United States Outlying Islands',
        'UY' => 'Uruguay',
        'UZ' => 'Uzbekistan',
        'VU' => 'Vanuatu',
        'VE' => 'Venezuela',
        'VN' => 'Viet Nam',
        'VG' => 'Virgin Islands, British',
        'VI' => 'Virgin Islands, U.S.',
        'WF' => 'Wallis And Futuna',
        'EH' => 'Western Sahara',
        'YE' => 'Yemen',
        'ZM' => 'Zambia',
        'ZW' => 'Zimbabwe',
    );

    public function getcountry($code) {

        $countries = $this->countries;
        return $countries[$code];
    }

}
