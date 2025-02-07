<?php
/*
Template Name: Message Form
*/

if (!is_user_logged_in()) {
    // Redirect to login page if user is not logged in
    wp_redirect(wp_login_url());
    exit;
}

$recipient_id = isset($_GET['recipient_id']) ? $_GET['recipient_id'] : '';
?>
<form method="POST" action="">
    <input type="hidden" name="recipient_id" value="<?php echo $recipient_id; ?>" />
    <input type="text" name="message_subject" placeholder="Subject" />
    <textarea name="message_content" rows="5" cols="30" placeholder="Enter your message"></textarea>
    <input type="submit" name="message_submit" value="Send Message" />
</form>