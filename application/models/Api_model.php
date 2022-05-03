<?php

Class Api_model extends CI_Model{
    function __construct() {
        parent::__construct();
    }
	const DUPLICATE_RECORD_HIGHLIGHT = 'table-secondary';
    const INVALID_RECORD_HIGHLIGHT = 'table-danger';
    
    //insert record
    function insert_and_return($tbl,$val){
        $this->db->insert($tbl,$val); 
        $data = $this->db->insert_id();
        return $data;
    }
    
    //update record
    function update_Data($ID,$val,$tbl_name) {  //colume name, array value, table name 
        $this->db->where($ID, $val[$ID]);
        $this->db->update($tbl_name, $val);
        if($this->db->affected_rows() == 1){
            return True;
        } else  {
            return False;
        }
    } 
    
    //delete record
    function delete_Data($ID_TNM,$ID,$tbl_name){
        $this->db->where($ID_TNM, $ID);
        $this->db->delete($tbl_name);
    }
    
    //get all record in table by order of asc or desc
    function getTableData($tbl,$order_by="") {
        $query = $this->db->query("SELECT * FROM $tbl $order_by");
        $result = $query->result_array();
        return $result;
    }
        
    //get record in table by using where clause
    function get_record_where($tbl,$arrayVal){ // array($clm => $val)
        $row = $this->db->get_where($tbl, $arrayVal)->result_array();
        return $row;
    }
    
    //Check record present in table insert time
    function Find_value($tbl_name,$checkVal){ //$fld_name = '$unit_name' and $fld_name = '$unit_name'
        $query = $this->db->query("SELECT * FROM $tbl_name where $checkVal");
		if ($query->num_rows() == 0) {
            return 0;
        } else {
            return 1;
        }
    }
    
    //Check record present in table update time
    function Find_value_id($tbl_name,$fld_name,$unit_name,$fld_id,$id){
        $query = $this->db->query("SELECT * FROM $tbl_name where $fld_name = '$unit_name' and $fld_id != '$id'");
        if ($query->num_rows() == 0) {
            return 0;
        } else {
            return 1;
        } 
    }
    
    function getGroupByData() {        
        $query = $this->db->query("SELECT * FROM isn_coupon_details where `delete_status` = '1' GROUP BY `brand_name`");
        $result = $query->result_array();
        return $result;
    }
    
    function getCustomeList($myquery) {        
        $query = $this->db->query("$myquery");
        $result = $query->result_array();
        return $result;
    }
	
	function validateDataAndReformat($importDataArr){

		$dataProvider = array();
                
    //duplicate record validation
        $SapidArrayCount = array_count_values(array_column($importDataArr, 'Sapid'));
        $hostnameArrayCount = array_count_values(array_column($importDataArr, 'Hostname'));
                        
        foreach ($SapidArrayCount as $key => $value) {  
            if($value > 1){
                $newSapidArray[] = array(
                    'Sapid' => $key
                );
            }
        }
        foreach ($hostnameArrayCount as $key => $value) {  
            if($value > 1){
                $newHostArray[] = array(
                    'Hostname' => $key
                );
            }
        }
        $newSapidArrayColumn = array_column($newSapidArray, 'Sapid');
        $newHostArrayColumn = array_column($newHostArray, 'Hostname');
        foreach ($importDataArr as  $importData) {
            $tempDataProvider = array();
            $sapId = $importData['Sapid'];
            $hostname = $importData['Hostname'];
            $loopback = $importData['Loopback'];
			$macAddress = $importData['Macaddress'];
			
			
			
            $tempDataProvider['duplicate'] = null;
			$pass_sapId =  "Sapid = '$sapId'";
			$getDatasapId = $this->Find_value('router_details', $pass_sapId);
            if ($getDatasapId > 0 ) {
                $tempDataProvider['duplicate'] = self::DUPLICATE_RECORD_HIGHLIGHT;
            }
            
            if(in_array($sapId, $newSapidArrayColumn)){
                $tempDataProvider['duplicate'] = self::DUPLICATE_RECORD_HIGHLIGHT;
            }	
			$pass_Hostname =  "Hostname = '$hostname'";
			$getDataHostname = $this->Find_value('router_details', $pass_Hostname);
			
            if ($getDataHostname > 0) {
                $tempDataProvider['duplicate'] = self::DUPLICATE_RECORD_HIGHLIGHT;
            }
            
            if(in_array($hostname, $newHostArrayColumn)){
                $tempDataProvider['duplicate'] = self::DUPLICATE_RECORD_HIGHLIGHT;
            }
			
			$pass_sapIdAndhostname =  "Sapid = '$sapId' and Hostname = '$hostname'";
			$getDatasapIdAndhostname = $this->Find_value('router_details', $pass_sapIdAndhostname);
			
            if ($getDatasapIdAndhostname > 0) {
                $tempDataProvider['duplicate'] = self::DUPLICATE_RECORD_HIGHLIGHT;
            }
			
			
			//Sap Id Validation 
            $tempDataProvider['sap_id'] = $sapId;
            $tempDataProvider['sap_id_valid'] = true;
            $tempDataProvider['sap_id_error_class'] =null;
            if (!$this->validateSAPId($sapId)) {
                $tempDataProvider['sap_id_valid'] = false;
                $tempDataProvider['sap_id_error_class'] = self::INVALID_RECORD_HIGHLIGHT;
            }
			
			//hostname validation
            $tempDataProvider['hostname'] = $hostname;
            $tempDataProvider['hostname_valid'] = true;
            $tempDataProvider['hostname_error_class'] =null;
            if (!$this->validateHostname($hostname)) {
                $tempDataProvider['hostname_valid'] = false;
                $tempDataProvider['hostname_error_class'] = self::INVALID_RECORD_HIGHLIGHT;
            }
			
			//Loopback validation
            $tempDataProvider['loopback'] = $loopback;
            $tempDataProvider['loopback_valid'] = true;
            $tempDataProvider['loopback_error_class'] = null;
			
            if (!$this->validateLoopback($loopback)) {
                $tempDataProvider['loopback_valid'] = false;
                $tempDataProvider['loopback_error_class'] = self::INVALID_RECORD_HIGHLIGHT;
            }
			
			//mac address validation
            $tempDataProvider['mac_address'] = $macAddress;
            $tempDataProvider['mac_address_valid'] = true;
            $tempDataProvider['mac_address_error_class'] = null;
            if (!$this->validateMacAddr($macAddress)) {
                $tempDataProvider['mac_address_valid'] = false;
                $tempDataProvider['mac_address_error_class'] = self::INVALID_RECORD_HIGHLIGHT;
            }
			
			$dataProvider[] = $tempDataProvider;
		}
		
		
		return $dataProvider;
	}
	
	
	 /**
     * Validate SAP Id 
     * @param string $sapid SAP ID
     * @return boolean true|false
     */
    public function validateSAPId($sapid) {
        return (strlen($sapid) == 18);
    }
	
	 /**
     * Validate Hostname
     * @param string $hostname
     * @return boolean true|false
     */
    public function validateHostname($hostname) {
        return (strlen($hostname) == 14);
    }
	
	 /**
     * Validate loopback IPV4
     * @param string $loopbackIp IPv4
     * @return boolean true|false
     */
    public function validateLoopback($loopbackIp) {
		
        return filter_var($loopbackIp, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
		//return filter_var($loopbackIp, FILTER_VALIDATE_IP);
                
//		$ip = $loopbackIp;
//		if (filter_var($ip, FILTER_VALIDATE_IP)) {
//		  return 1;
//		} else {
//		  return 0;
//		}		
    }
	
	 /**
     * Validate Mac Address
     * @param string $macAddr
     * @return boolean true|false
     */
    public function validateMacAddr($macAddr) {
        return filter_var($macAddr, FILTER_VALIDATE_MAC);
    }
	
}

?>