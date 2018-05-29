<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Panel extends CI_Controller {

	public function index()
	{

		if($this->session->userdata('email') == FALSE || $this->session->userdata('password') == FALSE)
		{
			header("location:" . base_url().'Login');
		}

		$this->load->view('panel/header');
		$this->load->view('panel/index');
		$this->load->view('panel/footer');
	}
}
