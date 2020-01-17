<?php
$msg = (isset($_GET['msg'])) ? $_GET['msg'] : 'Hello!'; 
$channelAccessToken = '';
// $userId = '';

$payload = array(
   'to'=>$userId,
   'messages'=>array(
      array('type'=>'text','text'=>$msg)
   )
);

// Send Request by CURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.line.me/v2/bot/message/push');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
   'Content-Type: application/json',
   'Authorization: Bearer ' . $channelAccessToken
));
$result = curl_exec($ch);
curl_close($ch);
echo $result;