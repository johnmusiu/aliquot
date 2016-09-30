<?php



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
    print_r($data);
    exit;
    //once you have the data, save it to the database
    //TODO::save data to the database
}

