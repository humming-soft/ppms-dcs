<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Journal extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('project_Model');
        $this->load->model('journal_model');
        $this->load->library('session');
        $this->load->view("template/header");
        $this->load->view('template/frame');
        date_default_timezone_set('Asia/Calcutta'); // to set the time zone
    }
    public function list_journals()
    {
       
        $data['records'] = $this->project_Model->project_get();
        $data['journalType'] = $this->journal_model->journal_type_get();
        $data['journal'] = $this->journal_model->journal_get();
        $data['category']=$this->journal_model->journal_category_get();
        $this->load->view('journal/list_journals',$data);
        $this->load->view('template/footer');;
    }
    public function add_journal()
    {
        $data['records'] = $this->project_Model->project_get();
        $data['journalType'] = $this->journal_model->journal_type_get();
        $data['category']=$this->journal_model->journal_category_get();
        $this->load->view('journal/add_journal',$data);
        $this->load->view('template/footer');;
    }
    public function add_new_journal()
    {
        $data = array('pjct_master_id' =>$this->input->post("intPjtId"),'journal_name' =>$this->input->post("strJournal"),'journal_type_id' => $this->input->post("intJournalType"),'journal_category_id'=>$this->input->post("intCatId"),'journal_status'=>0,'cre_by' => $this->session->userdata('uid'),'cre_date' => date('Y-m-d H:i:s'),'mod_by'=>$this->session->userdata('uid'),'mod_date' => date('Y-m-d H:i:s'));
        $result = $this->journal_model->journal_add($data);
        if($result==true){
            $this->session->set_flashdata('success', 'Journal '. $this->input->post("strJournal") . ' successfully added ');
            redirect('journal/list_journals', 'refresh');
        }else{
            $this->session->set_flashdata('error', 'Journal not added.');
            redirect('journal/add_journal', 'refresh');
        }
    }
    public function update_journal(){
        $id= $this->input->post('journalId');
        $row=$this->journal_model->get_journal_status($id);
        foreach ($row as $row):
            $journalstatus=trim($row['journal_status']);
        endforeach;
        if($journalstatus==0){
            $result=$this->journal_model->update_journal($id,$this->input->post("strJournal"),$this->input->post("intJournalType"),$this->input->post("intPjtId"),$this->input->post("intCatId"));
        }else{
            $result=$this->journal_model->update_journal($id,$this->input->post("strJournal"));
        }
        if($result==true){
            $this->session->set_flashdata('success','Journal '. $this->input->post("strJournal") . ' successfully updated');
            redirect('journal/list_journals', 'refresh');
        }else{
            $this->session->set_flashdata('error','Journal '. $this->input->post("strJournal") .'  updation failed.');
            redirect('journal/add_journal', 'refresh');
        }
    }
    public function delete_journal(){
        $id= $this->input->post('id');
        $row=$this->journal_model->get_journal_name($id);
        foreach ($row as $row):
            $journalname=trim($row['journal_name']);
        endforeach;
        $result=$this->journal_model->delete_journal($id);
        if($this->journal_model->count_journal_id($id)==0){
            $this->session->set_flashdata('success','Journal '. $journalname . ' details successfully deleted ');
        }else{
            $this->session->set_flashdata('error', 'Journal '. $journalname .' deletion failed.');
        }
    }
}