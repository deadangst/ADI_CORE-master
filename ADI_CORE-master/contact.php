<?php
$field_name = $_POST['cf_name'];
$field_email = $_POST['cf_email'];
$field_subject = $_POST['cf_subject'];
$field_message = $_POST['cf_message'];

$mail_to = 'info@desampainclusivo.com';
//$subject = 'Message from a site visitor '.$field_name;
$subject = 'Asunto: '.$field_subject;

$body_message = $field_name.' le envía un mensaje'."\n";
$body_message .= 'Lo puede contactar al E-mail: '.$field_email."\n";
$body_message .= 'Mensaje: '."\n".$field_message;

$headers = 'De: '.$field_email."\r\n";
$headers .= 'Reply-To: '.$field_email."\r\n";

$mail_status = mail($mail_to, $subject, $body_message, $headers);

if ($mail_status) { ?>
	<script language="javascript" type="text/javascript">
		alert('Gracias por tu mensaje. Nos pondremos en contacto contigo a la brevedad.');
		window.location = 'index.html';
	</script>
<?php
}
else { ?>
	<script language="javascript" type="text/javascript">
		alert('Envío fallido. Por favor, envía un email a info@desampainclusivo.com');
		window.location = 'index.html';
	</script>
<?php
}
?>