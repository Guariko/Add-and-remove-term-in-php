<?php

$model = "circle";
$modelStyles = "../css/styles.css";

require_once("../configs/classes.view.php");
require_once("../configs/functions.php");
include("body_head/head.php");


Circles::initialize(new Circle("24rem"));

const JSONFILE = "json_data/content.json";
$dataObject = [
    "tableClass" => "table",
    "headerStatus" => ["amount" => 1, "headerClass" => "table__head", "colSpan" => [4], "headerContents" => ["my head"]],
    "headRowClass" => "",
    "rowClass" => "table__row"
];

// [tableClass => ""], 
// headerStatus => [ amount => 1 ,"headerClass" => "", colSpan => [1], headerContents => ["my head"],
// headRowClass => "",
// rowClass => "",


JsonData::initialize(new Json(JSONFILE));


$table = new Table($dataObject, JSONFILE);

?>

<main class="main">

    <a href="create.term.php" class="create">create a new term</a>

    <?php

    $table->drawTable(1);

    ?>

</main>


<?php
include("body_head/body.php");
