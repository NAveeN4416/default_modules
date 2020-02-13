<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	require APPPATH . 'libraries/CO_Model.php';

	class Home_m extends CO_Model {

	function __construct()
	{
		parent::__construct();
	}

	public function get_data($table,$where='')
	{
		if($where)
		{
			return $this->db->where($where)->get($table);
		}
		else
		{
			return $this->db->get($table);
		}
	}


	public function check_data($table,$at)
	{
		$count = $this->db->where($at)->get($table)->num_rows();

		if($count)
		{
			return true ;
		}
		else
		{
			return false ;
		}
	}


//Getting Products
	public function get_products($data=array(),$status=1)
	{

      if(@$data['product_id'])
      {
      	$where['id'] = $data['product_id'];
      }

      if(@$data['user_id'])
      {
      	$where['owner_id'] = $data['user_id'] ;
      }

      if(@$data['category_id'])
      {
      	$where['category_id'] = $data['category_id'] ;
      }
//print_r($data);exit;
      if($status==3)
      {
      	$this->db->group_start();
      	  $this->db->where('status',1);
      	  $this->db->or_where('status',2);
      	  $this->db->or_where('status',3);
      	$this->db->group_end();
      }
      else
      {
      	 $where['status'] = 1;
      }
		if(@$data['search_value'])
		{
//print_r($data['search_value']);exit;
			$this->db->like('name',$data['search_value'],'both');
			$this->db->or_like('description',$data['search_value'],'both');
			$this->db->or_like('brand_name',$data['search_value'],'both');
			$this->db->or_like('model_name',$data['search_value'],'both');
		}

      $this->db->where($where);

      $products =  $this->db->get('products')->result_array();
//echo $this->db->last_query();exit;
      unset($where);

      foreach ($products as $key => $product)
      {
        $category = $this->db->where('id',$product['category_id'])->get('categories')->row_array();

        $products[$key]['category']       = $category['name_'.lang];
        $products[$key]['category_image'] = $category['image'];

        $sub_category = $this->db->where('id',$product['sub_category_id'])->get('sub_categories')->row_array();

        $products[$key]['sub_category']       = $sub_category['name_'.lang];
        $products[$key]['sub_category_image'] = $sub_category['image'];

        $model = $this->db->where('id',$product['model_id'])->get('models')->row_array();

        $products[$key]['model']       = @$model['name_'.lang];
        $products[$key]['model_image'] = @$model['image'];

        $products[$key]['damage']          = ($product['damage'])       ? "Yes" : "No" ;
        $products[$key]['deposit_string']  = ($product['deposit_flag']) ? "Yes" : "No" ;
        //$products[$key]['action_status']   = ($product['action_status']==1) ? "Available" : "UnAvailable" ;

        $rent_types = [1=>"hour", 2=>"day", 3=>"month"] ;

        $products[$key]['rent_per'] = $rent_types[$product['rent_type']];
      }

      return $products ;
	}



//Getting Products
	public function products($lang,$where,$status=array(),$sort=0)
	{

      if($status=='all')
      {
      	$this->db->group_start();
      	  $this->db->where('status',1);
      	  $this->db->or_where('status',2);
      	  $this->db->or_where('status',3);
      	$this->db->group_end();
      }
      else
      {
      	$where['status'] = 1;
      }

      if(sizeof($where))
      {
      	$products = $this->db->where($where)->get('products')->result_array();
      }
      else
      {
      	$products = $this->db->get('products')->result_array();
      }

      $products = $this->product_manipulation($products);

      return $products;
	}

//Manipulate data
	public function product_manipulation($products=array(),$lang='en')
	{
      foreach ($products as $key => $product)
      {
        $category = $this->db->where('id',$product['category_id'])->get('categories')->row_array();

        $products[$key]['category']       = $category['name_'.$lang];
        $products[$key]['category_image'] = $category['image'];

        $sub_category = $this->db->where('id',$product['sub_category_id'])->get('sub_categories')->row_array();

        $products[$key]['sub_category']       = (@$sub_category['name_'.$lang]) ? $sub_category['name_'.$lang] : ' ' ;
        $products[$key]['sub_category_image'] = (@$sub_category['image']) ? $sub_category['image'] : '' ;

        $model = $this->db->where('id',$product['model_id'])->get('models')->row_array();

        $products[$key]['model']       = (@$model['name_'.$lang]) ? $model['name_'.$lang]  : " ";
        $products[$key]['model_image'] = (@$model['image']) ? $model['image'] : " " ;

        $products[$key]['damage']          = ($product['damage'])       ? "Yes" : "No" ;
        $products[$key]['deposit_string']  = ($product['deposit_flag']) ? "Yes" : "No" ;
        //$products[$key]['action_status']   = ($product['action_status']==1) ? "Available" : "UnAvailable" ;

        $rent_types = [1=>"hour", 2=>"day", 3=>"month"] ;

        $products[$key]['rent_per'] = $rent_types[$product['rent_type']];
      }

      return $products ;
	}


//Get My Products
	public function get_my_products($lang='en',$where)
	{
		$products = $this->db->get('products')->result_array();

		$products = $this->product_manipulation($products,$lang);

		return $products ;
	}


//Get Normal Serach
	public function normal_search($lang='en',$where)
	{
		$this->db->where('category_id',$where['category_id']);

		$products = $this->db->get('products')->result_array();

		$products = $this->product_manipulation($products,$lang);

		return $products ;
	}

//Get Normal Serach
	public function sort_products($lang='en',$sort)
	{

		if(isset($_SESSION['filter_vars']))
		{
			$filter = $_SESSION['filter_vars'] ;

			if(@$filter['categories'])
			{
				$this->db->where_in('category_id',$filter['categories']);
			}

			if(@$filter['rent_type'])
			{
				$this->db->where('rent_type',$filter['rent_type']);
			}

			if($filter['deposit_flag']!='')
			{
				$this->db->where('deposit_flag',$filter['deposit_flag']);
			}

			if(@$filter['rating'])
			{
				$this->db->where('rating',$filter['rating']);
			}
		}


		$this->db->where('status',1);
		$this->db->order_by($sort['sort_field'],$sort['sort_value']) ;

		$products = $this->db->get('products')->result_array();

		$products = $this->product_manipulation($products,$lang);

		return $products ;
	}


//Get Normal Serach
	public function filter_products($lang='en',$filter)
	{
	//	print_r($filter);exit;

		if(@$filter['categories'] != '')
		{
			$this->db->where_in('category_id',$filter['categories'],false);
		}
		
		if(@$filter['model'] != '')
		{
			$this->db->where_in('model_id',$filter['model'],false);
		}
		
	    if(@$filter['min_price'] !='')
        {
         $this->db->where('rent_price >=', $filter['min_price'],false);
        }
        if(@$filter['max_price'] !='')
        {
          $this->db->where('rent_price <=', $filter['max_price'],false); 
        }
		

		if(@$filter['rent_type'])
		{
			$this->db->where('rent_type',$filter['rent_type']);
		}

		if($filter['deposit_flag'] !='')
		{
			$this->db->where('deposit_flag',$filter['deposit_flag']);
		}

		if(@$filter['rating'])
		{
			$this->db->where('rating',$filter['rating']);
		}

		$this->db->where('status',1);

		$products = $this->db->get('products')->result_array();
//echo $this->db->last_query();exit;
		$products = $this->product_manipulation($products,$lang);

		return $products ;
	}

//Get product details
	public function get_product_details($lang='en',$where)
	{
		$this->db->where('id',$where['id']);

		$products = $this->db->get('products')->result_array();

		$products = $this->product_manipulation($products,$lang);

		return $products ;
	}


//Checking Product Availability
	public function check_product_availability($start_date,$start_time,$end_date,$end_time,$product_id)
	{
		$start_time  = strtotime($start_date.' '.$start_time);
		$start_date  = strtotime($start_date);
		$end_time    = strtotime($end_date.' '.$end_time);
		$end_date    = strtotime($end_date);

		$where['status']     = 4 ;           //Check for Accepted
		$where['product_id'] = $product_id ; //Particular Product
		$where['expired']    = 0 ;           //Particular Product

		$booked_dates = $this->db->where($where)->get('booked_dates')->result_array();
		//echo $this->db->last_query();exit;
		$flag = 0 ; //Setting for flow control

		foreach ($booked_dates as $key => $date)
		{
			$sd_flag = $ed_flag = $sd_equal = $ed_equal = $behind_flag = $same_day_sclash = $same_day_eclash = 0 ;

			$dbs_date = strtotime($date['start_date']) ; //start_date from database
			$dbe_date = strtotime($date['end_date'])   ; //end_date from database
			$dbs_time = strtotime($date['start_date'].' '.$date['start_time']); //start_time from database
			$dbe_time = strtotime($date['end_date'].' '.$date['end_time']);   //end_time from database

		//Condition 1 :  (dbs_start < start_date < $dbe_date)
			$sd_flag = ($start_date>$dbs_date) ? (($start_date<$dbe_date) ? 1 : 0 ) : 0 ;

		//Condition 2 : (dbs_date < end_date < $dbe_date)
			$ed_flag = ($end_date>$dbs_date)   ? (($end_date<$dbe_date)   ? 1 : 0 ) : 0 ;

		//Condition 3: (if dates are equal)
			$sd_equal = ($start_date==$dbs_date) ? 1 : 0 ; //If same start date
			$ed_equal = ($end_date==$dbe_date)   ? 1 : 0 ; //if same end date

		//Conditions 4 (if start_date == dbe_date (differ bookings) - maintain 1 hour gap btwn bookings
			$same_day_sclash = ($start_date==$dbe_date) ? 1 : 0 ; //if same end date
			$same_day_eclash = ($end_date==$dbs_date)   ? 1 : 0 ; //if same end date

			//Check for time gap starting day
			if($same_day_sclash)
			{
				if($start_time>$dbe_time)
				{
					$same_day_sclash = 0;
				}
			}

			//Check for time gap ending day
			if($same_day_eclash)
			{
				if($end_time<$dbs_time)
				{
					$same_day_eclash = 0;
				}
			}

			//if no records found in between dbs_date and dbe_date
			//Conditions 3 : ( (start_time < dbs_time) && (end_time > dbe_time) )
			if($sd_flag==0 && $ed_flag==0 && $sd_equal==0 && $ed_equal==0 && $same_day_sclash==0 &&  $same_day_eclash==0)
			{

			   $new_stime = $dbs_time + 3600;

			   $behind_flag = ($start_time < $new_stime) ? (($end_time > $dbe_time) ? 1 : 0)  : 0 ;

				if($behind_flag)
				{
					$flag = 1;
					break;
				}
			}
			else
			{
				$flag = 1 ;
			}
		}

		return  $flag ;
	}


//Getting Rating n reviews on user
	public function get_reviews($user_id)
	{
		$reviews =  $this->db->select('ur.*,u.image as user_image,u.name as user_name,u.rating as user_rating')
					 		 ->where('ur.to_user',$user_id)
					 		 ->from('user_reviews as ur')
					 		 ->join('users as u','u.id=ur.from_user')
					 		 ->get()->result_array();

		foreach ($reviews as $key => $review)
		{
			$reviews[$key]['created_at'] = date('F d Y h:i:s a') ;
		}

		return $reviews ;
	}

//mazhar_code

//filter



//mazhar_code





















}
