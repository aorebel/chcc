<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Card Information</title>
	<link rel="stylesheet" href="../lib/css/stripe.css">
	<link rel="stylesheet" href="../lib/css/w3.css">
</head>
<body>
<div class="w3-padding">
	<form action="payprocess.php" method="post" id="payment-form" class="w3-padding">
	  <div class="form-row w3-row">
	  	<p class="verdana">
	  	This is only a testing environment please use this card information:<br>
	  	Card number: 4242-4242-4242-4242<br>
	  	Expiry Date: 04/24<br>
	  	CVC: 242<br>
	  	ZIP: please insert 5 digit. If Zip is only 4 digit add 0 before your ZIP
	  </p>
	  	
	    <p>
	    	<select id="itemType" name="item" class="w3-input w3-border StripeElement StripeElement--empty" onchange="showPrice('<?php echo $perPay; ?>')" required>
	    		<option value="">Select What to Pay</option>
	    		<?php 
	    		if( ($assRow['pay_plan']!="full") && (empty($cashRow)) ){ ?>
	    		<option value="Registration Fee">Registration Fee</option>
	    		<?php } ?>
	    		<option value="Current Due">Current Due</option>
	    	</select>
	    </p>
	    <p>
	    	<span class="w3-input w3-border StripeElement StripeElement--empty">Amount Due: <b id="price" class="w3-right"><input type="hidden" name="price" id="hiddenprice"></b></span>
	    </p>
	    <p>
	    	<input type="text" name="firstname" class="w3-input w3-border StripeElement StripeElement--empty" placeholder="First Name" required/>
	    </p>
	    <p>
	    	<input type="text" name="lastname" class="w3-input w3-border StripeElement StripeElement--empty" placeholder="Last Name" required/>
	    </p>
	    <p>
	    	<span class="w3-input w3-border StripeElement StripeElement--empty"><?php echo $studentInfo['email'];?></span>
	    	<input type="hidden" name="email" class="w3-input w3-border StripeElement StripeElement--empty" value="<?php echo $studentInfo['email'];?>" placeholder="Email" required/>
	    </p>
	    <p>
	    <label for="card-element" class="w3-text-blue">
	      Credit or debit card
	    </label>
	    </p>
	    <div id="card-element" class="w3-input w3-border w3-padding">
	      <!-- A Stripe Element will be inserted here. -->
	    </div>

	    <!-- Used to display form errors. -->
	    <div id="card-errors" role="alert"></div>
	  </div>
		<p>
			<input type="hidden" name="assID" value="<?php echo $assID; ?>">
			<input type="hidden" name="net" value="<?php echo $net; ?>">
			<input type="hidden" name="sid" value="<?php echo $sid; ?>">
			<input type="hidden" name="option" value="<?php echo $option; ?>">
		  <button type="submit" class="w3-input w3-button w3-blue StripeElement StripeElement--empty">Submit Payment</button>
	  </p>
	</form>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://js.stripe.com/v3/"></script>

<script src="../lib/js/stripe.js"></script>
</body>
</html>