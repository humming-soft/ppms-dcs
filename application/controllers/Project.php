<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('project_Model');
        $this->load->model('synchronice_model');
        $this->load->library('session');
        $this->load->view("template/header");
        $this->load->view('template/frame');
        date_default_timezone_set('Asia/Calcutta'); // to set the time zone
    }

    public function list_project()
    {
        $data['records'] = $this->project_Model->project_get();
        //$data['allStation'] = $this->project_Model->project_get_station();
        foreach ( $data['records'] as $project )
        {
            $datap="";
            $data['stat']= $this->project_Model->project_stations($project->pjct_master_id);
            /*foreach ( $data['stat'] as $stat )
            {
                $datap.=$stat->station_master_id.",";
            }
            $data['stations'][$project->pjct_master_id]=$datap."777";*/
        }
        $this->load->view('project/list_project',$data);
        $this->load->view('template/footer');
    }
    public function list_stations()
    {
        $data['records'] = $this->project_Model->station_get();
        $data['category'] = $this->project_Model->category_get();
        $data['region'] = $this->project_Model->region_get();
        $this->load->view('project/list_stations',$data);
        $this->load->view('template/footer');
    }
    public function add_project()
    {
        $this->load->view('project/add_project');
        $this->load->view('template/footer');
    }
    public function add_station()
    {
        $data['category'] = $this->project_Model->category_get();
        $data['region'] = $this->project_Model->region_get();
        $this->load->view('project/add_stations',$data);
        $this->load->view('template/footer');
        //test
    }
    public function add_new_project()
    {
        $projrctname=strtoupper(trim($this->input->post("strProjectName")));
        $count= $this->project_Model->count_project($projrctname);
        $measure= $this->input->post("strMessureId");
        if($count>0){
            $this->session->set_flashdata('error', ' Project name is already existed.');
            $this->load->view('project/add_project');
            $this->load->view('template/footer');
        }else {

            $data = array('pjct_name' => $projrctname, 'pjct_desc' => $this->input->post("strProjectDesc"), 'pjct_from' => date("Y-m-d", strtotime($this->input->post("dateFrom"))), 'pjct_to' => date("Y-m-d", strtotime($this->input->post("dateTo"))), 'cont_name' => $this->input->post("strContractName"), 'has_parking' => 0, 'has_depot' => 0, 'created_by' => $this->session->userdata('uid'), 'created_date' => date('Y-m-d H:i:s'), 'modified_by' => $this->session->userdata('uid'), 'modified_date' => date('Y-m-d H:i:s') ,'pjt_cost'=>floatval($this->input->post("strPjtValue")),'pjt_cost_mes'=> $measure);
            $result = $this->project_Model->project_add($data);
            if ($result == true) {
                $this->session->set_flashdata('success', $projrctname . ' successfully added ');
                redirect('project/list_project', 'refresh');
            } else {
                $this->session->set_flashdata('error', 'project not added.');
                redirect('project/list_project', 'refresh');
            }
        }
    }
    public function add_new_station()
    {
        $this->load->helper(array('form'));
        $this->load->library('form_validation');
        $this->form_validation->set_rules('strStationName', 'station name ', 'trim|required|min_length[2]|max_length[80]');
        $this->form_validation->set_rules('intRegionId', 'Region','required');
        $this->form_validation->set_rules('intCategoryId', 'Category','required');
        if ($this->form_validation->run() == FALSE) {
            $this->add_station();
        }
        else {
            if($this->input->post("isActive")==1){
                $isActive=$this->input->post("isActive");
            }else{
                $isActive=0;
            }
            $data = array('spd_name' =>$this->input->post("strStationName"),'region_master_id' =>$this->input->post("intRegionId"),'category_type_id' => $this->input->post("intCategoryId"),'is_active'=>$isActive, 'cre_by' =>$this->session->userdata('uid'), 'crea_date'=>date('Y-m-d H:i:s'),'mod_by'=>$this->session->userdata('uid'), 'mod_date'=>date('Y-m-d H:i:s'));
            $result = $this->project_Model->station_add($data);
            if($result==true){
                $this->session->set_flashdata('success', $this->input->post("strStationName") . ' successfully added ');
                redirect('project/list_stations', 'refresh');
            }else{
                $this->session->set_flashdata('error', 'station is not added.');
                $this->load->view('project/add_stations');
                $this->load->view('template/footer');
            }
        }
    }
    public function add_update_station()
    {
        $id=$this->input->post("projectMasterId");
        $target['station'] = $this->input->post("station");
        $cre_by = $this->session->userdata('uid');
        $crea_date = date('Y-m-d H:i:s');
        $mod_date = date('Y-m-d H:i:s');
        $mod_by = $this->session->userdata('uid');
        $row=$this->project_Model->get_project($id);
        foreach ($row as $row):
            $projname=trim($row['pjct_name']);
        endforeach;
        $count= $this->project_Model->count_station($id);
        if($count==0){
            foreach($target['station'] as $tar){
                $res = $this->project_Model->add_update_station($id,$tar, $cre_by, $crea_date, $mod_by, $mod_date);
            }
            if($res){
                $this->session->set_flashdata('success',' stations are successfully added  into project  '.$projname );
                redirect('project/list_project', 'refresh');
            }
        }
        if($count>0){
            $result=$this->project_Model->delete_project_station($id);
                foreach($target['station'] as $tar){
                    $res = $this->project_Model->add_update_station($id,$tar, $cre_by, $crea_date, $mod_by, $mod_date);
                }
            if($res){
                $this->session->set_flashdata('success', $projname.'  stations are successfully updated ');
                redirect('project/list_project', 'refresh');
            }
        }

    }
    public function delete_project(){
        $id= $this->input->post('id');
        $row=$this->project_Model->get_project($id);
        foreach ($row as $row):
            $projectname=trim($row['pjct_name']);
        endforeach;
        $result=$this->project_Model->project_delete($id);
        if($this->project_Model->count_project_id($id)==0){
            $this->session->set_flashdata('success', $projectname . ' details successfully deleted ');
        }else{
            $this->session->set_flashdata('error', ' deletion  is failed.');
        }
    }
    public function delete_station(){
        $id= $this->input->post('id');
        $row=$this->project_Model->get_station_name($id);
        foreach ($row as $row):
            $stationname=trim($row['spd_name']);
        endforeach;
        $result=$this->project_Model->station_delete($id);
        if($this->project_Model->count_station_id($id)==0){
            $this->session->set_flashdata('success', $stationname. ' details successfully deleted ');
        }else{
            $this->session->set_flashdata('error', ' deletion  is failed.');
        }
    }
    public function update_project(){
        $id= $this->input->post('projectId');
        $pjct_name=$this->input->post("strProjectName");
        $pjct_desc=$this->input->post("strProjectDesc");
        $pjct_from = $this->input->post("dateFrom");
        $pjct_to=$this->input->post("dateTo");
        $cont_name=$this->input->post("strContractName");
        $pjt_cost=floatval($this->input->post("strPjtValue"));
        $pjt_measure=$this->input->post("strMessureId");
        $has_parking=0;
        $has_depot=0;
        $modified_by=$this->session->userdata('uid');
        $modified_date=date('Y-m-d H:i:s');
        $result=$this->project_Model->update_project($id,$pjct_name,$pjct_from,$pjct_to,$pjct_desc,$cont_name,$has_parking,$has_depot,$modified_by,$modified_date,$pjt_cost,$pjt_measure );
        if($result==true){
            $this->session->set_flashdata('success', $this->input->post("strProjectName") . ' details successfully updated ');
            redirect('project/list_project', 'refresh');
        }
        else
        {
            $this->session->set_flashdata('error', ' updation is failed.');
            redirect('project/list_project', 'refresh');
        }
    }
    public function update_station(){
        if($this->input->post("isActive")==1){
            $isActive=$this->input->post("isActive");
        }else{
            $isActive=0;
        }
        $id= $this->input->post('stationId');
        $station_name= $this->input->post("strStationName");
        $regionId=$this->input->post("intRegionId");
        $categoryId = $this->input->post("intCategoryId");
        $modified_by=$this->session->userdata('uid');
        $modified_date=date('Y-m-d H:i:s');
        $result=$this->project_Model->update_station($id,$station_name,$regionId,$isActive,$categoryId,$modified_by,$modified_date);
        if($result==true){
            $this->session->set_flashdata('success', $this->input->post("strStationName") . ' details successfully updated ');
            redirect('project/list_stations', 'refresh');
        }
        else
        {
            $this->session->set_flashdata('error', ' updation is failed.');
            redirect('project/list_stations', 'refresh');
        }
    }


    //PADU
  
    //END
}