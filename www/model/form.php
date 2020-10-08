<?php
namespace model;

class form extends table{
    var $table, //table associated with the form
        $columns;//columns that model the fields of the form

    function __construct ($table, $columns){
        parent::__construct($table, $columns);
    }

    function formInputFields(){
        //create input fields depending on the values in the database
        foreach($this->columns as $key => $value){
            $fields.='
                        <label class="form-label" for="'.strtolower($key).'">'.$key.'</label>
                        <input class="form-control mr-sm-2" name="'.strtolower($key).'" type="'.strtolower($value).'">
                      ';
        }
        return $fields;
    }

    function validinput(){
        //only return true if the input value is valid
        return true;
    }

    function curl($c_url, $content_type, $post=false){
        $curl=curl_init($c_url);
        if($post!='auth'){
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        if(is_array($content_type))
            curl_setopt($curl, CURLOPT_HTTPHEADER, $content_type);
        else
            curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: ".$content_type));
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLINFO_HEADER_OUT, true);
        $result = curl_exec($curl);
        if(!$post){
            $this->response = json_decode($result);
        }else{
            return array(
                'data'     => $result,
                'redirect' => curl_getinfo($curl, CURLINFO_REDIRECT_URL),
                'status'   => curl_getinfo($curl, CURLINFO_HTTP_CODE)
            );
        }

    }


}
?>
