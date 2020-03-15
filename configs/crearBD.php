<?php

    error_reporting(0);
    
    class MyDB extends SQLite3
    {
       function __construct()
       {
          $this->open('Ventas.db');
       }
    }

    $db = new MyDB();
    /*
    if(!$db){
        echo $db->lastErrorMsg();
    }*/

    $sql=<<<EOF
    CREATE TABLE Usuario
        (k_id INTEGER PRIMARY KEY AUTOINCREMENT,
        n_username	TEXT NOT NULL,
        o_pass	TEXT NOT NULL
    );

    CREATE TABLE Producto
        (k_idP	INTEGER PRIMARY KEY AUTOINCREMENT,
        n_nomProdu	TEXT NOT NULL,
        v_precio	INTEGER NOT NULL CHECK(v_precio>0),
        o_img       TEXT NOT NULL
    );
EOF;

    $ret = $db->exec($sql);
    /*
    if(!$ret){
        echo $db->lastErrorMsg();
    }*/
    $db->close();

?>