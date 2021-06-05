<?php
 include("config.php");
 $company_name=$_GET['c_na'];
  
$db2=new Database();

$stmt=$db2->query("select * from company where company_name like '%".$company_name."%' order by company_name asc");
$result = $db2->resultset();
$company_rowcount=$db2->rowcount();
$company="<ul class='list-unstyled'>";
if($company_rowcount>0){
	foreach($result as $row){
	$company.="<li>".$row['company_name']."</li>";
}
}
else
{
	$company.="<li>No Data Found</li>";
}
$company.="</ul>";
echo $company;
?>