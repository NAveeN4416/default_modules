<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Property {

    public function Property(){

    }

    /*public function set_message($label,$message){
        throw new Exception("Not Implemented");
        
    }*/
}


class required extends Property{


    public function validate($label,$value,$message,$code)
    {
        if($code=='required' && $value==''){
            $this->label   = $label;
            $this->message = $message;
            return $this->set_message();
        }
        
        return false;
    }

    public function set_message(){
        return str_replace('{label}', $this->label, $this->message);
    }

}

class max_length extends Property{

    public function validate($label,$value,$message,$length)
    {
        if(!is_int($length))
            throw new Exception("max_length should be an interger");

        $this->label   = $label;
        $this->message = $message;
        $this->length  = $length;

        if(strlen($value)<$length)
            return $this->set_message();

        return false;
    }

    public function set_message(){
        $string = str_replace('{label}', $this->label, $this->message);
        $string = str_replace('{length}', $this->length, $string);
        return $string;
    }
}


$min_length =  new max_length ;

/*class min_length extends Property{
    public function set_message(){
        $string = str_replace('{label}', $this->label, $this->message);
        $string = str_replace('{length}', $this->length, $this->string);
        return $string;
    }

    public function validate($label,$value,$message,$length)
    {
        if(!is_int($length))
            throw new Exception("max_length should be an interger");

        $this->label   = $label;
        $this->message = $message;
        $this->length  = $length;

        if(strlen($value)!=$length)
            return $this->set_message();

        return True;
    }
}*/

class null extends Property{
    public function set_message($label,$length,$message){
        $string = str_replace('{label}', $label, $message);
        $string = str_replace('{length}', $length, $string);
        return $string;
    }
}