<?php
/*         __________________________________________
  ________|                                          |_______
  \       |              PHP PREVOD                  |      /
   \      |  Copyright © 2015 Extreme Design Studio  |     /
   /      |__________________________________________|     \
  /__________)                                    (_________\

* =======================================================================
* Copyright:            Extreme Design Studio 2014                  
* Author:               Dragan Jankovic (dragan88_ar@hotmail.com)       
* =======================================================================
* original filename:    class.MySql.php
* author:               Dragan Jankovic
* email:                dragan88_ar@hotmail.com
* =======================================================================
*/

/*
    $host       =   "localhost";
    $username   =   "username";
    $password   =   "sifra";
    $baza       =   "dbname";
*/


/**
* NE DIRAJ NISTA ISPOD OVOGA 
*/
class SQL
{
    protected $host;
    protected $username;
    protected $password;
    protected $db;
    protected $port;
    protected $charset;
    protected $sta;
    protected $gde;
    protected $uslov;
    protected $slozi;
    protected $metod;  
    protected $limit; 
    protected $skup;

    public function __construct($host = NULL, $username = NULL, $password = NULL, $db = NULL, $port = NULL, $charset = 'utf8')
    {

        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->db = $db;
        $this->port = $port;
        $this->charset = $charset;        
        $this->connect();

    }
    public function connect()
    {
        if (empty ($this->host))
            die ('Host nije podesen');

        $this->_mysqli = new mysqli ($this->host, $this->username, $this->password, $this->db, $this->port)
            or die('Problem prilikom konektovanja na bazu');

    } 

    public function uslov($uslov=NULL)
    {
        $this->uslov="WHERE ".$uslov;
    }
    public function procitaj($sta=NULL, $odakle=NULL, $slozi=NULL,$metod=NULL, $limit=NULL)
    {
       
        $this->sta=$sta;
        $this->odakle=$odakle;
        $this->slozi=$slozi;
        $this->metod=$metod;
        $this->limit=$limit;


        if($slozi){$this->slozi="ORDER BY ".$slozi;}
        if($metod==1){$this->metod="DESC";}
        else{$this->metod="ASC";}
        if($limit){$this->limit="LIMIT ".$limit;}

        $this->red = $this->_mysqli->query("SELECT $this->sta FROM $this->odakle $this->uslov $this->slozi $this->metod $this->limit ") or die("Greska prilikom izabira podataka iz baze!");
        $this->ocisti();
        return $this->red;
    }

    public function dodaj($gde=NULL,$skup=NULL )
    {
        $this->gde=$gde;
        $this->skup = array_keys($skup);
        $this->dodavanje="INSERT INTO ".$gde."
        (`".implode('`,`', $this->skup)."`)
        VALUES('".implode("','", $skup)."')";
        $this->ocisti();
        $this->_mysqli->query($this->dodavanje)or die("Greska prilikom dodavanja u bazu!");
        
        if(mysqli_affected_rows($this->_mysqli)>0)
        {
            return true;
        }
        else
        {
            return false;
        }

    }

    public function izmeni($gde, $skup)
    {
        $this->uslovSQL = '';
        if(!empty($this->uslov))
        {
            if(substr(strtoupper(trim($this->uslov)), 0, 5) != 'WHERE')
            {
                $this->uslovSQL = " WHERE ".$this->uslov;
            } else
            {
                $this->uslovSQL = " ".trim($this->uslov);
            }
        }
        $this->sql = "UPDATE ".$gde." SET ";
        $setovi = array();
        foreach($skup as $column => $value)
        {
             $setovi[] = "`".$column."` = '".$value."'";
        }
        $this->sql .= implode(', ', $setovi);
        $this->sql .= $this->uslovSQL;
        $this->ocisti();
        $this->_mysqli->query($this->sql);

        if(mysqli_affected_rows($this->_mysqli)>0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function obrisi($gde)
    {
        $this->uslovSQL = '';
        $this->gde=$gde;
        if(!empty($this->uslov))
        {
            if(substr(strtoupper(trim($this->uslov)), 0, 5) != 'WHERE')
            {
                $this->uslovSQL = " WHERE ".$this->uslov;
            } else
            {
                $this->uslovSQL = " ".trim($this->uslov);
            }
        }
        $this->sql = "DELETE FROM ".$this->gde.$this->uslovSQL;

        $this->ocisti();
        $this->_mysqli->query($this->sql);

        if(mysqli_affected_rows($this->_mysqli)>0)
        {
            return true;
        }
        else
        {
            return false;
        }        
    }

    public function ocisti()
    {
        $this->uslov=NULL;
        $this->skup=NULL;
        $this->sta=NULL;
        $this->gde=NULL;
        $this->odakle=NULL;
        $this->metod=NULL;
        $this->limit=NULL;
        $this->slozi=NULL;
        $sta=NULL;
        $gde=NULL;
        $uslov=NULL;
        $slozi=NULL;
        $metod=NULL;  
        $limit=NULL; 
        $skup=NULL;                
    }

    public function __destruct()
    {
        if ($this->_mysqli)
            $this->_mysqli->close();
    }


}

?>
