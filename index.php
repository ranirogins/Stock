<?php include("config.php");?>

<!doctype html>
<html>
    <head>
        <title></title>
        <!-- Datatable CSS -->
		<script src="jquery-3.6.0.min.js"></script>
		<script src="ajax.js"></script>
		<link href="style.css" rel="stylesheet">
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
<style>
table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    text-align: left;
    padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}

</style>
     </head>
	
	  <body>
  <br />
  <div class="container">
   <h2 align="left">Stock</h2>
   
   
   <h2 align="center">The easiest wat to buy and sell stocks.</h2>
   <h4 align="center">Stock analysis and screening tool for inverstors in india.</h4>
  
   <div>
   <form name="frm" id="frm"  method="post" action="#"> 

<br/>
<br/>
<?php 
$comp_name=$_POST["comp_name"];
include('add.php'); ?>
</form></div><?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

$db2=new Database();
$stmt=$db2->query("select * from company where company_name =:comp_name");
$db2->bind(':comp_name',$comp_name);
$result = $db2->resultset();

$c_rowcount=$db2->rowcount();
if($c_rowcount>0){
	
foreach($result as $row){	
	$company_id=$row['company_id'];
	$company_name=$row['company_name'];
	$market_price=$row['market_price'];
	$market_cap=$row['market_cap'];
	$stock_pe=$row['stock_pe'];
	$dividend_yield=$row['dividend_yield'];
	$roce_per=$row['roce_per'];
	$roe_pre_annum=$row['roe_pre_annum'];
	$debit_equity=$row['debit_equity'];
	$eps=$row['eps'];
	$reserves=$row['reserves'];
	$debt=$row['debt'];
}


?>

<div class="wrapper" style="width:75% !important;">
<table>
<tr><th colspan="6"><h3><?php echo $company_name;?></h3></th></tr>
<tr>
<td>Market Cap</td>
<td><?php echo $market_cap;?></td>
<td>Dividend Yield</td>
<td><?php echo $dividend_yield;?></td>
<td>Debt to Equity</td>
<td><?php echo $debit_equity;?></td>
</tr>
<tr>
<td>Current Market Price</td>
<td><?php echo $market_price;?></td>
<td>ROCE %</td>
<td><?php echo $roce_per;?></td>
<td>EPS</td>
<td><?php echo $eps;?></td>
</tr>
<tr>
<td>Stock P/E</td>
<td><?php echo $stock_pe;?></td>
<td>ROE</td>
<td><?php echo $roe_pre_annum;?></td>
<td>Reserves</td>
<td><?php echo $reserves;?></td>
</tr>
<tr>
<td>Debt</td>
<td><?php echo $debt;?></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>


</table>
</div>
										
<?php }

else {
?><div class="wrapper" style="width:75% !important;">No Data Found</div>


<?php }
}?>
 </br>
   
  </div>
 </body>
  
</html>
