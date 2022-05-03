<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Router Details</title>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <style type="text/css">

            ::selection{ background-color: #E13300; color: white; }
            ::moz-selection{ background-color: #E13300; color: white; }
            ::webkit-selection{ background-color: #E13300; color: white; }

            body {
                background-color: #fff;
                margin: 40px;
                font: 13px/20px normal Helvetica, Arial, sans-serif;
                color: #4F5155;
            }

            a {
                color: #003399;
                background-color: transparent;
                font-weight: normal;
            }

            h1 {
                color: #444;
                background-color: transparent;
                border-bottom: 1px solid #D0D0D0;
                font-size: 19px;
                font-weight: normal;
                margin: 0 0 14px 0;
                padding: 14px 15px 10px 15px;
            }

            code {
                font-family: Consolas, Monaco, Courier New, Courier, monospace;
                font-size: 12px;
                background-color: #f9f9f9;
                border: 1px solid #D0D0D0;
                color: #002166;
                display: block;
                margin: 14px 0 14px 0;
                padding: 12px 10px 12px 10px;
            }

            #body{
                margin: 0 15px 0 15px;
            }

            p.footer{
                text-align: right;
                font-size: 11px;
                border-top: 1px solid #D0D0D0;
                line-height: 32px;
                padding: 0 10px 0 10px;
                margin: 20px 0 0 0;
            }

            #container{
                margin: 10px;
                border: 1px solid #D0D0D0;
                -webkit-box-shadow: 0 0 8px #D0D0D0;
            }

            .required{
                color: red;
            }
        </style>
    </head>
    <body>

        <div id="container">
            <div class="card">
                <div class="card-body">
                    <h1>Upload Router Details File!</h1>

                    <div id="body">
                        <div class="card-content">
                        
                            <form autocomplete="off" role="form"  onsubmit="return checkValidation();"  class="form-horizontal" action="<?PHP echo base_url(); ?>home/actionImportExcel" role="form" name="addEvent" id="addEvent" enctype="multipart/form-data"  method="post">
                                <div class="row mg-b-20">
                                    <div class="col-xl-4 col-lg-4 col-md-6 col-12 form-group"></div>
                                    <div class="col-xl-4 col-lg-4 col-md-6 col-12 form-group">
                                        <label>Import Router Details File<span class="required">*</span></label>
                                        <input accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" type="file" name="upload_file" id="upload_file" class="form-control" />
                                        <span id="fileErrorMsg" class="required"><?PHP echo $errorMsg; ?></span>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-6 col-12 form-group"></div>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-12 form-group text-center">
                                        <button type="submit" name='submit' value="submit" class="btn btn-primary mb-2">Submit</button>											
                                     
                                        <a href="<?=base_url ()?>home/download/router_details_sample.xls" class="btn btn-primary">Download Sample File</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script type="text/javascript">
    function checkValidation() {
        if (!$("#upload_file").val()) {
            $("#fileErrorMsg").html("<div class='alert alert-danger text-center' role='alert'>Please upload file</div>");
            $("#upload_file").focus();
            setTimeout(function(){ $("#fileErrorMsg").html(""); }, 2000);
            return false;
        } else {
            $("#fileErrorMsg").html("");
        }
    }

    
</script>