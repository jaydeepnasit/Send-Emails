<?php

$data = array();

function validation($form){
    $form = trim(htmlspecialchars(stripcslashes(strip_tags($form))));
    return $form;
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if(isset($_POST['toemail']) && isset($_POST['subject']) && isset($_POST['message'])){
        
        $to_email = validation($_POST['toemail']);
        $subject = validation($_POST['subject']);
        $message = wordwrap(validation($_POST['message']),70);
        $headers = "From: webmaster@example.com" . "\r\n" ."CC: $to_email";

        if((!empty($to_email) && preg_match('/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/', $to_email)) && !empty($subject) && !empty($message)){

            try{
                if(mail($to_email, $subject, $message, $headers)){
                    $data['status'] = 400;
                    $data['data'] = "Email SuccessFully Sent";
                }
                else{
                    throw new Exception("Email Not Send");
                }
            }
            catch(Exception $e){
                $data['status'] = 404;
                $data['data'] = $e->getMessage();
            }

        }
        else{
            $data['status'] = 408;
            $data['data'] = "Data Not Validated";
        }

    }
    else {
        $data['status'] = 412;
        $data['data'] = "Access Denied";
    }

}
else{

    $data['status'] = 416;
    $data['data'] = "Access Denied";

}

echo json_encode($data);


?>