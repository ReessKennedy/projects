<? 
// Sample API --
// Sample Project ID --

if (isset($_GET['proj'])) { 
	$proj = $_GET['proj']; 
	echo "$proj";
	if ($proj == "projectid_1") {$projselect = XXXXXXXXXXXXX; }
	if ($proj == "projectid_2") {$projselect = XXXXXXXXXXXXX;}
	if ($proj == "projectid_3") {$projselect = XXXXXXXXXXXXX;}
	if ($proj == "projectid_4") {$projselect = XXXXXXXXXXXXX;}	
	if ($proj == "projectid_5") {$projselect = XXXXXXXXXXXXX;}	
	echo "$projselect";
}

// See class comments and Asana API for full info

$asana = new Asana(array('apiKey' => 'XXXXXXXXXXXXXXXXXXXXXXXXXX')); // Your API Key, you can get it in Asana
$projectId = $projselect; // Your Project ID Key, you can get it in Asana

$result = $asana->getProjectTasks($projectId);

// As Asana API documentation says, when response is successful, we receive a 200 in response so...
if ($asana->responseCode != '200' || is_null($result)) {
    echo 'Error while trying to connect to Asana, response code: ' . $asana->responseCode;
    return;
}

$resultJson = json_decode($result, true);
//var_dump($resultJson);

?>
