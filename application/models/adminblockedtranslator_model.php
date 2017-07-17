<?php

class Adminblockedtranslator_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }


    public function get_translator_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('translator_archive');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }


    public function get_translator($language = null, $search_string = null, $order = null, $order_type = 'Asc', $limit_start, $limit_end)
    {

        //$this->db->select('category.id');
        $this->db->select('*');
        $this->db->from('translator_archive');
        $this->db->order_by("id", "desc");

        if ($language != null && $language != 0) {
            $this->db->where("(`language` LIKE '%$language%')");
        }


        if ($search_string) {

            $lan_sql = "select * from `languages` where `name`='" . $search_string . "'";
            $lan_query = $this->db->query($lan_sql);
            $lan_num = $lan_query->num_rows();
            if ($lan_num > 0) {
                $lan_fetch = $lan_query->row();
                $lan_id = $lan_fetch->id;
                $lan = $lan_id;
                $this->db->where("(`language` REGEXP '[^\w\s ]".$lan_id."[^\w\s]')");
               $this->db->or_where("(`first_name` LIKE '%$search_string%' OR `last_name` LIKE '%$search_string%' OR CONCAT(first_name,' ',last_name) LIKE '%$search_string%' OR `email_address` LIKE '%$search_string%' OR `location` LIKE '%$search_string%')");
            } else {
                $this->db->where("(`first_name` LIKE '%$search_string%' OR `last_name` LIKE '%$search_string%' OR CONCAT(first_name,' ',last_name) LIKE '%$search_string%' OR `email_address` LIKE '%$search_string%' OR `location` LIKE '%$search_string%')");
            }
        }


        $this->db->group_by('translator_archive.id');

        if ($order) {
            $this->db->order_by($order, $order_type);
        } else {
            $this->db->order_by('id', $order_type);
        }
        $this->db->limit($limit_start, $limit_end);
        $query = $this->db->get();
        return $query->result_array();
    }


    function count_translator($language = null, $search_string = null, $order = null)
    {
        $this->db->select('*');
        $this->db->from('translator_archive');
        $this->db->order_by("id", "desc");
        if ($language != null && $language != 0) {
            $this->db->where("(`language` LIKE '%$language%')");
        }
        if ($search_string) {
            $lan_sql = "select * from `languages` where `name`='" . $search_string . "'";
            $lan_query = $this->db->query($lan_sql);
            $lan_num = $lan_query->num_rows();
            if ($lan_num > 0) {
                $lan_fetch = $lan_query->row();
                $lan_id = $lan_fetch->id;
                $lan = $lan_id;

                $this->db->where("(`language` REGEXP '[^\w\s ]".$lan_id."[^\w\s]')");
                $this->db->or_where("(`first_name` LIKE '%$search_string%' OR `last_name` LIKE '%$search_string%' OR CONCAT(first_name,' ',last_name) LIKE '%$search_string%' OR `email_address` LIKE '%$search_string%' OR `location` LIKE '%$search_string%')");
            } else {

                $this->db->where("(`first_name` LIKE '%$search_string%' OR `last_name` LIKE '%$search_string%' OR CONCAT(first_name,' ',last_name) LIKE '%$search_string%' OR `email_address` LIKE '%$search_string%' OR `location` LIKE '%$search_string%')");
            }
        }
        if ($order) {
            $this->db->order_by($order, 'Asc');
        } else {
            $this->db->order_by('id', 'Asc');
        }
        $query = $this->db->get();
        return $query->num_rows();
    }


    function store_translator($data)
    {
        $insert = $this->db->insert('translator_archive', $data);
        return $insert;
    }

    function update_translator($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('translator_archive', $data);
        $report = array();
        $report['error'] = $this->db->_error_number();
        $report['message'] = $this->db->_error_message();
        if ($report !== 0) {
            return true;
        } else {
            return false;
        }
    }


    function delete_translator($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('translator_archive');
    }


}

?>