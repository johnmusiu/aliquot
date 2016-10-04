<?php

// A class file to connect to a database

class DB_CONNECT {

      var $db_con;

      // constructor
      function __construct(){
      	       $this->connect();
      }

      function __destruct(){
      	       $this->close();
      }

      function connect(){

      	       // import database connection variables
	       require_once __DIR__ . '/db_config.php';

	       // $db = mysql_select_db(DB_DATABASE) or die(mysql_error());
	       $this->db_con = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
             //echo "success";
      }

      function close(){
      	       mysqli_close($this->db_con);
      }

}

?>

