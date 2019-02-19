<?php
require ("Model.php");

class getAlbum extends Model
{
    private $_id;
    public function getData($id)
    {
        $this->_id = (int) $id;
        if (is_array($this->checkid()))
            echo $this->getALbum_x();
        else
        {
            $this->_id = null;
            echo ("error");
        }
    }

    private function getALbum_x()
    {
        try
        {
            $db = $this->getDb();
            $req = $db->prepare("select albums.name, albums.cover, albums.release_date, albums.description, albums.artist_id,
                                               tracks.name as track_name, tracks.mp3, tracks.duration, artists.name as artist_name
                                        from albums
                                        inner join artists on artists.id = albums.artist_id
                                        inner join tracks on tracks.album_id = albums.id
                                            where albums.id = :id");
            $req->execute(array(":id" => $this->_id));
            return (json_encode($req->fetchAll()));
        }catch (Exception $e)
        {
            return (false);
        }
    }
    private function checkid()
    {
        try
        {
            $db = $this->getDb();
            $req = $db->prepare("select id from albums where id = :id");
            $req->execute(array(":id" => $this->_id));
            return($req->fetch());
        }catch (Exception $e)
        {
            return (false);
        }
    }
}