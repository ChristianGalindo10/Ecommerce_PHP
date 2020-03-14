<?php
   class BaseDatos extends SQLite3{
       function __construct(){
           $this->open("cuentas.db");
       }
   }
   $db = new BaseDatos();
?>