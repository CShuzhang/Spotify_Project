<?php
require("Model.php");

class getAllGenres extends Model
{
    public function getData()
    {
        echo ($this->getGender());
    }

    private function getGender()
    {
        try {
            $db = $this->getDb();
            $req = $db->prepare("select id, name from genres");
            $req->execute();
            return (json_encode($req->fetchAll()));

        }catch (Exception $e)
        {
            return (false);
        }
    }
}
