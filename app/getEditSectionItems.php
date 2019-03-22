<?php 
	require_once('../app/config/connect.php');

    $section_code = $_REQUEST['section'];
    $getSections = "select * from sections where section_code = ?";
    $sections = $conn->prepare($getSections);
    $sections->execute(array($section_code));
    $row = $sections->fetch(PDO::FETCH_ASSOC);
    ?>
        <p>      
        <label class="w3-text-blue"><b>Slots</b></label>
        <input type="text" class="w3-input w3-border" id="editSlots" name="slots" value="<?php echo $row['slots']; ?>">
    </p>
    <p>      
        <label class="w3-text-blue"><b>Allowed Units</b></label>
        <input type="text" class="w3-input w3-border" id="editUnits" name="units" value="<?php echo $row['units']; ?>">
    </p>

