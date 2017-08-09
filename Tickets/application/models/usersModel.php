<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class UsersModel extends CI_Model
{
    /*public function getUserName()
    {
        $this->db->select('username, email, first_name, last_name, compagny, phone');
        $this->db->from('users us');
        $this->db->join('users_groups usgr','usgr.user_id = us.id', 'inner');
        $query = $this->db->get();
        if($query->num_rows() != 0)
        {
            return $query->result_array();
        }
        else
        {
            return false;
        }*/

    public function getUserRole($user_identifiant)
    {
        $this->db->select('usgr.group_id');
        $this->db->from('users_groups usgr');
        $this->db->join('users us', 'usgr.user_id = us.id','inner');
        $this->db->where('us.id', $user_identifiant);
        $query = $this->db->get();
        if($query->num_rows()!=0)
        {
            return $query->result();
        }
        else {
            return false;
        }
    }
}