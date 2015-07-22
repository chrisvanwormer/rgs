<?php
//header('HTTP/1.1 503 Service Unavailable');
session_start();
require('phpmailer/PHPMailerAutoload.php');

if (isset($_GET['script'])) {
    $script = $_GET['script'];

    if ($script == 'message') {
        // process post variables
        $firstname    = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
        $lastname     = filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
        $email        = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $message      = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

        if ($firstname == '' || $lastname == '' || $email == '' || $message == '') {
            // throw error for missing fields
            $html = '
                     <p class="clickit-error-text">Whoops. Looks like you missed something. Please fill in all the fields.</p>
                     <a class="close-reveal-modal">&#215;</a>';
            echo $html;
            exit();
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // throw error for bad email
            $html = '
                     <p class="clickit-error-text">Looks like something isn\'t quite right with your email address. Please try again.</p>
                     <a class="close-reveal-modal">&#215;</a>';
            echo $html;
            exit();
        }

        //$sendmessage = $name . "\n" . $email . "\n" . $message;

        $mail = new PHPMailer();
        $mail->SMTPDebug = false;
        $mail->isSMTP();
        $mail->Host = 'smtpout.secureserver.net';
        $mail->SMTPAuth = true;
        $mail->Username = 'richard.fisher@rivergardenstudio.com';
        $mail->Password = 'RiverGarden282';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->From = 'no-reply@rivergardenstudio.com';
        $mail->FromName = 'River Garden Studio Web';
        $mail->addAddress('richard.fisher@rivergardenstudio.com');
        $mail->Subject = 'Website Contact Submission';

        $body = "First Name: " . $firstname . "\n";
        $body .= "Last Name: " . $lastname . "\n";
        $body .= "Email: " . $email . "\n";
        $body .= "Message: " . $message . "\n";

        $mail->Body = $body;

        if (!$mail->send()) {
            // throw error for mail failure
            $html = '
                     <p class="clickit-error-text">Something funky happened. Please try again.</p>
                     <a class="close-reveal-modal">&#215;</a>';
            echo $html;
        }

        //mail('hello@clickitdigital.com', 'Website Contact Submission', $sendmessage);

        $html = '
                 <h4 class="clickit-section-centered-text">Thanks much! You will be hearing back from us shortly.</h4>
                 <a class="close-reveal-modal">&#215;</a>';
        echo $html;
    } elseif ($script == 'newsletter') {
        // process post variables
        $email        = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

        if ($email == '') {
            // throw error for missing fields
            $html = '
                     <p class="clickit-error-text">Whoops. Looks like you missed something. Please fill in all the fields.</p>
                     <a class="close-reveal-modal">&#215;</a>';
            echo $html;
            exit();
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // throw error for bad email
            $html = '
                     <p class="clickit-error-text">Looks like something isn\'t quite right with your email address. Please try again.</p>
                     <a class="close-reveal-modal">&#215;</a>';
            echo $html;
            exit();
        }

        $mail = new PHPMailer();
        $mail->SMTPDebug = false;
        $mail->isSMTP();
        $mail->Host = 'smtpout.secureserver.net';
        $mail->SMTPAuth = true;
        $mail->Username = 'richard.fisher@rivergardenstudio.com';
        $mail->Password = 'RiverGarden282';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->From = 'no-reply@rivergardenstudio.com';
        $mail->FromName = 'River Garden Studio Web';
        $mail->addAddress('richard.fisher@rivergardenstudio.com');
        $mail->Subject = 'Website Newsletter Submission';

        $body = "Submitted Newsletter Email Address: " . $email . "\n";


        $mail->Body = $body;

        if (!$mail->send()) {
            // throw error for mail failure
            $html = '
                     <p class="clickit-error-text">Something funky happened. Please try again.</p>
                     <a class="close-reveal-modal">&#215;</a>';
            echo $html;
        }

        //mail('hello@clickitdigital.com', 'Website Contact Submission', $sendmessage);

        $html = '
                 <h4 class="clickit-section-centered-text">Thanks much! You will be hearing back from us shortly.</h4>
                 <a class="close-reveal-modal">&#215;</a>';
        echo $html;
    }
}