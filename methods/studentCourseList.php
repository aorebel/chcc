<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
</head>
<body>
  

<div class="w3-bar w3-light-gray ">
    <button class="w3-bar-item w3-button yearlevellink w3-red" onclick="openYearLevel(event,'firstYear')">First Year</button>
    <button class="w3-bar-item w3-button yearlevellink" onclick="openYearLevel(event,'secondYear')">Second Year</button>
    <button class="w3-bar-item w3-button yearlevellink" onclick="openYearLevel(event,'thirdYear')">Third Year</button>
  </div>
  
  <div id="firstYear" class="w3-container w3-border yearLevel">
    <h2>First Year</h2>
    <p>First Year is the capital yearLevel of England.</p>
  </div>

  <div id="secondYear" class="w3-container w3-border yearLevel" style="display:none">
    <h2>Second Year</h2>
    <p>Second Year is the capital of France.</p> 
  </div>

  <div id="thirdYear" class="w3-container w3-border yearLevel" style="display:none">
    <h2>Third Year</h2>
    <p>Third Year is the capital of Japan.</p>
  </div>
</div>

<script>

</script>
</body>
</html>