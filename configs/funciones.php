<?php
   mysql_connect($host_mysql,$user_mysql,$pass_mysql) or die ("Error al conectar al servidor");
   mysql_select_db($db_mysql) or die ("Error conectando a la base de datos"); 
?>