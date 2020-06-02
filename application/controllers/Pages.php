<?php defined('BASEPATH') OR exit('No direct script access allowed');
/* 
 * Pages Controller
 *
 * This script is the controller for the static pages on the site. Based on the CI tutorial.
 *
 * Version 1.4.5 (2014 04 23 1530)
 * Edited by Sean Wittmeyer (theseanwitt@gmail.com)
 * 
 */

class Pages extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('cas');
	}

	public function view($slug = 'home')
	{
	
		if ( ! file_exists(APPPATH.'/views/app/content/'.$slug.'.php'))
		{
			// Whoops, we don't have a page for that!
			//show_404();
			$this->load->helper('file');
			$data = $this->shared->get_byslug('page',$slug);
			if (!isset($data['title'])) show_404();
			$data['related'] = $this->shared->get_related('page',$data['id']);
			if ($data['img'] != '') $data['img'] = unserialize($data['img']);
			if (!empty($data['payload'])) $data['payload'] = unserialize($data['payload']);
			$data['type'] = 'page';
			$template = (empty($data['template'])) ? 'default': $data['template'];
			//print_r($data);die;
			$data['pagetitle'] = $data['title'];
			$data['contenttitle'] = $data['title'];
			$data['loadjs']['contenttools'] = true;
			$data['section'] = array($data['section'],$data['slug']);
			$data['settings'] = $this->shared->settings();
			$data['cartograph'] = $this->shared->cartograph_content(false,$data['settings']);
			if (strpos($template, 'pylos') !== false) {
				if ($template == 'pyloshome') {
					$this->load->model('pylos_model');
					$data['blocks'] = $this->pylos_model->get_data2('pylos_block',false);
					$data['guides'] = $this->pylos_model->get_data2('pylos_guides',false);
					$data['presentations'] = $this->pylos_model->get_data2('pylos_presentations',false);
					$data['filter'] = true;
				} 
				$this->load->view('app/pylos/templates/header', $data);
				$data['fullwidth'] = true;
				$this->load->view('app/pylos/templates/frontmatter-default', $data);
				$this->load->view("app/pages/$template", $data);
				$this->load->view('app/pylos/templates/footer', $data);
			} else {
				switch ($template) {
					case "trains":
						$data['section'] = array('playground',$slug);
					break;
					case "home":
					case "home_new":
						$data['bodyclass'] = 'body-home';
						$data['loadjs']['embedly'] = true;
					break;
					case "football":
						$data['section'] = array('playground',$slug);
					break;
					case "fieldnotes":
						$data['section'] = array('notes',$slug);
					break;
					case "rsvp" :
						$data['loadjs']['rsvp'] = true;
						break;
				}
				$this->load->view('app/builder/head', $data);
				$this->load->view('app/builder/nav', $data);
				$this->load->view("app/pages/$template", $data);
				$this->load->view('app/builder/foot', $data);
			}
		} else {
			$data['pagetitle'] = ucfirst($slug); // Capitalize the first letter
			$data['section'] = array('page',$slug);
			switch ($slug) {
				case "new":
					$data['loadjs']['contenttools'] = true;
					$data['loadjs']['embedly'] = true;
				break;
			}
			$this->load->view('app/builder/head', $data);
			$this->load->view('app/builder/nav', $data);
			$this->load->view('app/content/'.$slug, $data);
			$this->load->view('app/builder/foot', $data);
		}
	}
}
?>