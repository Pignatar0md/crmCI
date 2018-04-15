<?php
if (isset($this->session->userdata['logged_in']))
{
    header("location: index.php/clientes");
}
// if (isset($logout_message))
// {
//     echo "<div class='message'>";
//     echo $logout_message;
//     echo "</div>";
// }
if (isset($message_display))
{
    echo "<div class='message'>";
    echo $message_display;
    echo "</div>";
}

echo $header;
echo $body;
echo $footer;
?>
