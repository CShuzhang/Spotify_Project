<?php
require("Model.php");

class getAllAlbumsR extends Model
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
        $req = $db->prepare("select albums.id, albums.name, albums.cover_small, albums.release_date from albums order by albums.popularity");

        $req->execute();
        return (json_encode($req->fetchAll()));
       }catch (Exception $e)
       {
           return (false);
       }
   }
}