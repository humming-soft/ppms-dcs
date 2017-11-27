<?php (defined('BASEPATH')) OR exit('aNo direct script access allowed');

class Common_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

        $this->load->database();
    }

  
    public function validate_login($username, $password)
    {
        $hash_password = hash('sha256', $password);
        $ldap = "";
        $this->db->select('id, username, password, fullname, lastlogin, user_group');
        $this->db->from('users');
        $this->db->where(array('username' => $username));
        $query = $this->db->get();
        $user = $query->row_array();

        if (count($user) != 0) {
            if ($user['password'] == $hash_password) {
                /* Password available in DB, login through DB */
                $this->update_login_lastlog($user);
                $this->log_login_attempt(array('data' => 'Successful login for user ' . $username . ' using custom user in DB', 'ip_address' => $_SERVER['REMOTE_ADDR']));
                return $user;
            } else if ($user['password'] === "") {
                $ldap = $this->login_ad($username, $password);
                /* Empty password in DB, login through AD instead */
                if ($ldap) {
                    $this->update_login_lastlog($user);
                    $this->log_login_attempt(array('data' => 'Successful login ' . $username . ' from AD, username exists in DB', 'ip_address' => $_SERVER['REMOTE_ADDR']));
                    return $user;
                } else {
                    /* Wrong username/password in AD */
                    $this->log_login_attempt(array('data' => 'Wrong username/password for ' . $username, 'ip_address' => $_SERVER['REMOTE_ADDR']));
                    return false;
                }
            } else {
                /* Wrong password in DB */

                /* Login through AD */
                if ($ldap) {
                    $ldap = $this->login_ad($username, $password);
                    /* Login through AD */
                    $this->log_login_attempt(array('data' => 'Successful login ' . $username . ' from AD', 'ip_address' => $_SERVER['REMOTE_ADDR']));
                    return $user;
                } else {
                    /* Nope. */
                    $this->log_login_attempt(array('data' => 'Wrong password for user ' . $username, 'ip_address' => $_SERVER['REMOTE_ADDR']));
                    return false;
                }
                return false;
            }
        }
    }

   
    public function login_ad($username, $password)
    {
        $backslash = strpos($username, "\\");
        $domainuser = "MYMRT\\" . (($backslash === FALSE) ? $username : substr($username, $backslash + 1));
        //$ldap = ldap_connect("eagle.office.hummingsoft.com.my"); //172.16.2.10
        $ldap = ldap_connect("172.16.2.10"); //172.16.2.10
        return ldap_bind($ldap, $domainuser, $password);

        // $ldap = ldap_connect("172.16.2.10"); //172.16.2.10
        // return ldap_bind($ldap, $domainuser, $password);
    }

   
    public function update_login_lastlog($user)
    {
        $this->db->where('id', $user['id']);
        $this->db->set('lastlogin', 'NOW()', FALSE);
        return $this->db->update('users');
    }
   
    public function log_login_attempt($data)
    {
        return $this->db->insert('users_log', $data);
    }
    public function del_issue($dps_date)
    {
        $this->db->where('data_date', $dps_date);
        $this->db->delete('tbl_issue_mitigation');
    }
    public function del_late($dps_date)
    {
        $this->db->where('data_date', $dps_date);
        $this->db->delete('tbl_late_task');
    }
    public function del_up($dps_date)
    {
        $this->db->where('data_date', $dps_date);
        $this->db->delete('tbl_upcoming_task');
    }
    public function del_cost($dps_date)
    {
        $this->db->where('data_date', $dps_date);
        $this->db->delete('tbl_progress_cost');
    }
    public function del_wbs($dps_date)
    {
        $this->db->where('data_date', $dps_date);
        $this->db->delete('tbl_wbs');
    }
    public function del_scurve($dps_date)
    {
        $this->db->where('data_date', $dps_date);
        $this->db->delete('tbl_padus_curve');
    }
    public function parse_data_kdi($id, $data_date,$kd_desc,$forecast_date,$contract_date,$dps_date, $cre_by, $crea_date, $mod_by, $mod_date)
    {
        $sql = "INSERT INTO tbl_kd_master(journal_master_id, data_date, kd_desc,forecast_date,contract_date,dps_date,cre_by,crea_date,mod_by,mod_date) VALUES('$id','$data_date','$kd_desc','$forecast_date','$contract_date','$dps_date','$cre_by','$crea_date','$mod_by','$mod_date')";
        return $this->db->query($sql);
    }
    //KPI
    public function parse_data_kpi($id,$kpi_type,$baseline,$kpi_target,$actual, $data_date, $cre_by, $crea_date, $mod_by, $mod_date)
    {
        $sql = "INSERT INTO tbl_kpi_master(journal_master_id, kpi_type, baseline,kpi_target,actual,data_date,cre_by,crea_date,mod_by,mod_date) VALUES('$id','$kpi_type','$baseline','$kpi_target','$actual','$data_date','$cre_by','$crea_date','$mod_by','$mod_date')";
        return $this->db->query($sql);
    }
    //PS_CURVE
    public function parse_data_prgm_master($id,$prgm_sub_name,$early_prec,$actual_prec,$late_prec,$early_varience,$late_varience, $data_date, $cre_by, $crea_date, $mod_by, $mod_date)
    {
        $sql = "INSERT INTO tbl_prgm_master(journal_master_id, prgm_sub_name, early_prec,actual_prec,late_prec,early_varience,late_varience,data_date,cre_by,crea_date,mod_by,mod_date) VALUES('$id','$prgm_sub_name','$early_prec','$actual_prec','$late_prec','$early_varience','$late_varience','$data_date','$cre_by','$crea_date','$mod_by','$mod_date')";
        return $this->db->query($sql);
    }
    //VS_CURVE
    public function parse_project_prgm_master($id, $data_date,$early_prec,$actual_prec,$late_prec,$early_varience,$late_varience,$cre_by, $crea_date, $mod_by, $mod_date)
    {
        $sql = "INSERT INTO tbl_project_prgs_master(journal_master_id, early_perc,actual_perc,late_perc,early_variance,late_varience,data_date,cre_by,crea_date,mod_by,mod_date) VALUES('$id','$early_prec','$actual_prec','$late_prec','$early_varience','$late_varience','$data_date','$cre_by','$crea_date','$mod_by','$mod_date')";
        return $this->db->query($sql);
    }
    
    public function parse_data_upcoming($id, $task, $duration, $start_date, $end_date,$dps_date, $cre_by, $crea_date, $mod_by, $mod_date,$slug)
    {

        $sql = "INSERT INTO tbl_upcoming_task(journal_master_id, up_task, duration, start_date, end_date, data_date, cre_by, crea_date, mod_by, mod_date,slug) VALUES ($id, '$task', '$duration', '$start_date', '$end_date', '$dps_date','$cre_by','$crea_date','$mod_by','$mod_date','$slug')";
        return $this->db->query($sql);
    }
    public function parse_data_late($id, $task, $duration, $start_date, $end_date,$dps_date, $cre_by, $crea_date, $mod_by, $mod_date,$slug)
    {

        $sql = "INSERT INTO tbl_late_task(journal_master_id, late_task, duration, start_date, end_date, data_date, cre_by, crea_date, mod_by, mod_date,slug) VALUES ($id, '$task', '$duration', '$start_date', '$end_date', '$dps_date','$cre_by','$crea_date','$mod_by','$mod_date','$slug')";
        return $this->db->query($sql);
    }
    public function parse_data_issue($id, $date, $issue,$mitigation,$data_date, $cre_by, $crea_date, $mod_by, $mod_date,$slug)
    {

        $sql = "INSERT INTO tbl_issue_mitigation(journal_master_id, issue_date,issue,mitigation, data_date,cre_by, crea_date, mod_by, mod_date,slug) VALUES ($id, '$date', '$issue', '$mitigation','$data_date','$cre_by','$crea_date','$mod_by','$mod_date','$slug')";
        return $this->db->query($sql);
    }
    public function parse_progress_cost($id,$bal_value,$earned_value,$data_date, $cre_by, $crea_date, $mod_by, $mod_date,$slug)
    {

        $sql = "INSERT INTO tbl_progress_cost(journal_master_id,balance_value, earned_value, data_date,cre_by, crea_date, mod_by, mod_date,slug) VALUES ($id, '$bal_value', '$earned_value', '$data_date','$cre_by','$crea_date','$mod_by','$mod_date','$slug')";
        return $this->db->query($sql);
    }
    public function parse_data_projectcost($id, $total,$balance,$earned,$newbal,$newear,$slugName, $data_date, $cre_by, $crea_date, $mod_by, $mod_date)
    {

        $sql = "INSERT INTO tbl_progress_cost(journal_master_id, total_value, balance_value, earned_value, balance, earned, data_date, cre_by, crea_date, mod_by, mod_date, slug) VALUES ($id,'$total','$balance','$earned','$newbal', '$newear', '$data_date','$cre_by','$crea_date','$mod_by','$mod_date','$slugName')";
        return $this->db->query($sql);
    }
    public function parse_data_prgm_scurve($id,$time ,$early_prec,$late_prec,$actual_prec, $data_date, $cre_by, $crea_date, $mod_by, $mod_date,$slugName)
    {

        $sql = "INSERT INTO tbl_padus_curve(journal_master_id,  scurve_time, early_perc, late_perc, actual_perc, data_date, cre_by, crea_date, mod_by, mod_date, slug) VALUES ($id,'$time' , '$early_prec','$late_prec','$actual_prec', '$data_date','$cre_by','$crea_date','$mod_by','$mod_date','$slugName')";
        return $this->db->query($sql);
    }
    public function parse_data_prgm_wbs($id, $sub_name, $value,$data_date, $cre_by, $crea_date, $mod_by, $mod_date,$slugName)
    {

        $sql = "INSERT INTO tbl_wbs(journal_master_id, subject, sub_value,data_date, cre_by, crea_date, mod_by, mod_date, slug) VALUES ($id,'$sub_name' , '$value','$data_date','$cre_by','$crea_date','$mod_by','$mod_date','$slugName')";
        return $this->db->query($sql);
    }
    public function parse_data_park($id,$date_raised,$raised_by,$issues,$scope,$action,$remark,$data_date, $cre_by, $crea_date, $mod_by, $mod_date,$slugName)
    {

        $sql = "INSERT INTO tbl_parking_pot(journal_master_id, park_date, park_by, issue, scope, action_park, remark, data_date, cre_by, crea_date, mod_by, mod_date, slug) VALUES ($id,'$date_raised' ,'$raised_by','$issues','$scope','$action','$remark','$data_date','$cre_by','$crea_date','$mod_by','$mod_date','$slugName')";
        return $this->db->query($sql);
    }
    function count_upcoming_id($dps_date){
        $this->db->from('tbl_upcoming_task');
        $this->db->where('data_date', $dps_date);
        $query = $this->db->get();
        $rowcount = $query->num_rows();
        return $rowcount;
    }
    function count_late_id($dps_date){
        $this->db->from('tbl_late_task');
        $this->db->where('data_date', $dps_date);
        $query = $this->db->get();
        $rowcount = $query->num_rows();
        return $rowcount;
    }
    function upcoming_delete($dps_date){
        $this->db->where('data_date', $dps_date);
        $this->db->delete('tbl_upcoming_task');
    }
    function late_delete($dps_date){
        $this->db->where('data_date', $dps_date);
        $this->db->delete('tbl_late_task');
    }
    function count_issue_id($dps_date){
        $this->db->from('tbl_issue_mitigation');
        $this->db->where('data_date', $dps_date);
        $query = $this->db->get();
        $rowcount = $query->num_rows();
        return $rowcount;
    }
    function count_scurve_id($dps_date){
        $this->db->from('tbl_padus_curve');
        $this->db->where('data_date', $dps_date);
        $query = $this->db->get();
        $rowcount = $query->num_rows();
        return $rowcount;
    }
    function issue_delete($dps_date){
        $this->db->where('data_date', $dps_date);
        $this->db->delete('tbl_issue_mitigation');
    }
    function progress_cost($dps_date){
        $this->db->from('tbl_progress_cost');
        $this->db->where('data_date', $dps_date);
        $query = $this->db->get();
        $rowcount = $query->num_rows();
        return $rowcount;
    }
    function progress_cost_delete($dps_date){
        $this->db->where('data_date', $dps_date);
        $this->db->delete('tbl_progress_cost');
    }
    function count_park_id($dps_date){
        $this->db->from('tbl_parking_pot');
        $this->db->where('data_date', $dps_date);
        $query = $this->db->get();
        $rowcount = $query->num_rows();
        return $rowcount;
    }
    function park_delete($dps_date){
        $this->db->where('data_date', $dps_date);
        $this->db->delete('tbl_parking_pot');
    }
    function count_wbs_id($dps_date){
        $this->db->from('tbl_wbs');
        $this->db->where('data_date', $dps_date);
        $query = $this->db->get();
        $rowcount = $query->num_rows();
        return $rowcount;
    }
    public function parse_data_prgm_scurve_update($id,$time ,$actual_prec,$count1)
    {
        if($count1 > 0){
            $query ="SELECT count(*) as ncount FROM tbl_padus_curve where scurve_time='$time' and journal_master_id=$id and actual_perc > '0.00' ";
            $query = $this->db->query($query);
            $query_result = $query->result();
            foreach ( $query_result as $result ) {
                $count = $result->ncount;
            }
            if($count == 0 ){
                $this->db->where('journal_master_id', $id);
                $this->db->where('scurve_time', $time);
                $this->db->set('actual_perc', $actual_prec);
                return $this->db->update('tbl_padus_curve');
            }
        }

        
    }

    /**
     * @AgailE
     * date:18/09/2016
     * Parameter:none
     * Return type:
     * Description: function to upload image
     */
    public function image_upload($data)
    {
        return $this->db->insert('tbl_album_master', $data);
    }
}