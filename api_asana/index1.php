<?php
ini_set("max_execution_time", 300);
require_once('asana.php');

$asana = new Asana(array('apiKey' => 'bZN6mBeL.7cBWsHfKEMSPcNP4gmRHiIq'));

$tasks = $asana->getProjectTasks(42248342439432);
$tasksJson = json_decode($tasks);
?>

<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>ASANA</title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="assets/bootstrap.css">
<style>
  body {
  padding-top: 10px;
  padding-bottom: 10px;
  }
</style>

<link rel="stylesheet" href="assets/style.css">
<script src="assets/bootstrap.js"></script>
<script src="assets/jquery.js"></script>
<script src="assets/hs.js"></script>
<script src="assets/jquery.tablesorter.js"></script>
</head>

<body>

<div class="container">	 
<table width="98%" cellpadding="3" cellspacing="0" border="1" class="table" id="sorttable">
            <thead>
            <tr>
                <th>Date /Time Posted</th>
                <th>Task Name</th>
                <th>Description</th>
                <th>Comments</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($tasksJson->data as $task) {
                /*print_r($task);
                die();*/
                $taskDetail = json_decode($asana->getTask($task->id));
                if ($asana->responseCode != '200' || is_null($taskDetail)) 
                {
                    continue;
                }
                $taskStories = json_decode($asana->getTaskStories($task->id));
                ?>
                <tr>
                    <td><?php echo date("M, d Y", strtotime($taskDetail->data->created_at)); ?></td>
                    <td><?php echo $taskDetail->data->name; ?></td>
                    <td><?php echo $taskDetail->data->notes; ?></td>
                    <td>
                        <?php if (!empty($taskStories->data)):
                            echo '<ol>';
                            foreach ($taskStories->data as $comment): ?>
                                <li><?php echo $comment->text; ?></li>
                            <?php endforeach; echo '</ol>'; endif; ?>
                    </td>
                </tr>

            <?php
            }
            ?>
            </tbody>
        </table>
        </div>
</body>

<script>
$(function(){
	  $("#sorttable").tablesorter();
	});
</script>
</html>
