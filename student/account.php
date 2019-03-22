<?
$assID = $assRow['id'];

$queryCashier = "SELECT * from cashier where student_id = ? and assessment_id = ? ";
$getCashier = $conn->prepare($queryCashier);
$getCashier->execute(array($sid, $assID));
$cashRow = $getCashier->fetch(PDO::FETCH_ASSOC);

if(!empty($cashRow)){

  $queryCashier1 = "SELECT * from cashier where student_id = ? and assessment_id = ? order by id DESC limit 1";
  $getCashier1 = $conn->prepare($queryCashier1);
  $getCashier1->execute(array($sid, $assID));
  $cashRow1 = $getCashier1->fetch(PDO::FETCH_ASSOC);

  $queryCashier2 = "SELECT * from cashier where student_id = ? and assessment_id = ? and status = ? order by id DESC limit 1";
  $getCashier2 = $conn->prepare($queryCashier2);
  $getCashier2->execute(array($sid, $assID,"Pending"));
  $cashRow2 = $getCashier2->fetch(PDO::FETCH_ASSOC);

  $queryCashier3 = "SELECT sum(amount) as sum from cashier where student_id = ? and assessment_id = ? and status != ? order by id DESC limit 1";
  $getCashier3 = $conn->prepare($queryCashier3);
  $getCashier3->execute(array($sid, $assID, "Pending"));
  $cashRow3 = $getCashier3->fetch(PDO::FETCH_ASSOC);

  $queryCashier4 = "SELECT * from cashier where student_id = ? and assessment_id = ? and status != ? order by id DESC limit 1";
  $getCashier4 = $conn->prepare($queryCashier4);
  $getCashier4->execute(array($sid, $assID, "Pending"));
  $cashRow4 = $getCashier4->fetch(PDO::FETCH_ASSOC);
}



$option = $assRow['pay_plan'];
$net = $assRow['net_payable'];
//echo $option;

if($option=="full"){
  $div = 1;
  $perPay = $net/$div;
  $plan = "Full Payment";
}
else if($option=="half"){
  $div = 2;
  $perPay = $net/$div;
  $plan = "Two (2) Payments";
}
else if($option=="tri"){
  $div = 3;
  $perPay = $net/$div;
  $plan = "Three (3) Payments";
}
else if($option=="quarter"){
  $div = 4;
  $perPay = $net/$div;
  $plan = "Four (4) Payments";
}
$regFee = 500.00;

$ref = randomPass();


if(empty($cashRow)){
  $paymentStatus = "No payments yet";
}else{
  $paymentStatus = $cashRow4['comment']." ".$cashRow4['status'];
}

?>

<?php
if(($eRow['id']=="1") && ($eRow['status']=="Open")  ){

  if( ($isRegular=="REGULAR") && ($enrollmentRow['year_level']=="II")  && ($enrollmentRow['course_code']=="BA")  || ($enrollmentRow['course_code']=="BEED")  || ($enrollmentRow['course_code']=="ENG")  || ($enrollmentRow['course_code']=="FIL")  || ($enrollmentRow['course_code']=="MAPEH")  || ($enrollmentRow['course_code']=="SOCSCI") || ($enrollmentRow['course_code']=="MATH") ){
    if(empty($scRow)){ ?>
    <button onclick="document.getElementById('addBlockClassB').style.display='block'" class="w3-button w3-blue w3-left">Enroll Online</button>
    <?php } 
    
  }else{
    ?>
      <button onclick="" class="w3-button w3-gray w3-left">Online Enrollment is not Allowed</button>
    <?php
  }
  
}else{
  ?>
    <button class="w3-button w3-red w3-left">Enrollment is closed</button>
  <?php

}
if($assRow['pay_plan']==null){

  ?>
  <div>
<button class="w3-button w3-gray w3-right"  style="margin-left: 20px; ">
    Pay Registration Fee Only
</button>

<button class="w3-button w3-grey w3-right" style="margin-left: 20px; ">
    Pay Current Due
</button>

<button class="w3-button w3-gray w3-right"  style="margin-left: 20px; ">
    Pay with Card
</button>
<button class="w3-button w3-yellow w3-right" onclick="addPayOpt2()" style="">
    Add Payment Option
</button>
</div>

      <div class="w3-container " style="padding-left: 50px;">
 <?php 
  
      
    

 

}else{



if(empty($cashrow2) && $cashRow1['counter']!="0"){
?>

<button class="w3-button w3-yellow w3-right" onclick="showPayForm()" style="margin-left: 20px; ">
    Pay Current Due
</button>

<button class="w3-button w3-yellow w3-right" onclick="showCardInfo()" style="margin-left: 20px; ">
    Pay with Card
</button>

<?php }
else{
 ?>

<button class="w3-button w3-grey w3-right" style="margin-left: 20px; ">
    Pay Current Due
</button>

<button class="w3-button w3-gray w3-right"  style="margin-left: 20px; ">
    Pay with Card
</button>
<?php 
}

if( ($assRow['pay_plan']!="full") && (empty($cashRow)) ){ ?>
<button class="w3-button w3-yellow w3-right" onclick="showPayRegFeeForm()" style="margin-left: 20px; ">
    Pay Registration Fee Only
</button>
<?php 
}
//if($enInfo['sem']!=$sem && $enInfo['school_year'])
}

