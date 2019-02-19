<?php
function    route($get)
{
    static $table = ['AllAlbumsR', 'AllAlbums', 'AllArtists', 'AllGenres', 'ArtistsName', 'AlbumsName', 'Title', 'Album', 'Artist', 'Genre'];
    $c = -1;

    if (isset($get['search']))
    {
        while (isset($table[++$c]))
        {
            if ($table[$c] === ucfirst($get['search']))
            {
                $classname = 'get'.$table[$c];
                require_once './'.$classname.'.php';
                $req = new $classname();
                if (isset($get['value']))
                    $req->getData($get['value']);
                else
                    $req->getData();
            }
        }
    }
    else
        echo ("Je n'ai pas compris votre requetes, AND PUT THIS COOKIE DOWN");
}

route($_GET);