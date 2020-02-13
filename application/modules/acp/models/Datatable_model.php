<?PHP
class Datatable_model extends CI_Model{
		
	/**
		*------- Logs List *---------
	**/
	
	private function _get_logs_query()
    { 
        $this->db->select('l.*, u.Fullname, u.Username')
			         ->from(TBL_LOGS_OPERATIONS.' as l')
			         ->join(TBL_USERS.' as u', 'u.User_ID = l.User_ID')
			         ->order_by('TimeStamp', 'desc');
				
/*
				$this->db->get();
				echo $this->db->last_query();
*/
    }
    
    
    public function getWebsiteLogs(){
	    if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
		
		$this->_get_logs_query();		
        $user_data = $this->db->get()->result();
		return $user_data;
    }
    
    function logsCount_all()
    {
        $this->_get_logs_query();	
        return $this->db->get()->num_rows();
        //echo $this->db->last_query();
    }
 
    public function logsCount_filtered()
    {
        $this->_get_logs_query();	
        return $this->db->get()->num_rows();
    }
    
    /**
		*------- Customers List *---------
	**/

	var $order_columns_2  = array('c.Customer_ID', 'c.TimeStamp', 'c.Fullname', 'c.Phone', 'c.Address', 'FamilyMembers', 'TotalReservations', 'c.Status');
	private function _get_customers_query()
	{
		
			$where_phone = '';
			$where_name = '';
			
			if(!empty($_POST['phone'])){
				$phone = $_POST['phone'];
				$where_phone = "c.Phone = $phone AND";
			}
			
			if(!empty($_POST['name'])){
				$name = $_POST['name'];
				$where_name = "c.Fullname LIKE '%$name%' AND";
			}
			
			$where = "$where_name $where_phone c.Is_Deleted = 0";
			
			$total_fm = "(SELECT COUNT(fm.Customer_ID) FROM ".TBL_CUSTOMER_FAMILY." as fm WHERE fm.Customer_ID = c.Customer_ID AND Is_Deleted = 0) as TotalFamilyMembers";
			
			$total_reservations = "(SELECT COUNT(r.Customer_ID) FROM ".TBL_RESERVATIONS." as r WHERE r.Customer_ID = c.Customer_ID AND Is_Deleted = 0 AND Reservation_Confirmed = 1) as TotalReservations";
			
		    $this->db->distinct();
	        $this->db->select("c.*, 
	        				   {$total_fm}, 
	        				   {$total_reservations}"); 
	        				   
	        $this->db->from(TBL_CUSTOMERS.' AS c');
	        $this->db->where($where);
	        $this->db->group_by('c.Customer_ID');
	        
	        //print_r($_POST['order']);
		    if(isset($_POST['order']))
		    {
			    $ind = $_POST['order'][0]['column'];
			    $oColumn = $this->order_columns_2[$ind];
				$direction = $_POST['order'][0]['dir'];
				$where_order = "$oColumn $direction";
				$this->db->order_by($where_order);
		    } else {
			    $this->db->order_by("c.TimeStamp", "DESC");
		    }
    }
 
    function getCustomersList()
    {
        $this->_get_customers_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);

		$query = $this->db->get();
		//echo $this->db->last_query();
        return $query->result();
    }
 
