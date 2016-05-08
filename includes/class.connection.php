<?php

 /*
  -------------------------------------------------------------------------
      DR webtech's  GRIMCART connection class
              Version 2.1
    This program is free software published under the
    terms of the GNU Lesser General Public License.

    This program is distributed in the hope that it will
    be useful - WITHOUT ANY WARRANTY; without even the
    implied warranty of MERCHANTABILITY or FITNESS FOR A
    PARTICULAR PURPOSE.


	Questions & comments please send to damahrefeay@gmail.com
  -------------------------------------------------------------------------
*/

  class connections
  {

    var $connection;
    var $hostname;
    var $database;
    var $dbusername;
    var $dbpassword;
    var $error_message;

    function get_DB($host,$dbuname,$dbpwd,$database)
    {
        $this->hostname  = $host;
        $this->dbusername = $dbuname;
        $this->dbpassword  = $dbpwd;
        $this->database  = $database;

    }

    function DBLogin()
    {

        $this->connection = mysqli_connect($this->hostname,$this->dbusername,$this->dbpassword);

        if(!$this->connection)
        {
            $this->HandleDBError("Database Login failed! Please make sure that the DB login credentials provided are correct");
            return false;
        }

        if(!mysqli_select_db($this->connection, $this->database))
        {
            $this->createDB();

            mysqli_select_db($this->connection, $this->database);

            $this->createAllTables();

        }

            $this->createAllTables();

        return true;
    }

    function createDB()
    {
      $sql = "CREATE DATABASE ".$this->database;
      mysqli_query($this->connection, $sql);
      return true;
    }


    function HandleDBError($err)
    {
        $this->error_message = $err."\r\n mysqlerror:".mysql_error();
    }

    function get_Error()
    {
      $errormsg = nl2br(htmlentities($this->error_message));
        return $errormsg;
    }

   function createAllTables()
   {

     if(!$this->CreateAdminTable())
     {
       return false;
     }

     if(!$this->CreateCategoriesTable())
     {
       return false;
     }

     if(!$this->CreateCommentsTable())
     {
       return false;
     }

     if(!$this->CreateOrder_DetailsTable())
     {
       return false;
     }

     if(!$this->CreateOrdersTable())
     {
       return false;
     }

     if(!$this->CreatePrivate_OrderTable())
     {
       return false;
     }

      if(!$this->CreateProductsTable())
     {
       return false;
     }

     return true;

   }

  function CreateAdminTable()
    {
        $qry = "CREATE TABLE IF NOT EXISTS admin (".
                "adminID INT NOT NULL AUTO_INCREMENT ,".
                "adminname VARCHAR( 255 ) NOT NULL ,".
                "adminpass VARCHAR( 255 ) NOT NULL ,".
                "lastdatelog VARCHAR( 255 ) NOT NULL ,".
                "last_ip VARCHAR( 255 ) NOT NULL ,".
                "PRIMARY KEY ( adminID )".
                ")";
        $qry2 = "INSERT INTO `admin` (`adminID`, `adminname`, `adminpass`) VALUES (1, 'admin', '827ccb0eea8a706c4c34a16891f84e7b')";

      if(!mysqli_query($this->connection, $qry))
      {
        return false;
      }

      if(!mysqli_query($this->connection, $qry2))
      {
        return false;
      }

      return true;

     }

     function CreateCategoriesTable()
    {
        $qry = "CREATE TABLE IF NOT EXISTS categories (".
                "categoryID INT NOT NULL AUTO_INCREMENT ,".
                "cat_name VARCHAR( 255 ) ,".
                "parentID INT( 11 ) ,".
                "urlname VARCHAR( 50 ) ,".
                "PRIMARY KEY ( categoryID )".
                ")";

        if(!mysqli_query($this->connection, $qry))
        {
          return false;
        }

        return true;

     }

       function CreateCommentsTable()
    {
        $qry = "CREATE TABLE IF NOT EXISTS comments (".
                "cID INT NOT NULL AUTO_INCREMENT ,".
                "userID VARCHAR( 255 ) NOT NULL ,".
                "comment VARCHAR( 525 ) ,".
                "date VARCHAR( 255 ) NOT NULL ,".
                "productID INT( 11 ) ,".
                "PRIMARY KEY ( cID )".
                ")";

        if(!mysqli_query($this->connection, $qry))
        {
          return false;
        }

        return true;


     }

       function CreateOrdersTable()
    {
        $qry = "CREATE TABLE IF NOT EXISTS orders (".
                "orderID INT NOT NULL AUTO_INCREMENT ,".
                "order_time VARCHAR( 255 ) ,".
                "id_user VARCHAR( 525 ) NOT NULL ,".
                "cust_fullname VARCHAR( 255 ) ,".
                "cust_email VARCHAR( 255 ) ,".
                "cust_country VARCHAR( 255 ) ,".
                "cust_zip VARCHAR( 255 ) ,".
                "cust_state VARCHAR( 255 ) ,".
                "cust_city VARCHAR( 255 ) ,".
                "cust_address VARCHAR( 255 ) ,".
                "cust_phone VARCHAR( 255 ) ,".
                "ordernumber VARCHAR( 255 ) ,".
                "orderprice VARCHAR( 255 ) NOT NULL ,".
                "status VARCHAR( 255 ) NOT NULL ,".
                "track_no VARCHAR( 255 ) ,".
                "PRIMARY KEY ( orderID )".
                ")";

        if(!mysqli_query($this->connection, $qry))
        {
          return false;
        }

        return true;


     }

        function CreateOrder_DetailsTable()
    {
        $qry = "CREATE TABLE IF NOT EXISTS order_details (".
                "id INT NOT NULL AUTO_INCREMENT ,".
                "orderidno VARCHAR( 255 ) NOT NULL ,".
                "productid VARCHAR( 255 ) NOT NULL ,".
                "product_sku VARCHAR( 255 ) ,".
                "quantity INT( 255 ) NOT NULL ,".
                "unitprice DECIMAL( 10,2 ) NOT NULL ,".
                "total_unit_price DECIMAL( 10,2 ) NOT NULL ,".
                "shipment DECIMAL( 10,2 ) ,".
                "PRIMARY KEY ( id )".
                ")";

        if(!mysqli_query($this->connection, $qry))
        {
          return false;
        }

        return true;


     }

        function CreatePrivate_OrderTable()
    {
        $qry = "CREATE TABLE IF NOT EXISTS private_order (".
                "p_orderID INT NOT NULL AUTO_INCREMENT ,".
                "ordername VARCHAR( 355 ) ,".
                "p_ordernumber VARCHAR( 255 ) ,".
                "orderspec LONGTEXT ,".
                "email VARCHAR( 255 ) ,".
                "name VARCHAR( 255 ) ,".
                "username VARCHAR( 255 ) NOT NULL ,".
                "status VARCHAR( 255 ) NOT NULL ,".
                "orderdate VARCHAR( 255 ) NOT NULL ,".
                "PRIMARY KEY ( p_orderID )".
                ")";

       if(!mysqli_query($this->connection, $qry))
       {
         return false;
       }

       return true;


     }

          function CreateProductsTable()
    {
        $qry = "CREATE TABLE IF NOT EXISTS products (".
                "productID INT NOT NULL AUTO_INCREMENT ,".
                "categoryID INT( 11 ) NOT NULL ,".
                "prod_name VARCHAR( 255 ) ,".
                "prod_sku VARCHAR( 25 ) ,".
                "thumbnail VARCHAR( 700 ) ,".
                "price DECIMAL( 10,2 ) ,".
                "listprice DECIMAL( 10,2 ) ,".
                "prod_desc VARCHAR( 255 ) NOT NULL ,".
                "picture1 VARCHAR( 700 ) ,".
                "picture2 VARCHAR( 700 ) ,".
                "picture3 VARCHAR( 700 ) ,".
                "picture4 VARCHAR( 700 ) ,".
                "picture5 VARCHAR( 700 ) ,".
                "in_stock INT( 11 )  ,".
                "counter INT( 8 ) DEFAULT 0 ,".
                "value INT( 8 ) DEFAULT 0 ,".
                "prod_specs VARCHAR( 255 ) ,".
                "shipment DECIMAL( 10,2 ) ,".
                "PRIMARY KEY ( productID )".
                ")";

       if(!mysqli_query($this->connection, $qry))
       {
         return false;
       }

       return true;


     }
 }


?>
