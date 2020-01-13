<?php
$msg = (isset($_GET['msg'])) ? $_GET['msg'] : 'Hello!'; 
$channelAccessToken = 'LaLFpmLBs4/6vmsxIFl1z18SRLqNkYwvLOWVnNCDsxZz/Nx14i+JWPcmoQyFv4H9fKWk6mAqMKMJXLwPUckqMvTvpmENHHMGgo2JswD+k+Gpjv1rZOLAJX9l1E4obPD+aGJ9jZLi6BM7hS9Bn5l0hgdB04t89/1O/w1cDnyilFU=';
// $userId = 'U6df5fc85eeea4fa2b359777fed964d9d';
$userId = 'Uc3c087deec751b1a89545b1e1924ff7f';

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