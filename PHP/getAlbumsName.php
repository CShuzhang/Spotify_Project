<?php
require ('Model.php');

class getAlbumsName extends Model
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
        $req = $db->prepare("select albums.id, albums.name, albums.cover_small, albums.description, albums.release_date, albums.popularity,
                                                  genres.name as genre_name, artists.name, artists.id
                                        from albums
                                        inner join artists on artists.id = albums.artist_id
                                        inner join genres_albums on albums.id = genres_albums.album_id
                                        left join genres on genres.id = genres_albums.genre_id
                                            where albums.name like :name order BY albums.popularity");
        $req->execute(array(':name' => $this->_name . "%"));
        return (json_encode($req->fetchAll()));
    }
    private function checkName()
    {
        try
        {
            $db = $this->getDb();
            $req = $db->prepare("select count(id) from albums where name like :name");
            $req->execute(array(":name" => $this->_name . "%"));
            return($req->fetch());
        }catch (Exception $e)
        {
            $this->_name = "";
            return (false);
        }
    }
}
