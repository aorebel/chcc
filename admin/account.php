<?php 
require_once('../app/config/connect.php');
require_once('../app/functions.php');
require_once('../app/getSYSem.php');

$queryFeeCur = "SELECT fee_name, version, `date` from fees group by fee_name, version, `date` having count(*)>0 order by `date` DESC limit 1 ";
$getFeeCur = $conn->prepare($queryFeeCur);
$getFeeCur->execute();
$fcrow = $getFeeCur->fetch(PDO::FETCH_ASSOC);
$fee_name_fc = $fcrow['fee_name'];
$version_fc = $fcrow['version'];

$queryFees = "SELECT * from fees where fee_name = ? and version = ? order by category asc";
$getFees = $conn->prepare($queryFees);
$getFees->execute(array($fcrow['fee_name'], $fcrow['version']));
//$fees = $getFees->fetch(PDO::FETCH_ASSOC);
//echo getMiscFee($conn);

//$queryCheckAss = "SELECT sum(net_payable) as sumAss, count(student_id) as students, id from assessment where sem=? and school_year=? group by net_payable";
$queryCheckAss = "SELECT net_payable, student_id from assessment where sem=? and school_year=?";
$getCheckAss = $conn->prepare($queryCheckAss);
$getCheckAss->execute(array($sem,$sy));
$sumAss = $getCheckAss->fetch(PDO::FETCH_ASSOC);
while($rowSumAss = $getCheckAss->fetch(PDO::FETCH_ASSOC)){
  $totalNet += $rowSumAss['net_payable'];
  $totalStudents += 1;
}

//echo $totalNet;
$queryCheckEnrollment = "SELECT count(student_id) as students from enrollment where sem=? and school_year=?";
$getCheckEnrollment = $conn->prepare($queryCheckEnrollment);
$getCheckEnrollment->execute(array($sem,$sy));
$sumEnrollment = $getCheckEnrollment->fetch(PDO::FETCH_ASSOC);

$queryCheckAss2 = "SELECT * from assessment where sem=? and school_year=?";
$getCheckAss2 = $conn->prepare($queryCheckAss2);
$getCheckAss2->execute(array($sem,$sy));

while($rowAss2 = $getCheckAss2->fetch(PDO::FETCH_ASSOC)){
    //echo $rowAss2['id'];
    $assID2 = $rowAss2['id'];
    $queryCheckCashier = "SELECT * from cashier where assessment_id = ? and status != ?";
    $getCheckCashier = $conn->prepare($queryCheckCashier);
    $getCheckCashier->execute(array($assID2,"Pending"));
    while($cashSumRow = $getCheckCashier->fetch(PDO::FETCH_ASSOC)){
        //echo $cashSumRow['amount']."<br>";
        $sumcashier += $cashSumRow['amount'];
    }
    $queryCheckCashier2 = "SELECT * from cashier where assessment_id = ? and status = ?";
    $getCheckCashier2 = $conn->prepare($queryCheckCashier2);
    $getCheckCashier2->execute(array($assID2,"Pending"));
    while($cashSumRow2 = $getCheckCashier2->fetch(PDO::FETCH_ASSOC)){
        $countPending +=1;
    }
    if(empty($cashSumRow2)){
        $countPending = 0;
    }
    $queryCheckCashier3 = "SELECT * from cashier where assessment_id = ? and status = ?";
    $getCheckCashier3 = $conn->prepare($queryCheckCashier3);
    $getCheckCashier3->execute(array($assID2,"Confirmed"));
    while($cashSumRow3 = $getCheckCashier3->fetch(PDO::FETCH_ASSOC)){
        $countConfirmed +=1;
    }
    //echo $sumcashier;
}
//$paidAve = floatval($sumcashier)/floatval($sumAss['sumAss']);
if(floatval($sumcashier)==null || floatval($totalNet)==null){
    $paidAve = 0;
}else{
    $paidAve = floatval($sumcashier)/floatval($totalNet);
}

$paidPer =  $paidAve * 100;

