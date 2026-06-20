<?php
include 'db_connect.php';

// Process the form submission securely if the user clicks Save
if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $fullname = $conn->real_escape_string($_POST['fullname']);
      $email = $conn->real_escape_string($_POST['email']);
      $department = $conn->real_escape_string($_POST['department']);

      $sql = "INSERT INTO employees (fullname, email, department) VALUES ('$fullname', '$email', '$department')";

      if ($conn->query($sql) === TRUE){
            // Refresh the page to show the new entry cleanly
            header("Location: index.php");
            exit();
      }
}

// Fetch all existing employee metrics from the MySQL table
$result = $conn->query("SELECT * FROM employees ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang= "en">
<head>
            <meta charset="utf-8">
            <title>Corporate Employee Registry Portal</title>
            <style>
                  body{
                        font-family: 'segoe UI', Tahoma, Geneva, sans-serif; background-color: #f4f6f9; padding: 30px; color: #333;
                  }
                  .container {max-width: 900px; margin: 0 auto; background: white; padding:25px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0,1);}
                  h2{border-bottom: 2px solid #0056b3; padding-bottom: 10px; color: #0056b3;}
                  form{ display: grid; grid-template-columns: 1fr 1fr 1fr auto; gap: 10px; margin-bottom: 30px; }
                  input, select, button{padding: 10px; font-size: 14px; border: 1px solid #ccc; border-radius: 4px;}
                  button { background-color: #0056b3; color: white; border: none; cursor: pointer; font-weight: bold;}
                  button:hover{ background-color: #004085;}
                  table{ width:100%; border-collapse: collapse; margin-top: 20px;}
                  th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd;}
                  th { background-color: #f8f9fa; color: #555;}
                  tr:hover { background-color: #f1f3f5;}
            </style>
</head>
<body>
<div class= "container">
      <h2>Corporate Employee Registry Portal</h2>
      <form action = "index.php" method="POST">
            <input type="text" name="fullname" placeholder="Full name" required>
            <input type="email" name="email" placeholder="Email Address" required>
            <select name="department" required>
                  <option value="">Select Department</option>
                  <option value="IT & Infrastructure">IT & Infrastructure</option>
                  <option value="Finance">Finance</option>
                  <option value="Operations">Operations</option>
            </select>
            <button type="submit">Add Asset</button>
      </form>
      <h2>Active Database Registry Metrices</h2>
      <table>
            <tr>
                  <th> ID Reference</th>
                  <th> Full Name</th>
                  <th> Email</th>
                  <th> Department Assignment </th>  
                  <th> Registration Date</th> 
            </tr>  
            <?php if ($result->num_rows > 0): ?>
                 <?php while($row = $result->fetch_assoc()): ?>
                    <tr> 
                        <td>#<?php echo $row['id']; ?> </td>
                        <td><strong><?php echo htmlspecialchars($row['fullname']); ?></strong> </td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['department']); ?> </td>
                        <td><?php echo $row['created_at']; ?> </td>
                    </tr>
                  <?php endwhile; ?>

            <?php else: ?>
                  <tr><td colspan="5" style="text-align:center; color: #999;"> No records securely logged in the relational core matrix yet.</td></tr>
            
                  <?php endif; ?>
      </table>
</div>

</body>
</html>
                  

