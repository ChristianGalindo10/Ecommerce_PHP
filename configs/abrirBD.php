<?php
    error_reporting(0);
    
    class MyDB extends SQLite3
    {
       function __construct()
       {
          $this->open('VentasBD.db');
       }
    }

    $db = new MyDB();
    $db->close();

?>