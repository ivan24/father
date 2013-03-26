<?php

if (isset($_GET['send']) && $_GET['send'] === 'success') {
    print $modal->render('successOrderForm.php');
} else {
    print $modal->render(
        'orderForm.php',
        array(
            'value' => $modal->getSanitized(),
            'error' => $modal->getErrors()
        )
    );
}
if (isset($_POST) && !empty($_POST['user']) || (isset($_GET['send']) && ($_GET['send'] === 'success' || $_GET['send'] === 'another'))) :
    ?>
    <script type="text/javascript">
        $("#myModal").modal('show')
    </script>
<?php endif; ?>