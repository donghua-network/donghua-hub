<?php
namespace model;
class user extends form{
    var $table="users",
        $columns=array('username' => 'text',
        'password' => 'password',
        'role' => 'text');

    function __construct (){
        parent::__construct ($this->table, $this->columns);
    }

}
?>
