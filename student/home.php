<div id="profile" class="">



<?php 

require_once('../methods/view_student_profile.php');

?>




</div>

<div class="w3-padding" style="margin-top: -40px;">

  <button onclick="document.getElementById('viewAssessment').style.display='block'" class="w3-button w3-input w3-blue">ASSESSMENT</button>
  <button onclick="document.getElementById('viewCOR').style.display='block'" class="w3-button w3-input w3-blue">CERTIFICATE OF REGISTRATION</button>
  <?php //require_once('cor.php');?>
  <div id="viewAssessment" class="w3-modal">
    <div class="w3-modal-content" style="margin-bottom: 50px;">

      <header class="w3-container w3-blue"> 
        <span onclick="document.getElementById('viewAssessment').style.display='none'" 
        class="w3-button w3-display-topright">&times;</span>
        <h5>ASSESSMENT</h5>
      </header>

      <div class="w3-container w3-padding">
    


        <div id="assessment" style="display: block; width: 100%;">
    
            <?php 

        if( !empty($assRow)  ){
            ?>
         
            
            <button class="w3-button w3-yellow w3-right" onclick="printAss()" style="margin-left: 20px; ">
                Print
            </button>

            <?php 
                if($assRow['pay_plan']==""){
            ?>
            <!--button class="w3-button w3-yellow" onclick="addPayOpt()" style="">
                Add Payment Option
            </button-->
            <div class="w3-container " style="padding-left: 50px;">
            <?php } 

            require_once('../methods/view-assessment-on-admin.php'); 
            ?>
        </div>
            <?php
            
        }else{
            ?>
            
            <div class="jumbo text-center">No Subjects for SY <?php echo $sy." ".$sem." yet"; ?></div>

            <?php
        }

        ?>

        </div>



      </div>

    </div>
  </div>
  <div id="viewCOR" class="w3-modal">
    <div class="w3-modal-content" style="margin-bottom: 50px;"> 

      <header class="w3-container w3-blue"> 
        <span onclick="document.getElementById('viewCOR').style.display='none'" 
        class="w3-button w3-display-topright">&times;</span>
        <h5>CERTIFICATE OF REGISTRATION</h5>
      </header>

      <div class="w3-container w3-padding">
    


        <div id="assessment" style="display: block; width: 100%;">
    
            <?php 

        if( !empty($assRow)  ){
            
           
            require_once('cor.php'); 
            ?>
        </div>
            <?php
            
        }else{
            ?>
            
            <div class="jumbo text-center">No Subjects for SY <?php echo $sy." ".$sem." yet"; ?></div>

            <?php
        }

        ?>

        </div>



      </div>

    </div>
  </div>

</div>






<div class="w3-modal" id="payOptFormStud">  
    <div class="w3-modal-content" style="width: 300px;">  
        <header class="w3-container w3-blue"> 
          <span onclick="document.getElementById('payOptForm').style.display='none'" 
          class="w3-button w3-display-topright">&times;</span>
          <h5>Enroll New Subjects Form </h5>
        </header>

        <div class="w3-container">
            <div class="w3-padding" style="padding: 20px 10px 20px 10px">
            <p style="margin-bottom: 20px; font-family: century gothic; font-size: 12px;">Paying full in cash will grant students PHP 1000.00 discount on their tuition fee. All Partial payments are 0% interest guaranteed!</p> 
            <p> 
                <label for="">Payment Option:</label>
                <select name="text" name="payOpt" id="payOpt" class="w3-input w3-border" required>
                    <option value="">Select Payment Option</option>
                    <option value="full">Pay Full in Cash</option>
                    <option value="half">Two Payments</option>
                    <option value="tri">Three Payments</option>
                    <option value="quarter">Four Payments</option>
                    
                </select>
            </p>
            <p style="padding-bottom: 20px; margin-bottom: 20px;"> 
                <button class="w3-right w3-button w3-blue" onclick="addPOpt('<?php echo $assRow['id']; ?>','<?php echo $assRow['total_amount']; ?>')">Add Payment Option</button>
            </p>
            </div>
        </div>
        <footer style="height: 20px;"></footer>
    </div>
</div>



<script>
    function addPayOpt(){
      document.getElementById("payOptFormStud").style.display = "block";
    }
    function addPOpt(id,total){
        var id = id;
        var total = total
        var payOpt = document.getElementById("payOpt").value;
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
            
            