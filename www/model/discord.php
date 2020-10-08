<?php
namespace model;

class discord extends oauth{
    const scopes='identify';

    function __construct (){
        parent::__construct($this->table, $this->columns);
    }
    
    function formInputFields(){
        //create input fields depending on the values in the database
        foreach($this->columns as $key => $value){
            if($key !='Service'){
                $fields .= '
                            <label class="form-label" for="'.strtolower($key).'">'.$key.'</label>
                            <input class="form-control mr-sm-2" name="'.strtolower($key).'" type="'.strtolower($value).'">
                           ';
            }else{
                $fields .= '<input class="form-control mr-sm-2" name="'.strtolower($key).'" type="hidden" value="discord">';
            }

        }
        return $fields;
    }

    function clientID(){
        return $this->fetchData("clientID","Service='discord'")->fetch_row()[0];
    }

    function secret(){
        return $this->fetchData("Client_Secret","Service='discord'")->fetch_row()[0];
    }

}
