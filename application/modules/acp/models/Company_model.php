<?PHP
	class Company_model extends CI_Model
	{
		/*-----------------------------------------------------------
			---------------------- Company -----------------
		--------------------------------------------------------*/
		
		public function addCompany($company = array())
		{
			$this->db->insert(TBL_COMPANIES, $company);
			
			return $this->db->insert_id();
		}
		
		public function addCompany_Localized($localized_company = array(), $company_id = 0)
		{
			$this->db->where('Company_ID', $company_id)->delete(TBL_LOCALIZED_COMPANIES);
			
			return $this->db->insert_batch(TBL_LOCALIZED_COMPANIES, $localized_company);
		}
		
		// for campaign filter
		public function getCompanies($culture = 'en')
		{
			return $this->db->distinct()
							//->select('c.*, lc.*')
							->select('c.*, lc.Company_Name,lc.Company_ID as sub_user_CompanyID,lc.Culture,lc.Company_Description')
							->from(TBL_COMPANIES.' as c')
							->join(TBL_LOCALIZED_COMPANIES.' as lc', 'lc.Company_ID = c.sub_user_CompanyID')
							->where('lc.Culture', "{$culture}")
							->where('Is_Deleted', 0)
							->get()
							->result();
		}
		
		public function getCompanyByID($company_id = 0)
		{
			return $this->db
							->select('c.*, lc.Company_Name,lc.Company_ID as sub_user_CompanyID,lc.Culture,lc.Company_Description')
							->from(TBL_COMPANIES.' as c')
							->join(TBL_LOCALIZED_COMPANIES.' as lc', 'lc.Company_ID = c.sub_user_CompanyID')
							->join(TBL_USER_ROLES.' as r', 'r.Role_ID = c.Role_ID')
							->where('c.Company_ID', $company_id)
							->get()
							->result();
		}

		public function getCompany($company_id)
		{
			return $this->db->where('Company_ID',$company_id)->get(TBL_COMPANIES)->row();
		}
		
		public function updateCompany($company = array())
		{
			return $this->db
							->where('Company_ID', $company['Company_ID'])
							->update(TBL_COMPANIES, $company);
		}
		
		public function getCompanyImages($company_id = 0)
		{
			return $this->db
							->select('c.Company_Logo, cp.Picture')
							->from(TBL_COMPANIES.' as c')
							->join(TBL_COMPANY_PICTURES.' as cp', 'cp.Company_ID = c.Company_ID', 'LEFT')
							->where('c.Company_ID', $company_id)
							->get()
							->result();
		}
		
		public function deleteCompany($company_id = 0)
		{
			$d_company = $this->db->where('Company_ID', $company_id)->delete(TBL_COMPANIES);
			if($d_company)
			{
				$campaigns = $this->get_CompanyCampaigns($company_id) ;

				foreach ($campaigns as $key => $campaign) 
				{
					$this->db->where('Campaign_ID', $campaign->Campaign_ID)->delete(TBL_CAMPAIGN_PICTURES);
				}

				//$this->db->where('Company_ID', $company_id)->delete(TBL_COMPANY_PICTURES);
				$this->db->where('Company_ID', $company_id)->delete(TBL_CAMPAIGNS);
			}
			
			return $d_company;
		}
		
		/* -----------------------------------------------------------
			---------------------- Company Pictures -----------------
		   -------------------------------------------------------- */
		
		public function addCompanyPictures($company_picture = array())
		{
			$this->db->insert(TBL_COMPANY_PICTURES, $company_picture);
			return $this->db->insert_id();
		}
		
		public function deleteCompanyPictures($company_picture_id = 0)
		{
			return $this->db->where('Picture_ID', $company_picture_id)->delete(TBL_COMPANY_PICTURES);
		}
		
		
		/* -----------------------------------------------------------
			---------------------- Code decode -----------------
		   -------------------------------------------------------- */
		public function getCountries()
		{
			return $this->db->get(TBL_COUNTRIES)->result();
		}


		/* -----------------------------------------------------------
			---------------------- Company Users -----------------
		-------------------------------------------------------- */		
		public function getSubUsers($where)
		{
			return $this->db
						->select('Company_ID as user_id,Role_ID as role_id,Subuser_Name,Email,Company_Mobile,Registered_At')
						->where($where)
						->get(TBL_COMPANIES)->result();
		}

		public function updateSubUser($set,$where)
		{
			return $this->db->set($set)->where($where)->update(TBL_COMPANIES);
		}

		public function delete_Subuser($where)
		{
			return $this->db->where($where)->delete(TBL_COMPANIES);
		}


		/* -----------------------------------------------------------
			---------------------- Companies List Datatable -----------------
		-------------------------------------------------------- */

		var $order_columns_2  = array('c.Company_ID', 'c.Registered_At', '', 'lc.Company_Name', 'c.Email', 'c.Company_Phone', 'c.Status');
		private function _get_companies_query($culture)
		{
			
				$where_phone = '';
				$where_name = '';
				$where_mobile = '';
				$where_email = '';
				$where_country = '';
				
				if(!empty($_POST['company_phone']))
				{
					$phone = $_POST['company_phone'];
					$where_phone = "c.Company_Phone = '{$phone}' AND";
				}
				
				if(!empty($_POST['company_mobile']))
				{
					$phone = $_POST['company_mobile'];
					$where_mobile = "c.Company_Mobile = '{$phone}' AND";
				}
				
				if(!empty($_POST['email']))
				{
					$email = $_POST['email'];
					$where_email = "c.Email = '{$email}' AND";
				}
				
				if(!empty($_POST['company_name']))
				{
					$name = $_POST['company_name'];
					$where_name = "lc.Company_Name LIKE '%{$name}%' AND";
				}
				
				if($_POST['country'] != -1)
				{
					$country = $_POST['country'];
					$where_country = "c.Country_ID = '{$country}' AND";
				}
				
				$where = "{$where_name} lc.Culture = '{$culture}'"; // updated by A (25 Dec 2019) due to an error when admin add company not displaying {$where_phone} {$where_mobile} {$where_email} {$where_country}
				
			    $this->db->distinct();
		        $this->db->select('c.*, lc.Company_Name, COUNT(camp.Company_ID) as TotalCampaigns');
		        $this->db->from(TBL_COMPANIES.' AS c');
		        $this->db->join(TBL_LOCALIZED_COMPANIES.' as lc', 'lc.Company_ID = c.Company_ID');
		        $this->db->join(TBL_CAMPAIGNS.' as camp', 'camp.Company_ID = c.Company_ID', 'LEFT');
		        $this->db->where($where);
		        $this->db->group_by('c.Company_ID');
		        
		        //print_r($_POST['order']);
			    if(isset($_POST['order']))
			    {
				    $ind = $_POST['order'][0]['column'];
				    $oColumn = $this->order_columns_2[$ind];
					$direction = $_POST['order'][0]['dir'];
					$where_order = "$oColumn $direction";
					$this->db->order_by($where_order);
			    } else {
				    $this->db->order_by("c.Registered_At", "DESC");
			    }
	    }
	 
	    function getCompaniesList($culture = 'en')
	    {
	        $this->_get_companies_query($culture);
	        if($_POST['length'] != -1)
	        $this->db->limit($_POST['length'], $_POST['start']);
	
			$query = $this->db->get();
			//echo $this->db->last_query();
	        return $query->result();
	    }
	 
	    function companiesCount_filtered($culture)
	    {
	        $this->_get_companies_query($culture);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	 
	    public function companiesCount_all()
	    {
	        $this->db->from(TBL_COMPANIES." AS c");
	
	        return $this->db->count_all_results();
	    }
	    
	    
	    /**
			*------- Campaigns List *---------
		**/
		
		public function getCampaignByID($campaign_id = 0, $culture = 'en')
		{
			$query = $this->db->distinct()
			        		  ->select('c.*, lcamp.Campaign_Name, lc.Company_Name, lc.Company_Description, (SELECT COUNT(r.Campaign_ID) FROM '.TBL_RESERVATIONS.' as r WHERE r.Campaign_ID = c.Campaign_ID AND r.Reservation_Confirmed = 1) as Total_Reservations, GROUP_CONCAT(Title_en) as Campaign_Features,lcamp.Culture,lcamp.Programs,lcamp.Terms,lcamp.Campaign_Description,lcamp.Requirements')
			        		  ->from(TBL_CAMPAIGNS.' AS c')
			        		  ->join(TBL_LOCALIZED_CAMPAIGNS.' as lcamp', 'lcamp.Campaign_ID = c.Campaign_ID')
			        		  ->join(TBL_COMPANIES.' as cmp', 'cmp.Company_ID = c.Company_ID')
			        		  ->join(TBL_LOCALIZED_COMPANIES.' as lc', 'lc.Company_ID = cmp.Company_ID')
			        		  ->join('services as cf', 'FIND_IN_SET(cf.Service_ID, c.Services)', 'LEFT')
			        		  ->where('c.Campaign_ID', $campaign_id)
			        		  ->where('lc.Culture', "{$culture}")
			        		  ->where('lcamp.Culture', "{$culture}")
			        		  ->get();
			
			return $query->row();
		}
		
		public function getCampaignPictures($campaign_id = 0)
		{
			return $this->db
							->where('Campaign_ID', $campaign_id)
							->order_by('Order_In_List', 'ASC')
							->get(TBL_CAMPAIGN_PICTURES)
							->result();
		}
		
		var $order_columns  = array('c.Campaign_ID', 'c.Created_At', 'lc.Company_Name', 'lcamp.Campaign_Name', 'c.Campaign_Type', 'c.City_ID', 'c.From_Date', 'c.To_Date', 'c.Status');
		private function _get_campaigns_query($culture)
		{
			
				$where_to_date = '';
				$where_name = '';
				$where_from_date = '';
				$where_type = '';
				$where_city = '';
				$where_company = '';
				
				date_default_timezone_set('Asia/Riyadh');
				
				if(!empty($_POST['c_name']))
				{
					$name = $_POST['c_name'];
					$where_name = "lcamp.Campaign_Name LIKE '%{$name}%' AND";
				}
				
				if(!empty($_POST['from_date']))
				{
					$from_date = $_POST['from_date'];
					$where_from_date = "c.From_Date >= DATE_FORMAT(STR_TO_DATE('$from_date', '%d-%m-%Y'), '%Y-%m-%d') AND";
				}
				
				if(!empty($_POST['to_date']))
				{
					$to_date = $_POST['to_date'];
					$where_to_date = "c.To_Date <= DATE_FORMAT(STR_TO_DATE('$to_date', '%d-%m-%Y'), '%Y-%m-%d') AND";
				}
				
				/*if(@$_POST['c_type'] != -1)
				{
					$c_type = $_POST['c_type'];
					$where_type = "c.Campaign_Type = '{$c_type}' AND";
				}*/
				
				if(isset($_POST['c_status']))
				{
					$c_status = $_POST['c_status'];
					$where_type = "c.Status = '{$c_status}' AND";
				}				

				if(@$_POST['c_company'] != -1)
				{
					$c_company = $_POST['c_company'];
					$where_company = "c.Company_ID = '{$c_company}' AND";
				}
				
				if(!empty($_POST['city']))
				{
					$city = $_POST['city'];
					$where_city = "c.City LIKE '%{$city}%' AND";
				}
				
				$where = "$where_name $where_type $where_from_date $where_to_date $where_city $where_company lcamp.Culture = '{$culture}' AND lc.Culture = '{$culture}'";
	
			    $this->db->distinct();
		        $this->db->select("c.*, lcamp.Campaign_Name, lc.Company_Name, (SELECT COUNT(r.Campaign_ID) FROM ".TBL_RESERVATIONS." as r WHERE r.Campaign_ID = c.Campaign_ID AND r.Reservation_Confirmed = 1) as Total_Reservations"); 
		        $this->db->from(TBL_CAMPAIGNS.' AS c');
		        $this->db->join(TBL_COMPANIES.' as cmp', 'cmp.Company_ID = c.Company_ID');
		        $this->db->join(TBL_LOCALIZED_COMPANIES.' as lc', 'lc.Company_ID = cmp.Company_ID');
		        $this->db->join(TBL_LOCALIZED_CAMPAIGNS.' as lcamp', 'lcamp.Campaign_ID = c.Campaign_ID');
// 		        $this->db->join(TBL_RESERVATIONS.' as r', 'r.Campaign_ID = c.Campaign_ID', 'LEFT');
		        $this->db->where($where);
		        $this->db->group_by('c.Campaign_ID');
		        
		        //print_r($_POST['order']);
			    if(isset($_POST['order']))
			    {
				    $ind = $_POST['order'][0]['column'];
				    $oColumn = $this->order_columns[$ind];
					$direction = $_POST['order'][0]['dir'];
					$where_order = "$oColumn $direction";
					$this->db->order_by($where_order);
			    } 
			    else 
			    {
				    $this->db->order_by("c.Created_At", "DESC");
			    }
	    }

	    public function ChangeStatus($data)
	    {
	    	return $this->db->set('Status',$data['status'])->where('Campaign_ID',$data['id'])->update(TBL_CAMPAIGNS);
	    }
	 
	    function getCampaignsList($culture = 'en')
	    {
	        $this->_get_campaigns_query($culture);
	        if($_POST['length'] != -1)
	        $this->db->limit($_POST['length'], $_POST['start']);
	
			$query = $this->db->get();
			//echo $this->db->last_query();
	        return $query->result();
	    }
	 
	    function campaignsCount_filtered($culture)
	    {
	        $this->_get_campaigns_query($culture);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	 
	    public function campaignsCount_all()
	    {
	        $this->db->from(TBL_CAMPAIGNS." AS c");
	
	        return $this->db->count_all_results();
	    }



	    public function get_CompanyCampaigns($company_id)
	    {
	    	return $this->db->where('Company_ID',$company_id)->get(TBL_CAMPAIGNS)->result();
	    }


	    //=====================PAYMENTS====================================
	    public function GetCompany_SuccessOrders($Campaign_ID)
	    {
	    	$where['Payment_Verified']      = 1 ;
	    	$where['Reservation_Confirmed'] = 1 ;
	    	$where['Is_Deleted'] 			= 0 ;
	    	$where['Campaign_ID'] 			= $Campaign_ID ;

	    	return $this->db->where($where)->get(TBL_RESERVATIONS)->result();
	    }


	    public function Insert_Transactions($data)
	    {
	    	$this->db->insert(TBL_COMPANY_TRANSACTIONS,$data);

	    	return $this->db->insert_id();
	    }

	    public function Get_CompanyTransactions($where)
	    {
	    	return $this->db->where($where)->order_by('id','desc')->get(TBL_COMPANY_TRANSACTIONS)->result();
	    }


	    public function modifyCampaignFeatures($features = '')
	    {
		    
		    $feature_ids = '';
		    if(count($features) > 0){
			    foreach($features as $feature)
			    {
				    
				    $feature_ids .= $this->insertModifyFeature($feature).',';
			    }
			    
		    } else {
			    
			    $feature_ids .= $this->insertModifyFeature($features).',';
		    }
		    
		    return rtrim($feature_ids, ",");
	    }

		public function updateCampaignPicture($picture = array())
	    {
	        $upd = array(
	            'Campaign_ID' => $picture['Campaign_ID']
	        );
	        $query = 0;
	        if(is_array($picture['Picture_ID']))
	        {
		        foreach ($picture["Picture_ID"] as $id) 
		        {
			        $where = array(
		                'Picture_ID' => $id
		            );
					$this->db->where($where);
		            $query = $this->db->update(TBL_CAMPAIGN_PICTURES, $upd);
		        }
		        
	        } else {
		        
		        $where = array(
	                'Picture_ID' => $picture['Picture_ID']
	            );
		        $this->db->where($where);
	            $query = $this->db->update(TBL_CAMPAIGN_PICTURES, $upd);
	        }
	        
	        return $query;
	    }

		public function addCampaign_Localized($localized_campaign = array(), $campaign_id = 0)
		{
			$this->db->where('Campaign_ID', $campaign_id)->delete(TBL_LOCALIZED_CAMPAIGNS);
			
			return $this->db->insert_batch(TBL_LOCALIZED_CAMPAIGNS, $localized_campaign);
		}

	    private function insertModifyFeature($feature = '')
	    {
		    $checkFeature = $this->db->where("Feature = '{$feature}'")->get(TBL_CAMPAIGN_FEATURES)->result();
		    if(count($checkFeature) <= 0) 
		    {
			    $this->db->query("INSERT INTO ".TBL_CAMPAIGN_FEATURES." (Feature) VALUES ('{$feature}')");
				return $this->db->insert_id();
			}
			
			// else return tag id
			return $checkFeature[0]->Feature_ID;
	    }
	    
		public function updateCampaign($campaign = array())
		{
			return $this->db->where('Campaign_ID', $campaign['Campaign_ID'])->update(TBL_CAMPAIGNS, $campaign);
		}

		public function addCampaignPicture($picture = array())
		{
			$this->db->insert(TBL_CAMPAIGN_PICTURES, $picture);
			return $this->db->insert_id();
		}

		public function getCampaignPictureByID($picture_id = 0)
		{
			return $this->db->where('Picture_ID', $picture_id)->get(TBL_CAMPAIGN_PICTURES)->row();
		}

		public function deleteCampaignPicture($picture_id = 0)
		{
			return $this->db->where('Picture_ID', $picture_id)->delete(TBL_CAMPAIGN_PICTURES);
		}		
}
?>