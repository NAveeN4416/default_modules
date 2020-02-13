<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Require main contoller
require_once(APPPATH.'modules/acp/controllers/Base_Controller.php');

class News extends Base_Controller {
	
	// define controller
	protected $thisCtrl = "acp/news";
	public $__directories = array();
	
	function __construct()
	{
    	parent::__construct();
    	
    	$this->load->model('admin_model');
    	$this->load->model('news_model');
    	//send controller name to views
    	$this->load->vars( array('__controller' => $this->thisCtrl));
  	}
	
	/*-----------------------------------------------------------
		---------------------- News CATEGORY Section -----------------
		--------------------------------------------------------*/
		
	// #categories view function
	public function categories()
	{
		$this->LoadView('news/categories/add_categories');
	}	
	
	// #add-category function
	public function addCategory()
	{
		if($this->input->post('submit'))
		{
			$name_en = $this->input->post('name_en');
			$name_ar = $this->input->post('name_ar');
			
			if(strlen($name_en) < 2 && strlen($name_ar) < 2)
			{
				$this->session->set_flashdata('requestMsgErr', 125);
				redirect($this->thisCtrl.'/categories_v3');
			}
			$data = array(
				'Category_en' => $name_en,
				'Category_ar' => $name_ar
			);

			$result = $this->news_model->addCategory($data);

			$news_cat_id = $this->db->insert_id();

			$log = array(
							'row_id' 	   => $news_cat_id,
							'action_table' => 'news categories',
							'content' 	   => $_POST,
							'event' 	   => 'add'
						);

			$this->logs->add_log($log);

			if($result){
	             $this->session->set_flashdata('requestMsgSucc', 121);
	         } else {
	             $this->session->set_flashdata('requestMsgErr', 119);
	         }	
		}
		redirect($this->thisCtrl.'/manageCategories');
	}
	
	public function addCategory_HTTP()
	{
		$name_ar = $this->input->post('option_ar');
		$name_en = $this->input->post('option_en');
		
		$data = array(
			'Category_en' => $name_en,
			'Category_ar' => $name_ar
		);
		$category_id = $this->news_model->addCategory($data);
		echo json_encode(array('id' => $category_id));
	}
	
	public function manageCategories()
	{
		$log = array(
						'row_id' 	   => 0,
						'action_table' => 'news categories',
						'content' 	   => $_POST,
						'event' 	   => 'select'
					);

		$this->logs->add_log($log);

		$data['categories'] = $this->news_model->getCategories();
		$this->LoadView('news/categories/manage_categories', $data);
	}
	
	// #edit service
	public function editCategory($categoryID = 0)
	{
		$log = array(
						'row_id' 	   => $categoryID,
						'action_table' => 'news categories',
						'content' 	   => $categoryID,
						'event' 	   => 'select'
					);

		$this->logs->add_log($log);

		$data['category_id'] = $categoryID;
		$data['category'] = $this->news_model->getCategoryByID($data);
		$this->LoadView('news/categories/manage_categories', $data);
	}
	
	// #update service
	public function updateCategory()
	{
		if($this->input->post('submit'))
		{
			$name_en = $this->input->post('name_en');
			$name_ar = $this->input->post('name_ar');
			$id = $this->input->post('category_id');
			$name = $this->input->post('name');

			if(strlen($name_en) < 2 && strlen($name_ar) < 2)
			{
				$this->session->set_flashdata('requestMsgErr', 125);
				redirect($this->thisCtrl.'/editCategory/'.$id);
			}

			$updateData = array(
									'Category_ID' => $id,
									'Category_en' => $name_en,
									'Category_ar' => $name_ar
								);
				
			$result = $this->news_model->updateCategory($updateData);

	   		$log = array(
							'row_id' 	   => $id,
							'action_table' => 'news categories',
							'content' 	   => $_POST,
							'event' 	   => 'update'
						);

			$this->logs->add_log($log);

	        if($result)
	        {
	            $this->session->set_flashdata('requestMsgSucc', 120);
	        }
	        else
	        {
	            $this->session->set_flashdata('requestMsgErr', 119);
	        }	

		}
		redirect($this->thisCtrl.'/manageCategories');
	}
	
