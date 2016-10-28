<?php
    if(isset($_POST["btnAccept"])){
        $foodNameList = ["numberCheesePizza","numberMargheritaPizza","numberMexicanPizza",
                         "numberHawaiianaPizza","numberEggplant","numberIntegratedSeafood",
                         "numberSquidCream","numberPumpkinSoup","numberCoffee"];
        $foodNameTaste = ["pizzaTaste1", "pizzaTaste2", "pizzaTaste3" ,"pizzaTaste4",
                          "pastaTaste1", "pastaTaste2", "pastaTaste3"];                 
        
        for($i=0;$i<=count($foodNameList)-1;$i++){
            $a =$_POST["$foodNameList[$i]"];
            if($a==0){
                $numberCount += 1 ;
            }
            
        }
        if($numberCount!=9){
            // echo("sss");
            for($i=0;$i<=count($foodNameList)-1;$i++){
                // $a =$_POST["$foodNameList[i]"];
                setcookie("$foodNameList[$i]",$_POST["$foodNameList[$i]"]);
            }
            for($x=0;$x<=count($foodNameTaste)-1;$x++){
                setcookie("$foodNameTaste[$x]",$_POST["$foodNameTaste[$x]"]);
            }
            
            
            $datetime = date ("Y-m-d H:i:s" , mktime(date('H')+9, date('i'), date('s'), date('m'), date('d'), date('Y'))) ;
            if(!isset($_COOKIE["selfTime"])){
                setcookie("selfTime",$datetime);
            }
            header("location:orderSuccess.php");
        }
        
    }
    if(isset($_COOKIE["selfTime"])){
        header("location:orderSuccess.php");
    }
    
    
?>　






<html>
<head>
<meta charset="UTF-8">
<script style="text/javascript" src="js/jquery.js"></script>   
<link rel="stylesheet" href="css/bootstrap.min.css">
<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="css/nivo-lightbox.css" rel="stylesheet" />
<link href="css/nivo-lightbox-theme/default/default.css" rel="stylesheet" type="text/css" />
<link href="css/animations.css" rel="stylesheet" />
<link href="css/style.css" rel="stylesheet">
<link href="color/default.css" rel="stylesheet">

<style>
body{
    background : white;
    font-size : 2em;
}

#mainMenu{
    /*border : 2px solid gray;*/
    border-radius : 10px;
    width : 60%;
    height : 180%;
    margin : 2% 0% 0 5%;
    background : #ffffe6;
    display : none;
    float :left;
    
    
}    
h3{
    color : #000d33;
}
#foodTitle{
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    background : #00e6b8;
}


#bigArea{
    /*border-top : 1px solid gray;*/
    height : 30%;
    width : 100%;
    float :left;
    margin : 0% 0 5% 0;
    text-align : center ;
}

#smallArea1{
    height : 100%;
    width : 22%;
    margin : 1% 1%;
    text-align : center ;
    float :left;

}
#smallArea2{
    height : 100%;
    width : 22%;
    margin : 1% 5%;
    text-align : center ;
    float :left;

}
#smallArea3{
    height : 100%;
    width : 22%;
    margin : 1% 14%;
    text-align : center ;
    float :left;

}

#pizzaName{
    margin : 5% 0 5% 0;
}

#tasteArea{
    margin : 5% 0 5% 0;
}
#numberText{
    width : 25%;
    text-align : right;
}


#orderList{
    border-radius : 10px;
    float : left;
    /*border :1px solid gray;*/
    height :60%;
    width :25%;
    margin :2% 0% 0 70%;
    position : fixed;
    text-align : center;
    
}
hr{
    width: 100%;
    height: 2px;
    margin-left: auto;
    margin-right: auto;
    background-color:#000000;
    color:#000000;
}

p2{
    font-size : 2em;
}
#btnOK{
    height : 30%;
    width :40%;
    float : left;
    margin : 5% 10% 0% 5%;

}
#btnCancel{
    height : 30%;
    width : 40%;
    float:left;
    margin : 5% 0 0% 0%;
    
}




