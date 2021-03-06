<?php
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);
require_once 'db_connect.php';
mpesaB2Creceiver();

function mpesaB2Creceiver()
{

    $result=file_get_contents('php://input');

    //$data = ['details' => $result];
    logresult($result);

    $ret = file_put_contents('mydata.txt', $result, FILE_APPEND | LOCK_EX);
    $xml = new \DOMDocument();
    $xml->loadXML($result);

    $xm = new \DOMDocument();
    $xm->loadXML($xml->textContent);
    //logresult($xm);

    //submitDummyDataToDB($xm);
    $data['transaction_code'] = $xm->getElementsByTagName('TransactionID')->item(0)->nodeValue;
    $data['ConversationID'] = $xm->getElementsByTagName('ConversationID')->item(0)->nodeValue;
    $data['ResultCode'] = $xm->getElementsByTagName('ResultCode')->item(0)->nodeValue;
    for ($i = 1; $i < 8; $i++) {
        $data[$xm->getElementsByTagName('ResultParameters')->item(0)->childNodes->item($i - 1)->childNodes->item(0)->nodeValue] = $xm->getElementsByTagName('ResultParameters')->item(0)->childNodes->item($i - 1)->childNodes->item(1)->nodeValue;
    }

    ///Update the most recent row
    $person=$data['ReceiverPartyPublicName'];
    $person_array=explode('-',$person);
    $phone='0'.substr(trim($person_array[0]),-9);

    $data['phone'] = $phone;
    $data['name'] = $person_array[1];

    submitToDB($data);

        $successResponse = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:req="http://api-v1.gen.mm.vodafone.com/mminterface/request">
   <soapenv:Header/>
   <soapenv:Body>
      <req:ResponseMsg><![CDATA[<?xml version="1.0" encoding="UTF-8"?>
<response xmlns="http://api-v1.gen.mm.vodafone.com/mminterface/response">
    <ResponseCode>00000000</ResponseCode>
    <ResponseDesc>success</ResponseDesc>
</response>]]></req:ResponseMsg>
   </soapenv:Body>
</soapenv:Envelope>';
        header('Content-type: text/xml');
        echo trim($successResponse);
        exit;
}
function submitToDB($data){

    // Connect to db
    $db = new DB_CONNECT();
    $mysqli = $db->db_con;

    if($mysqli->connect_errno)
    {
        echo "unable to connect";
    }
    else
    {

        $name = $data['name'];
        $transaction_code = $data['transaction_code'];
        $phone = $data['phone'];
        $amount = $data['TransactionAmount'];
        $date = $data['TransactionCompletedDateTime'];
        $sql = "INSERT INTO b2cpayments(`id`,`name`, `phone`, `transaction_id`, `amount`, `status`, `transaction_time`)VALUES('', '$name', '$phone', '$transaction_code', '$amount', 1, '$date')";
        $result = $mysqli->query($sql);
        if($result==TRUE){
            print_r("success insert");
        }else{
            print_r("Error while inserting ".mysqli_error($mysqli));
        }
    }


}
function logresult($result){

    // Connect to db
    $db = new DB_CONNECT();
    $mysqli = $db->db_con;

    if($mysqli->connect_errno)
    {
        echo "unable to connect";
    }
    else
    {
        $result = str_replace("'",' ',$result);
        $sql = "INSERT INTO payment_logs(`details`)VALUES('$result')";
        $result = $mysqli->query($sql);
        if($result==TRUE){
            print_r("success raw data");
        }else{
            print_r("Error while inserting ".mysqli_error($mysqli));
        }
    }
}