?>
<br>

<table class="verdana dot-border w3-padding" style="width: 100%; margin-top:20px;" >
  <tr class="top-5">
    <td class="width-30">Payment Plan:</td>
    <td class="width-30"></td>
    <td class="width-10 w3-center"></td>
    <td id="po" class="right bold"><?php 
      if($plan==null){
        echo "Not yet enrolled";
      }else{echo $plan;} ?></td>
  </tr>
  <tr class="top-5">
    <td class="width-30">Discount:</td>
    <td class="width-30"></td>
    <td class="width-10 w3-center"></td>
    <td id="discount" class="right bold">PHP <?php 
      if($plan==null){
        echo "0";
      }else{
        echo $assRow['discount'];  
      }
      
    ?></td>
  </tr>
  <tr class="top-5">
    <td class="width-30">Net Payable:</td>
    <td class="width-30"></td>
    <td class="width-10 w3-center"></td>
    <td id="net" class="right bold">PHP <?php 
      if($plan==null){
        echo "0";
      }else{
        echo $assRow['net_payable'];
      }
     ?></td>
  </tr>
  <tr class="top-5">
    <td class="width-30">Per Pay Payable:</td>
    <td class="width-30"></td>
    <td class="width-10 w3-center"></td>
    <td id="perPay" class="right bold">PHP <?php 
      if($plan==null){
        echo "0";
      }else{
        echo $perPay;
      }
       ?>.00</td>
  </tr>
</table>
<table class="verdana dot-border w3-padding" style="width: 100%; margin-top:20px;" >
  <tr class="top-5">
    <td class="width-50">Pending Student Payment:</td>
    <td id="net" class="right bold" style="display: none;"> ( REFERENCE CODE:  <?php echo $cashRow2['ref_no']; ?> )</td>
    <td id="net" class="right bold">PHP <?php echo $cashRow2['amount']; ?></td>
  </tr>
</table>
<table class="verdana dot-border w3-padding" style="width: 100%; margin-top:20px;" >
  <tr class="top-5">
    <td class="width-30">Payment Status:</td>
    <td id="po" class="right bold"><?php echo $paymentStatus; ?></td>
  </tr>
  <tr class="top-5">
    <td class="width-30">Payments Left:</td>
    <td id="discount" class="right bold"><?php 
      if($plan==null){
        echo "N/A";
      }else{
        echo $cashRow1['counter'];
      } 
    ?> </td>
  </tr>
  <tr class="top-5">
    <td class="width-30">Total Paid Amount:</td>
    <td id="net" class="right bold">PHP <?php 
    if($plan==null){
        echo "0";
      }else{
        echo $cashRow3['sum'];} ?></td>
  </tr>
  <tr class="top-5">
    <td class="width-30">Outstanding Balance:</td>
    <td id="net" class="right bold">PHP <?php 
      if($plan==null){
        echo "0";
      }else{
    echo $cashRow1['bal'];} ?></td>
  </tr>
  <tr class="top-5">
    <td class="width-30">Current Due:</td>
    <td id="perPay" class="right bold">PHP <?php 
    if($plan==null){
        echo "0";
      }else{
        echo $perPay;} ?>.00</td>
  </tr>
