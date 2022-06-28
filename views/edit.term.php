<?php

$model = "Edit term";
$modelStyles = "../css/styles.css";

require_once("../configs/functions.php");

JsonData::initialize(new Json("json_data/content.json"));

$id = filter_input(INPUT_GET, "term", FILTER_VALIDATE_INT);

if ($id !== false) {
    $values = JsonData::getIdValues($id);
} else {
    $values = false;
};

include("body_head/head.php");

?>

<main class="edit__main">

    <?php if ($values !== false) : ?>

        <form action="" method="POST">
            <div>
                <label for="term">term</label>
                <input type="text" value="<?= $values->term ?>" id="term" name="term" maxlength="16" minlength="1" required>
            </div>
            <div>
                <label for="content">content</label>
                <textarea name="content" id="content" cols="30" rows="10" maxlength="50" minlength="1" required> <?= $values->content ?> </textarea>
            </div>
            <div>
                <button type="submit">
                    Done
                </button>
            </div>
        </form>

        <?php

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $term = $_POST["term"];
            $content = $_POST["content"];
            $termValues = ["term" => $term, "content" => $content];

            JsonData::editTerm($id, $termValues);
            unset($term);
            unset($content);
            unset($termValues);
            header("location: layout.view.php");
            die();
        };

        ?>

    <?php endif;

    if ($values === false) : ?>

        <h1>This term doesn't exist</h1>

    <?php endif;

    ?>

</main>

<?php

include("body_head/body.php");
