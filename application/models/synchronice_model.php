<?php (defined('BASEPATH')) OR exit('aNo direct script access allowed');

class synchronice_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

        $this->load->database();
    }

    function get_slug(){
        $this->db->select('*');
        $this->db->from('ref_slug');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    function get_maxdate($slug){
        $slug1=strtoupper($slug);
        $query=$this->db->query("SELECT  MAX(data_date) as maxdate FROM tbl_upcoming_task where slug='$slug' or slug='$slug1'");
        $result= $query->result_array();
        return $result;

    }
    function get_maxdate_up($slug){
        $slug1=strtoupper($slug);
        $query=$this->db->query("SELECT  MAX(data_date) as maxdate FROM tbl_upcoming_task where slug='$slug' or slug='$slug1'");
        $result= $query->result_array();
        return $result;

    }
    function get_maxdate_late($slug){
        $slug1=strtoupper($slug);
        $query=$this->db->query("SELECT  MAX(data_date) as maxdate FROM tbl_late_task where slug='$slug' or slug='$slug1'");
        $result= $query->result_array();
        return $result;

    }
    function get_maxdate_wbs($slug){
        $slug1=strtoupper($slug);
        $query=$this->db->query("SELECT  MAX(data_date) as maxdate FROM tbl_wbs where slug='$slug' or slug='$slug1'");
        $result= $query->result_array();
        return $result;

    }
    function get_maxdate_cost($slug){
        $slug1=strtoupper($slug);
        $query=$this->db->query("SELECT  MAX(data_date) as maxdate FROM tbl_progress_cost where slug='$slug' or slug='$slug1'");
        $result= $query->result_array();
        return $result;

    }
    function get_maxdate_scurve($slug){
        $slug1=strtoupper($slug);
        $query=$this->db->query("SELECT  MAX(data_date) as maxdate FROM tbl_padus_curve where slug='$slug' or slug='$slug1'");
        $result= $query->result_array();
        return $result;

    }
    function get_maxdate_issue($slug){
        $slug1=strtoupper($slug);
        $query=$this->db->query("SELECT  MAX(data_date) as maxdate FROM tbl_issue_mitigation where slug='$slug' or slug='$slug1'");
        $result= $query->result_array();
        return $result;

    }
    function getupcoming($slug,$date){
        $slug1=strtoupper($slug);
        $query=$this->db->query("SELECT  up_task,duration,start_date,end_date FROM tbl_upcoming_task where (slug='$slug' or slug='$slug1') and data_date='$date'");
        $result= $query->result_array();
        return $result;

    }
    function getlate($slug,$date){
        $slug1=strtoupper($slug);
        $query=$this->db->query("SELECT  late_task, duration, start_date, end_date FROM tbl_late_task where (slug='$slug' or slug='$slug1') and data_date='$date'");
        $result= $query->result_array();
        return $result;

    }
    function getissue($slug,$date){
        $slug1=strtoupper($slug);
        $query=$this->db->query("SELECT  issue_date, mitigation FROM tbl_issue_mitigation where (slug='$slug' or slug='$slug1') and data_date='$date'");
        $result= $query->result_array();
        return $result;

    }
    function getwbs($slug,$date){
        $slug1=strtoupper($slug);
        $query=$this->db->query("SELECT subject, sub_value FROM tbl_wbs where (slug='$slug' or slug='$slug1') and data_date='$date'");
        $result= $query->result_array();
        return $result;

    }
    function getprogresscost($slug,$date){
        $slug1=strtoupper($slug);
        $query=$this->db->query("SELECT balance,earned FROM tbl_progress_cost where (slug='$slug' or slug='$slug1') and data_date='$date'");
        $result= $query->result_array();
        return $result;

    }
    function getscurve($slug,$date){
        $slug1=strtoupper($slug);
        $query=$this->db->query("SELECT scurve_time, early_perc,late_perc, actual_perc FROM tbl_padus_curve where (slug='$slug' or slug='$slug1') and data_date='$date'");
        $result= $query->result_array();
        return $result;

    }
    function updateDB($slug, $value, $date){
            $this->db->from('items');
            $this->db->where("slug", $slug);
            $query = $this->db->get();
            $item = $query->row_array();
        if($item){
            $id = ($item['id']);
            $name = ($item['name']);
            $this->db->from('data_sources');
            $this->db->where("item_id = $id AND date = '$date'");
            $query = $this->db->get();
            $datax = $query->row_array();
            if($datax){
                $this->db->where('date',$date);
                $this->db->set('value',$value);
                $this->db->update('data_sources');
            }else{ //new row
                $d = array("item_id" => $id , "value" => $value, "date" => $date, "name" => $name);
                $this->db->insert('data_sources', $d);
            }
        }
    }
}