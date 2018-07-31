<?php
// db연결, 세션 유지
require("../lib/head_other.php");
?>


  <div class="main w3-container"  style="border: 1px solid black;">

    <div class="w3-border" style="padding-top: 30px; ">
      <h4><b>주문/결제</b></h4>
      <span>
        주문번호:<?=$order_num?>
      </span>
    </div>
  </div>


<div class="main2 row" style="border: 1px solid black;">
  
  <div class="col-75">
    <div class="w3-container" style="border: 1px solid black;">
      <table class="number-table w3-center">
      <thead>
          <tr>
              <th scope="col">플랫폼</th>
              <th scope="col">이름</th>
              <th scope="col">사진</th>
              <th scope="col">가격</th>
              <th scope="col">검수요청</th>
          </tr>
      </thead>
      <?php
        $sql = "SELECT * FROM ck LEFT JOIN items ON ck.itemNum = items.id WHERE ck.id = '$id'";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
        echo '
          <tbody">
              <tr>
                <td>'.$row['platform'].'</td>
                <td>'.$row['title'].'</td>
                <td><img src="../'.$row['path'].'/'.$row['fileName2'].'" style="width:8rem" alt=""></td>
                <td>'.$row['price'].'</td>
                <td><input type="checkbox"></td>
              <tr/>
          </tbody>
        ';
        }

      ?>
      
      </table>

    </div>
    <div class="w3-container" style="border: 1px solid black;">
        <h3>결제수단</h3>
        <p>해외 구매대행 제품이므로 환불과 교환이 어렵습니다 제조사를 통한 이메일 as를 진행하셔야 합니다 이점 유의하시길 바라겠습니다 </p>
        <p>검수과정을 통해 초기 불량체크 후 수령을 원하시면 제품당 1만원의 추가 비용이 발생합니다</p>
    </div>
    <div class="w3-container" style="border: 1px solid black;">
        <h2>결제</h2>
        <p>해외 구매대행 제품이므로 환불과 교환이 어렵습니다 제조사를 통한 이메일 as를 진행하셔야 합니다 이점 유의하시길 바라겠습니다 </p>
        <p>검수과정을 통해 초기 불량체크 후 수령을 원하시면 제품당 1만원의 추가 비용이 발생합니다</p>
    </div>
    <div class="w3-container" style="border: 1px solid black;">
        <h2>주의사항</h2>
        <p>해외 구매대행 제품이므로 환불과 교환이 어렵습니다 제조사를 통한 이메일 as를 진행하셔야 합니다 이점 유의하시길 바라겠습니다 </p>
        <p>검수과정을 통해 초기 불량체크 후 수령을 원하시면 제품당 1만원의 추가 비용이 발생합니다</p>
    </div>
  </div>


  <div class="col-25">
    <div class="container">
      <h4>Cart <span style="color:black"><i class="fa fa-shopping-cart"></i> <b>1</b></span></h4>
      <?php
      $sql = "SELECT * FROM ck LEFT JOIN items ON ck.itemNum = items.id WHERE ck.id = '$id'";
      $result = mysqli_query($conn, $sql);
      while($row = mysqli_fetch_assoc($result)){
        echo '
          <p>'.$row['title'].'<span value="'.$row['price'].'">'.$row['price'].'</span></p>
          <hr>
          <p>Total <input id="price" type="hidden" value="'.$row['price'].'"> <span style="color:black">'.$row['price'].'</span></p>
          ';
        }
      ?>
    </div>
  </div>

</div>
  <button id="checkout" class="w3-right w3-margin w3-button w3-khaki w3-xlarge">결제</button>


<script>

var pri = document.getElementById("price");



document.getElementById("checkout").addEventListener('click', function () {
         // input hidden으로 받은 재료 가격
         // youtubepage.php 에서 파라미터 값으로 받은 정보( 사용자 이름, 주문번호 등 ) 는 chekOut > IMP.request_pay 로 전달 하기


         var IMP = window.IMP; // 생략가능
         IMP.init('imp44540441'); // 'iamport' 대신 부여받은 "가맹점 식별코드"를 사용
         
         IMP.request_pay({
         pg : 'inicis', // version 1.1.0부터 지원.
         pay_method : 'card',
         merchant_uid : 'merchant_' + new Date().getTime(),
         name : '주문명:결제테스트',
         amount : parseInt( pri.value ),
         buyer_email : 'iamport@siot.do',
         buyer_name : '구매자이름',
         buyer_tel : '010-1234-5678',
         buyer_addr : '서울특별시 강남구 삼성동',
         buyer_postcode : '123-456',
         // 모바일 결제시 리다이렉트 url
         m_redirect_url : 'https://www.yourdomain.com/payments/complete'
         }, function(rsp) {
             if ( rsp.success ) {
                 var msg = '결제가 완료되었습니다.';
                 msg += '고유ID : ' + rsp.imp_uid;
                 msg += '상점 거래ID : ' + rsp.merchant_uid;
                 msg += '결제 금액 : ' + rsp.paid_amount;
                 msg += '카드 승인번호 : ' + rsp.apply_num;

                 //  ajax 이용해서 order_info 테이블에 내용 추가하기

                 // 결제완료후 리다이렉트
                 window.location.href = 'http://localhost:8080/';
             } else {
                 var msg = '결제에 실패하였습니다.';
                 msg += '에러내용 : ' + rsp.error_msg;
             }
             alert(msg);
         });

     });

// 검수박스 체크되었을때 1000만원 토탈금액 변경
// 1 문서가 열렸을때 checkbox가 체크 되어 있는지 확인 하는 함수 만들기
// 참고: https://www.w3schools.com/jsref/tryit.asp?filename=tryjsref_checkbox_checked
// 2 토탈가격을 불러와서 변수에 담고
// 3 토탈가격 + 10000원
// 4 합쳐진 가격을 토탈가격에 집어 넣기 ( + 검수가격 10000 span 추가하기 )



</script>

</body>
</html>