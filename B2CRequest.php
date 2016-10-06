<?php

require_once 'db_connect.php';
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);

define('SPID', "107027");
define('PASSWORD', "");
define('SERVICEID', "");
define('initiator_username', "");
define('initiator_pass', "Matr!x123");
define('B2CPaybill', "901001");
define('result_url', "http://52.207.189.106/B2Cresult.php");
//define('SSL_CERT_PATH', "");
//define('SSL_KEY_PATH', "");
//define('SSL_PASS', "");
//define('APICRYPT_PATH', "");

print_r(sendmoney("0728355429",100));
exit;
function sendmoney($phone, $amount)
{

//    date_default_timezone_set('Africa/Nairobi');
//    $no = "254" . substr($phone, -9);
//
//    $timestamp_ = date("YdmHis");
//    //$real_pass = base64_encode(hash('sha256', SPID . "" . PASSWORD . "" . $timestamp_));
//    $real_pass = "MzY3MDVDMjlGREREREUzRUM5OTE5MEM5RDVEMjg2NDRFQjI1OEU2RkJBQTZGRDRBOTBEMjg0MUY0ODhGMDk2Qw==";
    $securityCredential = getSecurityCredential(initiator_pass);
//    $securityCredential = "";
//    //self::getSecurityCredential(initiator_pass);
    $rand = rand(123456, 654321);
    $originId = SPID . "_" . initiator_username . "_" . $rand;
//    $type = 2;
//    $third_party_id = null;
//    $reqTime = date('Y-m-d') . "T" . date('H:i:s') . ".0000521Z"; //2014-10-21T09:47:19.0000521Z


//    $curlData = '<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">
//                                    <s:Header>
//            <h:RequestSOAPHeader xmlns:h="http://www.huawei.com.cn/schema/common/v2_1" xmlns="http://www.huawei.com.cn/schema/common/v2_1" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
//            <h:spId>' . SPID . '</h:spId>
//            <h:spPassword>' . $real_pass . '</h:spPassword>
//            <h:serviceId>' . SERVICEID . '</h:serviceId>
//            <h:timeStamp>' . $timestamp_ . '</h:timeStamp>
//            </h:RequestSOAPHeader>
//            </s:Header>
//                                    <s:Body xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
//            <RequestMsg xmlns="http://api-v1.gen.mm.vodafone.com/mminterface/request">
//            <![CDATA[<request xmlns="http://api-v1.gen.mm.vodafone.com/mminterface/request">
//            <Transaction>
//            <CommandID>BusinessPayment</CommandID>
//            <OriginatorConversationID>' . $originId . '</OriginatorConversationID>
//            <Parameters><Parameter><Key>Amount</Key><Value>' . $amount . '</Value></Parameter></Parameters>
//            <ReferenceData><ReferenceItem><Key>QueueTimeoutURL</Key><Value>' . result_url . '</Value></ReferenceItem></ReferenceData>
//            <Timestamp>' . $reqTime . '</Timestamp></Transaction>
//            <Identity>
//            <Caller>
//            <CallerType>' . $type . '</CallerType>
//            <ThirdPartyID>' . SPID . '</ThirdPartyID>
//            <Password>' . PASSWORD . '</Password>
//            <CheckSum></CheckSum>
//            <ResultURL>' . result_url . '</ResultURL>
//            </Caller>
//                <Initiator>
//                        <IdentifierType>11</IdentifierType>
//                        <Identifier>' . initiator_username . '</Identifier>
//                        <SecurityCredential>' . $securityCredential . '</SecurityCredential>
//                        <ShortCode>' . B2CPaybill . '</ShortCode>
//                    </Initiator>
//            <PrimaryParty>
//            <IdentifierType>4</IdentifierType>
//            <Identifier>' . B2CPaybill . '</Identifier>
//            </PrimaryParty>
//            <ReceiverParty>
//            <IdentifierType>1</IdentifierType>
//            <Identifier>' . $no . '</Identifier>
//            </ReceiverParty>
//            </Identity>
//
//            <KeyOwner>1</KeyOwner></request>]]></RequestMsg>
//            </s:Body>
//                                    </s:Envelope>';

    $curlData = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:req="http://api-v1.gen.mm.vodafone.com/mminterface/request">
<soapenv:Header>
<tns:RequestSOAPHeader xmlns:tns="http://www.huawei.com/schema/osg/common/v2_1">
<tns:spId>888777</tns:spId>
<tns:spPassword>ZjYwY2ZjYmI1YTRjZmEzY2JlNzNhNzEzODI0YzBlZjYwYmFlZWFmZGFmNTBkMjA4MWMyMGM3MDA3NzA0ZWQzMg==</tns:spPassword>
<tns:timeStamp>20160927093535</tns:timeStamp>
<tns:serviceId>888777000</tns:serviceId>
</tns:RequestSOAPHeader>
</soapenv:Header>
<soapenv:Body>
<req:RequestMsg>
<![CDATA[<?xml version="1.0" encoding="UTF-8"?>
<request xmlns="http://api-v1.gen.mm.vodafone.com/mminterface/request">
<Transaction>
<CommandID>BusinessPayment</CommandID>
<LanguageCode>0</LanguageCode>
<OriginatorConversationID>'.$originId.'</OriginatorConversationID>
<ConversationID></ConversationID>
<Remark>0</Remark>
<Parameters><Parameter>
<Key>Amount</Key>
<Value>50</Value>
</Parameter></Parameters>
<ReferenceData>
<ReferenceItem>
<Key>QueueTimeoutURL</Key>
<Value>http://52.207.189.106:8080/B2Cresult.php</Value>
</ReferenceItem></ReferenceData>
<Timestamp>20160927093535</Timestamp>
</Transaction>
<Identity>
<Caller>
<CallerType>2</CallerType>
<ThirdPartyID></ThirdPartyID>
<Password>Password0</Password>
<CheckSum>CheckSum0</CheckSum>
<ResultURL>http://52.207.189.106:8080/B2Cresult.php/</ResultURL>
</Caller>
<Initiator>
<IdentifierType>11</IdentifierType>
<Identifier>jaribioinit2</Identifier>
<SecurityCredential>'.$securityCredential.'</SecurityCredential>
<ShortCode>902004</ShortCode>
</Initiator>
<PrimaryParty>
<IdentifierType>4</IdentifierType>
<Identifier>902004</Identifier>
</PrimaryParty>
<ReceiverParty>
<IdentifierType>1</IdentifierType>
<Identifier>254791445875</Identifier>
</ReceiverParty>
</Identity>
<KeyOwner>1</KeyOwner>
</request>]]></req:RequestMsg>
</soapenv:Body>
</soapenv:Envelope>';

    sendRequest($curlData,$phone,$amount);
}

