<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if (isset($_POST['member-message'])) {
    $MESSAGE = new AdvertisementMessage(NULL);
    $VALID = new Validator();

    $MESSAGE->advertisement = $_POST['advertisement'];
    $MESSAGE->owner = $_POST['owner'];
    $MESSAGE->member = $_POST['member'];
    $MESSAGE->message = mysql_real_escape_string($_POST['message']);
    $MESSAGE->parent = $_POST['parent'];
    $MESSAGE->sender = $_POST['sender'];

    $VALID->check($MESSAGE, [
        'message' => ['required' => TRUE],
        'sender' => ['required' => TRUE]
    ]);
    
    if ($VALID->passed()) {
        $RESULT = $MESSAGE->create();

        if ($RESULT) {
            $VALID->addError("Your message was sent successfully.", 'success');
            $_SESSION['ERRORS'] = $VALID->errors();
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else {
            $VALID->addError("There was an error.please try again !", 'danger');
            $_SESSION['ERRORS'] = $VALID->errors();
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
}