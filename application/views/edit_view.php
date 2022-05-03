<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

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

<div id="container">
	

	<div id="body">
			<form name="frmtypeadd" method="post" action="<?php echo base_url(); ?>Home/UpdateData" id="frmtypeadd" >
				
				<table width="91%" align="center" cellPadding=6 cellSpacing=1 class="tborder"> 
					<thead> 
						<tr> 
							<td colspan="2" align="left" class="tbhdr">Edit Data</td> 
						</tr> 
					</thead> 
					<tbody>
						<tr class="row1">
							<td colspan="2" align="left">
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
									<tr class="row2" align="left"> 
										<td>Sap id </td> 
										<td>
											<input name="Sapid" type="text" step="any" class="fld" id="Sapid" value="<?php echo $geteditData['Sapid'];?>" />
										</td>
									</tr>
									<tr class="row2" align="left"> 
										<td>Host Name</td> 
										<td>
											<input name="Hostname" type="text" step="any" class="fld" id="Hostname" value="<?php echo $geteditData['Hostname'];?>" />
										</td>
									</tr>
									<tr class="row2" align="left"> 
										<td>Loop Back</td> 
										<td>
											<input name="Loopback" type="text" step="any" class="fld" id="Loopback" value="<?php echo $geteditData['Loopback'];?>" />
										</td>
									</tr>
									<tr class="row2" align="left"> 
										<td>Macaddress</td> 
										<td>
											<input name="Macaddress" type="text" step="any" class="fld" id="Macaddress" value="<?php echo $geteditData['Macaddress'];?>" />
										</td>
									</tr>
									<tr>
										<td align="center" colspan="2">
											<input type="hidden" value="<?php echo $geteditData['Id'];?>" class="backbttn" name='id'>
											<input type="button" value="Back" class="backbttn" onclick="window.location.href='<?=$_SERVER['PHP_SELF']?>?pageno=<?=$pageNo?>';">
											<input type="submit" name="Save" id="Save" value="Add" class="loginbttn">
										</td> 
									</tr>
									
								</table>
							</td>
						</tr> 
					</tbody>
				</table>
			</form>	
	</div>
</div>

</body>
</html>