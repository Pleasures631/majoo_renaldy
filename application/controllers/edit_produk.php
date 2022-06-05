<?php
defined('BASEPATH') or exit('No direct script access allowed');

class edit_produk extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->database();
        $this->load->model('edit_produk_models');
    }

    public function index()
    {
        $id = $this->input->get('id');
        $data['getDataExisting'] = $this->edit_produk_models->getData($id);
        $this->load->view('v_edit_produk', $data);
    }

    public function saveEditProduct()
    {
        $date = date('Y:m:d H:i:s');
        $arrProduct = array(
            'product_name'  =>  $this->input->post('nama_produk'),
            //'created_by'    =>  
            'updated_date'  => $date
        );

        $arrProductDetail = array(
            'category_id'               => $this->input->post('kategori_produk'),
            'product_desc'              => $this->input->post('deskripsi_produk'),
            'product_amount'            => $this->input->post('harga_produk'),
            'product_pict'              => $photo_name,
            'updated_date'              => $date
        );
        // $dataArray =  array(
        //     'nama'              => $this->input->post('nama_karyawan'),
        //     'alamat'            => $this->input->post('alamat_karyawan'),
        //     'tgl_lahir'         => $this->input->post('tanggal_lahir_karyawan'),
        //     'tgl_masuk_kerja'   => $this->input->post('tanggal_masuk_karyawan')
        // );
        // $this->db->where('id_user', $this->input->post('id_user'));
        // $this->db->update('t_user', $dataArray);
        redirect('/landing_page', 'refresh');
    }
}
