<?php
require("Model.php");

class getAllAlbums extends Model
{
    public function getData()
    {
        echo ($this->Albums());
    }
   private function Albums()
   {
       try
       {
        $db = $this->getDb();
        $req = $db->prepare("select albums.id, albums.name, albums.cover_small, albums.release_date from albums order by RAND()");

        $req->execute();
        return (json_encode($req->fetchAll()));
       }catch (Exception $e)
       {
           return (false);
       }
   }
}
