<?php 
require_once 'db_connect.php';
mpesareceiver();

function mpesareceiver()
{
/*
 * Lets get the XML input
 */
    $input = file_get_contents('php://input');
    $xml = new DOMDocument();
    $xml->loadXML($input);
    //generate data from from the xml
    $data = [];
    $data['phone'] = $xml->getElementsByTagName('MSISDN')->item(0)->nodeValue;
    $data['transaction_code'] = $xml->getElementsByTagName('TransID')->item(0)->nodeValue;
    $data['name'] = $xml->getElementsByTagName('KYCValue')->item(0)->nodeValue . ' ' . $xml->getElementsByTagName('KYCValue')->item(1)->nodeValue . ' ' . $data['last_name'] = $xml->getElementsByTagName('KYCValue')->item(2)->nodeValue;
    $data['amount'] = $xml->getElementsByTagName('TransAmount')->item(0)->nodeValue;
    $data['raw'] = $input;
    $data['transaction_date'] = date("Y-m-d H:i:s", strtotime($xml->getElementsByTagName('TransTime')->item(0)->nodeValue));
    $data['account_no'] = $xml->getElementsByTagName('BillRefNumber')->item(0)->nodeValue;
    //print_r($data);
    //exit;
    //once you have the data, save it to the database
    //TODO::save data to the database
    submitToDB($data);
    
}
function submitToDB($data){
    // Connect to db
    $db = new DB_CONNECT();
    $mysqli = $db->db_con;
    
    $email_support_gmail = 'aliquotltd@gmail.com';

    if($mysqli->connect_errno)
    {
        echo "unable to connect";
    }
    else
    {
        $name = $data['name'];
        $transaction_code = $data['transaction_code'];
        $phone = $data['phone'];
        $amount = $data['amount'];
        $date = $data['transaction_date'];
        $account = $data['account_no'];
        //notify admin
        $email_msg = "Payment reference: ".$transaction_code."<br/>";
		$email_msg .= "Amount: ".$amount."<br/>";
		$email_msg .= "Name: ".$name."</br>";
		$email_msg .= "Time: ".$date;
		$send = mail($email_support_gmail, "PAYMENT ALERT", $email_msg);
        
        $sql = "INSERT INTO payments(`id`,`name`, `phone`, `transaction_id`, `amount`, `account`, `transaction_time`)VALUES('', '$name', '$phone', '$transaction_code', '$amount', '$account', '$date')";
        $result = $mysqli->query($sql);
        if($result==TRUE){
            print_r("success insert");
        }else{
            print_r("Error while inserting ".mysqli_error($mysqli));
        }
    }
    
}

