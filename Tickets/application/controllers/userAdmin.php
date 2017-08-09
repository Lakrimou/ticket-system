<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserAdmin extends My_Controller
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
        $this->data['title'] = 'Accueil | client';
        /*$this->user = $this->ion_auth->user()->row();
                $user_id = $this->user->id;
                $user_identifiant = $user_id;
        $this->load->model('usersModel');
        $role = $this->usersModel->getUserRole($user_identifiant);
        $this->data['rolee'] = $role;*/
        $this->load->view('clients/headerClient', $this->data);
        $this->load->view('clients/sideBarUser', $this->data);
        $this->load->view('clients/accueilClient', $this->data);
        $this->load->view('clients/footerClient', $this->data);
    }

    public function getAllPublicClosedTicket()
    {
        $this->data['title'] = 'Dernieres tickets résolues';
        $this->load->model('ticketsModel');
        $this->data['publicClosedTicket'] = $this->ticketsModel->getAllPublicClosedTicket();
        $this->load->view('clients/headerClient', $this->data);
        $this->load->view('clients/sideBarUser', $this->data);
        $this->load->view('clients/allPublicClosedTicket', $this->data);
        $this->load->view('clients/footerClient', $this->data);
    }

    public function ajouterTicket()
    {
        $this->data['title'] = 'Ajouter un ticket | Client';
        $this->load->view('clients/headerClient',$this->data);
        $this->load->view('clients/sideBarUser', $this->data);
        $this->load->view('clients/ajouterTickets', $this->data);
    }

    public function ticketAjouter(){
        $this->load->library('form_validation');
        $this->load->helper('date');
        $this->form_validation->set_rules('titre','Titre','required|xss_clean');
        $this->form_validation->set_rules('body','body','required|xss_clean');
        //$this->form_validation->set_rules('id_cat','body','required|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            $tick = array(
                'title'=>$this->input->post('titre'),
                'body'=>$this->input->post('body'),
                'statut'=>'0',
                'date_ticket'=>date('Y,m,d'),
                'parent'=>'0',
                'kind'=>'0',
                'visibility'=>$this->input->post('visibility'),
                'id_categorie'=>$this->input->post('category')
                );
            $this->ticketsModel->addTicket($tick);
            $resultat = $this->ticketsModel->lastTicket();
            foreach($resultat as $key)
            {
                $id = $key->id_ticket;
            }
            $tickUser = array(
                'id_users'=>$this->session->userdata('user_id'),
                'id_ticket'=>$resultat = $id
            );
            $this->ticketsModel->addTicketUser($tickUser);
            echo 'ticket ajouté';
        }
        else {
            echo validation_errors();
        }
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
                redirect("UserAdmin/edit_user/$user_id", 'refresh');
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
        $this->load->view('clients/headerClient', $this->data);
        $this->load->view('clients/sideBarUser', $this->data);
        $this->_render_page('clients/comptePersonnel', $this->data);
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

      public function resultatsolution()
 {
    $this->data['title'] = 'Resultat recherche | Client';
    $this->load->view('clients/headerClient', $this->data);
    $this->load->view('clients/sideBarUser', $this->data);
    $title_sol = $this->input->post('searchTic');
    $this->load->model('ticketsModel');
    $rdgdd =  $this->ticketsModel->resultat_recherche_body($title_sol);
    $this->data['resultatSolutionn'] = $rdgdd;
    $this->load->view('clients/resultatRechercheSolution', $this->data);
 }

    public function recherche_Sol()
    {
        $this->data['title'] = 'Recherche | Client';
        $this->load->view('clients/headerClient', $this->data);
        $this->load->view('clients/sideBarUser', $this->data);
        $this->load->view('clients/rechercherSolution', $this->data);
    }

    function get_ticketts(){
    $this->load->model('ticketsModel');
        if (isset($_GET['term'])){
          $q = strtolower($_GET['term']);
          $this->ticketsModel->get_ticket_completer($q);
        }
    }  

    function mesTickets()
    {
        $this->data['title'] = 'Mes tickets | Client';
        $this->load->view('clients/headerClient', $this->data);
        $this->load->view('clients/sideBarUser', $this->data);
        $this->user = $this->ion_auth->user()->row();
        $user_id = $this->user->id;
        $user_identifiant = $user_id;
        $this->load->model('ticketsModel');
        $mesTicks = $this->ticketsModel->getMesTicks($user_identifiant);
        $this->data['mesTicketss'] = $mesTicks;
        $this->load->view('clients/mesTickets', $this->data);
    }

    public function conversationTicketClient()
    {
        $this->data['title'] = 'Conversation | Client';
        $this->load->view('clients/headerClient', $this->data);
        $this->load->view('clients/sideBarUser', $this->data);
        $ident = $this->input->get('ticket_id', TRUE);
        $this->data['identifiantTicket']=$ident;
        $this->load->model('ticketsModel');
        $this->data['openTicketsParent'] = $this->load->ticketsModel->getTicketOpenedParent($ident);
        $this->data['ClosedTicketsParent'] = $this->load->ticketsModel->getTicketClosedParent($ident);
        $conv =  $this->load->ticketsModel->getTicketOpenedConversation($ident);
        $this->data['conversation'] = $conv;
        $this->load->view('clients/conversationTickClient', $this->data);

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
            $this->ticketsModel->addTicket($tick);
            $resultat = $this->ticketsModel->lastTicket();
            foreach($resultat as $key)
            {
                $id = $key->id_ticket;
            }
            $tickUser = array(
                'id_users'=>$this->session->userdata('user_id'),
                'id_ticket'=>$resultat = $id
            );
            $this->ticketsModel->addTicketUser($tickUser);
            redirect('UserAdmin/conversationTicketClient', $this->data);
        }
    }

    public function getTicketsPublic()
    {
        $this->data['title'] = 'Les tickets publiques | Client';
        $this->load->view('clients/headerClient', $this->data);
        $this->load->view('clients/sideBarUser', $this->data);
        $this->load->model('ticketsModel');
        $pubTicks = $this->ticketsModel->getTicketsPublic();
        $this->data['ticketsPublique'] = $pubTicks;
        $this->load->view('clients/ticketsPublic', $this->data);
    }
}