<html>
<head>
<title>ThaiCreate.Com PHP Sending Email</title>
</head>
<body>
<?php
	$strTo = "system.goldenbeachgroup@gmail.com";
	$strSubject = "Test Send Email";
	$strHeader = "From: system.goldenbeachgroup@gmail.com";
	$strMessage = "My Body & My Description";
	$flgSend = mail($strTo,$strSubject,$strMessage,$strHeader);  // @ = No Show Error //
	if($flgSend)
	{
		echo "Email Sending.".$flgSend;
	}
	else
	{
		echo "Email Can Not Send.";
	}
?>
</body>
</html>