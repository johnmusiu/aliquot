<?php



mpesareceiver();





function mpesareceiver()
{

$input = file_get_contents('php://input');
    print_r($input);
    exit;
//$input = ['details' => $request->getContent()];
//$transaction = payments::create($input);
//
////        if ($transaction) {
//
//$xml = new \DOMDocument();
//$xml->loadXML($transaction->details);
//
//
//if ($xml->getElementsByTagName('BillRefNumber')->item(0)->nodeValue) {
//$result = self::notifyClient($input2, 'https://mobichurch.co.ke/malipo-mpesa-paybill?key=OKen9SLjAnxIW2shlld7hw4vAxYMaB4EyCM2dkRzf0DhMKg49J9YEmiv79HSaZgaUkHZDTNs2jKv7GOu');
//$result = self::sendJsonPaymentToThirdParty($input,'http://192.241.245.168:8080/mchurch/loadAcount');
//exit;
//}else{
//$data = [];
//
//$data['phone'] = $xml->getElementsByTagName('MSISDN')->item(0)->nodeValue;
//$data['transaction_code'] = $xml->getElementsByTagName('TransID')->item(0)->nodeValue;
//$data['name'] = $xml->getElementsByTagName('KYCValue')->item(0)->nodeValue . ' ' . $xml->getElementsByTagName('KYCValue')->item(1)->nodeValue . ' ' . $data['last_name'] = $xml->getElementsByTagName('KYCValue')->item(2)->nodeValue;
//$data['amount'] = $xml->getElementsByTagName('TransAmount')->item(0)->nodeValue;
//$data['details'] = $transaction->details;
//$data['transaction_date'] = date("Y-m-d H:i:s", strtotime($xml->getElementsByTagName('TransTime')->item(0)->nodeValue));
//
///**
//* save the data
//*/
//$result = transaction_logs::create($data);
///**
//* update user balance
//*/
//
//$user = self::updateUserAccountBalance($result);
//
//if ($user != null) {
///**
//* get user latest pending orders
//*/
//$order = userOrders::wherePhoneAndStatus($user->phone, 1)->orderBy('id', 'DESC')->first();
//
//if (!$order) {
//$no = "0" . substr($user->phone, -9);
//$order = userOrders::wherePhoneAndStatus($no, 1)->orderBy('id', 'DESC')->first();
//
//}
//if (!$order) {
//
//$no = "+254" . substr($data['phone'], -9);
////$no = "0".substr($user->phone,-9);
//$order = userOrders::wherePhoneAndStatus($no, 1)->orderBy('id', 'DESC')->first();
//
//
//}
//
//
//if ($order) {
//
//if ($user->account_balance >= $order->amount) {
////deduct amount from user
//
//$bet = Bet::find($order->item);
//
//$no = substr($data['phone'], -9);
//
//
//$bet_details = self::getBetDetails($order->item);
////                    print_r($bet_details);exit;
//if (self::payerIsBetInitiator($bet, $user)) {
//$message = "Your bet payment for " . $bet_details['homeTeamName'] . " vs " . $bet_details['awayTeamName'] . " against " . $bet_details['opponent'] . " has been received and activated.";
//$bet->initiator_confirmed = 1;
//} else {
//$message = "Your bet payment for " . $bet_details['homeTeamName'] . " vs " . $bet_details['awayTeamName'] . " against " . $bet_details['initiator'] . " has been received and activated.";
//$bet->betting_against_confirmed = 1;
//}
//
//$bet->save();
//if (($bet->initiator_confirmed == 1) && ($bet->betting_against_confirmed == 1)) {
//$bet->status = 2;
//
////status 2 both players haveconfirmed
////status 3 = match is in progress
////status bet settled
//$bet->save();
//}
//
//$user->account_balance -= $order->amount;
//
///**
//* Display a listing of the resource.
//*
//* @return Response
//*/
//}
//}
//
//}
//}
}

