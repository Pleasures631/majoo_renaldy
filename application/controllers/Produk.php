<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->database();
        $this->load->model('produk_models');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->helper('url');
    }

    public function index()
    {
        $data['dataKategori'] = $this->produk_models->getDataKategori();
        $this->load->view('v_produk', $data);
    }

    /**
     * 1. Cek nama produk harus unique
     */

    public function addProduct()
    {
        $photo_name = $_FILES['foto_produk']['name'];
        $fileNameDoc = str_replace(" ", "_", $photo_name);
        $date = date('Y:m:d H:i:s');
        $rules = $this->produk_models->setRulesValidation();
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_rules('nama_produk','Nama Produk','required|is_unique[t_product.product_name]');
        $this->form_validation->set_message('required', '%s masih kosong silahkan isi');
        $this->form_validation->set_message('is_unique', '%s Sudah terdaftar, silahkan diganti');
        

        if (empty($_FILES['foto_produk']['name'])) {
            $this->form_validation->set_rules('foto_produk', 'Upload Gambar', 'required');
        }

        if ($this->form_validation->run() == false) {
            $this->load->view('v_produk');
        } else {
            $success = array();
            $this->db->trans_begin();

            $arrProduct = array(
                'product_name'  =>  $this->input->post('nama_produk'),
                //'created_by'    =>  
                'created_date'  => $date
            );
            if (!$this->db->insert('t_product', $arrProduct)) {
                $success[] = false;
            } else {
                $product_id = $this->db->insert_id();
            }

            $arrProductDetail =  array(
                'product_id'                => $product_id,
                'category_id'               => $this->input->post('kategori_produk'),
                'product_desc'              => $this->input->post('deskripsi_produk'),
                'product_amount'            => $this->input->post('harga_produk'),
                'product_pict'              => $fileNameDoc,
                'created_date'              => $date
            );
            if (!$this->db->insert('t_product_detail', $arrProductDetail)) {
                $success[] = false;
            }

            $this->load->library('upload');
            $config['upload_path'] = FCPATH.'/upload';
            $config['file_name'] = $fileNameDoc;
            $config['allowed_types'] = '*';
            // $config['max_size']	= '1000';

            $this->upload->initialize($config);

            if (!$this->upload->do_upload('foto_produk')) {
                $success[] = false;
                echo "<script>alert('Data gagal di simpan')</script>";
                exit;
            }

            if (in_array(false, $success)) {
                $this->db->trans_rollback();
                echo "<script>alert('Data gagal di simpan')</script>";
            } else {
                $this->db->trans_commit();
                echo "<script>alert('Data berhasil di simpan');</script>";
                redirect('/landing_page', 'refresh');
            }
        }
    }

    public function edit()
    {
        isset($_FILES['foto_produk']['name']);
        $date = date('Y:m:d H:i:s');
        $rules = $this->produk_models->setRulesValidation();

        $this->form_validation->set_rules($rules);
        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required|callback_username_check');

        if (empty($_FILES['foto_produk']['name'])) {
           $this->form_validation->set_rules('foto_produk', 'Upload Gambar', 'required');
        }else{
            $fileNameDoc = str_replace(" ", "_", $_FILES['foto_produk']['name']);
        }

        if ($this->form_validation->run() == false) {
            $id = $this->input->get('id');
            $data['getDataExisting'] = $this->produk_models->getDataExistProduct($id);
            $data['dataKategori'] = $this->produk_models->getDataKategori();
            $this->load->view('v_edit_produk', $data);
        } else {
            $success = array();
            $this->db->trans_begin();

            $arrProduct = array(
                'product_name'  =>  $this->input->post('nama_produk'),
                //'created_by'    =>  
                'updated_date'  => $date
            );
            $this->db->where('product_id', $this->input->post('product_id'));
            if (!$this->db->update('t_product', $arrProduct)) {
                $success[] = false;
            }

            $arrProductDetail = array(
                'category_id'               => $this->input->post('kategori_produk'),
                'product_desc'              => $this->input->post('deskripsi_produk'),
                'product_amount'            => $this->input->post('harga_produk'),
                'product_pict'              => $fileNameDoc,
                'updated_date'              => $date
            );

            $this->db->where('product_detail_id', $this->input->post('product_detail_id'));            
            if (!$this->db->update('t_product_detail', $arrProductDetail)) {
                $success[] = false;
            }

            $this->load->library('upload');
            $config['upload_path'] = FCPATH.'/upload';
            $config['file_name'] = $fileNameDoc;
            $config['allowed_types'] = '*';
            // $config['max_size']	= '1000';

            $this->upload->initialize($config);

            if (!$this->upload->do_upload('foto_produk')) {
                $success[] = false;
                echo "<script>alert('Data gagal di simpan')</script>";
                exit;
            }
            
            if (in_array(false, $success)) {
                $this->db->trans_rollback();
                echo "<script>alert('Data gagal di simpan')</script>";
            } else {
                $this->db->trans_commit();
                echo "<script>alert('Data berhasil di simpan');</script>";
                redirect('/landing_page', 'refresh');
            }
        }
    }

    public function username_check()
    {
        $post = $this->input->post(null, TRUE);
        $query = $this->db->query("select * from t_product where product_name = '$post[nama_produk]' and product_id != $post[product_id]");
        if($query->num_rows() > 0){
            $this->form_validation->set_message('username_check', '%s sudah terdaftar');
            return false;
        }else{
            return true;
        }
    }
}
