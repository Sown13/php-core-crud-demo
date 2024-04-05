<?php

include './config/db.php';
include './templates/template.php';
$pdo = pdo_connect_mysql();

?>

<?= template_header('') ?>

<div class="featured" style="min-height: 79vh">
    <h2>Class: T2310E</h2>
    <h2>Student: Nguyễn Hải Sơn </h2>
    <h2>Subject: PHP</h2>
</div>


<?= template_footer('') ?>