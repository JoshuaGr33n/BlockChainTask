<?php

use App\GeneralSetting;

function get_image($image, $clean = '')
{
    return file_exists($image) && is_file($image) ? asset($image) . $clean : asset(config('constants.image.default'));
}


function slug($string)
{
    return Illuminate\Support\Str::slug($string);
}


function description_shortener($string, $length = null)
{
    if (empty($length)) $length = config('constants.stringLimit.default');
    return Illuminate\Support\Str::limit($string, $length);
}


function sidenav_active($routename, $class = 'active open')
{
    if (is_array($routename)) {
        foreach ($routename as $key => $value) {
            if (request()->routeIs($value)) {
                return $class;
            }
        }
    } elseif (request()->routeIs($routename)) {
        return $class;
    }
}


function show_datetime($date, $format = 'd M,Y h:i A')
{
    return \Carbon\Carbon::parse($date)->format($format);
}


function shortcode_replacer($shortcode, $replace_with, $template_string)
{

    return str_replace($shortcode, $replace_with, $template_string);
}


function verification_code($length)
{
    if ($length == 0) return 0;
    $min = pow(10, $length - 1);
    $max = 0;
    while ($length > 0 && $length--) {
        $max = ($max * 10) + 9;
    }
    return random_int($min, $max);
}


function site_precision()
{
    return config('constants.currency.precision.' . strtolower(config('constants.currency.base')));
}

function formatter_money($money, $currency = null)
{
    if (!$currency) $currency = config('constants.currency.base');
    $money = round($money, config('constants.currency.precision.' . strtolower($currency)));
    return $money;
}


function upload_image($file, $location, $size = null, $old = null, $thumb = null)
{
    $path = make_directory($location);
    if (!$path) throw new Exception('File could not been created.');

    if (!empty($old)) {
        remove_file($location . '/' . $old);
        remove_file($location . '/thumb_' . $old);
    }

    $filename = uniqid() . time() . '.' . $file->getClientOriginalExtension();

    $image = Image::make($file);
    if (!empty($size)) {
        $size = explode('x', $size);
        $image->resize($size[0], $size[1]);
    }
    $image->save($location . '/' . $filename);

    if (!empty($thumb)) {

        $thumb = explode('x', $thumb);
        Image::make($file)->resize($thumb[0], $thumb[1])->save($location . '/thumb_' . $filename);
    }

    return $filename;
}


function make_directory($path)
{
    if (file_exists($path)) return true;
    return mkdir($path, 0755, true);
}


function remove_file($path)
{
    return file_exists($path) && is_file($path) ? @unlink($path) : false;
}

function send_general_email($email, $subject, $message, $receiver_name = '')
{
    $general = GeneralSetting::first();
    
    
    
    if ($general->en != 1 || !$general->efrom) {
        return;
    }

    $message = shortcode_replacer("{{message}}", $message, $general->etemp);
    $message = shortcode_replacer("{{name}}", $receiver_name, $message);
    $config = $general->mail_config;

    if ($config->name == 'php') {
        send_php_mail($email, $receiver_name, $general->efrom, $subject, $message);
    } else if ($config->name == 'smtp') {
        send_smtp_mail($config, $email, $receiver_name, $general->efrom, $general->sitetitle, $subject, $message);
    } else if ($config->name == 'sendgrid') {
        send_sendgrid_mail($config, $email, $receiver_name, $general->efrom, $general->sitetitle, $subject, $message);
    } else if ($config->name == 'mailjet') {
        send_mailjet_mail($config, $email, $receiver_name, $general->efrom, $general->sitetitle, $subject, $message);
    }
}

function send_email($user, $type, $shortcodes = [])
{
    $general = GeneralSetting::first();
    
    
    $email_template = \App\EmailTemplate::where('act', $type)->where('email_status', 1)->first();
    
    if ($general->en != 1 || !$email_template) {
        return;
    }
    



    $message = shortcode_replacer("{{name}}", $user->username, $general->etemp);
    $message = shortcode_replacer("{{message}}", $email_template->email_body, $message);

    if (empty($message)) {
        $message = $email_template->email_body;
    }

    foreach ($shortcodes as $code => $value) {
        $message = shortcode_replacer('{{' . $code . '}}', $value, $message);
    }
    $config = $general->mail_config;
    
    if ($config->name == 'php') {
       send_php_mail($user->email, $user->username, $general->efrom, $email_template->subj, $message);
         
    } else if ($config->name == 'smtp') {
        send_smtp_mail($config, $user->email, $user->username, $general->efrom, $general->sitetitle, $email_template->subj, $message);
    } else if ($config->name == 'sendgrid') {
        send_sendgrid_mail($config, $user->email, $user->username, $general->efrom, $general->sitetitle, $email_template->subj, $message);
    } else if ($config->name == 'mailjet') {
        send_mailjet_mail($config, $user->email, $user->username, $general->efrom, $general->sitetitle, $email_template->subj, $message);
    }
}


