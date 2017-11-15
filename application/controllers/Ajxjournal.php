<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajxjournal extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('project_Model');
        $this->load->model('journal_model');
        $this->load->library('session');
        date_default_timezone_set('Asia/Calcutta'); // to set the time zone
    }

    /*public function delete_journal(){
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
    }*/
}