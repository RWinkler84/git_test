<?php

namespace Controller;

use View\ViewRenderer;

class AbstractController
{

    protected $html;


    public function __construct()
    {
        $this->html = new ViewRenderer;
    }

    
    protected function dataArrayToObjectArray($objectName, $dataArray){
        $objectArray = [];
        $objectName = 'model\\' . $objectName;

        for ($i = 0; $i < count($dataArray); $i++){
            $object = new $objectName;

            foreach ($dataArray[$i] AS $key => $value){
            $setter = 'set' . ucfirst($key);
                $object->$setter($value);
            }
            
            $objectArray[] = $object; 
        }

        return $objectArray;
    }

    protected function login(){

    }

}
