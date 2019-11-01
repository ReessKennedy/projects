<?
require_once (getcwd().'/wrapper/src/autoload.php');

use WorkFlowyPHP\WorkFlowy;
use WorkFlowyPHP\WorkFlowyException;
try
{
    $session_id = WorkFlowy::login('email@gmail.com', 'password');
}
catch (WorkFlowyException $e)
{
    var_dump($e->getMessage());
}



use WorkFlowyPHP\WorkFlowyList;

$list_request = new WorkFlowyList($session_id);
$list = $list_request->getList();


echo '<pre style="height: 400px; overflow-y: scroll; ">';
var_dump($list);
echo '</pre>';

echo '<hr>';


$array = json_decode(json_encode($list), true);


$i = 0;
foreach ($array as $key => $value) {
	echo $key;
	echo $value;
	echo '<br>';
	echo '<br>';
}
$i++;



//$newone = $list->searchSublist('/Testaddditoonforthis/', array('get_all' => false));
//print_r($newone);


?>

