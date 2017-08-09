<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class TicketsModel extends CI_Model
{
    //Récuperer le nombre des enregistrement dans la table ticket
    public function getRowsNumberTicket(){
        return $query = $this->db->count_all('ticket');
    }
    // Récupurer tous les tickets
    public function getAllTickets()
    {
        $this->db->select('tk.id_ticket, title, body, statut, date_ticket,parent,last_login, email, username, first_name, last_name');
        $this->db->from('ticket tk');
        $this->db->join('users_ticket ustk', 'tk.id_ticket = ustk.id_ticket','inner');
        $this->db->join('users us', 'us.id = ustk.id_users', 'inner');
        $this->db->where('tk.parent = 0');
        $this->db->where('tk.kind = 0');
        $query = $this->db->get();
        if($query->num_rows() != 0)
        {
            return $query->result_array();
        }
        else
        {
            return false;
        }
    }

public function resultat_recherche_title($title_rech)
    {
        $this->db->select('*');
        //$this->db->from('ticket');
        $this->db->like('title', $title_rech);
        $query = $this->db->get('ticket');
        if($query->num_rows() != 0)
        {
            return $query->result_array();
        }
        else
        {
            return false;
        }
    }
public function resultat_recherche_body($title_sol)
    {
        $this->db->select('*');
        //$this->db->from('ticket');
        $this->db->like('body_solution', $title_sol);
        $query = $this->db->get('solution');
        if($query->num_rows() != 0)
        {
            return $query->result_array();
        }
        else
        {
            return false;
        }
    }






    /*public function resultat_recherche_body($title_sol)
    {
        $this->db->select('*');
        //$this->db->from('ticket');
        $this->db->like('body_solution', $title_sol);
        $query = $this->db->get('solution');
        if($query->num_rows() != 0)
        {
            foreach ($query->result() as $row) {
            $data = $row;
        }
            return $data;
        }
        else
        {
            return false;
        }
    }*/


    function get_ticket_completer($q)
    {
        $this->db->select('*');
        $this->db->from('solution');
        $this->db->like('body_solution',$q);
        $query = $this->db->get();
        if($query->num_rows() != 0)
        {
     foreach ($query->result_array() as $row){
            $row_set[] = htmlentities(stripslashes($row['body_solution'])); //build an array
          }
          echo json_encode($row_set); //format the array into json data
        }
  }

/*function get_ticket_ticket($q)
    {
        $data = array();
        $list = array();
         
        foreach ($_POST['q'] as $p)
        {   
           array_push($list, $p);
                       
           $this->db->select('title');
           $this->db->from('ticket');
            
           if (count($p) > 0)
           {
                foreach ($list as $j)
                {
                    $this->db->like('title', $j);                 
                }
           }
            
            
           $query = $this->db->get();
            
        }
         
        foreach($query -> result() as $row)
        {
            array_push($data, $row);
        }
        
        //var_dump($data);
        return $data;
    } */

function get_ticket_ticket($q)
    {
        $this->db->select('title');
        $this->db->from('ticket');
        $this->db->like('title',$q);
        $query = $this->db->get();
        if($query->num_rows() != 0)
        {
     foreach ($query->result_array() as $row){
            $row_set[] = htmlentities(stripslashes($row['title'])); //build an array
          }
          echo json_encode($row_set); //format the array into json data
        }
  }
    //récuperer les tickets closed
    public function getTicketClosed() {
        $this->db->select('tk.id_ticket, title, body, date_ticket,parent,last_login, email, username, first_name, last_name');
        $this->db->from('ticket tk');
        $this->db->join('users_ticket ustk', 'tk.id_ticket = ustk.id_ticket','inner');
        $this->db->join('users us', 'us.id = ustk.id_users', 'inner');
        $this->db->where('tk.statut = 1');
        $this->db->where('tk.parent = 0');
        $this->db->where('tk.kind = 0');
        $query = $this->db->get();
        if($query->num_rows() != 0)
        {
            return $query->result_array();
        }
        else
        {
            return false;
        }
    }

    //Récupérer les tickets ouvertes
    public function getTicketOpened() {
        $this->db->select('tk.id_ticket, title, body, date_ticket,parent,last_login, email, username, first_name, last_name');
        $this->db->from('ticket tk');
        $this->db->join('users_ticket ustk', 'tk.id_ticket = ustk.id_ticket','inner');
        $this->db->join('users us', 'us.id = ustk.id_users', 'inner');
        $this->db->where('tk.statut = 0');
        $this->db->where('tk.parent = 0');
        $this->db->where('tk.kind = 0');
        $query = $this->db->get();
        if($query->num_rows() != 0)
        {
            return $query->result_array();
        }
        else
        {
            return false;
        }
    }

    //récuperer les utilisateurs du tickets closed
    public function getUserTicketsClosed()
    {
        $this->db->select('username, first_name, last_name');
        $this->db->from('users us');
        $this->db->join('users_ticket ustk', 'us.id = ustk.id_ticket','inner');
        $this->db->join('ticket tk', 'ustk.id_ticket = tk.id_ticket','inner');
        $this->db->where('tk.statut = 0');
        $query = $this->db->get();
        if($query->num_rows() != 0)
        {
            return $query->result_array();
        }
        else
        {
            return false;
        }
    }

    //Récupérer les tickets public et qui sont fermées
    public function getAllPublicClosedTicket()
    {
        $this->db->select('tk.title, tk.body, tk.date_ticket, us.username, us.first_name, us.last_name');
        $this->db->from('ticket tk');
        $this->db->join('users_ticket ustk', 'tk.id_ticket = ustk.id_ticket','inner');
        $this->db->join('users us', 'us.id = ustk.id_users');
        $this->db->where('tk.statut', 0);//0 ça veut dire status closed
        $this->db->where('tk.visibility', 1); //1 ça veut dire public
        $query = $this->db->get();
        if($query->num_rows() != 0)
        {
            return $query->result_array();
        }
        else
        {
            return false;
        }
    }

    //récupérer la dernière ticket ajouté
    public function lastTicket()
    {
        $query = $this->db->query('SELECT id_ticket FROM ticket ');
        $row = $query->last_row();
        return $query->result();
    }

    //ajouter ticket
    public function addTicket($tick = array())
    {
        $this->db->insert('ticket', $tick);
    }

    public function addTicketUser($tickUser = array())
    {
        $this->db->insert('users_ticket', $tickUser);
    }

     public function getTicketOpenedConversation($id) {
        $this->db->select('tk.id_ticket, tk.body, tk.date_ticket, us.username');
        $this->db->from('ticket tk');
        $this->db->join('users_ticket ustk', 'ustk.id_ticket = tk.id_ticket','inner');
        $this->db->join('users us','us.id = ustk.id_users','inner');
        $this->db->where('tk.parent',$id);
        $query = $this->db->get();
        if($query->num_rows() != 0)
        {
            return $query->result_array();
        }
        else
        {
            return false;
        }
    }

    public function userReplique($id_tick)
    {
        $this->db->select('us.username');
        $this->db->from('users us');
        $this->db->join('users_ticket ustk', 'ustk.id_users = us.id','inner');
        $this->db->join('ticket tk', 'tk.id_ticket = ustk.id_ticket');
        $this->db->where('tk.parent != 0');
        $this->db->where('tk.id_ticket', $id_tick);
        $query = $this->db->get();
        if($query->num_rows() != 0)
        {
            return $query->result();
        }
        else
        {
            return false;
        }
    }

    public function getTicketOpenedParent($ident) {
        $this->db->select('tk.id_ticket, tk.title, tk.body, tk.statut, tk.date_ticket, tk.parent, us.last_login, us.email, us.username, us.first_name, us.last_name, us.company, us.phone, tkc.categorie');
        $this->db->from('ticket tk');
        $this->db->join('users_ticket ustk', 'tk.id_ticket = ustk.id_ticket','inner');
        $this->db->join('users us', 'us.id = ustk.id_users', 'inner');
        $this->db->join('ticket_categorie tkc', 'tkc.id_categorie = tk.id_categorie');
        $this->db->where('tk.statut = 0');
        $this->db->where('tk.parent = 0');
        $this->db->where('tk.id_ticket',$ident);
        $query = $this->db->get();
        if($query->num_rows() != 0)
        {
            return $query->result_array();
        }
        else
        {
            return false;
        }
    }

    public function getTicketClosedParent($ident) {
        $this->db->select('tk.id_ticket, tk.title, tk.body, tk.statut, tk.date_ticket, tk.parent, us.last_login, us.email, us.username, us.first_name, us.last_name, us.company, us.phone, tkc.categorie');
        $this->db->from('ticket tk');
        $this->db->join('users_ticket ustk', 'tk.id_ticket = ustk.id_ticket','inner');
        $this->db->join('users us', 'us.id = ustk.id_users', 'inner');
        $this->db->join('ticket_categorie tkc', 'tkc.id_categorie = tk.id_categorie');
        $this->db->where('tk.statut = 1');
        $this->db->where('tk.id_ticket',$ident);
        $query = $this->db->get();
        if($query->num_rows() != 0)
        {
            return $query->result_array();
        }
        else
        {
            return false;
        }
    }

    public function getMesTicks($user_identifiant)
    {
        $this->db->select('tk.id_ticket, tk.title, tk.body, tk.statut, tk.date_ticket, us.username');
        $this->db->from('ticket tk');
        $this->db->join('users_ticket ustk', 'ustk.id_ticket = tk.id_ticket', 'inner');
        $this->db->join('users us','us.id = ustk.id_users','inner');
        $this->db->where('us.id', $user_identifiant);
        $query = $this->db->get();
        if($query->num_rows() != 0)
        {
            return $query->result_array();
        }
        else
        {
            return false;
        }
    }

    public function getTicketsPublic()
    {
        $this->db->select('tk.id_ticket, title, body, statut, date_ticket,parent, visibility, last_login, email, username, first_name, last_name');
        $this->db->from('ticket tk');
        $this->db->join('users_ticket ustk', 'tk.id_ticket = ustk.id_ticket','inner');
        $this->db->join('users us', 'us.id = ustk.id_users', 'inner');
        $this->db->where('tk.parent = 0');
        $this->db->where('tk.kind = 0');
        $this->db->where('visibility = 0');
        $query = $this->db->get();
        if($query->num_rows() != 0)
        {
            return $query->result_array();
        }
        else
        {
            return false;
        }
    }

   /* public function get_ticket_completer($q){
        $this->db->select('body');
        $this->db->like('body', $q);
        $query = $this->db->get('ticket');
        if($query->num_rows() != 0){
          foreach ($query->result_array() as $row){
            $row_set[] = htmlentities(stripslashes($row['body'])); //build an array
          }
          echo json_encode($row_set); //format the array into json data
        }
  }
*/

}