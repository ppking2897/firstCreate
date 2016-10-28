<?php
    
    header("Content-Type: text/html; charset=utf-8");
	include("connMysql.php");
	$seldb = @mysql_select_db("foodInfo");
	if (!$seldb) die("資料庫選擇失敗！");
    
    
    $foodName = ["雙層起司風味比薩" , "瑪格莉特風味比薩" , "墨西哥風味比薩" , "夏威夷風味比薩",
                   "茄子紅醬風味義大利麵" , "綜合海鮮紅醬風味義大利麵" , "花枝奶油白醬風味義大利麵" , 
                   "南瓜湯 " , "美式咖啡"]; 
        
    $foodNameList = ["numberCheesePizza","numberMargheritaPizza","numberMexicanPizza",
                     "numberHawaiianaPizza","numberEggplant","numberIntegratedSeafood",
                     "numberSquidCream","numberPumpkinSoup","numberCoffee"];

    $foodNameTaste = ["pizzaTaste1", "pizzaTaste2", "pizzaTaste3" ,"pizzaTaste4",
                          "pastaTaste1", "pastaTaste2", "pastaTaste3"];
    
    $foodPrice = ["110", "120", "130", "140", "210", "220", "230", "40", "50"];         
    
        
    for($i=0;$i<=count($foodNameList)-1;$i++){
        if(!isset($_COOKIE["$foodNameList[$i]"])){
            $checkData ++ ;
            if($checkData==8){
                $a = "Order Fail";
                echo $a;
                exit();
            }
        }
    }
    
    $a=$_COOKIE["selfTime"];
    
    
    setcookie("oldTime",$a);
    
    $sql_db = "SELECT * FROM `menu`";
    $result = mysql_query($sql_db);
    
?>

<html>
<head>
<title>管理者介面</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
<style>

    
</style>    
    
</head>    
<body>
  <table border="1" align="left">
    <tr>
    <th>菜色</th>
    <th>口味</th>
    <th>數量</th>
    <th>價格</th>
    </tr>


<?php

    
 
    while($row_result=mysql_fetch_assoc($result)){
        if($count ==0 && $check==1){
            echo "<table border=1 align=left>";
            echo  "<tr>";
            echo  "<th>菜色</th>";
            echo  "<th>口味</th>";
            echo  "<th>數量</th>";
            echo  "<th>價格</th>";
            echo  "</tr>";
            $check =0;
        }
		echo "<tr>";
		echo "<td>".$row_result["foodName"]."</td>";
		echo "<td>".$row_result["foodTaste"]."</td>";
		echo "<td>".$row_result["foodNumber"]."</td>";
		$singlePrice = $row_result["foodNumber"]*$row_result["foodPrice"];
		echo "<td>".$singlePrice."</td>";
		$sum += $singlePrice ;
		$count +=1;
		echo "</tr>";
		if($count>=9){
    		echo "<tr>";
    		echo "<Td COLSPAN=4 align=center>"."顧客預計取餐時間".$row_result["foodID"]."</td>";
    		echo "</tr>";
    		echo "<tr>";
            echo "<Td COLSPAN=4 align=center>"."總價格為:".$sum."</td>";
            echo "</tr>";
    		$count =0;
    		$check =1;
    		$sum = 0;
		}
		
    }
    
    
        

?>


</table>

</body>    
    
</html>

