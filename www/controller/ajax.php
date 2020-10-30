<?php
namespace controller;
class ajax implements IController{
    function __construct(){
        if(isset($_POST['class'])){
            $class=($_POST['class']=='discord')?'services\\'.$_POST['class']:$_POST['class'];
            $model='\\model\\'.$class;
            $this->form=new $model();
        }
    }

    function processRequest(){
        switch($_POST['action']){
        case 'select':
            $this->form->noresults="no data";
            $this->form->results="behold the ".$this->form->table." table";
            echo $this->form->showTable('*');
            break;
        case 'save':
            $this->form->insertData();
            break;
        case 'destroy':
            $this->form->truncateTable();
            break;
            //define('SOME_FILE', str_replace('//', '/', str_replace($_SERVER['DOCUMENT_ROOT'], '', dirname(__FILE__) . '/index.php')));
            //echo SOME_FILE;
        }
    }
}

?>
