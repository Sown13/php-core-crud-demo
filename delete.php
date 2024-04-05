<?php

include './config/db.php';
include './templates/template.php';
$pdo = pdo_connect_mysql();

$msg = '';

if (isset($_GET['id'])) {
    $stmt = $pdo->prepare('SELECT * FROM contacts WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Contact doesn\'t exist!');
    }

    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            $stmt = $pdo->prepare('DELETE FROM contacts WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            $msg = 'You have deleted the contact!';
        } else {
            header('Location: list.php');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}

?>

<?= template_header('') ?>

<div class="content delete" style="min-height: 79vh">
    <h2>Delete Contact</h2>
    <?php if ($msg) : ?>
        <p><?= $msg ?></p>
        <a class="btn btn-primary" href="/php_final_exam/list.php">Back to the contact list</a>
    <?php else : ?>
        <h3>Are you sure you want to delete this contact?</h3>
        <h4> Name: <?= $contact['name'] ?></h4>
        <h4> Phone Number: <?= $contact['phone_number'] ?></h4>
        <div class="yesno">
            <a class="btn btn-primary" href="delete.php?id=<?= $contact['id'] ?>&confirm=yes">Yes</a>
            <a class="btn btn-danger" href="delete.php?id=<?= $contact['id'] ?>&confirm=no">No</a>
        </div>
    <?php endif; ?>
</div>

<?= template_footer('') ?>