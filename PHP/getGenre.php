<?php
require ("Model.php");

class getGenre extends Model
{
    private $_id;

    public function     getData($id)
    {
        $this->_id = (int) $id;
        if (is_array($this->checkid()))
            echo $this->getGenre_x();
        else
        {
            $this->_id = null;
            echo ("error");
        }
    }

    private function        getGenre_x()
    {
        $db = $this->getDb();
        $req = $db->prepare("select albums.id as album_id, albums.name as albums_name, albums.artist_id as artist_id, albums.cover_small,
                                        artists.name as artist_name, genres.name as genre_name
                             from albums
                             inner join artists on artists.id = albums.artist_id
                             inner join genres_albums on albums.id = genres_albums.album_id
                             left join genres on genres.id = genres_albums.genre_id
                                  where genres.id = :id;");
        $req->execute(array(":id" => $this->_id));
        return (json_encode($req->fetchAll()));
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