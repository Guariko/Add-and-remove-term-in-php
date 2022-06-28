<?php


class Json
{

    public function __construct($path)
    {
        $this->path = $path;
        $this->createJsonFile();
    }

    public function createJsonFile()
    {

        if (!file_exists($this->path)) {
            $content = [
                1 => ["term" => "my term", "content" => "my term content"]
            ];

            file_put_contents($this->path, json_encode($content));
        };
    }

    public function appendDataToJson($dataObject)
    {

        if (!file_exists($this->path)) {
            $this->createJsonFile();
        };

        $handle = file_get_contents($this->path, true);
        $json = json_decode($handle);
        $id = 1;

        while (isset($json->$id)) {
            $id++;
        };

        $json->$id = $dataObject;

        file_put_contents($this->path, json_encode($json));
    }

    public function getIdValues($id)
    {
        $id = strval($id);
        $handle = file_get_contents($this->path, true);
        $json = json_decode($handle);
        foreach ($json as $jsonId => $idValue) {
            if ($id === $jsonId) {
                return $idValue;
            };
        };
        return false;
    }

    public function deleteIdValue($id)
    {
        $id = strval($id);
        $handle = file_get_contents($this->path, true);
        $json = json_decode($handle);
        foreach ($json as $jsonId => $idValue) {
            if ($id === $jsonId) {
                unset($json->$jsonId);
                file_put_contents($this->path, json_encode($json));
                return;
            };
        }
    }

    public function editTerm($id, $values)
    {

        $handle =  file_get_contents($this->path, true);
        $json = json_decode($handle);

        $json->$id = $values;

        file_put_contents($this->path,  json_encode($json));
    }
}

class JsonData
{

    static private $json;

    static public function initialize(Json $json)
    {
        return self::$json = $json;
    }

    static public function createJsonFile()
    {
        return self::$json->createJsonFile();
    }

    static public function appendDataToJson($dataObject)
    {
        return self::$json->appendDataToJson($dataObject);
    }

    static public function getIdValues($id)
    {
        return self::$json->getIdValues($id);
    }

    static public function deleteIdValue($id)
    {
        return self::$json->deleteIdValue($id);
    }

    static public function editTerm($id, $values)
    {
        return self::$json->editTerm($id, $values);
    }
}
