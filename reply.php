<?php
 
$channelAccessToken = 'LaLFpmLBs4/6vmsxIFl1z18SRLqNkYwvLOWVnNCDsxZz/Nx14i+JWPcmoQyFv4H9fKWk6mAqMKMJXLwPUckqMvTvpmENHHMGgo2JswD+k+Gpjv1rZOLAJX9l1E4obPD+aGJ9jZLi6BM7hS9Bn5l0hgdB04t89/1O/w1cDnyilFU=';
$password = 'join';      // user login password

$bodyMsg = file_get_contents('php://input');
$obj = json_decode($bodyMsg, true);

foreach ($obj['events'] as &$event) {

    $message = '...';
    if($event['message']['text'] === 'join'){
        $message = 'welcome join!';
    }

    $userId = $event['source']['userId'];
    // Make payload
    $payload = array(
       'replyToken' => $event["replyToken"],
       'messages' => array(
           array(
               'type' => 'text',
               'text' => $message
           )
       )
    );
 
   // Send reply API
   $ch = curl_init();
   curl_setopt($ch, CURLOPT_URL, 'https://api.line.me/v2/bot/message/reply');
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
   
}