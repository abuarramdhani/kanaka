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
    <h2><?php echo lang('code'); ?></h2>
</div>

<div id="content" style="text-align:center;">
<table width="100%" border="1" cellpadding="1" cellspacing="0">
	<tr >
		<th  align="center" width="5%" height="20px">No</th>
		<th  align="center"><?=lang('code')?></th>
		<th  align="center"><?=lang('username')?></th>
		<th  align="center"><?=lang('type')?></th>
		<th  align="center"><?=lang('status')?></th>
		<th  align="center"><?=lang('created_date')?></th>
	</tr>
	<?php 
    $i=0;
    if(count($codes) > 0){
	   foreach($codes as $code){
	   $i++;
   	?>
					
	<tr style="font-size:9px">
		<td align="center"><?php echo $i;?></td>
		<td><?=$code->code?></td>
		<td><?=$code->username?></td>
		<td><?=ucwords(lang($code->type))?></td>
 		<td><?=$code->status == 0 ? lang('available') : lang('not_available')?></td>
		<td><?=date('d-m-Y',strtotime($code->date_created))?></td>
	</tr>
	<?php 
        }
    }
    else{
    ?>
        <tr style="font-size:9px">
		  <td align="center" colspan="6">No Data Available</td>
        </tr>
    <?php
    }
    ?>
</table>
</div>
</body>
</html>
