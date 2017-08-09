<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeAdmin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ticketsModel');
        $this->load->helper( 'gravatar' );
       // $this->load->helper('url');
        //$this->load->helper('database');
    }

    public function index()
    {
        $this->donnees['title'] = 'Accueil';
        $this->load->view('headerAdmin', $this->donnees);
        $this->sess['login_name'] = $this->session->userdata('user_agent');
        $this->load->view('sideBarAdmin', $this->sess);
        $rowNumb = $this->load->ticketsModel->getRowsNumberTicket();
        $data['rowNumbb'] = $rowNumb;
        $this->load->view('homeAdmin', $data);
    }

    
}