//$unpaid = floatval($sumAss['sumAss']) - floatval($sumcashier);
//$unpaidAve =  floatval($unpaid)/floatval($sumAss['sumAss']);
$unpaid = floatval($totalNet) - floatval($sumcashier);
if(floatval($unpaid)==null || floatval($totalNet)==null){
    $unpaidAve = 0;
}else{
   $unpaidAve =  floatval($unpaid)/floatval($totalNet); 
}

$unpaidPer = $unpaidAve * 100;

?>



<script>
    
</script>


<div class="w3-container">

    
    <div class="w3-row s12 m8 w3-left" style="margin-top: -20px; display: block; width: 70%;">
        <h2 class="w3-center">Financial Statistics</h2>



        <h3 class="w3-center"><?php echo $sy." - ".$sem; ?></h3>
        <div class="w3-border w3-padding">
            <div class="w3-center">
                <b >
                    Expected Collection <br>
                    <?php echo "₱ ".$totalNet;?>
                </b>
            </div>
            <br>
            
            <b>Collected Amount</b>
            <div class="w3-light-grey">
                
                <div class="w3-green" style="height:30px; line-height:30px; width:<?php echo $paidPer;?>%; padding-left: 20px;">
                    <span class="w3-center"><b><?php echo number_format($paidPer, 2, '.', '');?>%</b></span>
                    
                </div>
                <span class="w3-right" style="margin-top: -25px;"><b><?php echo "₱ ".$sumcashier; ?>.00</b></span>
            </div><br>
            
            <b>Uncollected Amount</b>
            <div class="w3-light-grey">
                <div class="w3-red" style="height:30px; line-height:30px; width:<?php echo $unpaidPer;?>%; padding-left: 20px;">
                    <span class="w3-center"><b><?php echo number_format($unpaidPer, 2, '.', '');?>%</b></span>
                </div>
                <span class="w3-right" style="margin-top: -25px;"><b><?php echo "₱ ".$unpaid; ?>.00</b></span>
            </div><br>

            
        </div>

        <div class="w3-padding w3-row-padding">
            <div class="w3-quarter">
              <div class="w3-container w3-red w3-padding-16" style="height: 160px;">
                <div class="w3-left"><i class="fa fa-edit w3-xxxlarge"></i></div>
                <div class="w3-right">
                  <h3><?php echo $totalStudents;?></h3>
                </div>
                <div class="w3-clear"></div>
                <h4>Enlisted Students</h4>
              </div>
            </div>
            <div class="w3-quarter">
              <div class="w3-container w3-green w3-padding-16" style="height: 160px;">
                <div class="w3-left"><i class="fa fa-user w3-xxxlarge"></i></div>
                <div class="w3-right">
                  <h3><?php echo $sumEnrollment['students'];?></h3>
                </div>
                <div class="w3-clear"></div>
                <h4>Enrolled Student</h4>
              </div>
            </div>
            <div class="w3-quarter">
              <div class="w3-container w3-blue w3-padding-16" style="height: 160px;">
                <div class="w3-left"><i class="fa fa-coins w3-xxxlarge"></i></div>
                <div class="w3-right">
                  <h3><?php echo $countConfirmed;?></h3>
                </div>
                <div class="w3-clear"></div>
                <h4>Confirmed Payments</i></h4>
              </div>
            </div>
            <div class="w3-quarter">
              <div class="w3-container w3-orange w3-text-white w3-padding-16" style="height: 160px;">
                <div class="w3-left"><i class="fa fa-building w3-xxxlarge"></i></div>
                <div class="w3-right">
                  <h3><?php echo $countPending;?></h3>
                </div>
                <div class="w3-clear"></div>
                <h4>Pending Payments</h4>
              </div>
            </div>
        </div>
    </div>
    <div class="w3-row s12 m4 w3-right w3-light-gray  " style="width:30%; right: 0 !important; top: 25 !important; position: absolute; font-family: century gothic;" >
        <h5 class="w3-center w3-black" style="margin-top:0; height: 30px; line-height: 30px;">Fees</h5>
        <p class="verdana w3-padding">
            Changes made on this section will not affect current fee on enrolled students. Please make sure to apply change on the fee selection section before allowing enrollment to ensure no adjustments will be needed for already enrolled students.
        </p>
        <select name="fee_name_select" id="fee_name_select" class="w3-input w3-border" onclick="showFeeNameOptions('<?php echo $fee_name_fc; ?>')" onchange="showVersionSelection('<?php echo $fee_name_fc; ?>','<?php echo $version_fc; ?>')">
            <option value="<?php echo $fee_name_fc;?>"><?php echo $fee_name_fc;?></option>
        </select>
        <select name="version_select" id="version_select" class="w3-input w3-border" onchange="showFeesContent()">
            <option value="<?php echo $version_fc;?>"><?php echo $version_fc;?></option>
        </select>
        <table class="w3-container" style="width: 100%;" id="acctTable">
            
        <?php while($fRow = $getFees->fetch(PDO::FETCH_ASSOC)){ ?>
            <tr style="margin-bottom: 5px;" id="<?php echo $fRow['id']; ?>">
                <td>
                    <?php 
                        if($fRow['category']=="Registration"){
                            echo "RF";
                        }
                        else if($fRow['category']=="Miscellaneous"){
                            echo "MF";
                        }
                        else if($fRow['category']=="Other Fees"){
                            echo "OF";
                        }
                        else if($fRow['category']=="Development Fee"){
                            echo "DF";
                        }
                        else if($fRow['category']=="Tuition Fee"){
                            echo "TF";
                        }
                        else if($fRow['category']=="Lab Fee"){
                            echo "LF";
                        }
                    ?>
                </td>
                <td  style="word-wrap: break-word"><?php echo $fRow['name']; ?></td>
                <td class="w3-right" style="word-wrap: break-word"><?php echo $fRow['price']; ?></td>
                <!--td class=""><span onclick="deleteFee('<?php //echo $fRow['id']; ?>')" class="w3-red w3-round-small w3-center" style="padding: 2px;"><i class="fas fa-trash"></i></span></td-->
            </tr>
        <?php } ?>
        </table>
        
        <h5 class="w3-yellow w3-center" onclick="showAddFeeForm()">Add Fees</h5>
        <h5 class="w3-orange w3-center" onclick="showEditFeesForm()">Edit Fees</h5>
        
    </div>
    
