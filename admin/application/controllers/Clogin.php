<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Clogin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('security');
        $this->load->model('Mpetugas');
    }

    public function index() {
        $this->load->view('login');
    }

    public function auten() {
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            if (isset($this->session->userdata['logged_in'])) {
                redirect(site_url('admin'));
            } else {
                redirect(site_url('login'));
            }
        } else {
            $data_login = array(
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password')
            );
            $result = $this->Mpetugas->login($data_login);
            if ($result == TRUE) {
                $username = $this->input->post('username');
                $result = $this->Mpetugas->read_user_information($username);
                if ($result != false) {
                    $session_data = array(
                        'idptgs' => $result[0]->iduser,  
                        'level' => $result[0]->jabatan,
                        'toko' => $result[0]->idtoko
                    );
                    $this->session->set_userdata('logged_in', $session_data);
                    $data = array(
                        'pesan' => "sukses",
                        'level'=>$result[0]->jabatan
                    );
                    echo json_encode($data);
                }
            } else {
                $data = array(
                    'pesan' => "<i class='glyphicon glyphicon-alert'></i> Username atau Paswword Salah",
                );
                echo json_encode($data);
            }
        }
    }

    public function logout() {
        $sess_array = array(
            'username' => ''
        );
        $this->session->unset_userdata('logged_in', $sess_array);
        redirect(site_url('login'));
    }

}
