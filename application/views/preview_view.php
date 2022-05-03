
<!DOCTYPE html>

<html lang="en" id="loadPreviewData">
    <head>
        <title>Router Details</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        
        <style>
            .table-secondary{
                /*border: 1px solid gray;*/
                background: gray;
            }

            .table-danger{
                border: 1px solid red;
            }

        </style>
    </head>
    <body>
        <div class="row">
            <div id="container" class="ol-lg-12 mb-2" style="text-align: center;border: 1px;background-color: #94bf95; height: 30px;margin-top: 10px;padding-top: 5px;">
            <table class="table">
                    <thead>
                        <tr><b>
                        Router Data Preview
                            </b>
                        </tr>
                </thead>
            </table>
            </div>
        </div>
        <div class="row">
            <div id="container" class="ol-lg-12 mb-2">
                <table class="table">
                    <thead>
                        <tr style="background: #e0e3e5;">
                            <th scope="col">#</th>
                            <th scope="col">Sapid</th>
                            <th scope="col">Host Name</th>
                            <th scope="col">Loop Back</th>
                            <th scope="col">Macaddress</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        $error = 0;
                        foreach ($previewList as $Row) {
                            if(($Row['duplicate'] != '') || ($Row['sap_id_error_class'] != '') || ($Row['hostname_error_class'] != '') || ($Row['loopback_error_class'] != '') || ($Row['mac_address_error_class'] != '')){
                               $error = 1;
                            }
                            ?>
                            <tr class="<?PHP echo $Row['duplicate']; ?>" id="sampalInformation<?PHP echo $i; ?>">					
                                <th scope="row"><?php echo $i + 1; ?><input type="hidden" class="form-control" name="delete_status[]" id="delete_status<?PHP echo $i; ?>" value="1"></th>
                                <td class="<?PHP echo $Row['sap_id_error_class']; ?>"><input type="text" class="form-control" name="sap_id[]" value="<?php echo $Row['sap_id']; ?>"></td>
                                <td class="<?PHP echo $Row['hostname_error_class']; ?>"><input type="text" class="form-control" name="hostname[]" value="<?php echo $Row['hostname']; ?>"></td>
                                <td class="<?PHP echo $Row['loopback_error_class']; ?>"><input type="text" class="form-control" name="loopback[]" value="<?php echo $Row['loopback']; ?>"></td>
                                <td class="<?PHP echo $Row['mac_address_error_class']; ?>"><input type="text" class="form-control" name="mac_address[]" value="<?php echo $Row['mac_address']; ?>"></td>
                                <td onclick="removeRaw('<?PHP echo $i; ?>');"><i class="fa fa-trash"></i></td>
                            </tr>
                            <?php $i++;
                        } ?>
                    </tbody>
                </table>
                <div class="col-xl-12 col-lg-12 col-md-12 col-12 form-group text-center">
                    <button <?PHP if($error == 1){ ?> disabled="" <?PHP } ?> type="button" name='submit' value="submit" class="btn btn-primary mb-2" onclick="submitPreview()">Confirm and Continue</button>											
                    <button type="button" name='submit' value="submit" class="btn btn-primary mb-2" onclick="validateCheckPreview()">Validate</button>											
                </div>
            </div>
        </div>
    </body>
</html>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script type="text/javascript">
    function removeRaw(rowId) {
        $('#delete_status'+rowId).val("0");
        $('#sampalInformation' + rowId).hide();
    }
    
    function validateCheckPreview(){
        var sap_id = [];
        $("input[name='sap_id[]']").each(function(){
            sap_id.push(this.value);
        });
        
        var hostname = [];
        $("input[name='hostname[]']").each(function(){
            hostname.push(this.value);
        });
        
        var loopback = [];
        $("input[name='loopback[]']").each(function(){
            loopback.push(this.value);
        });
        
        var mac_address = [];
        $("input[name='mac_address[]']").each(function(){
            mac_address.push(this.value);
        });
        var delete_status = [];
        $("input[name='delete_status[]']").each(function(){
            delete_status.push(this.value);
        });
        
        var datastring = 'sap_id=' + sap_id + '&hostname=' + hostname + '&loopback=' + loopback + '&mac_address=' + mac_address+ '&delete_status=' + delete_status;
    
        $.ajax({
            url: "<?php echo base_url() ?>home/checkArrayValidation",
            type: 'POST',
            data: datastring,
            success: function(msg){
                $("#loadPreviewData").html(msg);
            }
        });
    }
    
    function submitPreview(){
        var sap_id = [];
        $("input[name='sap_id[]']").each(function(){
            sap_id.push(this.value);
        });
        
        var hostname = [];
        $("input[name='hostname[]']").each(function(){
            hostname.push(this.value);
        });
        
        var loopback = [];
        $("input[name='loopback[]']").each(function(){
            loopback.push(this.value);
        });
        
        var mac_address = [];
        $("input[name='mac_address[]']").each(function(){
            mac_address.push(this.value);
        });
        var delete_status = [];
        $("input[name='delete_status[]']").each(function(){
            delete_status.push(this.value);
        });
        
        var datastring = 'sap_id=' + sap_id + '&hostname=' + hostname + '&loopback=' + loopback + '&mac_address=' + mac_address + '&delete_status=' + delete_status;
    
        $.ajax({
            url: "<?php echo base_url() ?>home/checkAndSubmitArray",
            type: 'POST',
            data: datastring,
            success: function(msg){
                if(msg == '1'){
                    window.location = "<?php echo base_url() ?>home/redirectURL";  
                } else {
                    $("#loadPreviewData").html(msg);
                }
            }
        });
    }
</script>
