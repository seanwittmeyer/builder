<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Facebook_ion_auth {

	/*
		Library for login with facebook and create an ion_auth compatibility session. 

		author: Daniel Georgiev
		website: http://dgeorgiev.biz
	*/

	public function __construct() {

		// get Codeigniter instance
	    $this->CI =& get_instance();

	    // Load config
	    $this->CI->load->config('facebook_ion_auth', TRUE);

		$this->app_id = $this->CI->config->item('app_id', 'facebook_ion_auth');
		$this->app_secret = $this->CI->config->item('app_secret', 'facebook_ion_auth'); 
		$this->scope = $this->CI->config->item('scope', 'facebook_ion_auth');
		$this->app_salt = $this->CI->config->item('app_salt', 'facebook_ion_auth');
		
		if($this->CI->config->item('redirect_uri', 'facebook_ion_auth') === '' ) {
			$this->my_url = site_url(''); 
		} else {
			$this->my_url = $this->CI->config->item('redirect_uri', 'facebook_ion_auth');
		}
		
	}

    public function login() {

    	// null at first
		$code = $this->CI->input->get('code');
		
		// if is not set go make a facebook connection
		if(!$code) {

			// create a unique state
	   		$this->CI->session->set_userdata('state', md5(uniqid(rand(), TRUE)));

	   		// redirect to facebook oauth page
	   		$url_to_redirect =  "https://www.facebook.com/dialog/oauth?client_id=" 
	       						.$this->app_id
	       						."&redirect_uri=".urlencode($this->my_url)
	       						."&state=".$this->CI->session->userdata('state').'&scope='.$this->scope;

	       	redirect($url_to_redirect);

		} else {

			// check if session state is equal to the returned state

			if($this->CI->session->userdata('state') && ($this->CI->session->userdata('state') === $this->CI->input->get('state'))) {


				$token_url = "https://graph.facebook.com/oauth/access_token?"
			       . "client_id=" . $this->app_id . "&redirect_uri=" . urlencode($this->my_url)
			       . "&client_secret=" . $this->app_secret . "&code=" . $code;
				
				$params = null;
				$ch = curl_init($token_url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$params = curl_exec($ch);
				//$params = file_get_contents($token_url);
				
				//print_r($params);die;

				//parse_str($response, $params);
				
				$params = json_decode($params);
				//print_r($params);die;

				$this->CI->session->set_userdata('access_token', $params->access_token);

				$graph_url = "https://graph.facebook.com/me?access_token=".$params->access_token.'&fields=id,name,email';

				$user = json_decode(file_get_contents($graph_url));
				//print_r($user);die;

				// check if this user is already registered
				if(!$this->CI->ion_auth_model->identity_check($user->email)){
					$userdata = array(
						'first_name' => $user->first_name, 
						'last_name' => $user->last_name,
						'facebook' => $user->id
					);
					$register = $this->CI->ion_auth->register('fb_'.$user->id, $this->app_salt, $user->email, $userdata);
					$login = $this->CI->ion_auth->login($user->email, $this->app_salt, 1);

				} else {
					$login = $this->CI->ion_auth->login($user->email, $this->app_salt, 1);
				}

				return true;
		    }
		    else {
		   		return false;
		    }
	    }
    }
    /*public function login_fbapi24() {

    	// null at first
		$code = $this->CI->input->get('code');
		
		// if is not set go make a facebook connection
		if(!$code) {

			// create a unique state
	   		$this->CI->session->set_userdata('state', md5(uniqid(rand(), TRUE)));

	   		// redirect to facebook oauth page
	   		$url_to_redirect =  "https://www.facebook.com/dialog/oauth?client_id=" 
	       						.$this->app_id
	       						."&redirect_uri=".urlencode($this->my_url)
	       						."&state=".$this->CI->session->userdata('state').'&scope='.$this->scope;

	       	redirect($url_to_redirect);

	   	} else {

	   		// check if session state is equal to the returned state

			if($this->CI->session->userdata('state') && ($this->CI->session->userdata('state') === $this->CI->input->get('state'))) {


				$token_url = "https://graph.facebook.com/oauth/access_token?"
			       . "client_id=" . $this->app_id . "&redirect_uri=" . urlencode($this->my_url)
			       . "&client_secret=" . $this->app_secret . "&code=" . $code;
				
				$params = null;

				// facebook returns json object now, let's decode and pass on... 30 mar 2017 sw
				$params = json_decode(file_get_contents($token_url));
				print_r($params);die;

				//parse_str($response, $params);
				
				//$params = json_decode($response);
				//print_r($params);die;

				$this->CI->session->set_userdata('access_token', $params->access_token);

				$graph_url = "https://graph.facebook.com/me?access_token=".$params->access_token;

				$user = json_decode(file_get_contents($graph_url));
				//print_r($user);die;

				// check if this user is already registered
				if(!$this->CI->ion_auth_model->identity_check($user->email)){
					$userdata = array(
						'first_name' => $user->first_name, 
						'last_name' => $user->last_name,
						'facebook' => $user->id
					);
					$register = $this->CI->ion_auth->register('fb_'.$user->id, $this->app_salt, $user->email, $userdata);
					$login = $this->CI->ion_auth->login($user->email, $this->app_salt, 1);

				} else {
					$login = $this->CI->ion_auth->login($user->email, $this->app_salt, 1);
				}

				return true;
		    }
		    else {
		   		return false;
		    }
	    }
    }

*/
}

/* End of file Facebook_ion_auth.php */