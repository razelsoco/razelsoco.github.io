<?php
  //if(isset($_POST['submit'])){
    // message that will be displayed when everything is OK :)
    $okMessage = 'Contact form successfully submitted. Thank you, I will get back to you soon!';

    // If something goes wrong, we will display this message.
    $errorMessage = 'There was an error while submitting the form. Please try again later';

    $to = "razelsadaya@gmail.com"; // this is your Email address
    $from = $_POST['email']; // this is the sender's Email address
    $name = $_POST['name'];
    $subject = $_POST['subject'];
    //$subject2 = "Copy of your form submission";
    $message = $name . " wrote the following:" . "\n\n" . $_POST['message'];
    //$message2 = "Here is a copy of your message " . $name . "\n\n" . $_POST['message'];

    //$headers = "From:" . $from;
    //$headers2 = "From:" . $to;
    mail($to,$subject,$message,$headers);
    //mail($from,$subject2,$message2,$headers2); // sends a copy of the message to the sender
    echo "Your message has been sent. Thank you " . $name . ", I will contact you shortly.";
    // You can also use header('Location: thank_you.php'); to redirect to another page.
    //}

    try
    {

        if(count($_POST) == 0) throw new \Exception('Form is empty');


        // All the necessary headers for the email.
        $headers = array('Content-Type: text/plain; charset="UTF-8";',
            'From: ' . $from,
            'Reply-To: ' . $from,
            'Return-Path: ' . $from,
        );
        
        // Send email
        mail($sendTo, $subject, $message, implode("\n", $headers));

        $responseArray = array('type' => 'success', 'message' => $okMessage);
    }
    catch (\Exception $e)
    {
        $responseArray = array('type' => 'danger', 'message' => $errorMessage);
    }


    // if requested by AJAX request return JSON response
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        $encoded = json_encode($responseArray);

        header('Content-Type: application/json');

        echo $encoded;
    }
    // else just display the message
    else {
        echo $responseArray['message'];
    }
?>
