<?php

require "Model.php";

class getAllartists extends Model
{
    public function getData()
    {
        echo ($this->getAllArtist());
    }
    private function getAllArtist()
    {
        try
        {
        $db = $this->getDb();
        $req = $db->prepare("select artists.id, artists.name, artists.description, artists.photo
                                        from artists");
        $req->execute();
        return(json_encode($req->fetchAll()));
        }catch (Exception $e)
        {
            return (false);
        }
    }
}