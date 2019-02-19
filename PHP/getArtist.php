<?php
require ("Model.php");

class getArtist extends Model
{
    private $_id;
    public function     getData($id)
    {
        $this->_id = (int) $id;
        if (is_array($this->checkid()))
            echo $this->getArtist_x();
        else
        {
            $this->_id = null;
            echo ("error");
        }
    }
    private function    getArtist_x()
    {
        try
        {
            $db = $this->getDb();
            $req = $db->prepare("select albums.id as album_id, albums.name as album_name, albums.cover_small,
                                              genres.name as genre_name, genres.id as genre_id,
                                              artists.name as artist_name, artists.bio, artists.description, artists.photo
                                        from artists
                                  inner join albums on albums.artist_id = artists.id
                                  inner join genres_albums on albums.id = genres_albums.album_id
                                  left join genres on genres.id = genres_albums.genre_id
                                        where artists.id = :id");
            $req->execute(array(":id" => (int) $this->_id));
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
            $req = $db->prepare("select id from artists where id = :id");
            $req->execute(array(":id" => $this->_id));
            return($req->fetch());
        }catch (Exception $e)
        {
            return (false);
        }
    }
}