</style>
</head>    
<body>
    <title>點餐畫面</title>
    <!-- Navigation -->
    <div id="navigation">
    	<nav class="navbar navbar-custom" role="navigation">
          <div class="container">
                <div class="row">
                  <div class="col-md-2">
                   	<div class="site-logo">
                            <a href="main.html" class="brand">Menu</a>
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
                              <li class="active"><a href="#intro">Home</a></li>
                              <li><a href="#about">About Us</a></li>
							  <!--<li><a href="#service">Services</a></li>-->
         <!--                     <li><a href="#works">Works</a></li>				                                                                  -->
                              
                              <li><a href="#contact">Contact</a></li>
                            </ul>
                    	</div>
                    	 <!--/.Navbar-collapse -->
                    </div>
                </div>
          </div>
           <!--/.container -->
        </nav>
    </div> 
    
    <form method="post">
        <div id="mainMenu">
            <!--pizzaArea-->
            <div id="bigArea" style="border-top : 0 ;">
                <div id="foodTitle">    
                    <h3>Pizza:</h3>
                </div>
                <div id="smallArea1">
                    <!--picture-->            
                    <div id="pizzaPicture">
                        <img src="img/pizza01.jpg"/>
                    </div>
                    <!--picture-->
                    <div id="pizzaName" name="pizzaName">
                        雙層起司風味
                        <br>
                        價格:
                        <span>110</span>
                    </div>
                    <!--option-->
                    <div id="tasteArea">
                        餅皮選擇:
                        <select name="pizzaTaste1" id="taste01">
                            <option value="厚鬆餅皮">厚鬆餅皮</option>
                            <option value="薄脆餅皮">薄脆餅皮</option>
                        </select>
                    </div>
                    <div id="numberArea">
                        數量:
                        <input type = "number" id="numberText" min="0" value="0" name="numberCheesePizza"/>
                    </div>
                </div>
                <!--smallArea1-->
                <div id="smallArea1">
                    <!--picture-->            
                    <div id="pizzaPicture">
                        <img src="img/pizza02.jpg"/>
                    </div>
                    <!--picture-->
                    <div id="pizzaName">
                        瑪格莉特風味
                        <br>
                        價格:
                        <span>120</span>
                    </div>
                    <!--option-->
                    <div id="tasteArea">
                        餅皮選擇:
                        <select name="pizzaTaste2" id="taste02">
                            <option value="厚鬆餅皮">厚鬆餅皮</option>
                            <option value="薄脆餅皮">薄脆餅皮</option>
                        </select>
                    </div>
                    <div id="numberArea">
                        數量:
                        <input type = "number" id="numberText" min="0" value="0" name="numberMargheritaPizza"/>
                    </div>
                </div>
                <!--smallArea1-->
                <div id="smallArea1">
                    <!--picture-->            
                    <div id="pizzaPicture">
                        <img src="img/pizza03.jpg"/>
                    </div>
                    <!--picture-->
                    <div id="pizzaName">
                        墨西哥風味
                        <br>
                        價格:
                        <span>130</span>
                    </div>
                    <!--option-->
                    <div id="tasteArea">
                        餅皮選擇:
                        <select name="pizzaTaste3" id="taste03">
                            <option value="厚鬆餅皮">厚鬆餅皮</option>
                            <option value="薄脆餅皮">薄脆餅皮</option>
                        </select>
                    </div>
                    <div id="numberArea">
                        數量:
                        <input type = "number" id="numberText" min="0" value="0" name="numberMexicanPizza"/>
                    </div>
                </div>
                <!--smallArea1-->
                <div id="smallArea1">
                    <!--picture-->            
                    <div id="pizzaPicture">
                        <img src="img/pizza04.jpg"/>
                    </div>
                    <!--picture-->
                    <div id="pizzaName">
                        夏威夷風味
                        <br>
                        價格:
                        <spam>140</spam>
                    </div>
                    <!--option-->
                    <div id="tasteArea">
                        餅皮選擇:
                        <select name="pizzaTaste4" id="taste04">
                            <option value="厚鬆餅皮">厚鬆餅皮</option>
                            <option value="薄脆餅皮">薄脆餅皮</option>
                        </select>
                    </div>
                    <div id="numberArea">
                        數量:
                        <input type = "number" id="numberText" min="0" value="0" name="numberHawaiianaPizza"/>
                    </div>
                </div>
            </div>
            <!--pastaArea-->
            <div id="bigArea">
                <div id="foodTitle">    
                    <h3>Pasta:</h3>
                </div>
                <div id="smallArea2">
                    <!--picture-->            
                    <div id="pastaPicture">
                        <img src="img/paste01.jpg"/>
                    </div>
                    <!--picture-->
                    <div id="pastaName">
                        茄子紅醬風味
                        <br>
                        價格:
                        <span>210</span>
                    </div>
                    <!--option-->
                    <div id="tasteArea">
                        麵條選擇:
                        <select name="pastaTaste1" id="taste05">
                            <option value="直麵">直麵</option>
                            <option value="筆管麵">筆管麵</option>
                        </select>
                    </div>
                    <div id="numberArea">
                        數量:
                        <input type = "number" id="numberText" min="0" value="0" name="numberEggplant"/>
                    </div>
                </div>
                <div id="smallArea2">
                    <!--picture-->            
                    <div id="pastaPicture">
                        <img src="img/paste02.jpg"/>
                    </div>
                    <!--picture-->
                    <div id="pastaName">
                        綜合海鮮紅醬風味
                        <br>
                        價格:
                        <span>220</span>
                    </div>
                    <!--option-->
                    <div id="tasteArea">
                        麵條選擇:
                        <select name="pastaTaste2" id="taste06">
                            <option value="直麵">直麵</option>
                            <option value="筆管麵">筆管麵</option>
                        </select>
                    </div>
                    <div id="numberArea">
                        數量:
                        <input type = "number" id="numberText" min="0" value="0" name="numberIntegratedSeafood"/>
                    </div>
                </div>
                <div id="smallArea2">
                    <!--picture-->            
                    <div id="pastaPicture">
                        <img src="img/paste03.jpg"/>
                    </div>
                    <!--picture-->
                    <div id="pastaName">
                        花枝奶油白醬風味
                        <br>
                        價格:
                        <span>230</span>
                    </div>
                    <!--option-->
                    <div id="tasteArea">
                        麵條選擇:
                        <select name="pastaTaste3" id="taste07">
                            <option value="直麵">直麵</option>
                            <option value="筆管麵">筆管麵</option>
                        </select>
                    </div>
                    <div id="numberArea">
                        數量:
                        <input type = "number" id="numberText" min="0" value="0" name="numberSquidCream"/>
                    </div>
                </div>
            </div>
            <div id="bigArea">
                <div id="foodTitle">    
                    <h3>Others:</h3>
                </div>
                <div id="smallArea3">
                    <!--picture-->            
                    <div id="elsePicture">
                        <img src="img/soup01.jpg"/>
                    </div>
                    <!--picture-->
                    <div id="elseName">
                        南瓜湯
                        <br>
                        價格:
                        <span>40</span>
                    </div>
                    <div id="numberArea">
                        數量:
                        <input type = "number" id="numberText" min="0" value="0" name="numberPumpkinSoup"/>
                    </div>
                </div>
                <div id="smallArea3">
                    <!--picture-->            
                    <div id="elsePicture">
                        <img src="img/coffee01.jpg"/>
                    </div>
                    <!--picture-->
                    <div id="elseName">
                        美式咖啡
                        <br>
                        價格:
                        <span>50</span>
                    </div>
                    <div id="numberArea">
                        數量:
                        <input type = "number" id="numberText" min="0" value="0" name="numberCoffee"/>
                    </div>
                </div>
            </div>
        </div>
    <!--mainMenu-->

        <div id="orderList">
            <div id="foodTitle">    
                <h3>OrderList:</h3>
            </div>
            <p1></p1>
            <div id="foodTitle">    
                <h3>Sum:</h3>
            </div>
            <p2></p2>
            <div>
                <div id="btnOK">
                    <input type = "submit" value="確認" id="btnAccept" name="btnAccept"/>
                </div>    
                <div id="btnCancel">
                    <input type = "button" value="取消"/>
                </div>
            </div>
        </div>
        
        
    </form>
    
  
