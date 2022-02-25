<?php
// If is not empty it sets a header From in e-mail message (sets sender e-mail).
// Note: some hosting servers can block sending e-mails with custom From field in header.
//       If so, leave this field as empty.
define('FROM_EMAIL', 'info@ddelectricmotors.com');

// Recipient's e-mail. To this e-mail messages will be sent.
// e.g.: john@example.com
// multiple recipients e.g.: john@example.com, andy@example.com
define('TO_EMAIL', 'cf@frascadesigngroup.com');

/**
 * Function for sending messages. Checks input fields, prepares message and sends it.
 */
function sendMessage() {
    // Variables init
    $json = array();
    $token = "9320087105434084715";

    // Retrieving content from send data by form.
    // If you don't want to use filter_input you can use direct access to variable using $_POST['<name_input_name>']
    // e.g. $_POST['email']
    $contact_name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $contact_email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $contact_tel = filter_input(INPUT_POST, 'tel', FILTER_SANITIZE_STRING);
	$contact_service = filter_input(INPUT_POST, 'service', FILTER_SANITIZE_STRING);

    // This field is special, and it's used for anti bot protection.
    $contact_secret = filter_input(INPUT_POST, 'contact_secret', FILTER_SANITIZE_STRING);

    // Decode secret
    $contact_secret = strrev($contact_secret);

    // Token set in JS file have to be the same as in PHP file
    if ($contact_secret !== $token) {
        $json['result'] = 'NO_SPAM';
        header('Access-Control-Allow-Origin: *');
        echo json_encode($json);
        die();
    }

    // Adding e-mail headers
    $headers = "";
    if (FROM_EMAIL !== '') {
        $headers .= 'From: '.FROM_EMAIL."\r\n";
    }
    $headers .= 'Reply-To: '.$contact_email."\r\n";
    $headers .= 'Content-Type: text/plain; charset=UTF-8'."\r\n";


    /*
     * Formatting message.
     * It can be customizable in any way you like.
     */
    $title = 'DD Electric Website - New Message from '.$contact_name;
    $message = 'Hey,'."\n\n"
            .'You\'ve received new message from your website. Check details below:'."\n\n"
            .'Name: '.$contact_name."\n"
            .'E-mail: '.$contact_email."\n"
            .'Phone number: '.$contact_tel."\n"
			.'Service Needed: '.$contact_service."\n\n"
            .$contact_message;


    // Mail it!
    $result = mail(TO_EMAIL, $title, $message, $headers);

    // Notify Get In Touch With Us about result of sending.
    if ($result) {
        $json['result'] = 'OK';
    } else {
        $json['result'] = 'SEND_ERROR';
    }
    header('Access-Control-Allow-Origin: *');
    echo json_encode($json);
    die();
}

/*
 * Calling a from only when post request is detected (data was sent by form).
 * Otherwise it returns OK, which can be handy with checking that the script is alive.
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    sendMessage();
    die();
} else {
    if (function_exists('mail')) {
        die('OK');
    } else {
        die('PHP parser works, but <b>mail()</b> function seems to doesn\'t exist');
    }

}