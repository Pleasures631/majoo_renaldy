<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class landing_page extends CI_Controller {

	public function __construct() 
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->database();
        $this->load->model('landing_page_models');
    }

	public function index()
	{
        $data['allData'] = $this->landing_page_models->getData();
		$this->load->view('v_landing_page', $data);
	}

    public function deletedata()
    {
        $id = $this->input->get('id');
        $response = $this->landing_page_models->deleterecords($id);
        if ($response == true) {
            redirect('/landing_page', 'refresh');
        }
    }

}
