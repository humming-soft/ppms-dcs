<?php (defined('BASEPATH')) OR exit('aNo direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Ancy Mathew
 * Date: 9/23/2016
 * Time: 9:18 PM
 */

class project_Model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
        $this->load->database();

    }
    // Inserting in Table Data Attribute
    function project_add($data)
    {
            $this->db->insert('tbl_project_master', $data);
            return true;
    }
    function station_add($data)
    {
        $this->db->insert('tbl_stations', $data);
        return true;
    }
    function project_get()
    {
        $this->db->select('*');
        $this->db->from('tbl_project_master');
        $this->db->order_by('pjct_master_id', 'asc');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    function station_get()
    {
        $query=$this->db->query("SELECT a.category_type_name,b.spd_name,c.region_name, b.is_active,b.station_master_id,b.category_type_id,b.region_master_id,b.is_active  FROM tbl_category_type a,tbl_stations b,tbl_region_master c where a.category_type_id=b.category_type_id  and b.region_master_id=c.region_master_id order by b.station_master_id");
        $results= $query->result_array();
        return $results;
    }
    function category_get(){
        $this->db->select('*');
        $this->db->from('tbl_category_type');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    function region_get(){
        $this->db->select('*');
        $this->db->from('tbl_region_master');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    function project_get_station(){
        $this->db->select('*');
        $this->db->from('tbl_stations');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    function project_delete($id)
    {
        $this->db->where('pjct_master_id', $id);
        $this->db->delete('tbl_project_master');
    }
    function station_delete($id)
    {
        $this->db->where('station_master_id', $id);
        $this->db->delete('tbl_stations');
    }
    function project_stations($id)
    {
        $query ="SELECT station_master_id FROM tbl_project_sub where pjct_master_id=$id";
        $query = $this->db->query($query);
        $query_result = $query->result();
        return $query_result;
    }
    function update_project_sync($id,$modified_date)
    {
        $this->db->where('pjct_master_id',$id);
        $this->db->set('syn_date',$modified_date );
        $this->db->update('tbl_project_master');
        return true;
    }
    function update_all_project_sync($modified_date)
    {
        $sql = "UPDATE tbl_project_master SET syn_date = '$modified_date' WHERE pjct_master_id >1;";
        $this->db->query($sql);
        return true;
    }
    function update_project($id,$pjct_name,$pjct_from,$pjct_to,$pjct_desc,$cont_name,$has_parking,$has_depot,$modified_by,$modified_date,$pjt_cost,$pjt_measure)
    {
        $this->db->where('pjct_master_id',$id);
        $this->db->set('pjct_name',$pjct_name );
        $this->db->set('pjct_desc',$pjct_desc );
        $this->db->set('pjct_from',$pjct_from );
        $this->db->set('pjct_to',$pjct_to );
        $this->db->set('cont_name',$cont_name );
        $this->db->set('pjt_cost',$pjt_cost );
        $this->db->set('pjt_cost_mes',$pjt_measure );
        $this->db->set('has_parking',$has_parking );
        $this->db->set('has_depot',$has_depot );
        $this->db->set('modified_by',$modified_by );
        $this->db->set('modified_date',$modified_date );
        $this->db->update('tbl_project_master');
        return true;
    }
    function update_station($id,$station_name,$regionId,$isActive,$categoryId,$modified_by,$modified_date)
    {
        $this->db->where('station_master_id',$id);
        $this->db->set('spd_name',$station_name );
        $this->db->set('category_type_id',$categoryId );
        $this->db->set('region_master_id',$regionId );
        $this->db->set('is_active',$isActive );
        $this->db->set('mod_by',$modified_by );
        $this->db->set('mod_date',$modified_date );
        $this->db->update('tbl_stations');
        return true;
    }

    function add_update_station($id,$tar, $cre_by, $crea_date, $mod_by, $mod_date)
    {
        $sql = "INSERT INTO tbl_project_sub(pjct_master_id, station_master_id, cre_by,crea_date,mod_by,mod_date) VALUES('$id','$tar','$cre_by','$crea_date','$mod_by','$mod_date')";
        return $this->db->query($sql);
    }

    function count_station($id){
        $this->db->from('tbl_project_sub');
        $this->db->where('pjct_master_id', $id);
        $query = $this->db->get();
        $rowcount = $query->num_rows();
        return $rowcount;
    }
    function count_project($name){
        $this->db->from('tbl_project_master');
        $this->db->where('pjct_name', $name);
        $query = $this->db->get();
        $rowcount = $query->num_rows();
        return $rowcount;
    }
    function count_project_id($id){
        $this->db->from('tbl_project_master');
        $this->db->where('pjct_master_id', $id);
        $query = $this->db->get();
        $rowcount = $query->num_rows();
        return $rowcount;
    }
    function count_station_id($id){
        $this->db->from('tbl_stations');
        $this->db->where('station_master_id', $id);
        $query = $this->db->get();
        $rowcount = $query->num_rows();
        return $rowcount;
    }
    function get_project($id)
    {
        $query=$this->db->query("SELECT pjct_name FROM tbl_project_master where pjct_master_id=$id");
        $result= $query->result_array();
        return $result;

    }
    function delete_project_station($id)
    {
        $this->db->where('pjct_master_id', $id);
        $this->db->delete('tbl_project_sub');
    }
    function get_project_name($id)
    {
        $query=$this->db->query("SELECT pjct_name FROM tbl_project_master where pjct_master_id=(SELECT pjct_master_id FROM tbl_journal_master where journal_master_id=$id)");
        $result= $query->result_array();
        return $result;

    }
    function get_station_name($id)
    {
        $query=$this->db->query("SELECT spd_name FROM tbl_stations where station_master_id=$id");
        $result= $query->result_array();
        return $result;

    }
}