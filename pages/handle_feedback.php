<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sofia's Contact Feedback</title>
	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,700|Roboto:400,700" rel="stylesheet">
	<link href="https://unpkg.com/ionicons@4.5.5/dist/css/ionicons.min.css" rel="stylesheet">
	<!-- Style -->
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/print.css"  media="print">
</head>
<body id="feedback">
<header>
	<div>
		<img id="myPhoto" src="../images/sofia.jpg" alt="my photo" title="Sofia Faverman">
	</div>
	<!-- HAMBURGER MENU -->
    <div id="navigation">
         <input type="checkbox" id="toggle">
         <label for="toggle">Menu</label>
         <nav class="mainNav">
            <ul>
                <li><a href="../index.html"><i class="icon ion-md-home"></i> Home</a></li>
				<li><a href="portfolio.html"><i class="icon ion-md-images"></i> Portfolio</a></li>
				<li><a href="about.html"><i class="icon ion-md-person"></i> About Me</a></li>
				<li><a href="blog.html"><i class="icon ion-md-text"></i> Blog</a></li>
				<li><a href="resume.html"><i class="icon ion-md-book"></i> Resume</a></li>
				<li><a href="contact.html"><i class="icon ion-md-contact"></i> Contact</a></li>
            </ul>
         </nav>
     </div>
</header>
<main>


<h1>Sofia Faverman</h1>

<?php
//  script: handle_feedback.php
//	This page receives the data from contact.html.php
//  It will receive: name, phone, email and comments and submit in $_POST


/* $_POST is case sensitive
 * Must match the name attribute values from the form
*/

if(isset($_POST['email'])) {

    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "sofiasd@yahoo.com";
    $email_subject = "Email from Sofia's Portfolio website";

    function died($error) {
        // your error code can go here
        echo "<h3>We are very sorry, but there were error(s) found with the form you submitted.</h3>";
        echo "<h3>These errors appear below.</h3>";
        echo "<h3>".$error."</h3>";
        echo "<h3>Please go back and fix these errors.</h3>";
        die();
    }


    // validation expected data exists
    if(!isset($_POST['firstName']) ||
        !isset($_POST['lastName']) ||
        !isset($_POST['email']) ||
        /*!isset($_POST['phone']) ||*/
        !isset($_POST['questions'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');
    }

    $fName = $_POST['firstName']; //required
	$lName = $_POST['lastName'];  //required
	$email = $_POST['email'];     //required
	$phone = $_POST['phone'];
	$comments = $_POST['questions']; //required
	$contMethod = $_POST['contMethod']; //required

	switch ($contMethod) {
    case "phone":
        $method = "call you at $phone";
        break;
    case "email":
		$method = "email you at $email";
        break;
    case "text":
		$method = "text you at $phone";
        break;
    default:
        echo "Your preferred contact method is neither phone, email, nor text!";
    }

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

  if(!preg_match($email_exp,$email)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }

    $string_exp = "/^[A-Za-z .'-]+$/";

  if(!preg_match($string_exp,$fName)) {
    $error_message .= 'The First Name you entered does not appear to be valid.<br />';
  }

  if(!preg_match($string_exp,$lName)) {
    $error_message .= 'The Last Name you entered does not appear to be valid.<br />';
  }

  $phone_exp = "/[0-9]{3}-[0-9]{3}-[0-9]{4}/";

  if(!preg_match($phone_exp,$phone) && ($contMethod === 'phone' || $contMethod === 'text')) {
    $error_message .= 'The Phone Number you entered does not appear to be valid.<br />';
  }

  if(strlen($comments) < 2) {
    $error_message .= 'The Comments you entered do not appear to be valid.<br />';
  }

  if(strlen($error_message) > 0) {
    died($error_message);
  }

    $email_message = "Form details below.\n\n";


    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }



    $email_message .= "First Name: ".clean_string($fName)."\n";
    $email_message .= "Last Name: ".clean_string($lName)."\n";
    $email_message .= "Email: ".clean_string($email)."\n";
    $email_message .= "Telephone: ".clean_string($phone)."\n";
    $email_message .= "Comments: ".clean_string($comments)."\n";

// create email headers
$headers = 'From: '.$email."\r\n".
'Reply-To: '.$email."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);


//Print the received data:
print "<h3> Thank you, $fName $lName, for your comments. </h3>
<h3>I appreciate your feedback:<br>$comments</h3>
<h3>Your feedback is very important for my business.</h3>
<h3>Please allow me 24-48 hours to $method.</h3>";


/* This displays the content of the $_POST superglobal array
	if any post data has been sent.
	$_POST is a superglobal, which is an associative array
	The print_r() function allows you to inspect the contents
	of arrays and is used for debugging purposes.
	The <pre> tags simply makes the output easier to read

<pre>
	<?php print_r($_POST); ?>
</pre>

*/

}

?>
</main>
<footer>

	<p>Copyright &copy; <script type="text/javascript">document.write(new Date().getFullYear())</script></p>
	<a href="../index.html">Home</a> -
	<a href="portfolio.html">Portfolio</a> -
	<a href="about.html">About Me</a> -
	<a href="blog.html">Blog</a> -
	<a href="resume.html">Resume</a> -
	<a href="contact.html">Contact</a>
</footer>

</body>
</html>
