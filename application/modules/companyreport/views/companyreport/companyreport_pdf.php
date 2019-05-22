<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>

<style>
    body,table th,td{
        font-size: 11px;
        font-family: sans-serif;
    }
	
	 @page { margin: 10px 10px; }
     #header { left: 0px; top: 0px; right: 0px; text-align: center;  }
     #footer { left: 0px; bottom: 30px; right: 0px; font-size: 11px; font-family: sans-serif; text-align:right; }	
	  #content{
    	 border-bottom:0px solid #000000;
	 }
     #footer .page:after { content: counter(page, upper-roman); }
	#content{
	background-color:#FFFFFF;
	} 
</style>

<div id="header">
    <h2><?php echo lang('companyreport'); ?></h2>
</div>

<div id="content" style="text-align:center;">
<table width="100%" border="1" cellpadding="1" cellspacing="0">
	<tr >
		<th  align="center" width="5%" height="20px">No</th>
		<th  align="center"><?=lang('name')?></th>
		<th  align="center"><?=lang('description')?></th>
		<th  align="center"><?=lang('created_date')?></th>
	</tr>
	<?php 
    $i=0;
    if(count($companyreports) > 0){
	   foreach($companyreports as $companyreport){
	   $i++;
   	?>
					
	<tr style="font-size:9px">
		<td align="center"><?php echo $i;?></td>
		<td><?=$companyreport->name?></td>
		<td><?=$companyreport->description?></td>
		<td><?=date('d-m-Y',strtotime($companyreport->date_created))?></td>
	</tr>
	<?php 
        }
    }
    else{
    ?>
        <tr style="font-size:9px">
		  <td align="center" colspan="4">No Data Available</td>
        </tr>
    <?php
    }
    ?>
</table>
</div>
</body>
</html>