</div>



<div id="addFeeForm" class="w3-modal">
    <div class="w3-modal-content" style="width: 40%">
        <header class="w3-container w3-blue">
            <span onclick="document.getElementById('addFeeForm').style.display='none'" 
          class="w3-button w3-display-topright">&times;</span>
            <h5>Add Fee Form</h5>
        </header>
        <div class="w3-container w3-padding">
            <!--form action="../app/add_fee.php" method="post" class="w3-container w3-padding"-->
            <p>
                <label for="" class="w3-text-blue">Category</label>
                <select name="cat" class="w3-input w3-border" required>
                    <option value="">Select Category</option>
                    <option value="Registration">Registration</option>
                    <option value="Miscellaneous">Miscellaneous</option>
                    <option value="Other Fees">Other Fees</option>
                    <option value="Development Fee">Development Fee</option>
                    <option value="Tuition Fee">Tuition Fee</option>
                    <option value="Lab Fee">Laboratory Fee</option>
                </select>
            </p>
            <p>
                <label for="" class="w3-text-blue">Fee Title</label>
                <input type="text" name="fee" class="w3-input w3-border" required>
            </p>
            <p>
                <label for="" class="w3-text-blue">Price per Unit</label>
                <input type="text" name="price" class="w3-input w3-border" required>
            </p><br>
            <p>
                <button class="w3-button w3-blue" onclick="addFee()">Add Fee</button>
            </p>
            <!--/form-->
        </div>
    </div>
</div>


