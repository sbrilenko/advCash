<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('max_execution_time', 0);
require_once("MerchantWebService.php");
$merchantWebService = new MerchantWebService();

$arg0 = new authDTO();
$arg0->apiName = "api_name";
$arg0->accountEmail = "account_email";
$arg0->authenticationToken = $merchantWebService->getAuthenticationToken("api_password");

$arg1 = new withdrawToEcurrencyRequest();
$arg1->amount = 1.00;
$arg1->currency = "RUR";
$arg1->note = "note";
$arg1->savePaymentTemplate = true;

$validationSendMoneyToExmo = new validationSendMoneyToExmo();
$validationSendMoneyToExmo->arg0 = $arg0;
$validationSendMoneyToExmo->arg1 = $arg1;

$sendMoneyToExmo = new sendMoneyToExmo();
$sendMoneyToExmo->arg0 = $arg0;
$sendMoneyToExmo->arg1 = $arg1;

try {
    $merchantWebService->validationSendMoneyToExmo($validationSendMoneyToExmo);
    $sendMoneyToExmoResponse = $merchantWebService->sendMoneyToExmo($sendMoneyToExmo);

    echo print_r($sendMoneyToExmoResponse, true)."<br/><br/>";
} catch (Exception $e) {
    echo "ERROR MESSAGE => " . $e->getMessage() . "<br/>";
    echo $e->getTraceAsString();
}
?>