</body>    
<script>
    
    
    

    $(document).ready(function (){
        // alert("SSS");
        $("#mainMenu").show(1500);
        // y = parseInt($("input[id='numberText']").eq(0).val(),10);
        // alert(y);
    });
    
    var foodName = "";
    var menuAllNumber = 8;               //菜單總數
    
    var foodPrice = new Array;
    foodPrice=[110,120,130,140,210,220,230,40,50];
    
    var foodSumPrice = "";
    
    function foodPrint(){
        var i =0;
        $("p1").html("");
        foodName = "";
        foodSumPrice = 0;
        for(i=0;i<=menuAllNumber+1;i++){
            switch(i){
                case 0 :
                        if($("input[id='numberText']").eq(0).val()!=0){
                            transformNumber = parseInt($("input[id='numberText']").eq(0).val(),10);
                            foodSingelPrice = foodPrice[0] * transformNumber;
                            foodSumPrice += foodSingelPrice ;
                            foodName = "雙層起司風味" + "&nbsp" + $("#taste01").find(":selected").text() + "&nbsp" + "x" +  "&nbsp" + 
                            $("input[id='numberText']").eq(0).val() + "&nbsp" + "&nbsp" + "$" + foodSingelPrice + "<br>"　;
                        }
                        else {
                                foodName += "";
                        }
                        break;
                case 1 :
                        if($("input[id='numberText']").eq(1).val()!=0){
                            transformNumber = parseInt($("input[id='numberText']").eq(1).val(),10);
                            foodSingelPrice = foodPrice[1] * transformNumber;
                            foodSumPrice += foodSingelPrice ;
                            foodName = "瑪格莉特風味"  + "&nbsp"  + $("#taste02").find(":selected").text() + "&nbsp" + "x" +  "&nbsp" + 
                            $("input[id='numberText']").eq(1).val() + "&nbsp" + "&nbsp" + "$" + foodSingelPrice + "<br>"　;
                            
                        }
                        else {
                            foodName = "";
                        }
                        break;
                
                case 2 :
                        if($("input[id='numberText']").eq(2).val()!=0){
                            transformNumber = parseInt($("input[id='numberText']").eq(2).val(),10);
                            foodSingelPrice = foodPrice[2] * transformNumber;
                            foodSumPrice += foodSingelPrice ;
                            foodName = "墨西哥風味"  + "&nbsp"  + $("#taste03").find(":selected").text()  + "&nbsp" + "x" +  "&nbsp" + 
                           $("input[id='numberText']").eq(2).val() + "&nbsp" + "&nbsp" + "$" + foodSingelPrice + "<br>"　;
                        }
                        else {
                            foodName = "";
                        }
                        break;
                
                case 3 :
                        if($("input[id='numberText']").eq(3).val()!=0){
                            transformNumber = parseInt($("input[id='numberText']").eq(3).val(),10);
                            foodSingelPrice = foodPrice[3] * transformNumber;
                            foodSumPrice += foodSingelPrice ;
                            foodName = "夏威夷風味"  + "&nbsp"  + $("#taste04").find(":selected").text() + "&nbsp" + "x" +  "&nbsp" + 
                            $("input[id='numberText']").eq(3).val() + "&nbsp" + "&nbsp" + "$" + foodSingelPrice + "<br>"　;
                        }
                        else {
                            foodName = "";
                        }
                        break;
                case 4 :
                        if($("input[id='numberText']").eq(4).val()!=0){
                            transformNumber = parseInt($("input[id='numberText']").eq(4).val(),10);
                            foodSingelPrice = foodPrice[4] * transformNumber;
                            foodSumPrice += foodSingelPrice ;
                            foodName = "茄子紅醬風味"  + "&nbsp"  + $("#taste05").find(":selected").text() + "&nbsp"+ "x" +  "&nbsp" + 
                            $("input[id='numberText']").eq(4).val() + "&nbsp" + "&nbsp" + "$" + foodSingelPrice + "<br>"　; 
                        }
                        else {
                            foodName = "";
                        }       
                        break;
                case 5 :
                        if($("input[id='numberText']").eq(5).val()!=0){
                            transformNumber = parseInt($("input[id='numberText']").eq(5).val(),10);
                            foodSingelPrice = foodPrice[5] * transformNumber;
                            foodSumPrice += foodSingelPrice ;
                            foodName = "綜合海鮮紅醬風味"  + "&nbsp"  + $("#taste06").find(":selected").text() + "&nbsp"+ "x" +  "&nbsp" + 
                            $("input[id='numberText']").eq(5).val() + "&nbsp" + "&nbsp" + "$" + foodSingelPrice + "<br>"　; 
                        }
                        else {
                            foodName = "";
                        }       
                        break;
                case 6 :
                        if($("input[id='numberText']").eq(6).val()!=0){
                            transformNumber = parseInt($("input[id='numberText']").eq(6).val(),10);
                            foodSingelPrice = foodPrice[6] * transformNumber;
                            foodSumPrice += foodSingelPrice ;
                            foodName = "花枝奶油白醬風味"  + "&nbsp"  + $("#taste07").find(":selected").text() + "&nbsp"+ "x" +  "&nbsp" + 
                            $("input[id='numberText']").eq(6).val() + "&nbsp" + "&nbsp" + "$" + foodSingelPrice + "<br>"　;
                        }
                        else {
                            foodName = "";
                        }       
                        break;
                case 7 :
                        if($("input[id='numberText']").eq(7).val()!=0){
                            transformNumber = parseInt($("input[id='numberText']").eq(7).val(),10);
                            foodSingelPrice = foodPrice[7] * transformNumber;
                            foodSumPrice += foodSingelPrice ;
                            foodName = "南瓜湯 "  + "&nbsp"  + "x" +  "&nbsp" + $("input[id='numberText']").eq(7).val() + "&nbsp" + "&nbsp" + "$" 
                            + foodSingelPrice + "<br>"　;; 
                        }
                        else {
                            foodName = "";
                        }       
                        break;
                case 8 :
                        if($("input[id='numberText']").eq(8).val()!=0){
                            transformNumber = parseInt($("input[id='numberText']").eq(8).val(),10);
                            foodSingelPrice = foodPrice[8] * transformNumber;
                            foodSumPrice += foodSingelPrice ;
                            foodName = "美式咖啡"  + "&nbsp"  + "x" +  "&nbsp" + $("input[id='numberText']").eq(8).val() + "&nbsp" + "&nbsp" + "$" 
                            + foodSingelPrice + "<br>"　;;  
                        }
                        else {
                            foodName = "";
                        }       
                        break;
                
                default:
                        foodName = "" + "<br>";
                        
                        break;
            }
            $("p1").html($("p1").html()+foodName);
            $("p2").html("$"+foodSumPrice);
        }  
    }
    
    
    $("select").change(foodPrint);
    $("input[id='numberText']").change(foodPrint);
    //結帳清單隨著畫面捲動移動位置 
    $(window).scroll(function(){
        $("#orderList").css("margin","-10% 0 0 70%");
     });
   
    
    $(window).scroll(function() {
        if($(window).scrollTop() + $(window).height() == $(document).height()) {
            $("#orderList").css("margin","-10% 0 0 70%");
        }
    });
    $(window).scroll(function() {
        if($(window).scrollTop() == 0) {
            $("#orderList").css("margin","2% 0 0 70%");
        }
    });
    
</script>


</html>