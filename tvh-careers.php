<?php
	$msg = "";

	if (isset($_POST['carsub'])) {

		require 'phpmailer/PHPMailerAutoload.php';

		function sendemail($to, $from, $fromName, $body, $email, $attachment = "") {
			$mail = new PHPMailer();
			$mail->setFrom($from, $fromName);
			$mail->addAddress($to);
			$mail->addAttachment($attachment);
			$mail->Subject = 'Careers - TVH';
			
			$mail->Body = "Welcome Greetings!!!". "<br><br>";
			$mail->Body .= "Name:&nbsp;". $fromName ."<br>";
			$mail->Body .= "E-Mail:&nbsp;". $email ."<br>";
			$mail->Body .= "Message:". "<br>";
			$mail->Body .= $body. "<br>";
			$mail->Body .= "Please find the attachment of my CV.". "<br><br>";
			$mail->Body .= "Thank you". "<br><br>";
			$mail->isHTML(true);

			return $mail->send();
		}
		
		function sendemail2($to, $from, $fromName, $body ) {
			$mail = new PHPMailer();
			$mail->setFrom($from, $fromName);
			$mail->addAddress($to);
			$mail->addAttachment($attachment);
			$mail->Subject = 'Careers - TVH';
			$mail->Body = $body. "<br> Thank You.";
			$mail->isHTML(true);

			return $mail->send();
		}

		$name = $_POST['username'];
		$email = $_POST['email'];
		$body = $_POST['messtext'];
		

		$file = "attachment/" . basename($_FILES['attachment']['name']);
		if (move_uploaded_file($_FILES['attachment']['tmp_name'], $file)) {
		    if (sendemail('samkumar121@gmail.com','careers@tvh.in', $name, $body, $email, $file)) {
				$msg = 'Your resume successfully submitted. Thank you!!';
				sendemail2($email, 'noreply@tvh.in', 'TVH', 'Your resume successfully submitted. We will reach you soon!!');
			} else
				$msg = 'Your resume successfully submitted. Thank you!!';
		} else
			$msg = "Please check your attachment!";
	}
?>
<html>
	<head>
		<title>TVH - Careers</title>
		
		<link rel='stylesheet' id='bootstrap-css'  href='http://www.tvh.in/wp-content/themes/easyliving/css/bootstrap.min.css?ver=3.0' type='text/css' media='all' />
		<link rel='stylesheet' id='style-css'  href='http://www.tvh.in/wp-content/themes/easyliving/style.css?ver=3.8.21' type='text/css' media='all' />
	</head>
	
	<body style="background-color: #f5f5f5;">
	<h3>CAREERS</h3>
	<div class="divider"></div>  
		<form method="post" action="tvh-careers.php" enctype="multipart/form-data">
		<div>
		<label for="contact-name" data-name="name">Your Name</label>
			<input type="text"	name="username" required>
		<label for="contact-email" data-name="email">Your Email</label>
			<input type="email"	name="email" required>
		</div>
		<div>
		<div>
		<label for="contact-email" data-name="email">Message</label>
			<textarea name="messtext" style="width:100%;" required></textarea>
		</div>
		</div>
		<div>
		<div>
			<input type="file" name="attachment" required>
		</div>
		<div class="col-lg-2">
			<input class="buttonColor" type="submit" name="carsub" value="SUBMIT" style="width:150px;float:right;">
		</div>
		</div>
		</form><!-- end form -->
		<br><br>
		<?php echo $msg; ?>
	</div>
	
	</body>
</html>