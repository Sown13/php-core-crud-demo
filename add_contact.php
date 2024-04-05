<?php
//session_start();

include './config/db.php';
include './templates/template.php';
$pdo = pdo_connect_mysql();
$msg = '';

if (!empty($_POST)) {

    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $phone_number = isset($_POST['phone_number']) ? trim($_POST['phone_number']) : '';
    if (strlen($phone_number) > 20) {
        $msg = 'Invalid phone number (must be less than 20 characters)';
    } else {
        if ($phone_number < 0)  {
            $phone_number = $phone_number * (-1);
        }
        $stmt = $pdo->prepare('INSERT INTO contacts (name, phone_number) VALUES (?, ?)');
        $stmt->execute([$name, $phone_number]);
        $msg = 'Created Successfully!';
    }
}

?>

<?= template_header('') ?>

<div class="featured" style="min-height: 79vh">
    <div class="content update">
        <h2>Create Contact</h2>
        <p><span style="color: red;">*</span> Required</p>
        <form action="add_contact.php" method="post" style="margin-left:10px; max-width: 50vw">
            <div class="mb-3">
                <label for="name" class="form-label">Name <span style="color: red;">*</span></label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Contact Name" required>
            </div>
            <div class="mb-3">
                <label for="phone_number" class="form-label">Phone Number <span style="color: red;">*</span></label>
                <input type="number" class="form-control" id="phone_number" name="phone_number" placeholder="Phone Number" rows="3" required></input>
            </div>
            <input class="btn btn-primary" type="submit" value="Add this contact">
        </form>
        <?php if ($msg) : ?>
            <p><?= $msg ?></p>
        <?php endif; ?>
    </div>
</div>


<?= template_footer('') ?>