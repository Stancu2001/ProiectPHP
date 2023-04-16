<?php
class DB{
    private $con;
    function __construct($host,$userName,$password,$dbName)
    {
     $this->con=new PDO('mysql:host='.$host.';dbname='.$dbName,$userName,$password);
     
    }
    function query($query,$param=null){
        $prepare=$this->con->prepare($query);
        $prepare->execute($param);
        return $prepare;
    }
}
$db=new DB("localhost","root","","WEB");

?>