</table>
<div class="verdana dot-border w3-padding" style="width: 100%; margin-top:20px;" >

  <p>Note: Please make sure you pay your pending due with the exact amount listed on the "Pending Student Payment" section to our bank account. Make sure you include the <b>REFERENCE CODE</b> on your payment slip/comment section so we can track your payment. Processing your payment may take up to 24-hour after paying your due/transferring the amount to our bank account.</p>
  <p>Bank Account: (sample only)</p>
  <p>
    Account Name: <b>CHCC</b><br>
    Account Number: <b>1028923989</b><br>
  </p>
</div>

<div id="payForm" class="w3-modal">
  <div class="w3-modal-content" style="width: 30%;">

    <header class="w3-container w3-blue"> 
      <span onclick="document.getElementById('payForm').style.display='none'" 
      class="w3-button w3-display-topright">&times;</span>
      <h5>Payment Form</h5>
    </header>

    <div class="w3-container w3-padding">
      <form action="" method="post">
      <!--h3 class="w3-center" style="margin-top: 50px; margin-bottom: 50px;">Under Construction</h3-->
        <p style="display: none;">
          <label for="" class="w3-text-blue">Reference No.</label>
          <input type="text" class="w3-input w3-border" id="payRef" value="<?php echo $ref ?>" disabled>
        </p-->
        <p>
          <label for="" class="w3-text-blue">Amount Due</label>
          <input type="text" class="w3-input w3-border" value="<?php echo $perPay ?>" disabled>
        </p>
        <p>
          <label for="" class="w3-text-blue">Description</label>
          <input type="text" class="w3-input w3-border" value="Tuition Fee" disabled>
        </p>
        <p>
          <!--label for="" class="w3-text-blue">Email</label>
          <input type="text" name="email" class="w3-input w3-border" value="" required-->
        </p>
        <span class="w3-button w3-blue w3-right" onclick="payDue('<?php echo $perPay ?>','Tuition Fee','<?php echo $sid; ?>','<?php echo $assID; ?>','<?php echo $perPay; ?>','<?php echo $option ?>')">Submit</span>
      </form>
    </div>

  </div>
</div>
<div id="payRegFeeForm" class="w3-modal">
  <div class="w3-modal-content" style="width: 30%;">

    <header class="w3-container w3-blue"> 
      <span onclick="document.getElementById('payRegFeeForm').style.display='none'" 
      class="w3-button w3-display-topright">&times;</span>
      <h5>Payment Form</h5>
    </header>

    <div class="w3-container w3-padding">
      <form action="" method="post">
      <!--h3 class="w3-center" style="margin-top: 50px; margin-bottom: 50px;">Under Construction</h3-->
        <p style="display: none;">
          <label for="" class="w3-text-blue">Reference No.</label>
          <input type="text" class="w3-input w3-border" id="regRef" value="<?php echo randomPass(); ?>" disabled>
        </p>
        <p>
          <label for="" class="w3-text-blue">Amount Due</label>
          <input type="text" class="w3-input w3-border" value="<?php echo $regFee ?>" disabled>
        </p>
        <p>
          <label for="" class="w3-text-blue">Description</label>
          <input type="text" class="w3-input w3-border" value="Registration Fee" disabled>
        </p>
        <p>
          <!--label for="" class="w3-text-blue">Email</label>
          <input type="text" name="email" class="w3-input w3-border" value="" required-->
        </p>
        <span class="w3-button w3-blue w3-right" onclick="payReg('<?php echo $regFee ?>','Registration Fee','<?php echo $sid; ?>','<?php echo $assID; ?>','<?php echo $perPay; ?>','<?php echo $option ?>')">Submit</span>
      </form>
    </div>

  </div>
