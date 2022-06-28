<?php

class Circle
{

    public function __construct($width)
    {
        $this->width = $width;
    }

    public function drawCircle($color = "black", $amount = 1)
    {

        for ($i = 0; $i < $amount; $i++) : ?>

            <div class="circle" style="width: <?= $this->width ?>; background: <?= $color ?>"></div>

        <?php endfor;
    }
}

class Circles
{

    static private $circle;

    static public function initialize(Circle $circle)
    {
        return self::$circle = $circle;
    }

    static public function drawCircle($color = "black", $amount = 1)
    {
        return self::$circle->drawCircle($color, $amount);
    }
}

// $dataObject = [tableClass => ""], 
// headerStatus => [ amount => 1 ,"headerClass" => "", colSpan => [1], headerContents => ["my head"],
// headRowClass => "",
// rowClass => "",
// 

//]
// 
//
//

class Table
{

    function __construct($dataObject, $jsonFile)
    {
        $this->tableClass = $dataObject["tableClass"];
        $this->headerStatus = $dataObject["headerStatus"];
        $this->headRowClass = $dataObject["headRowClass"];
        $this->rowClass = $dataObject["rowClass"];
        $this->jsonFile = $jsonFile;
    }

    function drawTable($amount)
    {
        for ($i = 0; $i < $amount; $i++) : ?>

            <table class="<?= $this->tableClass ?>">
                <tr class="<?= $this->headRowClass ?>">
                    <?php
                    $this->drawTableHead($this->headerStatus);
                    ?>
                </tr>
                <?php

                $handle = file_get_contents($this->jsonFile, true);
                $json = json_decode($handle);
                foreach ($json as $id => $jsonData) : ?>

                    <tr class="<?= $this->rowClass ?>">

                        <td> <a href="../views/edit.term.php?term=<?= $id ?>" class="edit">Edit Term</a></td>
                        <td> <?= $jsonData->term ?> </td>
                        <td> <?= $jsonData->content ?> </td>
                        <td> <a href="../views/delete.view.php?term=<?= $id ?>">delete</a> </td>

                    </tr>
                <?php endforeach; ?>
            </table>

        <?php endfor;
    }

    function drawTableHead($headerStatus)
    {

        for ($i = 0; $i < $headerStatus["amount"]; $i++) : ?>

            <th colspan="<?= $headerStatus["colSpan"][$i] ?>" class="<?= $headerStatus['headerClass'] ?>">
                <?= $headerStatus["headerContents"][$i] ?>
            </th>

<?php endfor;
    }
}
