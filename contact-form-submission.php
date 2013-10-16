<?php

// check for form submission - if it doesn't exist then send back to contact form
if (!isset($_POST['save']) || $_POST['save'] != 'contact') {
    header('Location: contacto.php'); exit;
}
	
// get the posted data
$name = $_POST['contact_name'];
$email_address = $_POST['contact_email'];
$phone = $_POST['contact_phone'];
$message = $_POST['contact_message'];
	
// check that a name was entered
if (empty($name))
    $error = 'Tienes que introducir un nombre.';
// check that an email address was entered
elseif (empty($email_address)) 
    $error = 'Tienes que introducir una dirección de email.';
// check for a valid email address
elseif (!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/', $email_address))
    $error = 'Tienes que introducir una dirección de email valida.';
// check that a phone number was entered
if (empty($phone))
    $error = 'Tienes que introducir un número de teléfono.';
// check that a message was entered
elseif (empty($message))
    $error = 'Tienes que introducir un mensaje.';
		
// check if an error was found - if there was, send the user back to the form
if (isset($error)) {
    header('Location: contacto.php?e='.urlencode($error)); exit;
}

$headers = "From: $email_address\r\n"; 
$headers .= "Reply-To: $email_address\r\n";

// write the email content
$email_content = "Nombre: $name\n";
$email_content .= "Email: $email_address\n";
$email_content .= "Teléfono: $phone\n";
$email_content .= "Mensaje:\n\n$message";
	
// send the email
//ENTER YOUR INFORMATION BELOW FOR THE FORM TO WORK!
mail ('haritziturbe@gmail.com', 'HIRUMET.com - Mensaje del formulario de Contacto', $email_content, $headers);
	
// send the user back to the form
header('Location: contacto.php?s='.urlencode('Gracias por enviar el mensaje.')); exit;

?>