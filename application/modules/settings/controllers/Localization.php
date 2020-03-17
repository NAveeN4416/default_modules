<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'modules/settings/controllers/Base.php');
class Localization extends Base {

	/**
	 * All About Static words
	 *
	 * Maps to the following URL
	 * 		http://example.com/localization
	 */
	//public $auth_classes = 'Auth_Class';


	public function __construct()
  	{
        // Construct the parent class
     	parent::__construct();

    	$this->controller_path = "settings/localization/";
    	$this->controller = "localization";

    	$this->data = array();
    	$this->data['page_name'] = "localization" ;

    	$this->lang_file = APPPATH.'language/lang.json';
  	}

  	public function index()
  	{
  		$this->Load_View('localization/pages_list',$this->data);
  	}

  	public function Add_Params()
  	{
  		
  		$data =json_decode(file_get_contents($this->lang_file),True);

  		$post_data = $this->input->post();
  		$page_name = 'products';

  		$keys = $post_data['keys'];
  		$english = $post_data['english'];
  		$arabic = $post_data['arabic'];

  		foreach ($keys as $i => $key) {
  			
  			$param_name = $key;
  			$en_text = $english[$i];
  			$ar_text = $arabic[$i];

  			if($param_name && $en_text && $ar_text)
  			{
  				$data[$page_name]['en'][$param_name] = $en_text;
  				$data[$page_name]['ar'][$param_name] = $ar_text;
  			}

  		}

  		$jsondata = json_encode($data,JSON_PRETTY_PRINT);

  		file_put_contents($this->lang_file, $jsondata);

  		echo "<pre>"; print_r($data);exit;
  	}

}
