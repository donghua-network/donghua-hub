<?php
session_start();
abstract class data{
    var $mysql,//mysql object
        $sqldie,//if this is 1 it prints the query
        $result,//result from query
        $results,//message to show if there are results
        $noresults;//message to show if there are no results

    function __construct (){
        $this->sqldie=0;
    }

    function fetchData($columns, $where='', $groupby='', $orderby='', $limit=''){
    //fetch data to build the table
        $where=($where!="")?" WHERE ".$where:"";
        $groupby=($groupby!="")?" GROUP BY ".$groupby:"";
        $orderby=($orderby!="")?" ORDER BY ".$orderby:"";
        $limit=($limit!="")?" LIMIT ".$limit:"";
        if($this->table=='')$this->sqldie=1;
        $query="SELECT ".$columns." FROM ".$this->table.$where.$groupby.$orderby.$limit;
        if($this->sqldie)die($query);
        $result=$this->mysql->query($query) or die($this->mysql->error);
        return $result;
    }

    function pr($array){
        //easy function to print an array in an easy to read format
        print "<pre>";
        print_r($array);
        echo "</pre>";
    }

    abstract function validinput();
    //return false when the input is invalid

    function errorMessage($message){
        //show the errormessage in an alert
        return '<div class="alert alert-danger">'.$message.'</div>';
    }

    function createTable($columns){
        $columns=($columns!="")?', '.$columns:'';
        if($this->table=='')$this->sqldie=1;
        $query="CREATE TABLE IF NOT EXISTS ".$this->table." (Id INT AUTO_INCREMENT PRIMARY KEY".$columns.", Insert_date TIMESTAMP, Active TINYINT(1) DEFAULT 1);";
        if($this->sqldie)die($query);
        $this->mysql->query($query) or die($this->mysql->error);
    }

    function insertData($init=''){
        if($init==''){
            $values='';
            $this->columns;
            foreach($this->columns as $key => $value){
                $keys.=$this->mysql->real_escape_string($value).",";
                $values.="'".$this->mysql->real_escape_string($_POST[strtolower($value)])."',";
            }
        }else{

            $columns=array_combine($this->columns,$this->columntypes);
            foreach($columns as $key => $value){
                $keys.=$this->mysql->real_escape_string($key).",";
                $values.=$this->tableInitVals($key);
            }
        }
        $keys=substr($keys, 0, -1);
        $values=substr($values, 0, -1);
        if($this->table=='')$this->sqldie=1;
        $query="INSERT INTO ".$this->table." (".$keys.") VALUES (".$values.")";
        if($this->sqldie)die($query);
        $this->mysql->query($query) or die($this->mysql->error);
    }

    abstract function tableInitVals($key);

    function truncateTable(){
        if($this->table=='')$this->sqldie=1;
        $query="TRUNCATE ".$this->table.";";
        if($this->sqldie)die($query);
        $this->mysql->query($query) or die($this->mysql->error);
    }
}
?>