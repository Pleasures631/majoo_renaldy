<?php
defined('BASEPATH') or exit('No direct script access allowed');

class landing_page_models extends CI_Model
{

    public function getData()
    {
        $this->db->select('*');
        $this->db->from('t_product_detail');
        $this->db->join('t_product', 't_product_detail.product_id= t_product.product_id', 'left');
        $this->db->join('t_category', 't_product_detail.category_id= t_category.category_id', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function deleterecords($id)
    {
        $this->db->where("product_id", $id);
        $this->db->delete("t_product");
        return true;
    }
}