function send_php_mail($receiver_email, $receiver_name, $sender_email, $subject, $message)
{
    // $headers = "From:  <$sender_email> \r\n";
    // $headers .= "Reply-To:  $receiver_name<$receiver_email> \r\n";
    // $headers .= "MIME-Version: 1.0\r\n";
    // $headers .= "Content-Type: text/html; charset=utf-8\r\n";
    // mail($receiver_email, $subject, $message, $headers);
   $headers= "From: $sender_email\nReply-To:{$receiver_name}\nContent-type:text/html; charset=utf-8\r\n";
  mail($receiver_email, $subject, $message, $headers);
  
}


function send_smtp_mail($config, $receiver_email, $receiver_name, $sender_email, $sender_name, $subject, $message)
{
    $f = fsockopen($config->host, $config->port);
    if ($f !== false) {
        $res = fread($f, 1024);
        if (strlen($res) > 0 && strpos($res, '220') === 0) {
            $mail_val = [
                'send_to_name' => $receiver_name,
                'send_to' => $receiver_email,
                'email_from' => $sender_email,
                'email_from_name' => $sender_name,
                'subject' => $subject,
            ];
            Config::set('mail.driver', $config->driver);
            Config::set('mail.from', $config->username);
            Config::set('mail.name', $sender_name);
            Config::set('mail.host', $config->host);
            Config::set('mail.port', $config->port);
            Config::set('mail.username', $config->username);
            Config::set('mail.password', $config->password);
            Config::set('mail.encryption', $config->enc);
            $xx = Mail::send('partials.email', ['body' => $message], function ($send) use ($mail_val) {
                $send->from($mail_val['email_from'], $mail_val['email_from_name']);
                $send->replyto($mail_val['email_from'], $mail_val['email_from_name']);
                $send->to($mail_val['send_to'], $mail_val['send_to_name'])->subject($mail_val['subject']);
            });
        }
    }
}


function send_sendgrid_mail($config, $receiver_email, $receiver_name, $sender_email, $sender_name, $subject, $message)
{

$headers = array(
    'Authorization: Bearer '.$config->appkey,
    'Content-Type: application/json'
);

$datas = array(
    "personalizations" => array(
        array(
            "to" => array(
                array(
                    "email" => $receiver_email,
                    "name" => $receiver_name
                )
            )
        )
    ),
    "from" => array(
        "email" => $config->sender
    ),
    "subject" => $subject,
    "content" => array(
        array(
            "type" => "text/html",
            "value" => $message
        )
    )
);

$ch = curl_init();
curl_setopt($ch, CURLINFO_HEADER_OUT, true); // enable tracking
curl_setopt($ch, CURLOPT_URL, "https://api.sendgrid.com/v3/mail/send");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($datas));
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
$headerSent = curl_getinfo($ch, CURLINFO_HEADER_OUT); // request headers
curl_close($ch);


}

function send_mailjet_mail($config, $receiver_email, $receiver_name, $sender_email, $sender_name, $subject, $message)
{
    require 'core/app/Http/Helpers/Lib/Mailjet/vendor/autoload.php';
    $mj = new \Mailjet\Client($config->public_key, $config->secret_key, true, ['version' => 'v3.1']);
    $body = [
        'Messages' => [
            [
                'From' => [
                    'Email' => $sender_email,
                    'Name' => $sender_name,
                ],
                'To' => [
                    [
                        'Email' => $receiver_email,
                        'Name' => $receiver_name,
                    ]
                ],
                'Subject' => $subject,
                'TextPart' => "",
                'HTMLPart' => $message,
            ]
        ]
    ];
    $response = $mj->post(\Mailjet\Resources::$Email, ['body' => $body]);
}


function send_sms($user, $type, $shortcodes = [])
{
    $general = GeneralSetting::first(['sn', 'smsapi']);
    $sms_template = \App\SmsTemplate::where('act', $type)->where('sms_status', 1)->first();
    if ($general->sn == 1 && $sms_template) {
        $template = $sms_template->sms_body;
        foreach ($shortcodes as $code => $value) {
            $template = shortcode_replacer('{{' . $code . '}}', $value, $template);
        }
        $template = urlencode($template);
        $message = shortcode_replacer("{{number}}", $user->mobile, $general->smsapi);
        $message = shortcode_replacer("{{message}}", $template, $message);
        $result = @file_get_contents($message);
    }
}