<div id="editFeesForm" class="w3-modal">
    <div class="w3-modal-content" style="width: 60%">
        <header class="w3-container w3-blue">
            <span onclick="document.getElementById('editFeesForm').style.display='none'" 
          class="w3-button w3-display-topright">&times;</span>
            <h5>Edit Fees Form</h5>
        </header>
        <div class="w3-container w3-padding">
            <!--form action="../app/add_fee.php" method="post" class="w3-container w3-padding"-->
           <p>
               <label for="" class="w3-text-blue">Select Curriculum</label>
               <select name="feeName" id="feeName" class="w3-input w3-border" onchange="getFeeVersion()" required>
                <option value=""></option>
                   <?php 


                        $queryFeeName = "SELECT fee_name from fees group by fee_name having count(*) > 0";
                        $feeName = $conn->prepare($queryFeeName);
                        $feeName->execute();
                        while($rowFN = $feeName->fetch(PDO::FETCH_ASSOC)){
                            ?>
                            <option value="<?php echo $rowFN['fee_name']?>"><?php echo $rowFN['fee_name']?></option>
                            <?php 
                        }
                   ?>
               </select>
           </p>
           <p id="feeVerContainer">
               
           </p>
           <div id="editFees" class="w3-padding">
               
           </div>
            <!--/form-->
        </div>
    </div>
</div>
<script>
    
    function showAddFeeForm(){
        document.getElementById('addFeeForm').style.display = "block";
    }
    function showEditFeesForm(){
        document.getElementById('editFeesForm').style.display = "block";

        

    }
    function addFee(){
        var cat = document.getElementsByName('cat')[0].value;
        var fee = document.getElementsByName('fee')[0].value;
        var price = document.getElementsByName('price')[0].value;
        //console.log(cat+" "+fee);

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              //console.log(this.responseText);
              var data = JSON.parse(this.responseText);
              if(data.status=="error"){
                alert("Duplicate entry detected!");
              }
              else{
                document.getElementById('acctTable').innerHTML += "<tr><td>"+data.fee+"</td><td class='w3-right'>"+data.price+"</td></tr>";
              }
            }
        };
        xhttp.open("POST", "../app/add_fee.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("cat="+cat+"&fee="+fee+"&price="+price);
    }
    function deleteFee(id){
        var id = id;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              //console.log(this.responseText);
              location.reload();
            }
        };
        xhttp.open("POST", "../app/delete_fee.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("id="+id);
    }
    function getFeeVersion(){
        feeName = document.getElementById('feeName').value;
        //alert(feeName);

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              //console.log(this.responseText);
                document.getElementById('feeVerContainer').innerHTML = this.responseText;
            }
        };
        xhttp.open("POST", "../methods/fee-versions.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("feeName="+feeName);
    }
    function showFeesTable(){
        feeName = document.getElementById('feeName').value;
        feeVer = document.getElementById('feeVer').value;

        //alert(feeVer);

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              //console.log(this.responseText);
                document.getElementById('editFees').innerHTML = this.responseText;
            }
        };
        xhttp.open("POST", "../methods/edit-fees.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("feeName="+feeName+"&feeVer="+feeVer);
    }
    function showNewFeeName(){
        checkbox = document.getElementById("checkBox");
        //newFee = document.getElementById("newFeeName");
        if(checkbox.checked==true){
            document.getElementById("newFeeName").style.display = "block";
        }else{
            document.getElementById("newFeeName").style.display = "none";
        }
    }
    function showFeeNameOption(id){
        
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              //console.log(this.responseText);
                document.getElementById('fee_name_select').innerHTML = this.responseText;
                document.getElementById("fee_name_select").value = id;
            }
        };
        xhttp.open("POST", "../methods/show-fee-names.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send();
    }
    function showVersionSelection(id){
        feeName = id;
        //alert(feeName);

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              //console.log(this.responseText);
                document.getElementById('version_select').innerHTML = this.responseText;
            }
        };
        xhttp.open("POST", "../methods/fee-versions.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("feeName="+feeName);
    }
    function showFeesContent(){
        feeName = document.getElementById('fee_name_select').value;
        version = document.getElementById('version_select').value;

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              //console.log(this.responseText);
                document.getElementById('acctTable').innerHTML = this.responseText;
            }
        };
        xhttp.open("POST", "../methods/curriculum.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("feeName="+feeName+"&version="+version);
    }
    
</script>

