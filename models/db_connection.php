<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "smart_printing";

class DataBase
{
    public static $instance = NULL;
    public static function getInstance()
    {
        if (!isset(self::$instance)) 
        {
            self::$instance = mysqli_connect("localhost", "root", "", "smart_printing");
            if (mysqli_connect_errno())
            {
                die("Failed to connect to MySQL: " . mysqli_connect_error());
            }
        }
        return self::$instance;
    }
}
?>
