<?php
  require_once __DIR__ . "/database-conn.php";
  require_once __DIR__ . "/Department.php";

  $stmt = $conn->prepare("SELECT * FROM `departments` WHERE `id`=?;");
  $stmt->bind_param("d", $id);
  $id = $_GET["id"];

  $stmt->execute();
  $result = $stmt->get_result();

  $departments = [];

  if ($result && $result->num_rows > 0 ) {
    while ($row = $result->fetch_assoc()) {
      $current_department = new Department($row["id"], $row["name"]);
      $current_department->setContactData($row["address"], $row["phone"], $row["email"], $row["website"]);
      $current_department->head_of_department = $row["head_of_department"];
      $departments[] = $current_department;
    }
  } else if ($result) {
    echo "Dipartimento non trovato";
  } else {
    echo "Errore nella query";
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dipartimento</title>
</head>
<body>

  <?php foreach ($departments as $department) { ?>

    <a href="index.php">torna alla lista dei dipartimenti</a>

    <h2><?php echo $department->name; ?></h2>
    <p><?php echo $department->head_of_department; ?></p>

    <h4>Contatti</h4>
    <ul>
      <?php foreach ($department->getContactsAsArray() as $key => $value) { ?>
        <li><?php echo "$key: $value" ?></li>
      <?php } ?>
    </ul>
  <?php } ?>

</body>
</html>