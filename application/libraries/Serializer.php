<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Field.php';

class Serializers {

    public function Serializers()
    {
        $this->Set_Fields();
    }

    public function Set_Fields()
    {
        $name = new CharField('name',['required'=>'required','max_length'=>10]);
        $department = new CharField('name',['required'=>'required','max_length'=>10]);
    }
}


class Serializer {

    /**
     * Array output format
     */
    const ARRAY_FORMAT = 'array';

    /**
     * CodeIgniter instance
     *
     * @var object
     */
    private $_CI;

    /**
     * Data to parse
     *
     * @var mixed
     */
    protected $_data = [];
    protected $_errors = [];
    protected $_validation_rules = [];

    /**
     * 
     * @param array $rules
     * @param array $data
     * @param array $messages
     * @throws Exception
     */

    //Initialize with data
    public function Serializer($rules = array(),$data = array(), $messages = array())
    {
        // Get the CodeIgniter reference
        $this->_CI = &get_instance();

        if(is_array($data))
        {
            //Set the data to Process
            $this->_data = $data;
        }
        else
        {
            throw new Exception('data should be in array format');
        }

        if(is_array($rules))
        {
            //Set the data to Process
            $this->_rules = $rules;
        }
        else
        {
            throw new Exception('rules should be in array format');
        }

        if(is_array($messages))
        {
            //Set the data to Process
            $this->_messages = $messages;
        }
        else
        {
            throw new Exception('messages should be in array format');
        }
    }

    public function set_rules($rules)
    {
        if(is_array($rules))
        {
            //Set the rules to Validate
            $this->_rules = $rules;

            return ;
        }

        throw new Exception('Rules should be in array format');
    }

    public function get_validation_rules()
    {
        foreach ($this->_rules as $key => $value) 
        {
            $_rule = ($value=='required') ? $this->_messages[$key] : 'Optional' ;

            $this->_validation_rules[$key] = $_rule ;
        }

        return $this->_validation_rules;
    }

    public function is_valid()
    {
        foreach($this->_rules as $key => $required)
        {
            if($required=='required')
            {
                if(!array_key_exists($key, $this->_data) || $this->_data[$key]=='')
                {
                    $this->_errors[$key] = $this->_messages[$key] ;
                    $this->_parsedata[$key] = '' ;
                    continue;
                }
            }

            $this->_parsedata[$key] = (@$this->_data[$key]) ? $this->_data[$key] : '' ;
        }

        if($this->_errors)
        {
            return false;
        }

        return true;
    }

    public function get_validated_data()
    {
        return $this->_parsedata;
    }

    public function get_errors()
    {
        return $this->_errors;
    }

}