</div>
<div id="payWithCard" class="w3-modal">
  <div class="w3-modal-content" style="width: 50%; margin-top: -30px;">

    <header class="w3-container w3-blue"> 
      <span onclick="document.getElementById('payWithCard').style.display='none'" 
      class="w3-button w3-display-topright">&times;</span>
      <h5>Form for Credit Card or Debit Card Payment</h5>
    </header>

    <div class="w3-container">
      <?php require_once('card-info.php'); ?>
    </div>

  </div>
</div>
<!-- **************************ADD BLOCK SUBJECT*************************** -->
<div id="addBlockClassB" class="w3-modal">
  <div class="w3-modal-content">

    <header class="w3-container w3-blue"> 
      <span onclick="document.getElementById('addBlockClassB').style.display='none'" 
      class="w3-button w3-display-topright">&times;</span>
      <h5>Enroll Block Section Selection </h5>
    </header>

    <div class="w3-container w3-padding">
      
      <?php echo "<h5 class='w3-center'><b>SY ".$sy." ( ".$sem." )</b></h5>"; 
        $querySectionLists = "select * from sections where section_code like ? and course_code=?";
        $sectionLists = $conn->prepare($querySectionLists);
        $sectionLists->execute(array("%".$cue."%",$courseCode));
        
        while($sectionListsRow = $sectionLists->fetch(PDO::FETCH_ASSOC)){

          $sectionx = $sectionListsRow['section_code'];
          $pushThis = $sectionx.",".$sid.",".$sem.",".$sy.",".$isRegular.",".$courseCode;
            ?>
            <div class="w3-container">
            <button onclick="showSectionContent('<?php echo  $sectionx."C"; ?>')" class="w3-button w3-block w3-blue w3-left-align w3-center" style="border-top: 1px lightgray solid; font-family: arial narrow; font-weight: 800; font-size: 1.2em;"><?php echo  $sectionx; ?></button>
       
            <div id="<?php echo  $sectionx."C"; ?>" class="w3-hide w3-container">
        <?php
                $csys = getClassSYSem($conn, $sem, $sy, $sectionx);
            //if(){
              if($isRegular=="REGULAR" && !empty($csys)){
          ?>
        <div class="w3-container w3-padding">
          <div style="display: none;">
            <span id="stuID"><?php echo  $sid; ?></span>
            <span id="syID"><?php echo  $sy; ?></span>
            <span id="semID"><?php echo  $sem; ?></span>
          </div>

          <span id="blockRes" class="w3-left"></span>
          <button id="enrollBlock" onclick="enrollBlockSubject('<?php echo  $pushThis; ?>')" class="w3-button w3-blue w3-right">Enroll this Block</button>
        </div>
          <?php
        }?>
              <table class="w3-table">
                <?php 
                if(!empty($csys)){

                    classBlockTableHead(); 
                    getClassBlock($conn,$sectionx,$sy,$sem,$isRegular);

                }
                else{
                    echo "<div class='w3-row text-center' style='padding: 50px; font-weight: bold;'>No Subjects for SY ".$sy." ".$sem." yet!</div>";
                } 

                ?>
                </table>
            </div>
            
            <?php
   
        ?>
        </div>
        <?php
    }
    ?>
    
    </div>

  </div>
</div>
<!-- **************************ADD BLOCK SUBJECT END*************************** -->




<div class="w3-modal" id="payOptFormStud1">  
    <div class="w3-modal-content" style="width: 300px;">  
        <header class="w3-container w3-blue"> 
          <span onclick="document.getElementById('payOptFormStud1').style.display='none'" 
          class="w3-button w3-display-topright">&times;</span>
          <h5>Enroll New Subjects Form </h5>
        </header>

        <div class="w3-container">
            <div class="w3-padding" style="padding: 20px 10px 20px 10px">
            <p style="margin-bottom: 20px; font-family: century gothic; font-size: 12px;">Paying full in cash will grant students PHP 1000.00 discount on their tuition fee. All Partial payments are 0% interest guaranteed!</p> 
            <p> 
                <label for="">Payment Option:</label>
                <select name="text" name="payOpt" id="payOpt2" class="w3-input w3-border" required>
                    <option value="">Select Payment Option</option>
                    <option value="full">Pay Full in Cash</option>
                    <option value="half">Two Payments</option>
                    <option value="tri">Three Payments</option>
                    <option value="quarter">Four Payments</option>
                    
                </select>
            </p>
            <p style="padding-bottom: 20px; margin-bottom: 20px;"> 
                <button class="w3-right w3-button w3-blue" onclick="addPOpt3('<?php echo $assRow['id']; ?>','<?php echo $assRow['total_amount']; ?>')">Add Payment Option</button>
            </p>
            </div>
        </div>
        <footer style="height: 20px;"></footer>
    </div>
