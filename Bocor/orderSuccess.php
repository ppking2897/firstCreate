<?php
    include("connMysql.php");
    $seldb = mysql_select_db("foodInfo");
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
    
    $sql_query = "INSERT INTO `menu` (`foodName`,`foodId` ,`foodTaste`, `foodNumber` ,`foodPrice`) VALUES ";
    
    for($i=0;$i<=count($foodNameList)-1;$i++){
    
        if(!isset($_COOKIE["$foodNameList[$i]"])){
            $checkData ++ ;
            if($checkData==8){
                $a = "Order Fail";
                echo $a;
                exit();
            }
        }
        // $sql_query="UPDATE menu SET foodNumber='".$_COOKIE["$foodNameList[$i]"]."' WHERE foodId='$i' ";
        // mysql_query($sql_query);
        
        // $sql_query="UPDATE menu SET foodTaste='".$_COOKIE["$foodNameTaste[$i]"]."' WHERE foodId='$i' ";
        // mysql_query($sql_query);

        
        $sql_query .= "('".$foodName[$i]."',";
    	$sql_query .= "'".$_COOKIE["selfTime"]."',";
    	$sql_query .= "'".$_COOKIE["$foodNameTaste[$i]"]."',";
    	$sql_query .= "'".$_COOKIE["$foodNameList[$i]"]."',";
    	if($i!=8){
    	    $sql_query .= "'".$foodPrice[$i]."'),";
    	}
    	else{
    	    $sql_query .= "'".$foodPrice[$i]."');";
    	}
    }
    mysql_query($sql_query);
    // echo $a;
    $datetime = date ("Y-m-d H:i:s" , mktime(date('H')+9, date('i')-2, date('s'), date('m'), date('d'), date('Y'))) ;
    if($datetime>=$_COOKIE["selfTime"]){
        
        setcookie("selfTime",$_COOKIE["selfTime"],time());
        header("location:main.html");
        echo $datetime;
    }
    
    
?>

<html lang="en">
<head>
  <title>點餐成功!!</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="css/nivo-lightbox.css" rel="stylesheet" />
    <link href="css/nivo-lightbox-theme/default/default.css" rel="stylesheet" type="text/css" />
    <link href="css/animations.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet">
    <link href="color/default.css" rel="stylesheet">
  
  
</head>
<style type="text/css">


.progress{
    height : 20%;
}

.progress-bar{
    font-size : 2em;
    text-align : right;
}
#dateShow{
    text-align : center;
    font-size : 2em;
}

p{
    font-size : 1em;
}

</style>
<body>
    <div id="navigation">
    	<nav class="navbar navbar-custom" role="navigation">
          <div class="container">
                <div class="row">
                  <div class="col-md-2">
                   	<div class="site-logo">
                            <a href="main.html" class="brand" >Thankyou</a>
                    </div>
                  </div>
                      

                    <div class="col-md-10">
                     <!--Brand and toggle get grouped for better mobile display -->
                      	<div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
                            <i class="fa fa-bars"></i>
                            </button>
                      	</div>
                       <!--Collect the nav links, forms, and other content for toggling -->
                      	<div class="collapse navbar-collapse" id="menu">
                            <ul class="nav navbar-nav navbar-right">
                              <li class="active"><a href="main.html">Home</a></li>
                              <!--<li><a href="#about">About Us</a></li>-->
							  <!--<li><a href="#service">Services</a></li>-->
         <!--                     <li><a href="#works">Works</a></li>				                                                                  -->
                              
                              <li><a href="main.html#contact">Contact</a></li>
                            </ul>
                    	</div>
                    	 <!--/.Navbar-collapse -->
                    </div>
                </div>
          </div>
           <!--/.container -->
        </nav>
    </div> 
    <div id="mainArea"class="container">
      <div id="timeTitle"><br></div>
      <p>請於指定時間內前來領取餐點，謝謝!!</p>
      <div class="progress">
        
        <div id="loading" class="progress-bar progress-bar-striped active progress-bar-info " role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" 
            style="width:0%,height:70%">
          0%
        </div>
      </div>
      <div id="dateShow" name="dateShow">

              預計取餐時間:<?php  echo $_COOKIE["selfTime"]?>
      </div>
    </div>
    

<script>
    var timeSum = 0;
    function loopTime (){
        
        if(timeSum!=100){
            timeSum += 10; 
            waitTime = timeSum+"%" ;
            $("#loading").width(waitTime);
            $("#loading").text(waitTime);
            setTimeout('loopTime()',1000);
        }
        else{
            $("#loading").prop("class","progress-bar progress-bar-success progress-bar-striped")
        }
    }
    loopTime();
    
    

    // var someDate = new Date();
    // someDate.setHours(someDate.getHours()+1);
    
    // $("#dateShow").text("預計前來領餐時間:"+someDate);
</script>
</body>
</html>
