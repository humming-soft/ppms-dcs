<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Syncronice extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('synchronice_model');
        $this->load->model('journal_model');
        $this->load->model('project_Model');
        $this->load->library('session');
        date_default_timezone_set('Asia/Calcutta'); // to set the time zone
    }

    public  function synchdb($id=FALSE){

        $date = date("Y-m-d");
        $syn_date=date('Y-m-d H:i:s');
        if($id > 0){
            $pjctslug =$this->journal_model->get_slug_name_pro($id);
            foreach ($pjctslug as $row1):
                $slugName = $row1['slug'];
            endforeach;
            $dashboard =$this->builddash($slugName);

            $result=$this->synchronice_model->updateDB($slugName, $dashboard, $date);
            $result=$this->project_Model->update_project_sync($syn_date);
            if($result==true){
                $this->session->set_flashdata('success', $this->input->post("strProjectName") . 'successfully Synchroniced ');
                redirect('project/list_project', 'refresh');
            }
            else
            {
                $this->session->set_flashdata('error', ' Syncronication is failed.');
                redirect('project/list_project', 'refresh');
            }
        }
        else{
            $result1=$this->synchronice_model->get_slug();
            foreach ( $result1 as $slug )
            {
                switch ($slug->category) {
                    case 1:
                        $dashboard =$this->builddash($slug->slug);
                        $result=$this->synchronice_model->updateDB($slug->slug, $dashboard, $date);
                        break;
                    default:
                        echo "Nothing to run";
                }
            }

        }

        $result=$this->project_Model->update_all_project_sync($syn_date);
        if($result==true){
            $this->session->set_flashdata('success', $this->input->post("strProjectName") . 'successfully Synchroniced ');
            redirect('project/list_project', 'refresh');
        }
        else
        {
            $this->session->set_flashdata('error', ' Syncronication is failed.');
            redirect('project/list_project', 'refresh');
        }
    }
    public function builddash($slug){
        $up_coming =$this-> upcoming($slug);
        $late_task =$this-> late($slug);
        $issue = $this->issue($slug);
        $parking = $this->parking($slug);
         $wbs_summery =$this-> wbs($slug);
         $progress_cost = $this->progres_cost($slug);
         $scurve = $this->scurve($slug);
        if(sizeof($progress_cost['value'])>0 ) {
            foreach ($progress_cost['value'] as $q) {
                $balance=$q[0];
                $earned=$q[1];
            }
            $progress_cost_arr = array(
                'date' =>$progress_cost['date'] ,
                'balance'=>$balance,
                'earned'=>$earned
            );
        }
        if(sizeof($wbs_summery['wbs'])>0 ) {
            $subject = array();
            $sub_val = array();
            foreach ($wbs_summery['wbs'] as $q) {
                if ($q[0] != "")
                    $subject[] = $q[0];
                if ($q[1] != "")
                    $sub_val[] = (float)$q[1];
            }
            $wbs_summary_arr = array(
                'date' =>$wbs_summery['date'] ,
                'wbs_sub'=>$subject,
                'wbs_num'=>$sub_val
            );
        }
        //SCURVE
        if(sizeof($scurve['scurve'])>0 ) {
            $actual = array();
            $late = array();
            $early = array();
            $interval = array();
            foreach ($scurve['scurve'] as $q) {
                    $interval[] = $q[0];
                if ($q[1] != "")
                    $early[] = (float)$q[1];
                if ($q[2] != "")
                    $late[] = (float)$q[2];
                if ($q[3] != "")
                    $actual[] = (float)$q[3];

            }
            $lenghact=sizeof($actual);
            $index=$lenghact-1;
            $scurvearr = array(
                'date' =>$scurve['date'] ,
                'interval'=>$interval,
                'actualData' => $actual,
                'earlyData' => $early,
                'delayedData' => $late,
                'currentEarly' => $scurve['scurve'][$index][1] . '%',
                'currentLate' => $scurve['scurve'][$index][2] . '%',
                'currentActual' => $scurve['scurve'][$index][3] . '%',
                'varEarly' =>round(($scurve['scurve'][$index][3] - $scurve['scurve'][$index][1]),2) .'%',
                'varLate' => round(($scurve['scurve'][$index][3] - $scurve['scurve'][$index][2]),2) .'%',
                'chartType' => "long",
                'viewType' => "2",
            );
        }
        $finalUP = array("padu_upcomingtask" => $up_coming);
        $finalLATE = array("padu_latetask" => $late_task);
        $finalISSUE = array("padu_issuemitigation" => $issue);
        $finalSUMMERY = array("padu_wbs" => $wbs_summary_arr);
        $finalPROGRESS=array("padu_projectcost" => $progress_cost_arr);
        $finalPARK=array("padu_parking" => $parking);
        $finalSCURVE = array("scurve" => $scurvearr);
        $superFinal = array($slug => array_merge($finalUP, $finalLATE, $finalISSUE,$finalSUMMERY,$finalPROGRESS,$finalSCURVE,$finalPARK));
        return json_encode($superFinal);
    }
    /**
     * KPI(QRM)
     * @param $slug
     * @return Array
     * @Desc
     */
    function upcoming($slug){
        $result1=$this->synchronice_model->get_maxdate_up($slug);
            foreach ( $result1 as $result ) {
                $date = $result['maxdate'];
            }
          $upcoming = array();
          $upcoming1 = array();
           if($date != ""){
            $result2 =$this->synchronice_model->getupcoming($slug,$date);

            foreach($result2 as $q){
                $upcoming1[] = array($q['up_task'], $q['duration'], $q['start_date'], $q['end_date']);
            }
            $upcoming['date']=array(date('d-F-Y', strtotime($date)));
            $upcoming['value']=$upcoming1;
           }else{
               $upcoming['date']="";
               $upcoming['value']="";
           }
            return $upcoming;
    }
    function late($slug){
        $result1=$this->synchronice_model->get_maxdate_late($slug);
        foreach ( $result1 as $result ) {
            $date = $result['maxdate'];
        }
        $late = array();
        $late1 = array();
        if($date != ""){
            $result2 =$this->synchronice_model->getlate($slug,$date);

            foreach($result2 as $q){
                $late1[] = array($q['late_task'], $q['duration'], $q['start_date'], $q['end_date']);
            }
            $late['date']=array(date('d-F-Y', strtotime($date)));
            $late['value']=$late1;
        }else{
            $late['date']="";
            $late['value']="";
        }

        return $late;
    }
    function parking($slug){
        $result1=$this->synchronice_model->get_maxdate_park($slug);
        foreach ( $result1 as $result ) {
            $date = $result['maxdate'];
        }
        $park = array();
        $park1 = array();
        if($date != ""){
            $result2 =$this->synchronice_model->getpark($slug,$date);

            foreach($result2 as $q){
                $park1[] = array($q['park_date'], $q['park_by'], $q['issue'], $q['scope'],$q['action_park'],$q['remark']);
            }
            $park['date']=array(date('d-F-Y', strtotime($date)));
            $park['value']=$park1;
        }else{
            $park['date']="";
            $park['value']="";
        }

        return $park;
    }
    function issue($slug){
        $result1=$this->synchronice_model->get_maxdate_issue($slug);
        foreach ( $result1 as $result ) {
            $date = $result['maxdate'];
        }
        $issue = array();
        $issue1 = array();
        if($date != ""){
            $result2 =$this->synchronice_model->getissue($slug,$date);
            foreach($result2 as $q){
                $issue1[] = array($q['issue_date'],$q['issue'], $q['mitigation']);
            }
            $issue['date']=array(date('d-F-Y', strtotime($date)));
            $issue['value']=$issue1;
        }else{
            $issue['date']="";
            $issue['value']="";
        }
        return $issue;
    }
    function wbs($slug){
        $result1=$this->synchronice_model->get_maxdate_wbs($slug);
        foreach ( $result1 as $result ) {
            $date = $result['maxdate'];
        }
        $wbs = array();
        $wbs1 = array();
        if($date != ""){
            $result2 =$this->synchronice_model->getwbs($slug,$date);
            foreach($result2 as $q){
                $wbs1[] = array($q['subject'], $q['sub_value']);
            }
            $wbs['date']=array(date('d-F-Y', strtotime($date)));
            $wbs['wbs']=$wbs1;
        }else{
            $wbs['date']="";
            $wbs['wbs']="";
        }
        return $wbs;
    }
    function progres_cost($slug){
        $result1=$this->synchronice_model->get_maxdate_cost($slug);
        foreach ( $result1 as $result ) {
            $date = $result['maxdate'];
        }
        $cost = array();
        $cost1 = array();
        if($date != ""){
            $result2 =$this->synchronice_model->getprogresscost($slug,$date);
            foreach($result2 as $q){
                $cost1[] = array($q['balance'], $q['earned']);
            }
            $cost['date']=array(date('d-F-Y', strtotime($date)));
            $cost['value']=$cost1;
        }else{
            $cost['date']="";
            $cost['value']="";
        }
        return $cost;
    }
    function scurve($slug){
        $result1=$this->synchronice_model->get_maxdate_scurve($slug);
        foreach ( $result1 as $result ) {
            $date = $result['maxdate'];
        }
        $scurve = array();
        $scurve1 = array();
        if($date != ""){
            $result2 =$this->synchronice_model->getscurve($slug);

            foreach($result2 as $q){
                $scurve1[] = array($q['scurve_time'], $q['early_perc'], $q['late_perc'], $q['actual_perc']);
            }
            $scurve['date']=array(date('d-F-Y', strtotime($date)));
            $scurve['scurve']=$scurve1;
        }else{
            $scurve['date']="";
            $scurve['scurve']="";
        }
        return $scurve;
    }
}