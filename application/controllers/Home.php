<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('m_hki');
    }

	public function index()
	{
		$this->load->view('header');
		$this->load->view('home');
		$this->load->view('footer');
	}

	public function carihki()
	{
		# code...
		$search = $this->input->post('search');
		$data['hki']=$this->m_hki->get_hki_keyword($search);
		$this->load->view('header');
		$this->load->view('daftarhki',$data);
		$this->load->view('footer');
	}

	public function daftarhki()
	{
		$data['hki']=$this->m_hki->get_data_all('hki')->result();
		$this->load->view('header');
		$this->load->view('daftarhki',$data);
		$this->load->view('footer');
	}
	public function hakcipta()
	{
		$where = array(
            'skema' => '2'     
        );
		$data['hki']=$this->m_hki->get_data($where,'hki')->result();
		$this->load->view('header');
		$this->load->view('daftarhki',$data);
		$this->load->view('footer');
	}
	public function paten()
	{
		$where = array(
            'skema' => '1'     
        );
		$data['hki']=$this->m_hki->get_data($where,'hki')->result();
		$this->load->view('header');
		$this->load->view('daftarhki',$data);
		$this->load->view('footer');
	}
	public function selengkapnya($id)
	{
		$where = array(
            'id_hki' => $id     
        );
		$data['hki']=$this->m_hki->get_data($where,'hki')->result();
		$this->load->view('header');
		$this->load->view('selengkapnya',$data); 
		$this->load->view('footer');
	}


}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
 ?>
