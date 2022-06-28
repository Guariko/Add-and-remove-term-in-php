<?php


$model = "Create a term";
$modelStyles = "../css/styles.css";

require_once("../configs/functions.php");
JsonData::initialize(new Json("json_data/content.json"));


include("body_head/head.php");

?>

<main class="main">


    <form action="" method="POST" class="create__term">

        <div>
            <input type="text" placeholder="Term" maxlength="16" minlength="1" required name="termName">
        </div>
        <div>
            <textarea name="termContent" cols="30" rows="10" placeholder="Term Content" maxlength="50" minlength="1" requireds></textarea>
        </div>
        <div>
            <button type="submit">
                Create Term
            </button>
        </div>

    </form>
    <a href="layout.view.php" class="go__home">Return Home</a>
    <?php

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $termContent = ["term" => $_POST["termName"], "content" => $_POST["termContent"]];

        JsonData::appendDataToJson($termContent);
        unset($termContent);
        header("location: layout.view.php");
    }

    ?>

</main>

<?php

include("body_head/body.php");
