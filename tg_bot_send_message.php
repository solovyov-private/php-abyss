<?php
header('Content-type: text/html');
header('Access-Control-Allow-Origin: *');
header('Content-Type: text/html; charset=utf-8');

$info       = parse_ini_file('bot.ini', true);
$blacklist  = array();
$blacklist  = file('blacklist.txt');
$name       = $_POST['client_name'];
$phone      = $_POST['client_tel'];

$message    = "<b>".$name. " \n". $phone. "</b>\n"
            ."ip addr: ".$_SERVER['REMOTE_ADDR']
            ."\n<a href=\"https://www.telefonnyjdovidnyk.com.ua/nomer/".$phone."\">Проверить номер онлайн (сайт 1)</a>"
            ."\n<a href=\"https://id2call.com/number/".$phone."\">Проверить номер онлайн (сайт 2)</a>";

$chatid     = $info['telegram_bot']['chatid'];

$mainurl    = "https://api.telegram.org/bot".$info['telegram_bot']['token']. "/sendMessage";

if (strlen($name) == 0 || strlen($phone) < 10) {
    sleep(1);
    echo 'bad';
    return true;
}

foreach ($blacklist as &$value) {
    $value = rtrim($value);
    
    if($value == $phone){
        sleep(1);
        echo 'congrats';
        return true;
    }
}

$postfields = array('chat_id'=>$chatid, 'text'=>$message, 'parse_mode'=>'HTML', 'disable_web_page_preview' => 1);
$ch         = curl_init();

curl_setopt($ch, CURLOPT_URL, $mainurl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // On dev server only!

$result     = curl_exec($ch);

if (strpos($result,"true")!=0) {
    echo 'congrats';
}
else {
    echo 'bad'.$result;
}
?>
