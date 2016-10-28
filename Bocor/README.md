1.main.html主要是以網路上分享出的bootstrap製作，主要是改變畫面，內容顯示以及內容名稱跟改變
  超連結的網站
  
2.menu是比較主要的製作項目，php開頭判斷用isset指令確認按鍵的記憶體內容是否有改變，只要改變就成立，
  即使是空字串也是有將資料post出去，因為記憶體有做改變過
  
3.foodNameList(菜單選項)以及 foodNameTaste(口味)先宣告，讓其後面的判斷能夠開始進行，
  但應該將其做成一個能clude進去的表單，方便之後能夠維護或者新增菜單以及口味

4.判斷每個數量post出去的值是否為0，並以for迴圈做所有空格的判斷開始，並累加一個數值，若大於等於檢查的值
  則將判斷出每個品項的數值都是為0，則不引導到點餐成功的畫面，但應該出現一個數量為0的訊息
  
5.判斷其中品項至少一個有數量，就將post出去的資料儲存到cookie資料中，post出去的資料為菜單以及口味的資料
  儲存的cookie的資料可以方便給其他網頁做提領的動作
  
6.這邊是以時間做為類似會員資料的證明，並且到管理者那邊做比對做提領資料庫的依據
  $datetime = date ("Y-m-d H:i:s" , mktime(date('H')+9, date('i'), date('s'), date('m'), date('d'), date('Y'))) ;
  這語法是將時間改變形態顯示，提領時間並將此伺服器的時間改變為你想要的時間，並做儲存時間到cookie的動作
  並判斷是否之前有訂過餐，若有層直接跳到訂餐成功頁面，若沒有則直接繼續點餐  

javascript:  
7.當網頁準備好時，將畫面用慢速呈現出來

8.將所有的數字有所改變時，input[id='numberText']這數字的表格就會觸發change事件，去做出字串相加的動作
  此處的做法是判斷if($("input[id='numberText']").eq(0).val()!=0) 是否數量為0若沒有去做字串相加
  中間的eq是因為將id全部設定為同一個，利用eq去判斷是為哪一個區塊的菜單，再將此區塊菜名加入字串
        transformNumber = parseInt($("input[id='numberText']").eq(0).val(),10);
        此為菜單所輸入的數量將其由字串變成數字，數量*價格的結果當作單一個價格結果
        foodSingelPrice = foodPrice[0] * transformNumber;
        再將一個價格的結果持續相加，最後再將結果顯示
        foodSumPrice += foodSingelPrice ;
        這邊是將字串作相加，找出菜單名字，再找出口味的選項內的字串，再顯示數量跟價格
        但如果有兩種口味應該分開，此處只能選一個口味是"不合理"的
        foodName = "雙層起司風味" + "&nbsp" + $("#taste01").find(":selected").text() + "&nbsp" + "x" +  "&nbsp" + 
        $("input[id='numberText']").eq(0).val() + "&nbsp" + "&nbsp" + "$" + foodSingelPrice + "<br>"　;
    }

9.$(window).scroll(function(){
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
    這邊是將結帳視窗可以在視窗最上面、捲動中以及最下層時，可以改變視窗的位置
    防止當點多數的菜色時，會將顯示視窗拉長到最下面，導致不能按下確認按鈕

10.orderSuccess.php :
    include("connMysql.php");
    $seldb = mysql_select_db("foodInfo");
	if (!$seldb) die("資料庫選擇失敗！");
	先將連結到mysql的帳密資料以及格式資料包含進來
	開頭判斷是否有將資料庫選擇到你指定的資料庫，mysql_select_db　會回傳true或者false
	若成功則繼續，若失敗則顯示"資料庫選擇失敗！"　並停止
	
11.$foodName = ["雙層起司風味比薩" , "瑪格莉特風味比薩" , "墨西哥風味比薩" , "夏威夷風味比薩",
                   "茄子紅醬風味義大利麵" , "綜合海鮮紅醬風味義大利麵" , "花枝奶油白醬風味義大利麵" , 
                   "南瓜湯 " , "美式咖啡"]; 
        
    $foodNameList = ["numberCheesePizza","numberMargheritaPizza","numberMexicanPizza",
                     "numberHawaiianaPizza","numberEggplant","numberIntegratedSeafood",
                     "numberSquidCream","numberPumpkinSoup","numberCoffee"];

    $foodNameTaste = ["pizzaTaste1", "pizzaTaste2", "pizzaTaste3" ,"pizzaTaste4",
                          "pastaTaste1", "pastaTaste2", "pastaTaste3"];
    
    $foodPrice = ["110", "120", "130", "140", "210", "220", "230", "40", "50"];
    
    四個矩陣都是為了將別處的php內存入的cookie能夠讀取出來，所設定的名稱，都是以setcookie("名稱"，檔案)內的名稱
    去命名一致的名稱，才能夠以$_COOKIE("numberCheesePizza")的方式去提領

12.$sql_query = "INSERT INTO `menu` (`foodName`,`foodId` ,`foodTaste`, `foodNumber` ,`foodPrice`) VALUES ";
　 先將mysql指令做為字串存入裡面在由下面的迴圈去將menu內的所存入的cookie去做提領並將mysql字串相加
　 在由最後mysql_query($sql_query);去對資料庫做insert into 的動作
　 
    for($i=0;$i<=count($foodNameList)-1;$i++){
    
        if(!isset($_COOKIE["$foodNameList[$i]"])){
            $checkData ++ ;
            if($checkData==8){
                $a = "Order Fail";
                echo $a;
                exit();
            }
        }
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

13.menerger.php 　是管理者的角度去做出來的，此地方開頭是將訂單從資料庫提取出來的
    依照前面所存取的時間，去提領同個時間內所做的訂單，"但資料庫那邊是一直會儲存訂單
    並不會自動刪除，此處想法是要新增一個按鈕能夠結算當天的營業額以及賣的數量，再將及其兩個數值
    儲存到資料庫，能的話希望能夠自動更新頁面，並不是重新整理
    
14.$sql_db = "SELECT * FROM `menu`";
   $result = mysql_query($sql_db);
   這兩段語法是選取提取的資料庫內的子資料名稱，在利用下面那段去執行並指定資料庫的資料名稱
   若要指定哪一欄或者哪一列，後面加入where foodID=???　這段去更清楚選擇你所想要的資料
   此處是將所有資料全部提領，再將其歸類在同一時間上的訂單
   while($row_result=mysql_fetch_assoc($result))
   再利用這段將資料庫名稱對應，並且當內部的資料還沒提領完畢時，則會繼續執行while的迴圈