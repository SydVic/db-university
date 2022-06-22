<?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
?>

<?php
  require_once __DIR__ . "/database-conn.php";
  require_once __DIR__ . "/Department.php";

  // QUERY
  $sql = "SELECT `id`, `name` FROM `departments`;";
  $result = $conn->query($sql);
  // var_dump($result);

  $departments = [];

  if ($result && $result->num_rows > 0) {
    // abbiamo dei risultati nella query
    while ($row = $result->fetch_assoc()) { // fetch_assoc serve per prendere una riga alla volta
      // var_dump($row);
      $curr_department = new Department($row["id"], $row["name"]);
      $departments[] = $curr_department;
    }
    // var_dump($departments);
  } else if ($result) {
    // query è andata a buon fine ma non ci sono risultati

  } else {
    // query non è andata a buon fine
    // vuol dire che c'è un errore di sintassi nella query
    echo "Query error";
    die();
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lista Dipartimenti</title>
</head>
<body>
  <?php foreach($departments as $department) { ?>
    <div>
      <h2><?php echo $department->name; ?></h2>
      <a href="single-department.php?id<?php echo $department->id?>">ulteriori informazioni</a>
    </div>
  <?php } ?>
</body>
</html>