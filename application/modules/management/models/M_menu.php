<?php
class M_menu extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    var $sess;
    public function _getMenu($menu_id)
    {
        $sql = "SELECT a.*, b._view, b._add, b._update, b._delete 
            FROM menu a 
            JOIN access_menu b ON b.menu_id = a.menu_id
            WHERE b.menu_id = ? AND b.role_id = ?";
        $query = $this->db->query($sql, array(@$menu_id, @$this->session->userdata['role_id']));
        return $query->row_array();
    }
    public function _getTitle($menu_id)
    {
        $sql = "SELECT a.menu_nm 
            FROM menu a 
            WHERE a.menu_id = ? ";
        $query = $this->db->query($sql, array(@$menu_id));
        return $query->row_array();
    }


    public function list_data($cookie)
    {
        // $where = $this->where($cookie);
        $sql = "SELECT a.* FROM menu a 
                ORDER BY "
            . $cookie['order']['field'] . " " . $cookie['order']['type'] .
            " LIMIT " . $cookie['cur_page'] . "," . $cookie['per_page'];
        $query = $this->db->query($sql);
        return $query->result_array();
    }
}
