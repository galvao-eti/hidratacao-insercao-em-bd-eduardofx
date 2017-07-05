<?php
namespace Alfa\Config;

class Conn 
{
   public static function getDb()
    {
        return new \PDO("mysql:host=localhost;dbname=db","root","");
    }
    
}