<?php defined('BASEPATH') OR exit('No direct script access allowed');
/* 
 * Content Controller
 *
 * This script is the controller for the static pages on the site. Based on the CI tutorial.
 *
 * Version 1.4.5 (2019 09 10 1940)
 * Edited by Sean Wittmeyer (sean@zilifone.net)
 * 
 */

class Content extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('cas');
	}

	public function definition($slug)
	{
		$data = $this->shared->get_byslug('definition',$slug);
		if (!isset($data['title'])) show_404();
		$data['settings'] = $this->shared->settings();
		$data['cartograph'] = $this->shared->cartograph_content(false,$data['settings']);
		$data['related'] = $this->shared->get_related('definition',$data['id']);
		if ($data['img'] != '') $data['img'] = unserialize($data['img']);
		if ($data['payload'] != '') $data['payload'] = unserialize($data['payload']);
		$data['type'] = 'definition';
		$data['pagetitle'] = $data['title'];
		$data['section'] = array(($data['template'] == 'project') ? 'projects': 'notes',$data['slug']);
		$data['loadjs'][] = 'blank';
		$data['loadjs']['contenttools'] = true;
		$data['loadjs']['embedly'] = true;
		//print_r($data);die;
		$this->load->view('app/builder/head', $data);
		$this->load->view('app/builder/nav', $data);
		$path = ($data['template'] == 'default') ? 'app/cas/definition/definition': "app/cas/definition/{$data['template']}";
		$this->load->view($path, $data);
		$this->load->view('app/builder/foot', $data);
	
	}
	public function taxonomy($slug)
	{
		$data = $this->shared->get_byslug('taxonomy',$slug);
		if (!isset($data['title'])) show_404();
		$data['related'] = $this->shared->get_related('taxonomy',$data['id']);
		$data['settings'] = $this->shared->settings();
		$data['cartograph'] = $this->shared->cartograph_content(false,$data['settings']);
		$data['type'] = 'taxonomy';
		if ($data['img'] != '') $data['img'] = unserialize($data['img']);
		if ($data['payload'] != '') $data['payload'] = unserialize($data['payload']);
		$data['pagetitle'] = $data['title'];
		$data['section'] = array(($data['template'] == 'project') ? 'projects': 'notes',$data['slug']);
		$data['loadjs'][] = 'blank';
		$data['loadjs']['contenttools'] = true;
		$data['loadjs']['embedly'] = true;
		//print_r($data);die;
		$this->load->view('app/builder/head', $data);
		$this->load->view('app/builder/nav', $data);
		$path = ($data['template'] == 'default') ? 'app/cas/taxonomy/taxonomy': "app/cas/taxonomy/{$data['template']}";
		$this->load->view($path, $data);
		$this->load->view('app/builder/foot', $data);
	
	}
	public function paper($slug)
	{
		$data = $this->shared->get_byslug('paper',$slug);
		if (!isset($data['title'])) show_404();
		$data['related'] = $this->shared->get_related('paper',$data['id']);
		$data['settings'] = $this->shared->settings();
		$data['cartograph'] = $this->shared->cartograph_content(false,$data['settings']);
		$data['type'] = 'paper';
		$data['pagetitle'] = $data['title'];
		$data['section'] = array('notes',$data['slug']);
		$data['loadjs'][] = 'blank';

		//print_r($data);die;
		$this->load->view('app/builder/head', $data);
		$this->load->view('app/builder/nav', $data);
		$this->load->view('app/cas/paper', $data);
		$this->load->view('app/builder/foot', $data);
	
	}
	public function feed($type="")
	{
		$data['type'] = $type;
		$data['pagetitle'] = (empty($type)) ? 'The Feed' : ($type == 'html') ? 'Websites': ucfirst($type).'s';
		$data['section'] = array('feed',$type);
		$data['loadjs']['embedly'] = true;
		$data['loadjs']['livesearch'] = true;
		$data['settings'] = $this->shared->settings();
		//$data['cartograph'] = $this->cas->cartograph_content(false,$data['settings']);
		$data['path'] = array(
			'title'=>'The Feed',
			'url'=> current_url()
		);
		$data['navfullwidth'] = true;
		//print_r($data);die;
		$this->load->view('app/builder/head', $data);
		$this->load->view('app/builder/nav', $data);
		$this->load->view('app/cas/feed', $data);
		$this->load->view('app/builder/foot', $data);
	
	}
	/* dev use only
	public function preload($go)
	{
		$terms = array('Parametric Urbanism,Urban Computational Modeling,Evolutionary Economic Modeling,Generative/Iterative Urbanism,Landscape Urbanism,Resilient Urbanism,Informal Urbanism,Tactical Urbanism,Communicative/Strategic Navigation,Urban Datascape,Relational Geography,Assemblage Geography,');
		$user = $this->ion_auth->user()->row();
		foreach ($terms as $term) {
			$insert = array(
				'slug' => $this->shared->slug($term,'taxonomy','slug'),
				'timestamp' => time()-604800,
				'unique' => sha1('cas-'.microtime()),
				'body' => "Sweet grinder java, id milk single shot bar robusta milk, cream, beans as cultivar caf� au lait aftertaste saucer. Dark, cortado, est, coffee fair trade extra cortado turkish, variety, eu extraction crema french press robusta extra est shop trifecta aftertaste siphon. Variety, dripper coffee bar robusta americano cream carajillo lungo caf� au lait cinnamon grounds to go. So, aromatic black pumpkin spice and roast, as variety extraction aftertaste americano, aromatic turkish brewed breve brewed ristretto. Crema irish eu breve viennese, arabica white iced barista mocha single origin strong shop robust, caf� au lait, fair trade kopi-luwak shop macchiato extra arabica macchiato. Wings, carajillo medium, rich, java americano grounds, viennese, cinnamon, caramelization java dark con panna iced, et, ut americano whipped and affogato. Bar aftertaste, gal�o, espresso that, a, crema, espresso skinny acerbic, iced aged dripper french press macchiato, latte pumpkin spice spoon cup pumpkin spice single shot rich aromatic iced. Et half and half cappuccino aged dripper, half and half, grinder et, white, coffee body viennese, milk shop viennese, barista in plunger pot macchiato that black. Seasonal extraction organic, black, single shot crema roast black gal�o latte, saucer plunger pot qui redeye coffee.",
				'title' => $term,
				'excerpt' => "Caramelization half and half robust kopi-luwak, brewed, foam affogato grounds extraction plunger pot, bar single shot froth eu shop latte et, chicory, steamed seasonal grounds dark organic.",
				'user' => $user->id,
			);
			print("slug \n");
			$result = $this->db->insert('build_definition',$insert);
		}

		print_r('done');
	}
	*/
}