function sendRequest($curlData,$phone,$amount)
{
      //  echo "sending request";
    $url = 'https://196.201.214.137:18423/mminterface/request';
//    $url = 'http://196.201.214.136:8310/mminterface/request';
    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_TIMEOUT, 360);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 360);
    curl_setopt($curl, CURLOPT_ENCODING, 'utf-8');

    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'SOAPAction:""',
        'Content-Type: text/xml; charset=utf-8',
    ));
    //curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
    //curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);

    curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)');
//CURLOPT_VERBOSE        => true,
//curl_setopt($curl, CURLOPT_SSLCERT, '/var/www/html/sdp_apps/services/b2c/pkcs/testbroker.crt');
    curl_setopt($curl, CURLOPT_SSLCERT, '/var/www/server.crt');
    curl_setopt($curl, CURLOPT_SSLCERTTYPE, 'PEM');

//curl_setopt($curl, CURLOPT_SSLKEY, '/var/www/html/sdp_apps/services/b2c/pkcs/certs_chain.pem');
    curl_setopt($curl, CURLOPT_SSLKEY, '/var/www/server.key');
    //curl_setopt($curl, CURLOPT_SSLKEYPASSWD, 'inuka');

    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $curlData);
    //curl_setopt($curl, CURLOPT_HEADERFUNCTION, 'read_header'); // get header

    $result = curl_exec($curl);

    if (curl_errno($curl)) {
        echo 'Curl Error: ' . curl_error($curl) . "\n\n";
    }
    //STATUS CODES
    /*
     * SUCCESSFUL : 100
     * ERROR : 101
     */
//    print_r($result);
//    exit;
    if ($result) {
        logTransaction($amount,$phone);
        curl_close($curl);
        return true;
    }else{
        //Curl error
        //curl_errno($curl);
        curl_close($curl);
        return false;
    }
}


function logTransaction($amount,$phone)
{

    $db = new DB_CONNECT();
    $mysqli = $db->db_con;

    if($mysqli->connect_errno)
    {
        echo "unable to connect";
    }
    else
    {

        $sql = "INSERT INTO payments(`id`, `phone`, `amount`)VALUES('', '$phone', '$amount')";
        $result = $mysqli->query($sql);
        if($result==TRUE){
            print_r("success insert");
        }else{
            print_r("Error while inserting ".mysqli_error($mysqli));
        }
    }

}

function getSecurityCredential($source)
{

    $crypttext;
    $padding = "OPENSSL_PKCS1_PADDING";
    $fp = fopen("apicrypt.safaricom.co.ke.cer", "r");
    $pub_key = fread($fp, 8192);
    fclose($fp);
    $pub_key_string = openssl_get_publickey($pub_key);
    openssl_public_encrypt($source, $crypttext, $pub_key_string);
    /*this simply passes the string contents of pub_key_string back to be decoded*/
    $test = base64_encode($crypttext);
    return $test;
}



