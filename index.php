<?php
  // Connect to the database
  $conn = mysqli_connect("localhost", "root", "", "students_db");

  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
?>

<!DOCTYPE html>
<html>
<head>
  <title>Students Data Management</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f0f0f0;
    }

    .container {
      width: 80%;
      margin: 40px auto;
      background-color: #fff;
      padding: 20px;
      border: 1px solid #ddd;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .header {
      background-color: #333;
      color: #fff;
      padding: 10px;
      text-align: center;
      border-bottom: 1px solid #ddd;
    }

    .header h1 {
      margin: 0;
    }

    .form {
      margin-top: 20px;
    }

    .form label {
      display: block;
      margin-bottom: 10px;
    }

    .form input[type="text"] {
      width: 100%;
      height: 40px;
      margin-bottom: 20px;
      padding: 10px;
      border: 1px solid #ccc;
    }

    .form input[type="submit"] {
      width: 100%;
      height: 40px;
      background-color: #333;
      color: #fff;
      padding: 10px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .form input[type="submit"]:hover {
      background-color: #444;
    }

    .table {
      margin-top: 20px;
    }

    .table th, .table td {
      border: 1px solid #ddd;
      padding: 10px;
      text-align: left;
    }

    .table th {
      background-color: #f0f0f0;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h1>Students Data Management</h1>
    </div>
    <div class="form">
      <form action="index.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name"><br><br>
        <label for="class">Class:</label>
        <input type="text" id="class" name="class"><br><br>
        <label for="dept">Department:</label>
        <input type="text" id="dept" name="dept"><br><br>
        <input type="hidden" name="action" value="insert">
        <input type="submit" value="Submit">
      </form>
    </div>
    <div class="table">
      <?php
        // Display students data
        $sql = "SELECT * FROM students";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
          echo "<table>";
          echo "<tr><th>ID</th><th>Name</th><th>Class</th><th>Department</th></tr>";
          while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>" . $row["class"] . "</td>";
            echo "<td>" . $row["dept"] . "</td>";
            echo "</tr>";
          }
          echo "</table>";
        } else {
          echo "No students data available.";
        }
      ?>
    </div>
  </div>
</body>
</html>

<?php
  // Insert data into the database
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $class = $_POST["class"];
    $dept = $_POST["dept"];

    $sql = "INSERT INTO students (name, class, dept) VALUES ('$name', '$class', '$dept')";
    mysqli_query($conn, $sql);
  }
?>

<?php
  // Update data
  if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["action"] == "update") {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $class = $_POST["class"];
    $class = $_POST["class"];
    $dept = $_POST["dept"];

    $sql = "UPDATE students SET name = '$name', class = '$class', dept = '$dept' WHERE id = '$id'";
    mysqli_query($conn, $sql);
  }
?>

<?php
  // Delete data
  if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["action"] == "delete") {
    $id = $_POST["id"];

    $sql = "DELETE FROM students WHERE id = '$id'";
    mysqli_query($conn, $sql);
  }
?>

<script>
  function validateForm() {
    var name = document.getElementById("name").value;
    var class = document.getElementById("class").value;
    var dept = document.getElementById("dept").value;

    if (name == "" || class == "" || dept == "") {
      alert("Please fill in all fields.");
      return false;
    }
  }
</script>