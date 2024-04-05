<?php

include './config/db.php';
include './templates/template.php';

$pdo = pdo_connect_mysql();
$stmt = $pdo->prepare('SELECT * FROM contacts');
$stmt->execute();
$contact_list = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>

<?= template_header('') ?>

<div class="recentlyadded content-wrapper" style="min-height: 79vh">
  <h2>List </h2>
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col" class="col-1">#</th>
        <th scope="col">Name</th>
        <th scope="col">Phone Number</th>
        <th scope="col" colspan="2" class="col-2">Option</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $index = 0;
      foreach ($contact_list as $contact) :
        $index++
      ?>
        <tr>
          <th scope="row"><?= $index ?></th>
          <td><a href="detail.php?id=<?= $contact['id'] ?>" class="contact"> <span class="name"><?= $contact['name'] ?></span> </a></td>
          <td><span class="quantity"><?= $contact['phone_number'] ?></td>
          <td class="actions">
            <a href="edit_contact.php?id=<?= $contact['id'] ?>" class="edit"><i class="fas fa-pen fa"></i></a>
          </td>
          <td class="actions">
            <a href="delete.php?id=<?= $contact['id'] ?>" class="trash"><i class="fas fa-trash fa"></i></a>
          </td>
        </tr>
        </a>
      <?php endforeach; ?>

    </tbody>
  </table>
</div>


<?= template_footer('') ?>