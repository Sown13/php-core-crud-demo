<?php
//session_start();

include './config/db.php';
include './templates/template.php';
$pdo = pdo_connect_mysql();
$id =  trim($_GET["id"]);
$msg = '';
if (isset($id)) {
    $stmt = $pdo->prepare('SELECT * FROM contacts WHERE id = ?');
    $stmt->execute([$id]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        $msg = 'Contact doesn\'t exist with that ID!';
    }
} else {
    $msg = 'No ID specified!';
}


?>

<?= template_header('') ?>

<div class="featured" style="min-height: 79vh">
    <?php if ($msg) : ?>
        <p><?= $msg ?></p>
    <?php else : ?>
        <h2>Detail Page</h2>
        <h4> Name:<?= $contact['name'] ?> </h4>
        <h4> Phone number: <?= $contact['phone_number'] ?> </h4>
    <?php endif; ?>
</div>


<?= template_footer('') ?>