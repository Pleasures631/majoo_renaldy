<?php
defined('BASEPATH') or exit('No direct script access allowed');

class produk_models extends CI_Model
{

    public function getProductName()
    {
        $this->db->select('*');
        $this->db->from('t_product');

        $query = $this->db->get();
        return $query->result_array();
    }

    public function getDataKategori()
    {
        $this->db->select('*');
        $this->db->from('t_category');

        $query = $this->db->get();
        return $query->result_array();
    }

    public function getDataExistProduct($id)
    {
        $this->db->select('*');
        $this->db->from('t_product_detail');
        $this->db->where('product_detail_id', $id);
        $this->db->join('t_product', 't_product_detail.product_id= t_product.product_id', 'left');
        $this->db->join('t_category', 't_product_detail.category_id= t_category.category_id', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function setRulesValidation()
    {
        return [
            [
                'field' =>  'deskripsi_produk',
                'label' =>  'Deskripsi Produk',
                'rules' =>  'required',
                'errors' =>  [
                    'required'  => '%s harus diisi!'
                ]
            ],
            [
                'field' =>  'harga_produk',
                'label' =>  'Harga Produk',
                'rules' =>  'required',
                'errors' =>  [
                    'required'  => '%s harus diisi!'
                ]
            ],
            [
                'field' =>  'kategori_produk',
                'label' =>  'Kategori',
                'rules' =>  'required',
                'errors' =>  [
                    'required'  => '%s harus diisi!'
                ]
            ]
        ];
    }
}
