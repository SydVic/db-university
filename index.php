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

  $departments = [];

  if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $current_department = new Department($row["id"], $row["name"]);
      $departments[] = $current_department;
    }
  } else if ($result) {
    echo "Query vuota";
  } else {
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

  <h1>Lista dipartimenti</h1>

  <?php foreach($departments as $department) { ?>
    <div>
      <h3><?php echo $department->name; ?></h3>
      <a href="single-department.php?id=<?php echo $department->id?>">Ulteriori informazioni</a>
    </div>
  <?php } ?>
</body>
</html>