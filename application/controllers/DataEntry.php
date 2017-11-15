<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dataentry extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('common_model');
        $this->load->model('journal_model');
        $this->load->model('project_Model');
        $this->load->view("template/header");
        $this->load->view('template/frame');
        $this->load->library('excel');
        date_default_timezone_set('Asia/Calcutta'); // to set the time zone
    }

    /**
     * @jane
     * date:15/09/2016
     * Parameter:none
     * Return type:
     * Description: This function is to show the data entry page
     */
    public function add_data()
    {
        $this->load->view('data_entry/add_data');
        $this->load->view('template/footer');
    }

    public function list_dataentry()
    {
        $data['records'] = $this->project_Model->project_get();
        $data['journalType'] = $this->journal_model->journal_type_get();
        $data['journal'] = $this->journal_model->journal_get();
        $this->load->view('data_entry/list_dataentry', $data);
        $this->load->view('template/footer');
    }

    /**
     * @Ancy
     * date:29/09/2016
     * Parameter:none
     * Return type:
     * Description: This function is to save the Excel and CSV data in to Database
     */

    public function parse_data_manual()
    {
        $total=$this->input->post("total");
        $balance=$this->input->post("balance");
        $earned=$this->input->post("earned");
        if($balance > $total &&  $earned > $total ){

            $this->session->set_flashdata('error', 'Balance value and Earned value is higher than Total.');
            redirect('dataentry/list_dataentry', 'refresh');
        }else if($balance > $total){
            $this->session->set_flashdata('error', 'Balance is higher than Total.');
            redirect('dataentry/list_dataentry', 'refresh');
        }else if($earned > $total){
            $this->session->set_flashdata('error', 'Earned is higher than Total.');
            redirect('dataentry/list_dataentry', 'refresh');
        }else{
            $id = $this->input->post("journalid1");
            $cetegoryId = $this->input->post("categoryId1");
            //$data_date = date("Y-m-d ", strtotime($this->input->post("datadate")));
            $data_date = date("Y-m-d ", strtotime($this->input->post("datadate1")));
            $cre_by = $this->session->userdata('uid');
            $crea_date = date('Y-m-d H:i:s');
            $mod_date = date('Y-m-d H:i:s');
            $mod_by = $this->session->userdata('uid');
            $row = $this->journal_model->get_category_name($cetegoryId);
            $pjctslug =$this->journal_model->get_slug_name($this->input->post("journalid1"));
            foreach ($pjctslug as $row1):
                $slugName = $row1['slug'];
            endforeach;
            foreach ($row as $row):
                $categoryName = $row['journal_category_name'];
            endforeach;
            if(strtoupper($categoryName)=="COST"){
                $bal = (1 - $balance / $total) * 100;
                $ear=(1 - $earned / $total) * 100;
                $newear= round($ear, 1);
                $newbal= round($bal, 1);
                $res = $this->common_model->parse_data_projectcost($id,$total,$balance,$earned, $newbal,$newear,$slugName, $data_date, $cre_by, $crea_date, $mod_by, $mod_date);
                if ($res) {
                    $this->session->set_flashdata('success', 'Successfully Inserted');
                    redirect('dataentry/list_dataentry', 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'Faild for Insertion.');
                    redirect('dataentry/list_dataentry', 'refresh');
                }
            }else{
                $this->session->set_flashdata('error', 'Category Of Journal Mismatch.');
                redirect('dataentry/list_dataentry', 'refresh');
            }

        }
    }
    public function parse_data()
    {
        $parse_array = array();
        if (empty($_FILES['file']['tmp_name'])){
            $this->session->set_flashdata('error', 'Plese attach file!!');
            redirect('dataentry/list_dataentry', 'refresh');
        }else{
           $file = $_FILES['file']['tmp_name'];
            $cetegoryId = $this->input->post("categoryId");
            $pjctslug =$this->journal_model->get_slug_name($this->input->post("journalid"));
            foreach ($pjctslug as $row1):
                $slugName = $row1['slug'];
            endforeach;
            $row = $this->journal_model->get_category_name($cetegoryId);
            foreach ($row as $row):
                $categoryName = $row['journal_category_name'];
            endforeach;
            if($categoryName == "PADU-SCURVE"  || $categoryName == "WBS"){
                $parse_array = $this->parse_excel_calc($file);

            }else{
                $parse_array = $this->parse_excel($file);
            }
        $highestRow = $this->get_row($file);
        $id = $this->input->post("journalid");
        //$data_date = date("Y-m-d ", strtotime($this->input->post("datadate")));
        $data_date = date("Y-m-d ", strtotime($this->input->post("datadate")));
        $cre_by = $this->session->userdata('uid');
        $crea_date = date('Y-m-d H:i:s');
        $mod_date = date('Y-m-d H:i:s');
        $mod_by = $this->session->userdata('uid');
        if ($highestRow > 1) {
            switch (strtoupper($categoryName)) {
                case "KPI":
                    $i = 2;
                    while ($i <= $highestRow) {
                        $kpi_type = (empty($parse_array[$i][0])) ? "" : $parse_array[$i][0];
                        $baseline = (empty($parse_array[$i][1]) || !is_numeric($parse_array[$i][1])) ? 0.00 : $parse_array[$i][1];
                        $kpi_target = (empty($parse_array[$i][2]) || !is_numeric($parse_array[$i][2])) ? 0.00 : $parse_array[$i][2];
                        $actual = (empty($parse_array[$i][3]) || !is_numeric($parse_array[$i][3])) ? 0.00 : $parse_array[$i][3];
                        $res = $this->common_model->parse_data_kpi($id, $kpi_type, $baseline, $kpi_target, $actual, $data_date, $cre_by, $crea_date, $mod_by, $mod_date);
                        $i++;
                    }
                    if ($res) {
                        $this->session->set_flashdata('success', 'file is successfully uploaded');
                        redirect('dataentry/list_dataentry', 'refresh');
                    } else {
                        $this->session->set_flashdata('error', 'Upload is failed.');
                        redirect('dataentry/list_dataentry', 'refresh');
                    }
                    break;
                case "KAD":
                    $i = 2;
                    while ($i <= $highestRow) {
                        $kd_desc = (empty($parse_array[$i][0])) ? "" : $parse_array[$i][0];
                        $forecast_date = (empty($parse_array[$i][1])) ? "" : date("Y-m-d", strtotime($parse_array[$i][1]));
                        $contract_date = (empty($parse_array[$i][2])) ? "" : date("Y-m-d", strtotime($parse_array[$i][2]));
                        $dps_date = (empty($parse_array[$i][3])) ? "" : date("Y-m-d", strtotime($parse_array[$i][2]));
                        $res = $this->common_model->parse_data_kdi($id, $data_date, $kd_desc, $forecast_date, $contract_date, $dps_date, $cre_by, $crea_date, $mod_by, $mod_date);
                        $i++;
                    }
                    if ($res) {
                        $this->session->set_flashdata('success', 'file is successfully uploaded');
                        redirect('dataentry/list_dataentry', 'refresh');
                    } else {
                        $this->session->set_flashdata('error', 'Upload is failed.');
                        redirect('dataentry/list_dataentry', 'refresh');
                    }
                    break;
                case "P-SCURVE":
                    $i = 2;
                    while ($i <= $highestRow) {
                        $prgm_sub_name = (empty($parse_array[$i][0])) ? "" : $parse_array[$i][0];
                        $early_prec = (empty($parse_array[$i][1]) || !is_numeric($parse_array[$i][1])) ? 0.00 : $parse_array[$i][1];
                        $actual_prec = (empty($parse_array[$i][2]) || !is_numeric($parse_array[$i][2])) ? 0.00 : $parse_array[$i][2];
                        $late_prec = (empty($parse_array[$i][3]) || !is_numeric($parse_array[$i][3])) ? 0.00 : $parse_array[$i][3];
                        $early_varience = (empty($parse_array[$i][4]) || !is_numeric($parse_array[$i][4])) ? 0.00 : $parse_array[$i][4];
                        $late_varience = (empty($parse_array[$i][5]) || !is_numeric($parse_array[$i][5])) ? 0.00 : $parse_array[$i][5];
                        $res = $this->common_model->parse_data_prgm_master($id, $prgm_sub_name, $early_prec, $actual_prec, $late_prec, $early_varience, $late_varience, $data_date, $cre_by, $crea_date, $mod_by, $mod_date);
                        $i++;
                    }
                    if ($res) {
                        $this->session->set_flashdata('success', 'file is successfully uploaded');
                        redirect('dataentry/list_dataentry', 'refresh');
                    } else {
                        $this->session->set_flashdata('error', 'Upload is failed.');
                        redirect('dataentry/list_dataentry', 'refresh');
                    }
                    break;
                case "V-SCURVE":
                    $i = 2;
                    while ($i <= $highestRow) {
                        $early_prec = (empty($parse_array[$i][0]) || !is_numeric($parse_array[$i][0])) ? 0.00 : $parse_array[$i][0];
                        $actual_prec = (empty($parse_array[$i][1]) || !is_numeric($parse_array[$i][1])) ? 0.00 : $parse_array[$i][1];
                        $late_prec = (empty($parse_array[$i][2]) || !is_numeric($parse_array[$i][2])) ? 0.00 : $parse_array[$i][2];
                        $early_varience = (empty($parse_array[$i][3]) || !is_numeric($parse_array[$i][3])) ? 0.00 : $parse_array[$i][3];
                        $late_varience = (empty($parse_array[$i][4]) || !is_numeric($parse_array[$i][4])) ? 0.00 : $parse_array[$i][4];
                        $res = $this->common_model->parse_project_prgm_master($id, $data_date, $early_prec, $actual_prec, $late_prec, $early_varience, $late_varience, $cre_by, $crea_date, $mod_by, $mod_date);
                        $i++;
                    }
                    if ($res) {
                        $this->session->set_flashdata('success', 'file is successfully uploaded');
                        redirect('dataentry/list_dataentry', 'refresh');
                    } else {
                        $this->session->set_flashdata('error', 'Upload is failed.');
                        redirect('dataentry/list_dataentry', 'refresh');
                    }
                    break;
                case "UP-TASK":
                    $i = 2;
                    $count=0;
                    $row = $this->common_model->count_upcoming_id($data_date);
                    if($row > 0){
                        $this->common_model->upcoming_delete($data_date);
                    }
                    while ($i <= $highestRow) {
                            $task = (empty($parse_array[$i][1])) ? "" :trim($parse_array[$i][1]);
                            $duration = (empty($parse_array[$i][7])) ? "" :trim($parse_array[$i][7]);
                            $start_date = (empty($parse_array[$i][3])) ? "" :trim( $parse_array[$i][3]);
                            $end_date = (empty($parse_array[$i][4])) ? "" : trim($parse_array[$i][4]);
                            $res = $this->common_model->parse_data_upcoming($id, $task, $duration, $start_date, $end_date, $data_date, $cre_by, $crea_date, $mod_by, $mod_date,$slugName);
                            $i++;
                            $count++;
                        }

                    if ($res) {
                        $this->session->set_flashdata('success', 'file is successfully uploaded  '.$count.' Rows Inserted');
                        redirect('dataentry/list_dataentry', 'refresh');
                    } else {
                        $this->session->set_flashdata('error', 'Upload is failed.');
                        redirect('dataentry/list_dataentry', 'refresh');
                    }
                    break;
                case "LATE-TASK":
                    $i = 2;
                    $count=0;
                    $row = $this->common_model->count_late_id($data_date);
                    if($row > 0){
                        $this->common_model->late_delete($data_date);
                    }
                    while ($i <= $highestRow) {
                            $task = (empty($parse_array[$i][0])) ? "" :trim($parse_array[$i][0]) ;
                            $duration = (empty($parse_array[$i][4])) ? "" :trim($parse_array[$i][4]) ;
                            $start_date = (empty($parse_array[$i][1])) ? "" : trim($parse_array[$i][1]);
                            $end_date = (empty($parse_array[$i][2])) ? "" : trim($parse_array[$i][2]);
                            $res = $this->common_model->parse_data_late($id, $task, $duration, $start_date, $end_date, $data_date, $cre_by, $crea_date, $mod_by, $mod_date,$slugName);
                            $i++;
                            $count++;

                        }
                    if ($res) {
                        $this->session->set_flashdata('success', 'file is successfully uploaded  '.$count.' Rows Inserted');
                        redirect('dataentry/list_dataentry', 'refresh');
                    } else {
                        $this->session->set_flashdata('error', 'Upload is failed.');
                        redirect('dataentry/list_dataentry', 'refresh');
                    }
                    break;
                case "COST":
                    $i = 2;
                    $count=0;
                    $row = $this->common_model->progress_cost($data_date);
                    if($row > 0){
                        $this->common_model->progress_cost_delete($data_date);
                    }
                    while ($i <= $highestRow) {
                        $bal_value = (empty($parse_array[$i][0])) ? "" : $parse_array[$i][0];
                        $earned_value = (empty($parse_array[$i][1])) ? "" : $parse_array[$i][1];
                        $res = $this->common_model->parse_progress_cost($id,$bal_value,$earned_value, $data_date,$cre_by, $crea_date, $mod_by, $mod_date,$slugName);
                        $i++;
                        $count++;
                    }
                    if ($res) {
                        $this->session->set_flashdata('success', 'file is successfully uploaded  '.$count.' Rows Inserted');
                        redirect('dataentry/list_dataentry', 'refresh');
                    } else {
                        $this->session->set_flashdata('error', 'Upload is failed.');
                        redirect('dataentry/list_dataentry', 'refresh');
                    }
                    break;
                case "ISSUE":

                    $count=0;
                    $row = $this->common_model->count_issue_id($data_date);
                    if($row > 0){
                        $this->common_model->issue_delete($data_date);
                    }
                    $i = 2;
                    while ($i <= $highestRow) {
                        $date = (empty($parse_array[$i][0])) ? "" : $parse_array[$i][0];
                        $issue = (empty($parse_array[$i][1])) ? "" : $parse_array[$i][1];

                            $res = $this->common_model->parse_data_issue($id, $date, $issue,$data_date, $cre_by, $crea_date, $mod_by, $mod_date,$slugName);
                            $i++;
                            $count++;

                        }
                    if ($res) {
                        $this->session->set_flashdata('success', 'file is successfully uploaded  '.$count.' Rows Inserted');
                        redirect('dataentry/list_dataentry', 'refresh');
                    } else {
                        $this->session->set_flashdata('error', 'Upload is failed.');
                        redirect('dataentry/list_dataentry', 'refresh');
                    }
                    break;
                case "PADU-SCURVE":
                    $i = 2;
                    $count=0;
                    while ($i <= $highestRow) {
                        $time=(empty($parse_array[$i][0])) ? "" : $parse_array[$i][0];
                        $early_prec = (empty($parse_array[$i][1])) ? "" : $parse_array[$i][1];
                        $early_perc_value=round(($early_prec*100) ,2);
                        if($count == 0){
                            $actual_prec_value=0.00;
                        }else{
                            $actual_prec = (empty($parse_array[$i][2])) ? "" : $parse_array[$i][2];
                            $actual_prec_value=!empty($actual_prec)? round(($actual_prec*100),2):$actual_prec;
                        }
                            if($early_perc_value > 0.00){
                                $late_prec = $early_perc_value - 2.00;
                            }else{
                                $late_prec=0.00;
                            }
                            $res = $this->common_model->parse_data_prgm_scurve($id,$time , $early_perc_value,$late_prec,$actual_prec_value, $data_date, $cre_by, $crea_date, $mod_by, $mod_date,$slugName);
                            $i++;
                            $count++;
                    }
                    if ($res) {
                        $this->session->set_flashdata('success', 'file is successfully uploaded  '.$count.' Rows Inserted');
                        redirect('dataentry/list_dataentry', 'refresh');
                    } else {
                        $this->session->set_flashdata('error', 'Upload is failed.');
                        redirect('dataentry/list_dataentry', 'refresh');
                    }
                    break;
                case "WBS":
                    $i = 2;
                    $count=0;
                    while ($i <= $highestRow) {
                        $sub_name = (empty($parse_array[$i][0])) ? "" : $parse_array[$i][0];
                        $value = (empty($parse_array[$i][1]) || !is_numeric($parse_array[$i][1])) ? 0.00 : $parse_array[$i][1];
                        $value_sub=round(($value*100) ,2);
                            $res = $this->common_model->parse_data_prgm_wbs($id, $sub_name, $value_sub,$data_date, $cre_by, $crea_date, $mod_by, $mod_date,$slugName);
                            $i++;
                            $count++;
                        }
                    if ($res) {
                        $this->session->set_flashdata('success', 'file is successfully uploaded  '.$count.' Rows Inserted');
                        redirect('dataentry/list_dataentry', 'refresh');
                    } else {
                        $this->session->set_flashdata('error', 'Upload is failed.');
                        redirect('dataentry/list_dataentry', 'refresh');
                    }
                    break;
                case "PROGRESS-COST":
                    $i = 2;
                    while ($i <= $highestRow) {
                        $balance = (empty($parse_array[$i][0])) ? 0 : $parse_array[$i][0];
                        $earned =  (empty($parse_array[$i][1])) ? 0 : $parse_array[$i][1];
                        $res = $this->common_model->parse_data_project_cost($id, $balance, $earned,$data_date, $cre_by, $crea_date, $mod_by, $mod_date,$slugName);
                        $i++;
                    }
                    if ($res) {
                        $this->session->set_flashdata('success', 'file is successfully uploaded');
                        redirect('dataentry/list_dataentry', 'refresh');
                    } else {
                        $this->session->set_flashdata('error', 'Upload is failed.');
                        redirect('dataentry/list_dataentry', 'refresh');
                    }
                    break;

                default:
                    $this->session->set_flashdata('error', 'the journal category is wrong!!!!!');
                    redirect('dataentry/list_dataentry', 'refresh');
                    break;
            }
        } else {
            $this->session->set_flashdata('error', 'your selected file only contain heading');
            redirect('dataentry/list_dataentry', 'refresh');
        }
        }
    }

    /**
     * @Ancy
     * date:29/09/2016
     * Parameter:none
     * Return type:
     * Description: This function is to get number of rows in the file
     */
    public function get_row($file)
    {
        $objPHPExcel = PHPExcel_IOFactory::load($file);
        $highestRow = $objPHPExcel->getActiveSheet()->getHighestRow();
        return $highestRow;
    }

    /**
     * @Ancy
     * date:29/09/2016
     * Parameter:none
     * Return type:
     * Description: This function is to get file records
     */
    public function parse_excel($file)
    {
        $objPHPExcel = PHPExcel_IOFactory::load($file);
        $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
        PHPExcel_Shared_Date::ExcelToPHP($dateValue = 0, $adjustToTimezone = FALSE, $timezone = NULL);
        $highestRow = $objPHPExcel->getActiveSheet()->getHighestRow();
        $c = $objPHPExcel->getActiveSheet()->getHighestColumn();
        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($c);
        $val = array();
        for ($row = 1; $row <= $highestRow; ++$row) {
            for ($col = 0; $col < $highestColumnIndex; ++$col) {
                $cell = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($col, $row);
                if (PHPExcel_Shared_Date::isDateTime($cell)) {
                    $InvDate = $cell->getValue();
                    $cellVal = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($InvDate));
                } else {
                    $cellVal = $cell->getValue();
                }

                /* $cell = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($col, $row)->getValue();*/
                $val[$row][$col] = $cellVal;
            }
        }
        return $val;
    }
    public function parse_excel_calc($file)
    {
        $objPHPExcel = PHPExcel_IOFactory::load($file);
        $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
        PHPExcel_Shared_Date::ExcelToPHP($dateValue = 0, $adjustToTimezone = FALSE, $timezone = NULL);
        $highestRow = $objPHPExcel->getActiveSheet()->getHighestRow();
        $c = $objPHPExcel->getActiveSheet()->getHighestColumn();
        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($c);
        $val = array();
        for ($row = 1; $row <= $highestRow; ++$row) {
            for ($col = 0; $col < $highestColumnIndex; ++$col) {
                $cell = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($col, $row);
                if (PHPExcel_Shared_Date::isDateTime($cell)) {
                    $InvDate = $cell->getValue();
                    $cellVal = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($InvDate));
                } else {
                    $cellVal = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($col, $row)->getCalculatedValue();
                }
                $val[$row][$col] = $cellVal;
            }
        }
        return $val;
    }

    public function doupload()
    {
        $this->load->helper(array('form'));
        $this->load->library('form_validation');
        if (empty($_FILES['userfile']['name']))
        {
            $this->session->set_flashdata('error', 'You could not select any picture.');
            redirect('dataentry/list_dataentry', 'refresh');
        }
        else
        {
            $this->load->library('upload');
            $files = $_FILES;
            $cpt = count($_FILES['userfile']['name']);
            $id = $this->input->post("journalimage");
            $data_date = date("Y-m-d", strtotime($this->input->post("datadateImage")));
            $userid = $this->session->userdata('uid');
            $row = $this->project_Model->get_project_name($id);
            foreach ($row as $row):
                $projectname = trim($row['pjct_name']);
            endforeach;
            $chk = 0;
            $er = 0;
            $count = 0;
            for ($i = 0; $i < $cpt; $i++) {
                $_FILES['userfile']['name'] = $files['userfile']['name'][$i];
                $_FILES['userfile']['type'] = $files['userfile']['type'][$i];
                $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
                $_FILES['userfile']['error'] = $files['userfile']['error'][$i];
                $_FILES['userfile']['size'] = $files['userfile']['size'][$i];
                $array = explode('_', $_FILES['userfile']['name']);
                $root = $_SERVER['DOCUMENT_ROOT'];

                if (sizeof($array) == 3) {
                    $project = (empty($array[0])) ? "" : strtoupper(trim($array[0]));
                    $array2 = explode('.', $array[2]);
                    $description = (empty($array2[0])) ? "" : $array2[0];
                    if (strlen(substr($array[1], 0, 2)) == 2 && strlen(substr($array[1], 2, 2)) == 2 && strlen(substr($array[1], 4, 4)) == 4 && is_numeric(substr($array[1], 0, 2)) && is_numeric(substr($array[1], 2, 2)) && is_numeric(substr($array[1], 4, 4))) {
                        $uploaddate = (empty($array[1])) ? "" : date("Y-m-d", strtotime(substr($array[1], 0, 2) . '-' . substr($array[1], 2, 2) . '-' . substr($array[1], 4, 4)));
                    } else {
                        $uploaddate = "";
                    }
                } else {
                    $project = "";
                    $description = "";
                    $uploaddate = "";
                }
                // check whether there is a folder in the document root if not create
                if (!is_dir($root . '/' . 'gallery')) {
                    mkdir($root . '/' . 'gallery', 0777, true);
                }
                // check whether there is a folder for album inside the gallery if not create
                if (!is_dir($root . '/' . 'gallery' . '/' . $id)) {
                    mkdir($root . '/' . 'gallery' . '/' . $id, 0777, true);
                }
                // check whether there is a folder for date inside the album if not create
                if (!is_dir($root . '/' . 'gallery' . '/' . $id . '/' . $data_date)) {
                    mkdir($root . '/' . 'gallery' . '/' . $id . '/' . $data_date, 0777, true);
                }
                $config['upload_path'] = $root . '/' . 'gallery' . '/' . $id . '/' . $data_date;
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '0';
                $config['overwrite'] = FALSE;
                $this->upload->initialize($config);
                if (strcasecmp($projectname, $project) == 0) {
                    if ($this->upload->do_upload()) {
                        $filedetails = $this->upload->data();
                        $data = array('journal_master_id' => $id, 'image_name' => $filedetails['file_name'], 'image_path' => $filedetails['file_path'], 'image_desc' => $description, 'image_upload_date' => $uploaddate, 'data_date' => $data_date, 'crea_date' => date('Y-m-d H:i:s'), 'mod_date' => date('Y-m-d H:i:s'), 'cre_by' => $userid, 'mod_by' => $userid);
                        $this->common_model->image_upload($data);
                        $count++;
                        $chk = 1;
                    }
                } else {
                    $er = 1;
                }
            }
            if ($chk == 1 && $er == 1) {
                $total = $cpt - $count;
                $this->session->set_flashdata('success', $count . "  picture(s) attached with journal and " . $total . " pictures do not match with journal .");
                redirect('dataentry/list_dataentry', 'refresh');
            } else if ($count == $cpt && $chk == 1) {
                $this->session->set_flashdata('success', $count . "  picture(s) attached with journal.");
                redirect('dataentry/list_dataentry', 'refresh');
            } else if ($er == 1 && $chk == 0) {
                $this->session->set_flashdata('error', "picture(s) not uploaded bcoz, Picture do not match with journal .");
                redirect('dataentry/list_dataentry', 'refresh');
            } else {
                $this->session->set_flashdata('error', 'Picture(s) not uploaded.');
                redirect('dataentry/list_dataentry', 'refresh');
            }
        }
    }
}

   /* public function doupload() {
            $id=$this->input->post("journalimage");
            $data_date=date("Y-m-d", strtotime($this->input->post("datadate")));
            $cre_by = $this->session->userdata('uid');
            $crea_date = date('Y-m-d H:i:s');
            $mod_date = date('Y-m-d H:i:s');
            $mod_by = $this->session->userdata('uid');
            $row=$this->journal_model->get_journal_name($id);
            foreach ($row as $row):
                $journalname=$row['journal_name'];
            endforeach;
        $root = $_SERVER['DOCUMENT_ROOT'];
        $name;
        $temp;
        $album;
        $date;
        $des;
        $chk = 0;
        $temp = array();
        $name = array();
        $data = array();
        if($this->input->post('fileSubmit') && !empty($_FILES['userFiles']['name'])){
            $filesCount = count($_FILES['userFiles']['name']);
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['userFile']['name'] = $_FILES['userFiles']['name'][$i];
                $_FILES['userFile']['type'] = $_FILES['userFiles']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['userFiles']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['userFiles']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['userFiles']['size'][$i];
                $name = explode('.', $_FILES['userFiles']['name'][$i]);
                $temp = explode('_', $name[0]);
                $album = $temp[0];
                $date = $temp[1];
                $desc = $temp[2];
                // check whether there is a folder in the document root if not create
                if (!is_dir($root.'/'.'gallery')) {
                    mkdir($root.'/'.'gallery', 0777, true);
                }
                // check whether there is a folder for album inside the gallery if not create
                if (!is_dir($root.'/'.'gallery'.'/'.$album)) {
                    mkdir($root.'/'.'gallery'.'/'.$album, 0777, true);
                }
                // check whether there is a folder for date inside the album if not create
                if (!is_dir($root.'/'.'gallery'.'/'.$album.'/'.$date)) {
                    mkdir($root.'/'.'gallery'.'/'.$album.'/'.$date, 0777, true);
                }
                $uploadPath = $root.'/'.'gallery'.'/'.$album.'/'.$date;
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('userFile'))
                {
                    $filedetails=$this->upload->data();
                    $data = array('data_entry_no' => $id,'pict_file_name' => $filedetails['file_name'],'pict_file_path' => '/journalimagenonp/'.$id.'/'.$userid.'/','pict_definition' => $this->input->post('imagedesc'),'pict_user_id' => $userid,'data_source' => '1');
                    $this->assessment->add_journal_data_entry_picturenonp($data);
                    $chk == 1;

                }
            }
            if($chk == 1)
            {
                $error = array('error' => 'Image Upload Failed, Try Again !','success' => '');
            }
            else
            {
                $error = array('error' => '','success' => 'Image Upload Successfully!');
            }
            $this->load->view('image_upload',$error);
            $this->load->view('template/footer');
        }
        else{
            // throw server side error
        }

    }*/

    /* for ($x = 1; $x <= $r; $x++) {
               $a=array();
               foreach ($cell_collection as $cell) {
                   $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
                   $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
                   $data_value = $objPHPExcel->getActiveSheet()->getCell($column.$x)->getValue();
                   if (empty($data_value)) {
                       echo "---";
                   } else {
                       echo "<br>";
                       array_push($a,$data_value);
                       echo $data_value;
                       echo "<br>";
                   }
               }
           }*/
        /*if (isset($_POST["submit"])) {
            $file = $_FILES['file']['tmp_name'];
            $handle = fopen($file, "r");
            $c = 0;
            while (($filesop = fgetcsv($handle, 1000, ",")) !== false) {
                $viaduct_master_id = $filesop[0];
                $incident_date = $filesop[1];
                $incident_desc = $filesop[2];
                $data_date = $filesop[3];
                $cre_by = $filesop[4];
                $crea_date = $filesop[5];
                $mod_by = $filesop[6];
                $mod_date = $filesop[7];
                $res = $this->common_model->parse_data($viaduct_master_id, $incident_date, $incident_desc, $data_date, $cre_by, $crea_date, $mod_by, $mod_date);
                $c = $c + 1;
            }
            if ($res) {
                echo "You database has imported successfully . You have inserted " . $c . " recoreds";
                exit;
            } else {
                echo "Sorry!There is some problem .";
                exit;
            }

        }*/
/*public function get_column($file){
        $objPHPExcel = PHPExcel_IOFactory::load($file);
        $c = $objPHPExcel->getActiveSheet()->getHighestColumn();
        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($c);
        return $highestColumnIndex;
    }*/


/*$viaduct_master_id = $parse_array[$i][0];
$incident_desc = $parse_array[$i][2];
$incident_date = date("Y-m-d", strtotime($parse_array[$i][1]));
$data_date =date("Y-m-d", strtotime($parse_array[$i][3]));
$cre_by = $this->session->userdata('uid');
$crea_date = date('Y-m-d H:i:s');
$mod_date = date('Y-m-d H:i:s');
$mod_by = $this->session->userdata('uid');
$res = $this->common_model->parse_data($viaduct_master_id, $incident_date, $incident_desc, $data_date, $cre_by, $crea_date, $mod_by, $mod_date);*/