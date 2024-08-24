<?php
   $to_email = "phurpawangchuk20@gmail.com";
//sonamchoden.it@rtc.bt";
   $subject = "Simple Email Test via PHP";
   $body = "Hi,\n This is test email send by PHP Script";
   $headers = "From: sender@example.com";
 
   if ( mail($to_email, $subject, $body, $headers)) {
      echo("Email successfully sent to $to_email...");
   } else {
      echo("Email sending failed...");
   }
?>
