<?php 

        // sanitize form values
        $name    = 'Stu';// $_POST["name"];
        $email   = 'stuart.a.mason@gmail.com'; //$_POST["email"];
        $message = 'Hello!'; // $_POST["comment"];
        $subject = 'Mail from website!';
 
        // get the blog administrator's email address
        $to = 'stuart.a.mason@gmail.com'; //get_option( 'admin_email' );
 
        $headers = "From: ".$name." <".$email.">\r\n";
 
        // If email has been process for sending, display a success message
        if ( mail( $to, $subject, $message, $headers ) ) {

            echo 'true';

        } else {

            echo 'false';

        }
   
?>