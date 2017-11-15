<?php (defined('BASEPATH')) OR exit('aNo direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Ancy Mathew
 * Date: 9/23/2016
 * Time: 9:18 PM
 */

class journal_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
        $this->load->database();

    }
    function journal_type_get()
    {
        $this->db->select('*');
        $this->db->from('tbl_journal_type');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    function journal_category_get()
    {
        $this->db->select('*');
        $this->db->from('tbl_journal_category');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    function journal_get()
    {
       // $query=$this->db->query("SELECT a.journal_master_id, a.pjct_master_id, a.journal_name, a.journal_type_id,a.journal_category_id,a.journal_status,b.journal_type_name,c.pjct_name FROM tbl_journal_master a,tbl_journal_type b,tbl_project_master c where a.journal_type_id=b.journal_type_id and a.pjct_master_id=c.pjct_master_id order by a.journal_master_id");
        $query=$this->db->query("SELECT a.journal_master_id, a.pjct_master_id, a.journal_name,a.journal_status, a.journal_type_id,a.journal_category_id,b.journal_type_name,c.pjct_name,c.pjt_cost,c.pjt_cost_mes FROM tbl_journal_master a,tbl_journal_type b,tbl_project_master c where a.journal_type_id=b.journal_type_id and a.pjct_master_id=c.pjct_master_id order by a.journal_master_id");
        $results= $query->result_array();
        return $results;
    }
    function journal_add($data)
    {
        $this->db->insert('tbl_journal_master', $data);
        return true;
    }
    function update_journal($id,$jrnl_name,$jrnl_type='',$projectId='',$category='')
    {
        $this->db->where('journal_master_id',$id);
        if($category!='' && $projectId!='' && $jrnl_type!=''){
            $this->db->set('journal_name',$jrnl_name );
            $this->db->set('journal_type_id',$jrnl_type );
            $this->db->set('journal_category_id',$category );
            $this->db->set('pjct_master_id',$projectId );
        }else{
            $this->db->set('journal_name',$jrnl_name );
        }
        $this->db->set('mod_by',$this->session->userdata('uid'));
        $this->db->set('mod_date',date('Y-m-d H:i:s') );
        $this->db->update('tbl_journal_master');
        return true;
    }
    function delete_journal($id)
    {
        $this->db->where('journal_master_id', $id);
        $this->db->delete('tbl_journal_master');
    }
    function get_journal_name($id)
    {
        $query=$this->db->query("SELECT  journal_name FROM tbl_journal_master where journal_master_id=$id");
        $result= $query->result_array();
        return $result;
    }
    function get_category_name($id)
    {
        $query=$this->db->query("SELECT journal_category_name FROM tbl_journal_category where journal_category_id=$id");
        $result= $query->result_array();
        return $result;
    }
    function get_journal_status($id)
    {
        $query=$this->db->query("SELECT  journal_status  FROM tbl_journal_master where journal_master_id=$id");
        $result= $query->result_array();
        return $result;

    }
    function get_slug_name($id)
    {
        $query=$this->db->query("SELECT a.slug FROM tbl_project_master a join tbl_journal_master b on a.pjct_master_id=b.pjct_master_id and journal_master_id=$id");
        $result= $query->result_array();
        return $result;

    }
    function get_slug_name_pro($id)
    {
        $query=$this->db->query("SELECT a.slug FROM tbl_project_master a join tbl_journal_master b on a.pjct_master_id=b.pjct_master_id and pjct_master_id=$id");
        $result= $query->result_array();
        return $result;

    }
    function count_journal_id($id){
        $this->db->from('tbl_journal_master');
        $this->db->where('journal_master_id', $id);
        $query = $this->db->get();
        $rowcount = $query->num_rows();
        return $rowcount;
    }
}