    function customersCount_filtered()
    {
        $this->_get_customers_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function customersCount_all()
    {
        $this->db->from(TBL_CUSTOMERS." AS c");

        return $this->db->count_all_results();
    }
    
    /**
		*------- Products List *---------
	**/

    
	var $order_columns_1  = array('p.Product_ID', 'p.TimeStamp', '', 'p.Title_en', '', 'p.Quantity', 'ppu.Price');
	private function _get_products_query()
	{
		
			$where_title = '';
			$where_category = '';
			$where_subcategory = '';
			$where_quantity = '';
			$where_unit = '';
			
			if(!empty($_POST['title'])){
				$title = $_POST['title'];
				$where_title = "(p.Title_en LIKE '%$title%' OR p.Title_ar LIKE '%$title%') AND";
			}
			
			if($_POST['category'] != -1){
				$category = $_POST['category'];
				$where_category = "pc.Category_ID = $category AND";
			}
			
			if($_POST['subcategory'] != -1){
				$subcategory = $_POST['subcategory'];
				$where_subcategory = "psc.SubCategory_ID = $subcategory AND";
			}
			
			if($_POST['unit'] != -1){
				$unit= $_POST['unit'];
				$where_unit = "pu.Unit_ID = $unit AND";
			}
			
			if(!empty($_POST['quantity'])){
				$quantity = $_POST['quantity'];
				$limit = $_POST['quantity_limit'];
				$where_quantity = "p.Quantity $limit $quantity AND";
			}
			
			$where = "$where_category $where_subcategory $where_title $where_quantity $where_unit p.Status >= 0";
			
		    $this->db->distinct();
	        $this->db->select('p.*, ppu.Price, psc.SubCategory_en, psc.SubCategory_ar, pc.Category_en, pc.Category_ar, pd.Cover_Thumb as Thumbnail'); 
	        $this->db->from(TBL_PRODUCTS.' AS p');
	        $this->db->join(TBL_PRODUCT_PRICE_PERUNIT.' as ppu', 'ppu.Product_ID = p.Product_ID');
	        $this->db->join(TBL_PRODUCT_UNITS.' as pu', 'pu.Unit_ID = pu.Unit_ID');
	        $this->db->join(TBL_PRODUCT_SUBCATEGORIES.' as psc', 'psc.SubCategory_ID = p.SubCategory_ID');
	        $this->db->join(TBL_PRODUCT_CATEGORIES.' as pc', 'pc.Category_ID = psc.Category_ID');
	        $this->db->join(TBL_PRODUCT_DETAILS.' as pd', 'pd.Product_ID = p.Product_ID', 'left');
	        $this->db->where($where);
	        $this->db->group_by('p.Product_ID');
	        
	        //print_r($_POST['order']);
		    if(isset($_POST['order'])){
			    $ind = $_POST['order'][0]['column'];
			    $oColumn = $this->order_columns_1[$ind];
				$direction = $_POST['order'][0]['dir'];
				$where_order = "$oColumn $direction";
				$this->db->order_by($where_order);
		    } else {
			    $this->db->order_by("a.Product_ID", "DESC");
		    }
    }
 
    function getProductsList()
    {
        $this->_get_products_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);

		$query = $this->db->get();
		
		//echo $this->db->last_query();
        return $query->result();
    }
 
    function productsCount_filtered()
    {
        $this->_get_products_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function productsCount_all()
    {
        $this->db->from(TBL_PRODUCTS.' as p');

        return $this->db->count_all_results();
    }	
	
		
	/**
		*------- product reviews *---------
	**/
	
	private function _get_reviews_query()
    { 
        $this->db->select('r.*, c.Fullname, c.Phone, p.Title_en, p.Title_ar')
			         ->from(TBL_PRODUCT_REVIEWS.' as r')
			         ->join(TBL_PRODUCTS.' as p', 'p.Product_ID = r.Product_ID')
			         ->join(TBL_CUSTOMERS.' as c', 'c.Customer_ID = r.Customer_ID')
			         ->order_by('r.TimeStamp', 'desc');
				
/*
				$this->db->get();
				echo $this->db->last_query();
*/
    }
    
    
    public function getProductReviews(){
	    if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
		
		$this->_get_reviews_query();		
        $user_data = $this->db->get()->result();
		return $user_data;
    }
    
    function reviewsCount_all()
    {
        $this->_get_reviews_query();	
        return $this->db->get()->num_rows();
        //echo $this->db->last_query();
    }
 
    public function reviewsCount_filtered()
    {
        $this->_get_reviews_query();	
        return $this->db->get()->num_rows();
    }
	
	/**
		*------- SMS Logs List *---------
	**/
	
	private function _get_sms_query()
    { 
        $this->db->select('s.*, u.Fullname, u.Username')
			         ->from(TBL_LOGS_SMS.' as s')
			         ->join(TBL_USERS.' as u', 'u.User_ID = s.User_ID')
			         ->order_by('TimeStamp', 'desc');
				
/*
				$this->db->get();
				echo $this->db->last_query();
*/
    }
    
    
    public function getSMSLogs(){
	    if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
		
		$this->_get_sms_query();		
        $user_data = $this->db->get()->result();
		return $user_data;
    }
    
    function smsCount_all()
    {
        $this->_get_sms_query();	
        return $this->db->get()->num_rows();
        //echo $this->db->last_query();
    }
 
    public function smsCount_filtered()
    {
        $this->_get_sms_query();	
        return $this->db->get()->num_rows();
    }
		
}
?>