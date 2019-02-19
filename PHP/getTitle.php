<?php

require ("Model.php");

class getTitle extends Model
{
    private $_name;

    public function getData($name)
    {
        $this->_name = $name;
        if (is_array($this->checkname()))
            echo $this->getAlbumsName_x();
        else
        {
            $this->_id = null;
            echo ("error");
        }
    }
    private function    getAlbumsName_x()
    {
        $db = $this->getDb();
        $req = $db->prepare("select albums.id, albums.name, albums.cover_small, tracks.name, tracks.duration, tracks.mp3
                                        from tracks
                                        inner join albums on albums.id = tracks.album_id
                                            where tracks.name like :name order BY albums.popularity");
        $req->execute(array(':name' => $this->_name . "%"));
        return (json_encode($req->fetchAll()));
    }
    private function checkName()
    {
        try
        {
            $db = $this->getDb();
            $req = $db->prepare("select count(id) from tracks where name like :name");
            $req->execute(array(":name" => $this->_name . "%"));
            return($req->fetch());
        }catch (Exception $e)
        {
            $this->_name = "";
            return (false);
        }
    }
}
