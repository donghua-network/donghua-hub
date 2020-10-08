<?php
namespace model;

class oauth extends form{
    var $table='oauth',
        $columns=array('Service' => 'text',
                       'clientID' => 'text',
                       'Client_Secret' => 'password');

    function __construct (){
        parent::__construct($this->table, $this->columns);
    }
    
}
