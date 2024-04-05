<?php

include './config/db.php';
include './templates/template.php';
$pdo = pdo_connect_mysql();
$msg = '';


if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $phone_number = isset($_POST['phone_number']) ? trim($_POST['phone_number']) : '';
        if (strlen($phone_number) > 20) {
            $msg = 'Invalid phone number (must be less than 20 characters)';
        } else {
            if ($phone_number < 0) {
                $phone_number = $phone_number * (-1);
            }
            $stmt = $pdo->prepare('UPDATE contacts SET name = ?, phone_number = ? WHERE id = ?');
            $stmt->execute([$name, $phone_number, $_GET['id']]);
            $msg = 'Updated Successfully!';
        }
    }
    $stmt = $pdo->prepare('SELECT * FROM contacts WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Contacts doesn\'t exist with that ID!');
    }
} else {
    exit('Contact not found!');
}
?>




<?= template_header('') ?>

<div class="content update" style="min-height: 79vh">
    <h2>Update Contact #<?= $contact['id'] ?></h2>
    <form action="edit_contact.php?id=<?= $contact['id'] ?>" method="post" style="margin-left:10px; max-width: 50vw">
        <label for="name">Name</label>
        <input class="form-control" type="text" name="name" placeholder="New name" value="<?= $contact['name'] ?>" id="name">
        <label for="phone_number">phone_number</label>
        <input class="form-control" type="number" name="phone_number" placeholder="New number" value="<?= $contact['phone_number'] ?>" id="phone_number">
        <input style="margin-top:20px;" type="submit" class="btn btn-primary" value="Update">
    </form>
    <?php if ($msg) : ?>
        <p><?= $msg ?></p>
    <?php endif; ?>
</div>

<?= template_footer('') ?>