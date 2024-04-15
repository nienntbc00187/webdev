
    <?php
    include "header.php";
    ?>

<?php
$action = '';

// Kiểm tra xem có tham số 'action' trong URL không
if (isset($_GET['action'])) {
    $action = $_GET['action'];
}

switch ($action) {
    case '':
        include "homepage.php";
        break;
    case 'details':
        include "details.php";
        break;
    default:
        include "404.php";
        break;
}
?>




    <?php
    include "footer.php";
    ?>