	// #delete service function
	public function deleteCategory($categoryID = 0)
	{
		$data['category_id'] = $categoryID;
		$result = $this->news_model->deleteCategory($data);

   		$log = array(
						'row_id' 	   => $categoryID,
						'action_table' => 'news categories',
						'content' 	   => $categoryID,
						'event' 	   => 'delete'
					);

		$this->logs->add_log($log);

		if($result)
		{
	        $this->session->set_flashdata('requestMsgSucc', 122);
	    }
	    else
	    {
	        $this->session->set_flashdata('requestMsgErr', 119);
	    }

		redirect($this->thisCtrl.'/manageCategories');
	}
	
	/*-----------------------------------------------------------
		---------------------- #news -----------------
		--------------------------------------------------------*/
	
	
	public function addNews()
	{
		$data['categories'] = $this->news_model->getCategories();
		$this->LoadView('news/add_news', $data);
	}	
	
	public function addNews_POST()
	{
		if($this->input->post('submit'))
		{
			$category = $this->input->post('category');
			$title = $this->input->post('title_en');
			$title_ar = $this->input->post('title_ar');
			$content_en = $this->input->post('content_en');
			$content_ar = $this->input->post('content_ar');
				
			$insertData = array(
				'Category_ID' => $category,
				'Title_en' => $title,
				'Title_ar' => $title_ar,
				'Content_en' => $content_en,
				'Content_ar' => $content_ar
			);
			
			$target_dir = $GLOBALS['img_news_dir'];
			
			// image options
			$file_options = array(
				'file' => 'news_picture',
				'directory' => $target_dir,
				'file_name' => date('Y-m-d H-i-s')
			);
			$upload_data = UploadFile($file_options);
			
			$image_uploaded = 0;
			
			$upd_filename = '';
			
			if (is_array($upload_data) && array_key_exists('file_name', $upload_data))
	        {
		        $upd_filename = $upload_data['file_name'];
		        
				$insertData['Picture'] = $upd_filename;
				
				$image_uploaded = 1;
			}
			
			$news_ID = $this->news_model->addNews($insertData);			

			$log = array(
							'row_id' 	   => $news_ID,
							'action_table' => 'news',
							'content' 	   => $_POST,
							'event' 	   => 'add'
						);

			$this->logs->add_log($log);

			if($news_ID && $image_uploaded)
			{
				// generate thumbnail
	            $file_name_arr = explode('.', $upd_filename);
	            
				$extension = array_pop($file_name_arr);
				
				$thumbname = $news_ID;
				
				$thumbname_with_ext = $thumbname.'.'.$extension;
				
	            $return_thmbname = GenerateThumbFromImage($target_dir, $upd_filename, $thumbname_with_ext, 300, 220);
	            
	            $upd_data['News_ID'] = $news_ID;
	            
				$upd_data['Thumbnail'] = $thumbname.$return_thmbname.'.'.$extension;

				$this->news_model->updateNews($upd_data);
			}

			if($news_ID)
			{
	            $this->session->set_flashdata('requestMsgSucc', 121);
	        } 
	        else 
	        {
	            $this->session->set_flashdata('requestMsgErr', 119);
	        }
		}
		
		redirect($this->thisCtrl.'/manageNews');
	}
	
	public function manageNews()
	{
		$log = array(
						'row_id' 	   => 0,
						'action_table' => 'news',
						'content' 	   => $_POST,
						'event' 	   => 'select'
					);

		$this->logs->add_log($log);

		$data['categories']   = $this->news_model->getCategories();
		$data['news'] 		  = $this->news_model->getNews();
		$data['total'] 	      = $this->admin_model->getTotals();
		$data['activeNews']   = $this->news_model->getActiveNews();	
		$data['inActiveNews'] = $this->news_model->getInActiveNews();
		
		$this->LoadView('news/manage_news', $data);
	}
	
