<?php

require_once(APPPATH.'modules/site/controllers/Base.php');

class Independent extends Base
{
    public function __construct() 
    {
        parent::__construct();

        $this->controller = "independent";
        $this->controller_path = "site/independent/";

        $this->load->model('Common_model');
        $this->site_config = $this->Common_model->Get_Site_Config();
        $this->__Site_Status();
    }
 
    public function index()
    {
        return $this->load->view('under_development');
    }

    public function __Site_Status()
    {
        $status = $this->site_config['status'];

        if($status==1)
        {
          return redirect('site');
        }
    }

}
