<?php 

require_once('../app/config/connect.php');
require_once('../app/functions.php');
require_once('../app/getSYSem.php');

$teacher = $_POST['teacher'];
$class = $_POST['cc'];
$subject = $_POST['subject'];
$subjID = $_POST['subjID'];

?>
<h5 class="w3-center"><?php echo $subject." ( ".$class." )"; ?></h5>

<div class="w3-row">
	<table class="w3-table w3-border">
		<tr>
			<th>Student ID</th> 
			<th>Student Name</th>    			
			<th>Prelims</th>
			<th>Midterms</th>
			<th>Finals</th>
			<th>Grade</th>
			<th>Remarks</th>
			<th>Drop Student</th>
		</tr>
	<?php 
		$queryStudents = "SELECT * from student_classes where class_code = ? and sem = ? and school_year = ?";
		$getStudents = $conn->prepare($queryStudents);
		$getStudents->execute(array($class,$sem,$sy));
		$sassCount = $getStudents->rowCount();
		while($sassrow = $getStudents->fetch(PDO::FETCH_ASSOC)){
			//$count++;
			$studID = $sassrow['student_id'];

			$queryStud= "SELECT * from students where student_id = ? ";
			$getStud = $conn->prepare($queryStud);
			$getStud->execute(array($studID));
			$strow = $getStud->fetch(PDO::FETCH_ASSOC);

			$queryGrade = "SELECT * from grade where student_id = ? and subject_id = ? and sem = ? and school_year = ?";
			$getGrade = $conn->prepare($queryGrade);
			$getGrade->execute(array($studID,$subjID,$sem,$sy));
			$grow = $getGrade->fetch(PDO::FETCH_ASSOC);


			$queryEStud= "SELECT * from studentenrollment where student_id = ? order by id DESC limit 1";
			$getEStud = $conn->prepare($queryEStud);
			$getEStud->execute(array($studID));
			$stErow = $getEStud->fetch(PDO::FETCH_ASSOC);
			$stEcount = $getEStud->rowCount();

			//echo $studID." ".$strow['lname'];
			$sPic = checkPicture($conn, $studID);
			$mi = explode(".", $strow['mi']);
			$name = ucwords($strow['fname']." ".$mi[0].". ".$strow['lname']);
			if(!empty($sPic)){
				$pic = $sPic['dir']."".$sPic['title'];
			}
			else{
				$pic = "../lib/res/avatar.png";
			}
			if($sassCount==0){
				echo "<h2 style='text-align: center;'>No students enrolled this subject yet!</h2>";
			}
			//echo $sassCount;
			if($stErow['sem']!=$sem && $stErow['school_year']!=$sy){
				//echo "<h2 style='text-align: center;'>No students enrolled this subject yet for the SY ".$sy." Sem ".$sem."!</h2>";
			}else{
	?>
		<tr>
			<!-- ACCOUNT -->
			<!-- STUDENT INFO -->
			<td><?php echo $studID;?></td>
			<td style="width: 150px !important;">
				<b><?php echo $name?></b><br>
				
			</td>
			<!-- PRELIMS TExT BOX -->
			<td>
			<?php 
				$commandM = "6";
				$queryCommandM = "select * from commands where id = ?";
				$getCommandM = $conn->prepare($queryCommandM);
				$getCommandM->execute(array($commandM));
				$mrow = $getCommandM->fetch(PDO::FETCH_ASSOC);
				//echo $mrow['status'];
				if($mrow['status']=="Open"){

					if($grow['remarks']==="Unofficially Dropped" || $grow['remarks']==="Officially Dropped"){
					?>
						<input type="text"  value="<?php echo $grow['midterms'] ?>" class="w3-input w3-border" style="width: 80px;" disabled>

					<?php
				
			 		}else{
					?>
						<select id="<?php echo $class."".$studID."pre"; ?>" value="" class="w3-input w3-border" style="width: 80px;" onchange="postGrade('<?php echo $class; ?>','<?php echo $subjID; ?>','<?php echo $studID; ?>','<?php echo $sem; ?>','<?php echo $sy; ?>','pre')">
							
							<option value="<?php echo $grow['prelims'] ?>" selected><?php echo $grow['prelims'] ?></option>
							
							<option value="1.00">1.00</option>
							<option value="1.25">1.25</option>
							<option value="1.50">1.50</option>
							<option value="1.75">1.75</option>
							<option value="2.00">2.00</option>
							<option value="2.25">2.25</option>
							<option value="2.50">2.50</option>
							<option value="2.75">2.75</option>
							<option value="3.00">3.00</option>
							<option value="5.00">5.00</option>
						</select>
			<?php 


				}
				}else{?>
				<input type="text"  value="<?php echo $grow['midterms'] ?>" class="w3-input w3-border" style="width: 80px;" disabled>
			<?php } ?>

			</td>
			<!-- MIDTERMS TExT BOX -->
			<td>
			<?php 
				$commandM = "3";
				$queryCommandM = "select * from commands where id = ?";
				$getCommandM = $conn->prepare($queryCommandM);
				$getCommandM->execute(array($commandM));
				$mrow = $getCommandM->fetch(PDO::FETCH_ASSOC);
				//echo $mrow['status'];
				if($mrow['status']=="Open"){

					if($grow['remarks']==="Unofficially Dropped" || $grow['remarks']==="Officially Dropped"){
					?>
						<input type="text"  value="<?php echo $grow['midterms'] ?>" class="w3-input w3-border" style="width: 80px;" disabled>

					<?php
				
			 		}else{
					?>
						<select id="<?php echo $class."".$studID."mid"; ?>" value="" class="w3-input w3-border" style="width: 80px;" onchange="postGrade('<?php echo $class; ?>','<?php echo $subjID; ?>','<?php echo $studID; ?>','<?php echo $sem; ?>','<?php echo $sy; ?>','mid')">
							<option value="<?php echo $grow['midterms'] ?>"><?php echo $grow['midterms'] ?></option>
							
							<option value="1.00">1.00</option>
							<option value="1.25">1.25</option>
							<option value="1.50">1.50</option>
							<option value="1.75">1.75</option>
							<option value="2.00">2.00</option>
							<option value="2.25">2.25</option>
							<option value="2.50">2.50</option>
							<option value="2.75">2.75</option>
							<option value="3.00">3.00</option>
							<option value="5.00">5.00</option>
						</select>
			<?php 


				}
				}else{?>
				<input type="text"  value="<?php echo $grow['midterms'] ?>" class="w3-input w3-border" style="width: 80px;" disabled>
			<?php } ?>

			</td>

			<!-- FINALS TExT BOX -->

			<td>
			<?php 
				$commandF = "5";
				$queryCommandF = "select * from commands where id = ?";
				$getCommandF = $conn->prepare($queryCommandF);
				$getCommandF->execute(array($commandF));
				$frow = $getCommandF->fetch(PDO::FETCH_ASSOC);
				//echo $frow['status'];
				if($frow['status']=="Open"){

					if($grow['remarks']==="Unofficially Dropped" || $grow['remarks']==="Officially Dropped"){
						?>
							<input type="text"  value="<?php echo $grow['midterms'] ?>" class="w3-input w3-border" style="width: 80px;" disabled>

						<?php
					}else{
					?>
						<select id="<?php echo $class."".$studID."fin"; ?>" value="" class="w3-input w3-border" style="width: 80px;" onchange="postGrade('<?php echo $class; ?>','<?php echo $subjID; ?>','<?php echo $studID; ?>','<?php echo $sem; ?>','<?php echo $sy; ?>','fin')">
							<option value="<?php echo $grow['finals'] ?>"><?php echo $grow['finals'] ?></option>
							
							<option value="1.00">1.00</option>
							<option value="1.25">1.25</option>
							<option value="1.50">1.50</option>
							<option value="1.75">1.75</option>
							<option value="2.00">2.00</option>
							<option value="2.25">2.25</option>
							<option value="2.50">2.50</option>
							<option value="2.75">2.75</option>
							<option value="3.00">3.00</option>
							<option value="5.00">5.00</option>
						</select>
				<?php }
				
				 }else{?>
				<input type="text"  value="<?php echo $grow['finals'] ?>" class="w3-input w3-border" style="width: 80px;"  disabled>
			<?php } ?>
			</td>

			<!-- GRADE -->
			<td><span id="<?php echo $class."".$studID."G"; ?>" class="w3-input w3-border-0" style="width: 80px;"><?php echo $grow['grade'] ?></span>
			</td>
			<!-- REMARKS -->
			<td><span id="<?php echo $class."".$studID."R"; ?>" class="w3-input w3-border-0" style="width: 100px;"><?php echo $grow['remarks'] ?></span>
			</td>
			<!-- ACTION -->
			<td>
				<select  id="<?php echo $class."".$studID."D"; ?>" class="w3-input" style="width:150px;" onchange="dropStud('<?php echo $class; ?>','<?php echo $subjID; ?>','<?php echo $studID; ?>','<?php echo $sem; ?>','<?php echo $sy; ?>')">
					<option value="">Drop Student</option>
					<option value="Unofficially Dropped">Unofficially Drop</option>
					<option value="Officially Dropped">Officially Drop</option>
					<option value="Incomplete">Incomplete</option>
				</select>
			</td>
		</tr>
	<?php
			}
		}

	?>
	</table>
</div>

<script>

	
</script>
