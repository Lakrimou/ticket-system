<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tickets extends MY_Controller
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

    public function getAllTickets()
    {
        $this->data['title'] = 'Tous les tickets';
        $this->load->view('headerAdmin', $this->data);
        $this->load->view('sideBarAdmin');
        $all = $this->ticketsModel->getAllTickets();
        $this->donnees['allTicketts'] = $all;
        $this->load->view('allTickets', $this->donnees);
    }

    public function getTicketsClosed()
    {
        $this->data['title'] = 'Tickets Fermées';
        $this->load->view('headerAdmin', $this->data);
        $this->load->view('sideBarAdmin');
        $close = $this->ticketsModel->getTicketClosed();
        $this->donnees['closeedTickets'] = $close;
        $this->load->view('closedTickets', $this->donnees);
    }

    public function getTicketsOpened()
    {
        $this->data['title'] = 'Tickets Ouvertes';
        $this->load->view('headerAdmin', $this->data);
        $this->load->view('sideBarAdmin');
        $open = $this->ticketsModel->getTicketOpened();
        $this->donnees['openedTicketts'] = $open;
        $this->load->view('openedTickets', $this->donnees);
    }

    public function ajouterTicket()
    {
        $this->data['title'] = 'Ajouter une ticket';
        $this->load->view('clients/ajouterTickets', $this->data);
    }

    public function ticketAjouter(){
        $this->load->library('form_validation');
        $this->load->helper('date');
        $this->form_validation->set_rules('titre','Titre','required|xss_clean');
        $this->form_validation->set_rules('body','body','required|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            $tick = array(
                'title'=>$this->input->post('titre'),
                'body'=>$this->input->post('body'),
                'statut'=>1,
                'date_ticket'=>date('Y,m,d'),
                'parent'=>1,
                'kind'=>1,
                'visibility'=>0
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
            echo 'ticket ajouté';
        }
        else {
            echo validation_errors();
        }
    }


    public function conversationTicket()
    {
        $this->data['title'] = 'Conversation | Admin';
        $this->load->view('headerAdmin', $this->data);
        $this->load->view('sideBarAdmin', $this->data);
        $ident = $this->input->get('ticket_id', TRUE);
        $this->data['identifiantTicket']=$ident;
        $this->load->model('ticketsModel');
        $this->data['openTicketsParent'] = $this->load->ticketsModel->getTicketOpenedParent($ident);
        $this->data['ClosedTicketsParent'] = $this->load->ticketsModel->getTicketClosedParent($ident);
        $conv =  $this->load->ticketsModel->getTicketOpenedConversation($ident);
        $this->data['conversation'] = $conv;
        
        /*foreach($conv as $key) {
            $userNameRepli = array();
            $id_tick = $key['id_ticket'];
            $userNameRepli[] = $this->load->ticketsModel->userReplique($id_tick);    
        }
        $this->data['usernames'] = $userNameRepli;*/
        $this->load->view('conversationTick', $this->data);

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
            redirect('tickets/conversationTicket', $this->data);
        }
    }
}