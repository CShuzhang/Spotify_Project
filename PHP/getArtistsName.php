<?php
require ("Model.php");

class getArtistsName extends Model
{
    private $_name;

    public function getData($name)
    {
        $this->_name = $name;
        if (is_array($this->checkname()))
            echo $this->getArtistsName_x();
        else
        {
            $this->_id = null;
            echo ("error");
        }
    }
    private function    getArtistsName_x()
    {
        $db = $this->getDb();
        $req = $db->prepare("select id, name, photo, description from artists where name like :name");
        $req->execute(array(":name" => $this->_name . "%"));
        return (json_encode($req->fetchAll()));
    }
    private function checkName()
    {
        try
        {
            $db = $this->getDb();
            $req = $db->prepare("select count(id) from artists where name like :name");
            $req->execute(array(":name" => "%" . $this->_name . "%"));
            return($req->fetch());
        }catch (Exception $e)
        {
            $this->_name = "";
            return (false);
        }
    }
}