function activeTemplate($asset = false)
{
        $gs = GeneralSetting::first(['active_template']);
        $template = $gs->active_template;
    if ($asset) return 'assets/templates/' . $template . '/';
    return 'templates.' . $template . '.';
}

function recaptcha()
{
    $recaptcha = \App\Plugin::where('act', 'google-recaptcha3')->where('status', 1)->first();
    return $recaptcha ? $recaptcha->generateScript() : '';
}


function getTrx($length = 12)
{
    $characters = 'ABCDEFGHJKMNOPQRSTUVWXYZ123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function isActive($route = null)
{
    return \Illuminate\Http\Request::routeIs($route);
}


function remove_element($array, $value)
{
    return array_diff($array, (is_array($value) ? $value : array($value)));
}

function cryptoQR($wallet, $amount, $crypto = null)
{

    $varb = $wallet . "?amount=" . $amount;
    return "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=$varb&choe=UTF-8";
}


function curlContent($url)
{
    //open connection
    $ch = curl_init();
    //set the url, number of POST vars, POST data
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //execute post
    $result = curl_exec($ch);
    //close connection
    curl_close($ch);
    return $result;
}

function send_contact($from, $name, $subject, $message)
{
    $general = GeneralSetting::first();
    $to = $general->efrom;

    $config = $general->mail_config;
    if ($config->name == 'php') {
        send_php_mail($from, $general->sitename, $to, $subject, $message);
    } else if ($config->name == 'smtp') {
        send_smtp_mail($config, $from, $general->sitename, $to, $name, $subject, $message);
    } else if ($config->name == 'sendgrid') {
        send_sendgrid_mail($config, $from, $general->sitename, $to, $name, $subject, $message);
    } else if ($config->name == 'mailjet') {
        send_mailjet_mail($config, $from, $general->sitename, $to, $name, $subject, $message);
    }
}


function str_slug($title = null)
{
    return \Illuminate\Support\Str::slug($title);
}

function str_limit($title = null, $length = 10)
{
    return \Illuminate\Support\Str::limit($title, $length);
}

function diffForHumans($date = null)
{
    return \Carbon\Carbon::parse($date)->diffForHumans();
}

function notify($user, $type, $shortcodes = null)
{

    send_email($user, $type, $shortcodes);
    send_sms($user, $type, $shortcodes);
}

function site_name()
{

    $general = GeneralSetting::first();

    $sitname = str_word_count($general->sitename);
    $sitnameArr = explode(' ', $general->sitename);

    if ($sitname > 1) {
        $title = "<span>$sitnameArr[0] </span> ". str_replace($sitnameArr[0],'',$general->sitename);
    } else {
        $title = "<span>$general->sitename</span>";
    }

    return $title;
}





function getIpInfo(){
    $ip = Null;
    $deep_detect = TRUE;

    if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
        $ip = $_SERVER["REMOTE_ADDR"];
        if ($deep_detect) {
            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
    }



    //$xml = @simplexml_load_file("http://www.geoplugin.net/xml.gp?ip=" . $ip);




    $user_agent     =   $_SERVER['HTTP_USER_AGENT'];
    $os_platform    =   "Unknown OS Platform";
    $os_array       =   array(
        '/windows nt 10/i'     =>  'Windows 10',
        '/windows nt 6.3/i'     =>  'Windows 8.1',
        '/windows nt 6.2/i'     =>  'Windows 8',
        '/windows nt 6.1/i'     =>  'Windows 7',
        '/windows nt 6.0/i'     =>  'Windows Vista',
        '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
        '/windows nt 5.1/i'     =>  'Windows XP',
        '/windows xp/i'         =>  'Windows XP',
        '/windows nt 5.0/i'     =>  'Windows 2000',
        '/windows me/i'         =>  'Windows ME',
        '/win98/i'              =>  'Windows 98',
        '/win95/i'              =>  'Windows 95',
        '/win16/i'              =>  'Windows 3.11',
        '/macintosh|mac os x/i' =>  'Mac OS X',
        '/mac_powerpc/i'        =>  'Mac OS 9',
        '/linux/i'              =>  'Linux',
        '/ubuntu/i'             =>  'Ubuntu',
        '/iphone/i'             =>  'iPhone',
        '/ipod/i'               =>  'iPod',
        '/ipad/i'               =>  'iPad',
        '/android/i'            =>  'Android',
        '/blackberry/i'         =>  'BlackBerry',
        '/webos/i'              =>  'Mobile'
    );
    foreach ($os_array as $regex => $value) {
        if (preg_match($regex, $user_agent)) {
            $os_platform    =   $value;
        }
    }
    $browser        =   "Unknown Browser";
    $browser_array  =   array(
        '/msie/i'       =>  'Internet Explorer',
        '/firefox/i'    =>  'Firefox',
        '/safari/i'     =>  'Safari',
        '/chrome/i'     =>  'Chrome',
        '/edge/i'       =>  'Edge',
        '/opera/i'      =>  'Opera',
        '/netscape/i'   =>  'Netscape',
        '/maxthon/i'    =>  'Maxthon',
        '/konqueror/i'  =>  'Konqueror',
        '/mobile/i'     =>  'Handheld Browser'
    );
    foreach ($browser_array as $regex => $value) {
        if (preg_match($regex, $user_agent)) {
            $browser    =   $value;
        }
    }

    //$data['country'] = $country;
    //$data['city'] = $city;
    //$data['area'] = $area;
    //$data['code'] = $code;
    //$data['long'] = $long;
    //$data['lat'] = $lat;
    $data['os_platform'] = $os_platform ;
    $data['browser'] = $browser ;
    $data['ip'] = request()->ip();
    $data['time'] = date('d-m-Y h:i:s A');


    return $data;
}




function send_ticket_email($user, $type, $shortcodes = [])
{
    $general = GeneralSetting::first();
    $email_template = \App\EmailTemplate::where('act', $type)->where('email_status', 1)->first();
    if ($general->en != 1 || !$email_template) {
        return;
    }

    $message = shortcode_replacer("{{name}}", $user->name, $general->etemp);
    $message = shortcode_replacer("{{message}}", $email_template->email_body, $message);

    if (empty($message)) {
        $message = $email_template->email_body;
    }

    foreach ($shortcodes as $code => $value) {
        $message = shortcode_replacer('{{' . $code . '}}', $value, $message);
    }
    $config = $general->mail_config;

    if ($config->name == 'php') {
        send_php_mail($user->email, $user->name, $general->efrom, $email_template->subj, $message);
    } else if ($config->name == 'smtp') {
        send_smtp_mail($config, $user->email, $user->name, $general->efrom, $general->sitetitle, $email_template->subj, $message);
    } else if ($config->name == 'sendgrid') {
        send_sendgrid_mail($config, $user->email, $user->name, $general->efrom, $general->sitetitle, $email_template->subj, $message);
    } else if ($config->name == 'mailjet') {
        send_mailjet_mail($config, $user->email, $user->name, $general->efrom, $general->sitetitle, $email_template->subj, $message);
    }
}


function showBelowUser($id){
    $under_ref = \App\User::where('refer',$id)->get();
    $print = array();
    $i = 2;
    foreach ($under_ref as $data) {
        $cc = \App\User::where('refer',$data->id)->count();
        echo "<li class=\"container\">";
        echo '<p>'. $print[] = $data->username .'</p>';
        if($cc>0){
            echo '<ul>';
            echo '<li class="container">';
            echo '<p>'. $print[] =  showBelowUser($data->id) .'</p>';
            echo '</li>';
            echo '</ul>';
        }
        echo "</li>";
        $i++;
    }
}



function levelCommision($id, $amount, $commissionType = ''){
    $usr = $id;
    $i = 1;
    $gnl = GeneralSetting::first();

    $level = \App\Referral::count();

    while($usr!="" || $usr!="0" || $i<$level ) {
        $me = \App\User::find($usr);
        $refer= \App\User::find($me->refer);


            if($refer == "") {
                break;
            }
            $comission = \App\Referral::where('level',$i)->first();
            $com = ($amount * $comission->percent)/100;


            $referWallet = \App\UserWallet::where('user_id',$refer->id)->where('type','interest_wallet')->first();
            $new_bal = formatter_money($referWallet->balance +$com);
            $referWallet->balance = $new_bal;
            $referWallet->save();

            $trx = getTrx();

            \App\Trx::create([
                'user_id' => $refer->id,
                'amount' => formatter_money($com),
                'main_amo' => $new_bal,
                'charge' => 0,
                'type' => '+',
                'remark' => 'commission',
                'title' => $i.'  level Referral Commission',
                'trx' => $trx,
            ]);

            \App\CommissionLog::create([
                'user_id' => $refer->id,
                'who' => $id,
                'level' => $i.' level Referral Commission',
                'amount' => formatter_money($com),
                'main_amo' => $new_bal,
                'title' => $commissionType,
                'trx' => $trx,
            ]);


            notify($refer, $type = 'REFERRAL_COMMISSION', [
                'amount' =>  formatter_money($com),
                'main_balance' => $new_bal,
                'trx' => $trx,
                'level' => $i.' level Referral Commission',
                'currency' =>$gnl->cur_text
            ]);



            $usr = $refer->id;
            $i++;
    }

    return 0;

}
