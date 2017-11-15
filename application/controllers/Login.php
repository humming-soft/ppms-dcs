<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('common_model');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        date_default_timezone_set('Asia/Calcutta'); // to set the time zone
    }

    /**
     * @jane
     * date:12/09/2016
     * Parameter:none
     * Return type:
     * Description: This function is for redirecting to the landing page
     */
    public function index()
    {
        $this->load->view('login/login');
    }

    /**
     * @jane
     * date:12/09/2016
     * Parameter:none
     * Return type:
     * Description: This function is for login the users
     */
    public function login()
    {
        $this->form_validation->set_rules('username','User name','trim|required');
        $this->form_validation->set_rules('password','Password','trim|required');
        $username = strtolower($this->input->post("username"));
        $password = $this->input->post("password");

        if ($this->form_validation->run() == TRUE)
        {
            $result = $this->common_model->validate_login($username, $password);
            if($result)
            {
                $this->session->set_userdata(array(
                    'loggedin' => true,
                    'uid' => $result["id"],
                    'username'=> $result["username"],
                    'fullname'=> $result["fullname"],
                    'lastlogin' => $result["lastlogin"],
                    'usergroup' => $result["user_group"]
                ));
                redirect(base_url('project/list_project'), 'refresh');
            } else {
				//$data['msg'] = '<div class="alert alert-danger" role="alert"><i class="fa fa-fw fa-close text-danger m-r-1"></i><strong>Oh Snap!</strong>Change a few things up and try submitting again.</div>';
                $data['msg'] = '<div class="alert no-bg b-l-danger b-l-3 b-t-gray b-r-gray b-b-gray" role="alert"><strong class="text-white">Oh Snap! </strong><span class="text-gray-lighter">Change a few things up and try submitting again.</span></div>';
                $this->load->view('login/login',$data);
            }
        }else{
            $this->load->view('login/login');
        }
    }

    /**
     * @jane
     * date:12/09/2016
     * Parameter:none
     * Return type:
     * Description: This function is for logout the users
     */
    public function logout()
    {
        $this->load->view('login/login');
    }
}