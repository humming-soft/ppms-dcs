<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajxproject extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('project_Model');
        $this->load->model('journal_model');
        $this->load->library('session');
        date_default_timezone_set('Asia/Calcutta'); // to set the time zone
    }
   /* public function add_new_project()
    {
        $projrctname=strtoupper(trim($this->input->post("strProjectName")));
        $count= $this->project_Model->count_project($projrctname);
        if($count>0){
            $this->session->set_flashdata('error', ' Project name is already existed.');
            $this->load->view('project/add_project');
            $this->load->view('template/footer');
        }else {
            $data = array('pjct_name' => $projrctname, 'pjct_desc' => $this->input->post("strProjectDesc"), 'pjct_from' => date("Y-m-d", strtotime($this->input->post("dateFrom"))), 'pjct_to' => date("Y-m-d", strtotime($this->input->post("dateTo"))), 'cont_name' => $this->input->post("strContractName"), 'has_parking' => $this->input->post("intParking"), 'has_depot' => $this->input->post("intDepot"), 'created_by' => $this->session->userdata('uid'), 'created_date' => date('Y-m-d H:i:s'), 'modified_by' => $this->session->userdata('uid'), 'modified_date' => date('Y-m-d H:i:s'));
            $result = $this->project_Model->project_add($data);
            if ($result == true) {
                $data["status"] ='success';
                $data["journal"] =$journalname;
                $data["url"]=base_url() . 'project/list_project/';
                echo json_encode($data);
            } else {
                redirect('project/list_project', 'refresh');
            }
        }
    }*/
    public function delete_journal(){
        $id = $_POST['userid'];
        $row=$this->journal_model->get_journal_name($id);
        foreach ($row as $row):
            $journalname=trim($row['journal_name']);
        endforeach;
        $result=$this->journal_model->delete_journal($id);
        if($this->journal_model->count_journal_id($id)==0){
            $data["status"] ='success';
            $data["journal"] =$journalname;
            $data["url"]=base_url() . 'journal/list_journals/';
            echo json_encode($data);
        }else{
            $data["status"] ='error';
            echo json_encode($data);
        }
    }
}