</div>



<script>
    function addPayOpt2(){
      //alert();
      document.getElementById("payOptFormStud1").style.display = "block";
    }
    function addPOpt3(id,total){
        var id = id;
        var total = total
        var payOpt = document.getElementById("payOpt2").value;
        //alert(id);

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              //console.log(this.responseText);
               
              var data = JSON.parse(this.responseText);

              if(data.status=="success"){
                  //document.getElementById('po').innerHTML = data.option;
                  //document.getElementById('discount').innerHTML = data.discount;
                  //document.getElementById('net').innerHTML = data.net;
                  //document.getElementById('perPay').innerHTML = data.perPay;
                  //document.getElementById("payOptForm").style.display = "none";
                  //alert(this.responseText);
                  location.reload();
              }
              else{ 
                alert("Please select a payment option!");
              }
              //document.getElementById('enrollBlock').attrubute = "disabled";
            }
        };
        xhttp.open("POST", "../app/add_pay_option.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("option="+payOpt+"&id="+id+"&total="+total);

    }
</script>




<script>
    function showPayForm(){
      document.getElementById("payForm").style.display = "block";
    }
    function showPayRegFeeForm(){
      document.getElementById("payRegFeeForm").style.display = "block";
    }
    function showSectionContent(id) {
        var x = document.getElementById(id);
        if (x.className.indexOf("w3-show") == -1) {
            x.className += " w3-show";
            x.previousElementSibling.className = 
            x.previousElementSibling.className.replace("w3-blue", "w3-gray");
        } else { 
            x.className = x.className.replace(" w3-show", "");
            x.previousElementSibling.className = 
            x.previousElementSibling.className.replace("w3-gray", "w3-blue");
        }
    }


    function enrollBlockSubject(id){
      var section = id;
      
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            //console.log(this.responseText);
            var res = this.responseText;
            //document.getElementById('blockRes').innerHTML = res;
            
            alert(res);
            location.reload();
            
            //document.getElementById('enrollBlock').attrubute = "disabled";
          }
      };
      xhttp.open("POST", "../app/add_block_section.php", true);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("section="+section);

    }
    function payDue(amount, desc, id, assID, due, plan){
      var ref = document.getElementById("payRef").value;
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            var res = this.responseText;
            
            console.log(res);
            if(res.includes("success")){
              
              location.reload();
            }
          }
      };
      xhttp.open("POST", "../app/student_payment.php", true);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("user="+id+"&assID="+assID+"&ref="+ref+"&desc="+desc+"&amount="+amount+"&due="+due+"&plan="+plan);
    }
    function payReg(amount, desc, id, assID, due, plan){
      var ref = document.getElementById("regRef").value;
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            var res = this.responseText;
             console.log(res);
            if(res.includes("success")){
              
              location.reload();
            }
          }
      };
      xhttp.open("POST", "../app/student_payment.php", true);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("user="+id+"&assID="+assID+"&ref="+ref+"&desc="+desc+"&amount="+amount+"&due="+due+"&plan="+plan);
    }
    function showCardInfo(){
      document.getElementById("payWithCard").style.display = 'block';
    }
    function showPrice(price){
      var item = document.getElementById("itemType").value;
      var regFee = "500.00";
      //var tfee = price.replace(".", '');

      if(item=="Registration Fee"){
        document.getElementById("hiddenprice").value = "500";
        document.getElementById("price").innerHTML = "₱ "+regFee;
      }else if(item=="Current Due"){
        console.log(price);
        document.getElementById("hiddenprice").value = price;
        document.getElementById("price").innerHTML = "₱ "+price+".00";
      }
    }
</script>