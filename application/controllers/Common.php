<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->view("template/header");
        $this->load->view('template/frame');
        /*$this->form_validation->set_error_delimiters('<div class="error">', '</div>');*/
        date_default_timezone_set('Asia/Calcutta'); // to set the time zone
    }

    public function index()
    {
        $this->load->view('template/dashboard');
        $this->load->view('template/footer');
    }
    public function form2()
    {
        $this->load->view('forms2');
        $this->load->view('template/footer');
    }

    public function imageupload()
    {
        $this->load->view('image_upload',array('error' => ' ','success' => ' ' ));
        $this->load->view('template/footer');
    }
public function validation()
{
    $this->load->view('validation');
    $this->load->view('template/footer');			
}
public function form4()
{
    $this->load->view('forms');
}
 function get_label($objid)
    {
        $this->db->where('sec_obj_id', $objid);
        $query = $this->db->get('sec_object');
        $rows = $query->result();
        $label='';
        foreach ($rows as $row):
            $label=$row->sec_obj_desc;
        endforeach;
        return $label;
    }

}