	public function editNews($NewsID = 0)
	{
		$log = array(
						'row_id' 	   => $NewsID,
						'action_table' => 'news',
						'content' 	   => $_POST,
						'event' 	   => 'select'
					);

		$this->logs->add_log($log);
		
		$data['categories'] = $this->news_model->getCategories();
		$data['news_id']    = $NewsID;
		$data['news'] 	    = $this->news_model->getNewsById($data);

		$this->LoadView('news/edit_news_details', $data);		
	}
	
	public function updateNews()
	{
		if($this->input->post('submit'))
		{
			$title = $this->input->post('title_en');
			$title_ar = $this->input->post('title_ar');
			$id = $this->input->post('news_id');
			$content_en = $this->input->post('content_en');
			$content_ar = $this->input->post('content_ar');
			$category = $this->input->post('category');
			
			$result = '';
			$insertData = array(
				'News_ID' => $id,
				'Title_en' => $title,
				'Title_ar' => $title_ar,
				'Content_en' => $content_en,
				'Content_ar' => $content_ar,
				'Category_ID' => $category
			);
			
			$target_dir = $GLOBALS['img_news_dir'];

			// image options
			$file_options = array(
				'file' 		=> 'news_picture',
				'directory' => $target_dir,
				'file_name' => date('Y-m-d H-i-s')
			);
			$upload_data = UploadFile($file_options);
			
			if (is_array($upload_data) && array_key_exists('file_name', $upload_data))
	        {
		        $data['news_id'] = $id;
		        
				$oldNews = $this->news_model->getNewsById($data);
		        
		        $upd_filename = $upload_data['file_name'];
		        
				$insertData['Picture'] = $upd_filename;
				
				// generate thumbnail
	            $file_name_arr = explode('.', $upd_filename);
	            
				$extension = array_pop($file_name_arr);
				
				$thumbname = $id;
				
				$thumbname_with_ext = $thumbname.'.'.$extension;
				
	            $return_thmbname = GenerateThumbFromImage($target_dir, $upd_filename, $thumbname_with_ext, 300, 220);
					
				//echo $return_thmbname;exit;

				$insertData['Thumbnail'] = $thumbname.$return_thmbname.'.'.$extension;;
				
				@unlink('./'.$target_dir.$oldNews[0]->Picture);

			}
			
			$result = $this->news_model->updateNews($insertData);

			$log = array(
							'row_id' 	   => $id,
							'action_table' => 'news',
							'content' 	   => $_POST,
							'event' 	   => 'update'
						);

			$this->logs->add_log($log);

			if($result)
			{
	            $this->session->set_flashdata('requestMsgSucc', 121);
	        }
	        else
	        {
	            $this->session->set_flashdata('requestMsgErr', 119);
	        }
		}

		redirect($this->thisCtrl.'/manageNews');
	}
	
	public function deleteNews($NewsID = 0)
	{
		$log = array(
						'row_id' 	   => 0,
						'action_table' => 'News',
						'content' 	   => $NewsID,
						'event' 	   => 'delete'
					);

		$this->logs->add_log($log);

		$data['Id'] = $NewsID;
		
		$result = $this->news_model->deleteNews($data);
		if($result){
	         $this->session->set_flashdata('requestMsgSucc', 122);
         } else {
             $this->session->set_flashdata('requestMsgErr', 119);
         }
			redirect($this->thisCtrl.'/manageNews');
	}
	
	private function _generateThumb($news_ID = 0, $get_filename = '')
    {
	    $file_name_arr = explode('.', $get_filename);
		$extension = array_pop($file_name_arr);
		$thumbname = $news_ID;
		$thumbname_with_ext = $thumbname.'.'.$extension;
        
        $return_thmbname = GenerateThumbFromImage($GLOBALS['img_news_dir'], $get_filename, $thumbname_with_ext, 330, 214);
		$thumbnail_name = $thumbname.$return_thmbname.'.'.$extension; // picture_thumb_1x.jpg
		
		return $thumbnail_name;
    }
	
}
?>