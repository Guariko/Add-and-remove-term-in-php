<?php

$model = "Delete term";
$modelStyles = "../css/styles.css";

require_once("../configs/functions.php");
include("body_head/head.php");



$id = filter_input(INPUT_GET, "term", FILTER_VALIDATE_INT);
JsonData::initialize(new Json("json_data/content.json"));


$term = JsonData::getIdValues($id);



?>

<main class="delete__main">

    <?php if ($term !== false) :

        $term = $term->term;

    ?>

        <form action="" method="POST">
            <h1>Are you sure you want to delete <mark> <?= $term ?> </mark></h1>
            <div>
                <button type="submit" name="yes">yes</button>
                <button type="submit" name="no">no</button>
            </div>
        </form>



        <?php

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $delete = $_POST["yes"];

            if (isset($delete)) {

                JsonData::deleteIdValue($id);
                header("location: layout.view.php");
            } else {
                header("location: layout.view.php");
            };
        };

    endif;

    if ($term === false) : ?>

        <h1>This term doesn't exist</h1>
        <a href="layout.view.php" class="button">Go home</a>

    <?php endif;



    ?>

</main>

<?php

include("body_head/body.php");
