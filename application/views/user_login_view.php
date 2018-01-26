<?php
if (isset($this->session->userdata['logged_in']))
{
    header("location: http://localhost/crm/index.php/login/user_login_process");
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

$header;
?>
<script>
$(function () {
  $("#pass").keyup(function () {
    $("#login").prop('disabled', false);
  });
});
</script>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="col-md-3 col-md-offset-4">
            <br/>
            <legend>Bienvenido</legend>
            <?php
            echo form_open('login/user_login_process');

            $user = array("type" => "text", "class" => "form-control input-sm", "name" => "user", "id" => "name", "placeholder" => "johndoe");
            $pass = array("type" => "password", "class" => "form-control input-sm", "name" => "pass", "id" => "pass", "placeholder" => "*******");
            $login = array("id" => "login", "class" => "btn btn-primary btn-sm", "type" => "submit", "disabled" => "true", "value" => "Ingresar");
            echo "<div class='error_msg'>";
            if (isset($error_message))
            {
                echo $error_message;
            }
            echo validation_errors();
            echo "</div>";
            ?>
            <?= form_input($user) ?>
            <br>
            <?= form_input($pass) ?>
            <br>
            <?= form_submit($login) ?>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<?php $footer; ?>
