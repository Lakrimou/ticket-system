<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OperatorHome extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->model('ticketsModel');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->config->item('use_mongodb', 'ion_auth') ?
            $this->load->library('mongo_db') :

            $this->load->database();

        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

        $this->lang->load('auth');
        $this->load->helper('language');
    }

    public function index()
    {
        redirect("OperatorHome/homeOperator", 'refresh');
    }

    public function accueilOperator()
    {
        $this->data['title'] = 'Conversation | Opérateur';
        $this->load->view('operateurs/headerOperator', $this->data);
        $this->load->view('operateurs/sideBarOperator', $this->data);
        $ident = $this->input->get('ticket_id', TRUE);
        $this->data['identifiantTicket']=$ident;
        $this->load->model('ticketsModel');
        $this->data['openTicketsParent'] = $this->load->ticketsModel->getTicketOpenedParent($ident);
        $this->data['ClosedTicketsParent'] = $this->load->ticketsModel->getTicketClosedParent($ident);
        $conv =  $this->load->ticketsModel->getTicketOpenedConversation($ident);
        $this->data['conversation'] = $conv;
        $this->load->view('operateurs/accueilOperator', $this->data);

        $this->load->library('form_validation');
        $this->load->helper('date');
        $this->form_validation->set_rules('solution', 'Solution', 'required');
        $this->form_validation->set_rules('id_ticket', 'id_ticket', 'required');
        if ($this->form_validation->run() == true)
        {
            $tick = array( 
                'body'=>$this->input->post('solution'),
                'date_ticket'=>date('Y,m,d'),
                'parent'=>$this->input->post('id_ticket')
            );
            $resultat = $this->ticketsModel->lastTicket();
            foreach($resultat as $key)
            {
                $id = $key->id_ticket;
            }
            $tickUser = array(
                'id_users'=>$this->session->userdata('user_id'),
                'id_ticket'=>$resultat = $id
            );
            $this->ticketsModel->addTicket($tick);
            $this->ticketsModel->addTicketUser($tickUser);
            redirect('OperatorHome/accueilOperator', $this->data);
        }
    }

    public function recherche()
    {
        $this->data['title'] = 'Recherche Ticket | Opérateur';
        $this->load->view('operateurs/headerOperator', $this->data);
        $this->load->view('operateurs/sideBarOperator', $this->data);
        $this->load->view('operateurs/recherche', $this->data);

    }

    public function recherche_Sol()
    {
        $this->data['title'] = 'Recherche | Opérateur';
        $this->load->view('operateurs/headerOperator', $this->data);
        $this->load->view('operateurs/sideBarOperator', $this->data);
        $this->load->view('operateurs/recherche_Solution', $this->data);
    }

    public function homeOperator(){
        $this->data['title'] = 'Accueil | Opérateur';
        $this->load->view('operateurs/headerOperator', $this->data);
        $this->load->view('operateurs/sideBarOperator', $this->data);
        $this->load->model('ticketsModel');
        $this->data['rowNumbb'] = $this->load->ticketsModel->getRowsNumberTicket();
        $this->load->view('operateurs/homeOperator', $this->data);
    }

    function get_ticketts(){
    $this->load->model('ticketsModel');
        if (isset($_GET['term'])){
          $q = strtolower($_GET['term']);
          $this->ticketsModel->get_ticket_completer($q);
        }
    }   
     
    function get_tick(){
    $this->load->model('ticketsModel');
        if (isset($_GET['term'])){
            $q = strtolower($_GET['term']);
            $this->ticketsModel->get_ticket_ticket($q);
        }
    }   
    

    public function resultatRecherche()
    {
        //khtr i vue n accepte que des données sous forme de tableau
        $this->data['title'] = 'Resultat recherche | Opérateur';
        $this->load->view('operateurs/headerOperator', $this->data);
        $this->load->view('operateurs/sideBarOperator', $this->data);
        $title_rech = $this->input->post('search');
        $this->load->model('ticketsModel');
        $rdgd =  $this->ticketsModel->resultat_recherche_title($title_rech);
        $this->data['resul'] = $rdgd;
        $this->load->view('operateurs/resultatrecherche', $this->data);
    }

    public function resultatsolution()
    {
        $this->data['title'] = 'Resultat recherche | Opérateur';
        $this->load->view('operateurs/headerOperator', $this->data);
        $this->load->view('operateurs/sideBarOperator', $this->data);
        $title_sol = $this->input->post('searchTic');
        $this->load->model('ticketsModel');
        $rdgdd =  $this->ticketsModel->resultat_recherche_body($title_sol);
        $this->data['resultatSolutionn'] = $rdgdd;
        $this->load->view('operateurs/resultatRechercheSolution', $this->data);
    }


    public function nouveauTicket()
    {
        $this->data['title'] = 'Nouveaux Tickets | Opérateur';
        $this->load->view('operateurs/headerOperator', $this->data);
        $this->load->view('operateurs/sideBarOperator', $this->data);
        $this->load->model('ticketsModel');
        $this->data['openedTicketts'] = $this->load->ticketsModel->getTicketOpened();
        $this->load->view('operateurs/nouveauTickets', $this->data);
    }

    public function tousTickets()
    {
        $this->data['title'] = 'Tous les tickets | Opérateur';
        $this->load->view('operateurs/headerOperator', $this->data);
        $this->load->view('operateurs/sideBarOperator', $this->data);
        $this->load->model('ticketsModel');
        $this->data['allTicketts'] = $this->load->ticketsModel->getAllTickets();
        $this->load->view('operateurs/allTickets', $this->data);
    }

    public function compte()
    {
        $this->data['title'] = 'Paramètre du compte | Opérateur';
        $this->load->view('operateurs/headerOperator', $this->data);
        $this->load->view('operateurs/sideBarOperator', $this->data);
        $this->load->view('operateurs/comptePersonnel', $this->data);
    }

    public function edit_user($user_id)
    {
       // $this->data['page_title'] = "Modifier les utilisateurs";

        /*if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('auth', 'refresh');
        }*/

        $user = $this->ion_auth->user($user_id)->row();
        $groups=$this->ion_auth->groups()->result_array();
        $currentGroups = $this->ion_auth->get_users_groups($user_id)->result();

        //validate form input
        $this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'required|xss_clean');
        $this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'required|xss_clean');
        $this->form_validation->set_rules('phone', $this->lang->line('edit_user_validation_phone_label'), 'required|xss_clean');
        $this->form_validation->set_rules('email', $this->lang->line('edit_user_validation_email_label'), 'required|valid_email');
        $this->form_validation->set_rules('company', $this->lang->line('edit_user_validation_company_label'), 'required|xss_clean');
        $this->form_validation->set_rules('groups', $this->lang->line('edit_user_validation_groups_label'), 'xss_clean');

        if (isset($_POST) && !empty($_POST))
        {
            // do we have a valid request?
            if ($this->_valid_csrf_nonce() === FALSE || $user_id != $this->input->post('id'))
            {
                show_error($this->lang->line('error_csrf'));
            }

            $data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name'  => $this->input->post('last_name'),
                'company'    => $this->input->post('company'),
                'phone'      => $this->input->post('phone'),
                'email' => $this->input->post('email')
            );

            //Update the groups user belongs to
            $groupData = $this->input->post('groups');

            if (isset($groupData) && !empty($groupData)) {

                $this->ion_auth->remove_from_group('', $user_id);

                foreach ($groupData as $grp) {
                    $this->ion_auth->add_to_group($grp, $user_id);
                }

            }

            //update the password if it was posted
            if ($this->input->post('password'))
            {
                $this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
                $this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');

                $data['password'] = $this->input->post('password');
            }

            if ($this->form_validation->run() === TRUE)
            {
                $this->ion_auth->update($user->id, $data);

                //check to see if we are creating the user
                //redirect them back to the admin page
                $this->session->set_flashdata('message', "User Saved");
                redirect("OperatorHome/edit_user/$user_id", 'refresh');
            }
        }

        //display the edit user form
        $this->data['csrf'] = $this->_get_csrf_nonce();

        //set the flash data error message if there is one
        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

        //pass the user to the view
        $this->data['user'] = $user;
        $this->data['groups'] = $groups;
        $this->data['currentGroups'] = $currentGroups;

        $this->data['first_name'] = array(
            'name'  => 'first_name',
            'id'    => 'first_name',
            'type'  => 'text',
            'value' => $this->form_validation->set_value('first_name', $user->first_name),
        );
        $this->data['last_name'] = array(
            'name'  => 'last_name',
            'id'    => 'last_name',
            'type'  => 'text',
            'value' => $this->form_validation->set_value('last_name', $user->last_name),
        );
        $this->data['company'] = array(
            'name'  => 'company',
            'id'    => 'company',
            'type'  => 'text',
            'value' => $this->form_validation->set_value('company', $user->company),
        );
        $this->data['phone'] = array(
            'name'  => 'phone',
            'id'    => 'phone',
            'type'  => 'text',
            'value' => $this->form_validation->set_value('phone', $user->phone),
        );
        $this->data['email'] = array(
            'name'  => 'email',
            'id'    => 'email',
            'type'  => 'text',
            'value' => $this->form_validation->set_value('email', $user->email),
        );
        $this->data['password'] = array(
            'name' => 'password',
            'id'   => 'password',
            'type' => 'password'
        );
        $this->data['password_confirm'] = array(
            'name' => 'password_confirm',
            'id'   => 'password_confirm',
            'type' => 'password'
        );
        $this->data['title'] = lang('edit_user_heading');
        $this->load->view('operateurs/headerOperator', $this->data);
        $this->load->view('operateurs/sideBarOperator', $this->data);
        $this->_render_page('operateurs/comptePersonnel', $this->data);
    }

    function _get_csrf_nonce()
    {
        $this->load->helper('string');
        $key   = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $this->session->set_flashdata('csrfkey', $key);
        $this->session->set_flashdata('csrfvalue', $value);

        return array($key => $value);
    }

    function _valid_csrf_nonce()
    {
        if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
            $this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    function _render_page($view, $data=null, $render=false)
    {

        $this->viewdata = (empty($data)) ? $this->data: $data;

        $view_html = $this->load->view($view, $this->viewdata, $render);

        if (!$render) return $view_html;
    }

    public function getTicketsClosed()
    {
        $this->data['title'] = 'Tickets Fermées';
        $this->load->view('operateurs/headerOperator', $this->data);
        $this->load->view('operateurs/sideBarOperator', $this->data);
        $close = $this->ticketsModel->getTicketClosed();
        $this->donnees['closeedTickets'] = $close;
        $this->load->view('operateurs/closedTickets', $this->donnees);
    }

    public function getTicketsOpened()
    {
        $this->data['title'] = 'Tickets ouverts';
        $this->load->view('operateurs/headerOperator', $this->data);
        $this->load->view('operateurs/sideBarOperator', $this->data);
        $open = $this->ticketsModel->getTicketOpened();
        $this->donnees['openedTicketts'] = $open;
        $this->load->view('operateurs/openedTickets', $this->donnees);
    }
}

