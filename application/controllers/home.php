<?php

Class Home extends CI_Controller {

    function __construct() {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $this->no_cache();

        $this->load->model('Api_model');
        $this->load->helper('download');

        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '2048M');
    }

    protected function no_cache() {
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Cache-Control: post-check=0, pre-check=0', false);
        header('Pragma: no-cache');
    }

    function index() {
        $this->load->view('home_view');
    }

    function loadExcelReader2() {
        @$this->load->view('excel_reader/php-excel-reader/excel_reader2.php');
    }

    function loadSpreadsheetReader() {
        @$this->load->view('excel_reader/SpreadsheetReader.php');
    }

    function actionImportExcel() {
        $tempPath = $_FILES['upload_file']['tmp_name'];
        if (($_FILES["upload_file"]["type"] == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet") || ($_FILES["upload_file"]["type"] == "application/vnd.ms-excel")) {
            $this->loadExcelReader2();
            $this->loadSpreadsheetReader();

            $tempPath = $_FILES['upload_file']['tmp_name'];
            $uploadPath = 'uploads/' . $_FILES['upload_file']['name'];
            move_uploaded_file($tempPath, $uploadPath);
            $Reader = new SpreadsheetReader($uploadPath);
            $totalSheet = count($Reader->sheets());
            $importDataArr = array();
            
            /* For Loop for all sheets */
            for ($i = 0; $i < $totalSheet; $i++) {
                @$s = 0;
                $Reader->ChangeSheet($i);

                foreach ($Reader as $Row) {

                    if ($s != 0) {

                        $Sapid = isset($Row[0]) ? $Row[0] : '';
                        $Hostname = isset($Row[1]) ? $Row[1] : '';
                        $Loopback = isset($Row[2]) ? $Row[2] : '';
                        $Macaddress = isset($Row[3]) ? $Row[3] : '';


                        $importDataArr[] = array(
                            "Sapid" => $Sapid,
                            "Hostname" => $Hostname,
                            "Loopback" => $Loopback,
                            "Macaddress" => $Macaddress
                        );
                    }
                    $s++;
                }
            }
            $dataProvider = $this->Api_model->validateDataAndReformat($importDataArr);

            $data['previewList'] = $dataProvider;
            $this->load->view('preview_view', $data);

            //redirect(base_url()."Home/redirectURL");
        } else {
            $data['errorMsg'] = 'Please upload xlsx or xls file format';
            $this->load->view('home_view',$data);
        }
    }

    function redirectURL() {
        $myquery = "SELECT * FROM router_details ";
        $excelRecordList = $this->Api_model->getCustomeList($myquery);
        $data['excelRecordList'] = $excelRecordList;
        $this->load->view('details_view', $data);
    }

    function editData() {
        $editId = $_GET['id'];
        $member = array(
            "Id" => $editId
        );

        $connection = 'router_details';
        $geteditData = $this->Api_model->get_record_where($connection, $member);
        $data['geteditData'] = $geteditData[0];
        $this->load->view('edit_view', $data);
    }

    function UpdateData() {

        $Id = $_POST['id'];
        $Sapid = $_POST['Sapid'];
        $Hostname = $_POST['Hostname'];
        $Loopback = $_POST['Loopback'];
        $Macaddress = $_POST['Macaddress'];

        $member = array(
            "Id" => $Id,
            "Sapid" => $Sapid,
            "Hostname" => $Hostname,
            "Loopback" => $Loopback,
            "Macaddress" => $Macaddress
        );


        $connection = 'router_details';
        $this->Api_model->update_Data('Id', $member, $connection);


        redirect(base_url() . "Home/redirectURL");
    }
    
    function checkArrayValidation(){
        $sap_id = $this->input->post('sap_id');
        $explodeSapId = explode(',', $sap_id);
        
        $hostname     = $this->input->post('hostname');
        $explodeHostname = explode(',', $hostname);
        
        $loopback     = $this->input->post('loopback');
        $explodeLoopback = explode(',', $loopback);
        
        $mac_address     = $this->input->post('mac_address');
        $explodeMacAddress = explode(',', $mac_address);
        
        $delete_status     = $this->input->post('delete_status');
        $explodeDeleteStatus = explode(',', $delete_status);
        
        for($i=0;$i<=count($explodeSapId);$i++){
            if($explodeSapId[$i]){
                if($explodeDeleteStatus[$i] == '1'){
                    $importDataArr[] = array(
                        "Sapid" => $explodeSapId[$i],
                        "Hostname" => $explodeHostname[$i],
                        "Loopback" => $explodeLoopback[$i],
                        "Macaddress" => $explodeMacAddress[$i]
                    );
                }
            }
        }
        
        $dataProvider = $this->Api_model->validateDataAndReformat($importDataArr);

        $data['previewList'] = $dataProvider;
        $this->load->view('preview_view', $data);
    }
    
    function checkAndSubmitArray(){
        $sap_id = $this->input->post('sap_id');
        $explodeSapId = explode(',', $sap_id);
        
        $hostname     = $this->input->post('hostname');
        $explodeHostname = explode(',', $hostname);
        
        $loopback     = $this->input->post('loopback');
        $explodeLoopback = explode(',', $loopback);
        
        $mac_address     = $this->input->post('mac_address');
        $explodeMacAddress = explode(',', $mac_address);
        
        $delete_status     = $this->input->post('delete_status');
        $explodeDeleteStatus = explode(',', $delete_status);
        
        for($i=0;$i<=count($explodeSapId);$i++){
            if($explodeSapId[$i]){
                if($explodeDeleteStatus[$i] == '1'){
                    $importDataArr[] = array(
                        "Sapid" => $explodeSapId[$i],
                        "Hostname" => $explodeHostname[$i],
                        "Loopback" => $explodeLoopback[$i],
                        "Macaddress" => $explodeMacAddress[$i]
                    );
                }
            }
        }
        
        $dataProvider = $this->Api_model->validateDataAndReformat($importDataArr);
        $error = 0;
        foreach ($dataProvider as $Row) {
            if(($Row['duplicate'] != '') || ($Row['sap_id_error_class'] != '') || ($Row['hostname_error_class'] != '') || ($Row['loopback_error_class'] != '') || ($Row['mac_address_error_class'] != '')){
                $error = 1;
             }
        }
        if($error == 1){
            $data['previewList'] = $dataProvider;
            $this->load->view('preview_view', $data);
        } else {
            for($i=0;$i<=count($explodeSapId);$i++){
                if($explodeSapId[$i]){
                    $member = array(
                        "Sapid" => $explodeSapId[$i],
                        "Hostname" => $explodeHostname[$i],
                        "Loopback" => $explodeLoopback[$i],
                        "Macaddress" => $explodeMacAddress[$i]
                    );
                    
                    $connection = 'router_details';
                    $this->Api_model->insert_and_return($connection,$member);
                }
            }
            
            echo '1';
        }        
    }

    function download($fileName = NULL) {  
       
        if ($fileName) {
        $file = "uploads/sample/". $fileName;
         // check file exists    
         if (file_exists ( $file )) {
            
          // get file content
          $data = file_get_contents ( $file );
          //force download
          force_download ( $fileName, $data );
         } else {
          // Redirect to base url
          redirect ( base_url () );
         }
        }
    }

    function DeleteDate(){
        $delete_id = $this->input->post('delete_id');
        $connection = 'router_details';
        $geteditData = $this->Api_model->delete_Data('Id', $delete_id, $connection);
    }

}

?>