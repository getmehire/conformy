<?php
<header> 
// <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
	</header>
//Initializing variable
$action = "";
// This is somewhat of a validity checker.
// I don't have the form sending to anywhere in the 'form' DOM.
// I validate the existence of the form in a hidden field.

//isset()
$action = isset($_POST['action']) ? $_POST['action'] : '';
//empty()
$action = !empty($_POST['action']) ? $_POST['action'] : '';

if ($action=="")    /* display the contact form */
    {
 ?>

<div class="form-wrap">
    <form  action="" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="action" value="submit">

    <div class="form-group">
      <label for="first_name" class="required">First Name</label>
      <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" required="yes">
    </div>
    <div class="form-group">
      <label for="last_name" class="required">Last Name</label>
      <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name" required="yes">
    </div>
    <div class="form-group">
      <label for="business_type">Are you:</label>
			<label class="radio-inline">
			  <input type="radio" name="business_type" id="individual" value="Individual"> Individual
			</label>
			<label class="radio-inline">
			  <input type="radio" name="business_type" id="company" value="Company"> Company
			</label>
	</div>
    <div class="form-group">
      <label for="company_name">Company Name<red> </red></label>
      <input type="text" class="form-control" name="company_name" id="company_name" placeholder="Company Name" required="no">
    </div>
    <div class="form-group">
      <label for="email" class="required">Email Address</label>
      <input type="email" class="form-control" name="email" id="email" placeholder="Email" required="yes">
    </div>
    <div class="form-group">
      <label for="phone" class="required">Phone</label>
      <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone" required="yes">
    </div>
     <div class="form-group">
      <label for="type" class="required">Do you require an NDA:</label>
			<label class="radio-inline">
			  <input type="radio" name="nda" id="yes" value="Yes" /> Yes
			</label>
			<label class="radio-inline">
			  <input type="radio" name="nda" id="no" value="No" /> No
			</label>
	</div>
    <div class="form-group ">
	      <label for="interest">Service areas you are interested in:</label>
      <p class="checkbox">
		<label>
		<input type="checkbox" name="interest[]" id="interest1" value="Product Development Consulting" aria-label="Product Development Consulting"> Product Development Consulting
		</label>
      </p>
      <p class="checkbox">
		<label>
		<input type="checkbox" name="interest[]" id="interest2" value="Industrial Design" aria-label="Industrial Design"> Industrial Design
		</label>
      </p>
	  <p class="checkbox">
		<label>
		<input type="checkbox" name="interest[]" id="interest3" value="Technical Document Preparation" aria-label="Technical Document Preparation"> Technical Document Preparation
		</label>
	  </p>
	  <p class="checkbox">
		<label>
		<input type="checkbox" name="interest[]" id="interest4" value="Patent images and Specifications" aria-label="Patent images and Specifications"> Patent images and Specifications
		</label>
	  </p>
	  <p class="checkbox">
		<label>
		<input type="checkbox" name="interest[]" id="interest5" value="Risk Assessments" aria-label="Risk Assessments"> Risk Assessments
		</label>
	  </p>
	  <p class="checkbox">
		<label>
		<input type="checkbox" name="interest[]" id="interest6" value="Complete 2D CAD files for Manufacturing" aria-label="Complete 2D CAD files for Manufacturing"> Complete 2D CAD files for Manufacturing
		</label>
	  </p>
	  <p class="checkbox">
		<label>
		<input type="checkbox" name="interest[]" id="interest7" value="Prototyping" aria-label="Prototyping"> Prototyping
		</label>
	  </p>
	  <p class="checkbox">
		<label>
		<input type="checkbox" name="interest[]" id="interest8" value="Verification Testing" aria-label="Verification Testing"> Verification Testing
		</label>
	  </p>
	  <p class="checkbox">
		<label>
		<input type="checkbox" name="interest[]" id="interest9" value="Validation Testing" aria-label="Validation Testing"> Validation Testing
		</label>
	  </p>
	  <p class="checkbox">
		<label>
		<input type="checkbox" name="interest[]" id="interest10" value="Manufacturing Drawings Package" aria-label="Manufacturing Drawings Package"> Manufacturing Drawings Package
		</label>
	  </p>
	  <p class="checkbox">
		<label>
		<input type="checkbox" name="interest[]" id="interest11" value="Complete Design History File" aria-label="Complete Design History File"> Complete Design History File
		</label>
	  </p>
	  	</div>

    <div class="form-group"><center>
		<button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

    <?php
    }
else                /* send the submitted data */
    {
	date_default_timezone_set('America/Chicago');  /* You should set your timezone. */

    $first_name		=	$_POST['first_name'];
    $last_name		=	$_POST['last_name'];
    $business_type	=	$_POST['business_type'];
    $company_name	=	$_POST['company_name'];
    $email			=	$_POST['email'];
    $business_type	=	$_POST['business_type'];
    $phone			=	$_POST['phone'];
    $nda			=	$_POST['nda'];
    $interests = 'No languages selected';  /* This sets this variable if no boxes are checked. */
	if (isset($_POST['interest'])){          /* This builds an array from all those checkboxes. */
	  $interests = implode(',
	  ', $_POST['interest']);  /* This line break will put each item on a new line in the email. */
	}

    if (($first_name=="")||($email=="")||($last_name==""))
        {
		echo 'Certain fields are required, please fill <a href="form.php">the form</a> again.';
	    }
    else{
	    $date 		=	date('m/d/Y - h:i:s A');

	    $from		=	"From: $first_name $last_name<$email>\r\nReturn-path: $email";
	    $from_noreply	= "no_reply@mycompany.com";
        $subject	=	"Web contact form: $last_name";
		$date 		=	date('m/d/Y - h:i:s A');
		$courtesy 	=	"
Thank you for your interest in contacting My Company.
(Here is a copy of the form you recently sent to us.)
";
        $message	=	"
Sent:   $date \r
---------------------------------------------------
Name:    $first_name $last_name\r
Company: $company_name\r
Type:    $business_type\r
Email:   $email\r
Phone:   $phone\r
NDA:     $nda\r
Interests:\r $interests\r

        				";
        $courtesy_message = "$courtesy \r\r $message";

		mail("myemailaddress@mycompany.com", $subject, $message, $from);  // This one goes to ME.
		mail($from, $subject, $courtesy_message, $from_noreply);    // This one goes to the guest.
		echo '

<div class="alert alert-success" role="alert">
<h2>Thank you!</h2> Your message has been sent to our office and we will reply as soon as possible.
</div>

		';
	    }
    }
?>


</div>
  
