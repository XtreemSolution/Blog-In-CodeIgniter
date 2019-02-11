<?php
/**
* Common_Model Model for Admin and site
*/
class Common_Model extends CI_Model {

	function __construct() {
		global $URI, $CFG, $IN;
        $ci = get_instance(); 
        $ci->load->config('config');
        $this->setSiteConfigData();
        $this->setMemberConfigData();
        $this->setLocalTimeZone();
	}

	function setSiteConfigData() {
		$this->config->set_item('per_page',20);
		$this->config->set_item('per_page_front',4);
	}

	function setMemberConfigData() {
		if($this->session->userdata('user_id'))
		{
			$userData = $this->getUserDataById($this->session->userdata('user_id'));
			if($userData)
			{
				$this->config->set_item('first_name',$userData->first_name);
			}
		}
	}

	function getUserDataById($user_id) {
		$this->db->where('id',$user_id);
		$query = $this->db->get('tbl_users');
		$result = $query->row();
		return $result;
	}

	function setLocalTimeZone() {	
		if(!$this->session->userdata('local_time_zone'))
		{
			
			$timezone = 'Asia/Kolkata';
			
			$this->session->set_userdata('local_time_zone',$timezone);
			
		}
		date_default_timezone_set($this->session->userdata('local_time_zone'));
	}

	function checkAdminLogin() {
		if($this->session->userdata('admin_id')) {
			return true;
		} else {
			if($this->input->is_ajax_request()) {
				$data['success'] = false;
				$data['message'] = 'Please login first';
				$data['error_type'] = 'auth';
				echo json_encode($data); die;
			} else {
				redirect('admin/login');				
			}	
		}
	}
	

	
	function checkRequestedDataExists($data) {
		if(!$data) {
			show_404();
		}
		return true;
	}

	function createSlugForTable($title,$table) {
		$slug = url_title($title);
		$slug = strtolower($slug);
		$i = 0;
		$params = array ();
		$params['slug'] = $slug;
		while ($this->db->where($params)->get($table)->num_rows()) {
			if (!preg_match ('/-{1}[0-9]+$/', $slug )) {
				$slug .= '-' . ++$i;
			} else {
				$slug = preg_replace ('/[0-9]+$/', ++$i, $slug );
			}
			$params ['slug'] = $slug;
		}
		return $slug;
	}  


	function getOptionValue($slug = '', $language_abbr = '') {
		$this->db->select('*');
		$this->db->where('website_setting.slug',$slug);
		if($language_abbr)
			$this->db->where('website_setting.language_abbr',$language_abbr);
		$query = $this->db->get('website_setting');		
		$result = $query->row();
		if($result)
			return $result->value;
	}

	function checkLoginAdminStatus() {
		$user = $this->getLoginAdmin();
		if($user) {
			return true;
		} else {
			$this->session->sess_destroy();
			redirect('admin/login');
			return false;
		}
	}

	function getLoginAdmin() {
		$userId = $this->session->userdata('admin_id');
		$this->db->where('id',$userId);
		$this->db->where('status','Active');
		$this->db->where('is_delete','No');
		$query = $this->db->get('tbl_users');
		$result = $query->row();
		return $result;
	}


	function getDefaultToGMTTime($time) {
		$gmtTime = local_to_gmt($time);
		return $gmtTime;
	}

	function getDefaultToGMTDate($time,$format = 'Y-m-d H:i:s A') {
		$gmtTime = local_to_gmt($time);
		return date($format,$gmtTime);
	}

	function getGMTDateToLocalDate($date, $format = 'Y-m-d H:i:s') {
		$date = new DateTime($date, new DateTimeZone('GMT'));
		$date->setTimeZone(new DateTimeZone($this->session->userdata('local_time_zone')));
		return $date->format($format);
	}

	function showLimitedText($string,$len) {
		$string = strip_tags($string);
		if (strlen($string) > $len)
			$string = mb_substr($string, 0, $len-3) . "...";
		return $string;
	}
  
	function checkUserLogin() {
		if($this->session->userdata('user_id')) {
			return true;
		} else {
			if($this->input->is_ajax_request()) {
				$data['success'] = false;
				$data['message'] = 'Please login first';
				$data['error_type'] = 'auth';
				echo json_encode($data); die;
			} else {
				redirect('login');				
			}
		}
	}

	function checkLoginUserStatus() {
		$user = $this->getLoginUser();
		if($user) {

		} else {
			$this->session->sess_destroy();
			redirect('login');
			return false;
		}
	}

	function getLoginUser() {
		$userId = $this->session->userdata('user_id');
		$this->db->where('id',$userId);
		$this->db->where('status','Active');
		$this->db->where('is_email_verified','Yes');
		$query = $this->db->get('tbl_members');
		$result = $query->row();
		return $result;
	}

	function checkUseAlreadyLogin() {
		$userId = $this->session->userdata('user_id');
		if($userId) {
			redirect('');
		} else {
			return false;
		}
	}

	function setUserType(){
		$user_type = array(			
			'Restaurant_Service_Provider'=>'Restaurant Service Provider',
			'Hotel_Owner'=>'Hotel Owner',
			'Hotel_Receptionist'=>'Hotel Receptionist',
			'Transfer_Service_Provider'=>'Transfer Service Provider',
			'Baby_Sitter_Service_Provider'=>'Baby Sitter Service Provider',
			'Dog_Sitter_Service_Provider'=>'Dog Sitter Service Provider',
			'Beauty_Service_Provider'=>'Beauty Service Provider',
			'Tour_Service_Provider'=>'Tour Service Provider',
			'Hair_Dresser_service_provider'=>'Hair Dresser Service Provider',
			'Massage_Service_Provider'=>'Massage Service Provider',
			'Scooter_Rental_Service_Provider'=>'Scooter Rental Service Provider',
			'Personal_Shopper_Service_Provider'=>'Personal Shopper Service Provider',
			'Garage_Service_Provider'=>'Garage Service Provider'
		 );
		return $user_type;
	}

	function getEmbedVideoURLByVideoURL($video_url) {

    	$checkVimeo = $this->checkVimeoVideo($video_url);
		$check = $this->getDailyMotionId($video_url);
	
    	if($check) {
			$video_array = explode('/',$video_url);
			$video_id = end($video_array);
			return "https://www.dailymotion.com/embed/video/".$video_id;
		}
		else if($checkVimeo) {
			$video_array = explode('/',$video_url);
			$video_id = end($video_array);
			return "https://player.vimeo.com/video/".$video_id;
		}
		else {
			
			$video_array = explode('=',$video_url);
			$video_id = end($video_array);
			return "https://www.youtube.com/embed/".$video_id;
		}
    }

    function checkVimeoVideo($url)
	{
		$checkString = "/^.+vimeo.com\/?/";
		$m = preg_match($checkString,$url);
		return $m;
	}

	function getDailyMotionId($url)
	{
		$checkString = "/^.+dailymotion.com\/(video|hub)\/([^_]+)[^#]*(#video=([^_&]+))?/";
		$m = preg_match($checkString,$url);
		return $m;
	}
}