<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct() 
    {
        parent::__construct();
        $this->load->helper('url');
    }

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function addFormKaryawan()
	{
		$nama_karyawan = $this->input->post('nama_karyawan');
		var_dump($nama_karyawan);exit();
	}
}
