<?php
namespace model\services;
use model\oauth;

class discord extends oauth{
    const scopes='identify';
    var $hiddenFields=array('Service' => 'discord'),
        $fieldProperties=array('clientID'=>'required','Client_Secret'=>'required');

    function __construct (){
        parent::__construct($this->table, $this->columns);
    }
    
    function clientID(){
        return $this->fetchData("clientID","Service='discord'")->fetch_row()[0];
    }

    function secret(){
        return $this->fetchData("Client_Secret","Service='discord'")->fetch_row()[0];
    }

}
