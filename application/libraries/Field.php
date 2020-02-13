<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Properties.php';

class Field {

    /**
     * Array output format
     */
    const ARRAY_FORMAT = 'array';

    protected $_args = [];
    protected $_messages = [];

    /**
     * CodeIgniter instance
     *
     * @var object
     */
    private $_CI;

    protected $default_codes = ['required','null'];

    public function Field($properties=array())
    {
        foreach($properties as $property => $value) {

            if(!in_array($property, $this->default_codes))
                throw new Exception("Invalid $property argument passed");
                
            $this->$property = $value;
        }

        $this->_properties = $properties;
    }

    public function validation_rules()
    {
        return $this->_properties;
    }

    public function generate_messages()
    {
        if(!property_exists($this, 'label'))
            throw new Exception("Need Lable to set messages !");
        
        $label = strtoupper($this->label) ;

        foreach ($this->_properties as $property => $code) {
            $obj = new $property();
            $msg = $obj->set_message($this->label,$this->default_messages[$property],$code);

            $this->_messages[$property] = $msg;
        }

        return $this->_messages;
    }

    public function set_value($value='')
    {
        $this->_value = $value ;
    }

    public function validate()
    {
        if(!property_exists($this, '_value'))
            throw new Exception("CharField object needs value to validate, use set_value(value) method to set value");

        foreach ($this->_properties as $property => $code) {
            foreach ($this->_properties as $property => $code) {
            $obj = new $property();
            $flag = $obj->validate($this->label,$this->_value,$this->default_messages[$property],$code);

            if($flag)
                $this->_messages[$property] = $flag;
        }

        return $this->_messages;
        }
    }
}

class CharField extends Field {

    protected $default_codes = ['required','null','max_length','min_length'] ;

    protected $default_messages = [
                                    'required'   => "{label} is required" ,
                                    'null'       => "{label} may not be NUll",
                                    'max_length' => "{label} should be > {length} chars",
                                    'min_length' => "{label} should be < {length} chars"
                                ] ;

    public function CharField($label,$properties)
    {
        parent::Field($properties);
        $this->label = $label;
    }

    public function set_value($value='')
    {
        if(is_string($value))
            $this->_value = $value ;

        return false;
    }

}

class IntegerField extends Field {

    protected $default_codes = ['required','null','max_length','min_length'] ;

    protected $default_messages = [
                                    'required'   => "{label} is required" ,
                                    'null'       => "{label} may not be NUll",
                                    'max_length' => "{label} should be > {length} chars",
                                    'min_length' => "{label} should be < {length} chars"
                                ] ;

    public function CharField($label,$properties)
    {
        parent::Field($properties);
        $this->label = $label;
    }

    public function set_value($value='')
    {
        if(is_integer($value))
            $this->_value = $value ;

        return false;
    }

}