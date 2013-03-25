<?php require_once './Mail.php';

$class = new Mail();
if (isset($_POST) && !empty($_POST['user'])) :
    ?>
    <script type="text/javascript">
        $("#myModal").modal('show')
    </script>
<?php endif; ?>