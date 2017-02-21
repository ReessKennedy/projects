<meta charset="utf-8">
<?php

date_default_timezone_set('Europe/Paris');

require_once 'vendor/autoload.php';
//require_once 'src/autoload.php';

/**
 * Sample usage
 */

use WorkFlowyPHP\WorkFlowy;
use WorkFlowyPHP\WorkFlowyException;
use WorkFlowyPHP\WorkFlowyList;
use WorkFlowyPHP\WorkFlowyAccount;

/**
 * Session
 */

if (!empty($_GET['sessionid']))
{
    $session_id = $_GET['sessionid'];
}
else
{
    try
    {
        $session_id = WorkFlowy::login('workflowy1@yopmail.com', 'workflowy1');
        var_dump($session_id);
    }
    catch (WorkFlowyException $e)
    {
        var_dump($e->getMessage());
    }
}

/**
 * Account
 */

/*
$account_request = new WorkFlowyAccount($session_id);
var_dump($account_request->getUsername());
var_dump($account_request->getEmail());
var_dump($account_request->getRegistrationDate());
var_dump($account_request->getTheme());
var_dump($account_request->getItemsCreatedInMmonth());
var_dump($account_request->getMonthlyQuota());
exit;
*/

/**
 * Lists
 */

$list_request = new WorkFlowyList($session_id);
$list = $list_request->getList();

$sublist = $list->searchSublist('#test3#');

$sublist->createSublist('creation test', date('m-d-Y H:i:s'), 999);


/*

$sublist->getID();
$sublist->getName();
$sublist->getDescription();
$sublist->getParent();
$sublist->isComplete();
$sublist->getOPML();
$sublist->getSublists();
$sublist->searchSublist();

$sublist->setName('my sublist');
$sublist->setDescription('my description');
$sublist->setParent($list, 2);
$sublist->setComplete(true || false);
$sublist->createSublist('My list name', 'My list description', 999);

*/