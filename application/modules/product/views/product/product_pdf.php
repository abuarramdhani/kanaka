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
    <h2><?php echo lang('product'); ?></h2>
</div>

<div id="content" style="text-align:center;">
<table width="100%" border="1" cellpadding="1" cellspacing="0">
	<tr>
		<th rowspan="2" align="center" width="5%" height="20px">No</th>
		<th rowspan="2" align="center"><?=lang('product_code')?></th>
		<th colspan="2" align="center"><?=lang('barcode')?></th>
		<th rowspan="2" align="center"><?=lang('product_name')?></th>
		<th rowspan="2" align="center"><?=lang('packing_size')?></th>
		<th rowspan="2" align="center"><?=lang('qty_per_ctn')?></th>
		<th colspan="4" align="center"><?=lang('carton_dimension')?></th>
		<th rowspan="2" align="center"><?=lang('weight')?></th>
		<th rowspan="2" align="center"><?=lang('category')?></th>
		<th rowspan="2" align="center"><?=lang('view_total')?></th>
		<th rowspan="2" align="center"><?=lang('description')?></th>
		<th rowspan="2" align="center"><?=lang('feature')?></th>
		<th rowspan="2" align="center"><?=lang('created_date')?></th>
	</tr>
	<tr>
		<th><?=lang('product')?></th>
		<th><?=lang('carton')?></th> 
		<th>L</th> 
		<th>W</th> 
		<th>H</th> 
		<th>Vol (m<sup>3</sup>)</th> 
	</tr>
	<?php 
    $i=0;
    if(count($products) > 0){
	   foreach($products as $product){
		   print_r($products);exit;
	   $i++;
   	?>
					
	<tr style="font-size:9px">
		<td align="center"><?php echo $i;?></td>
		<td><?=$product->product_code?></td>
		<td><?=$product->barcode_product?></td>
		<td><?=$product->barcode_carton?></td>
		<td><?=$product->name?></td>
		<td><?=$product->packing_size?></td>
		<td><?=$product->qty_per_ctn?></td>
		<td><?=$product->length?></td>
		<td><?=$product->width?></td>
		<td><?=$product->height?></td>
		<td><?=$product->volume?></td>
		<td><?=$product->weight?></td>
		<td><?=$product->category_id?></td>
		<td><?=$product->view_total?></td>
		<td><?=$product->description?></td>
		<td><?=$product->feature?></td>
		<td><?=date('d-m-Y',strtotime($product->date_created))?></td>
	</tr>
	<?php 
        }
    }
    else{
    ?>
        <tr style="font-size:9px">
		  <td align="center" colspan="10">No Data Available</td>
        </tr>
    <?php
    }
    ?>
</table>
</div>
</body>
</html>
