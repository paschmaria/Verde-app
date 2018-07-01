<?php
    header("Access-Control-Allow-Origin: *");
    
    $username  = "plurimustech@gmail.com";
    $password  = "Soluciales2018";
    $sender    = e($_POST['sender']);
    $recipient = e($_POST['recipient']);
    $sms_mess  = e($_POST['sms']);
    $voice_mess  = "";
    //rebuild sms form data
    $smsdata = http_build_query(
        array(
            'username' => $username,
            'password' => $password,
            'message' => $sms_mess,
            'recipient' => $recipient,
            'sender' => $sender,
        )
    );
    //prepare a http post request
    $opts = array('http' =>
        array(
            'method'  => 'POST',
            'header'  => 'Content-type: application/x-www-form-urlencoded',
            'content' => $smsdata
        )
    );
    //craete a stream to communicate with betasms api
    $context  = stream_context_create($opts);
    //get result from communication
    $result = file_get_contents('http://login.betasms.com/api/', false, $context);
    //return result to client, this will return the appropriate respond code
    echo $result;