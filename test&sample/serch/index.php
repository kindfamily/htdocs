<?php
require("../../config/session.php");
require("../../config/config.php");
require("../../lib/db.php");

?>
<!DOCTYPE html>
<html>
    
<?php
// cdn 링크 모음
require("../../config/cdn.php");
?>
    <head>
        <style>
            ul{
                list-style:none;
            }
            #display {
                width:100%;
                display:none;
                position:static;
                z-index:9999;           
                float:right;
                border-left:solid 1px #dedede;
                border-right:solid 1px #dedede;
                border-bottom:solid 1px #dedede;
                overflow:hidden;
            }
    
            .display_box {
                padding:4px;
                font-size:12px;
                height:80px;
                background:#FFFFFF;
                color: #333333;
            }
            
            .display_box:hover {
                background:#fcffaa;
                color: black;
                cursor: pointer;
            }
            
            .boximage { 
                float:left;
                margin-right:10px;
            }
        </style>  
    
        <script>
            $(document).ready(function () {
                $("#keyword").keyup(function()   {
                    var keyword = $(this).val();
                    var dataString = 'searchword='+ keyword;                
                                
                    if(keyword=='') { 
                         
                         $("#display").hide();

                    } else {    
                        $.ajax({
                        type: "POST",
                        url: "suggestions.php",
                        data: dataString,
                        cache: false,
                        success: function(html) {               
                            $("#display").html(html).show(); 
                            
                            $("#key").click(function(){
                                $("#display").hide();
                                $("#play").html(html).show(); 
                            });
                          
                            }
                        });
                    } return false;                             
                });     
            }); 
    
 
            function goDetail(no) { 
                document.location.href="detail.php?no="+no;
            }   
            
           
            

            // 아직 미완성 코드
            // function addNewItem() { 
                
            //     var html2 = '<li><form action="javascript:checkSearch();"><div class="input-group" style="border:1px solid black; height:100px;"><input name="keyword" id="keyword" type="text" class="form-control"><span class="input-group-btn"><button class="btn btn-danger" type="button" onclick="javascript:checkSearch('+keyword+');">검색</button></span></div></form></li>';
            //     $("#addNew").after(html2);
            // }   
        </script>
    </head>
 
    <body>    
    <ul>
        <li id="addNew">
            <form action="javascript:checkSearch();">
                <div class="input-group">
                    <input name="keyword" id="keyword" type="text" class="form-control">
                    <span class="input-group-btn">
                        <button class="btn btn-danger" type="button" onclick="javascript:checkSearch('keyword');">검색</button>
                    </span>
                </div>
                <div id="display"></div>
                <div id="play"></div>
            </form>
            
          
        </li>
       
        
        <!-- <button class="btn btn-danger" type="button" onclick="javascript:addNewItem();">add new item</button> -->
    </ul>
        
       
    </body>
</html>
