<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Router Details</title>
        
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css"/>
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
        </style>
    </head>
    <body>
    <div class="row">
            <div id="container" class="ol-lg-12 mb-2" style="text-align: center;border: 1px;background-color: #94bf95; height: 39px;margin-top: 0px;width: 1000px;margin-left: 24px;padding-top: 10px;font-size: 22px;">
            <table class="table">
                    <thead>
                        <tr>
                            <b>
                                Router Details
                            </b>
                        </tr>
                </thead>
            </table>            
            </div>

            <div class="ol-lg-12 mb-2" style="width: 259px;">
            <table class="table">
                    <thead>
                        <tr>
                        <a href="<?=base_url ()?>home" class="btn btn-primary">Import Router File</a>
                        </tr>
                </thead>
            </table>            
            </div>

 

        </div>
        <div id="container">
        
            <div id="body">
                <table id="example" class="table table-striped">
                    <thead>
                        <tr  style="background: #7e929f;">
                            <th>Sapid</th>
                            <th>Hostname</th>
                            <th>Loopback</th>
                            <th>Macaddress</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?PHP foreach ($excelRecordList as $value) { ?> 
                        <tr>
                            <td><?PHP echo $value['Sapid']; ?></td>
                            <td><?PHP echo $value['Hostname']; ?></td>
                            <td><?PHP echo $value['Loopback']; ?></td>
                            <td><?PHP echo $value['Macaddress']; ?></td>
                            <td style="cursor: pointer;"> 
                            <a class="reminderdit" delete_id="<?php echo $value['Id']; ?>" title="Delete">Delete</a>
                            
                            
                            
                        </td>								
                        </tr>
                    <?PHP } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
        
        <script type="text/javascript">
            $(document).ready(function() {
                $('#example').DataTable();

            $(".reminderdit").click(function () {
                var delete_id = $(this).attr("delete_id");

                let text = "Are you sure you want to delete this row";
                if (confirm(text) == true) {
                    var send_obj = new Object();
                    send_obj['delete_id'] = delete_id;           
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>home/DeleteDate",
                        data: send_obj,
                        success: function (msg) {
                            location.reload();
                        }
                    });
            } 
        });

    });

            
        </script>
    </body>
</html>