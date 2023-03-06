<?php

require_once('./functions.php');

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}

echo "WELCOME ".$_SESSION['user']['email']." !";

$link = connectDB();

if(isset($_GET['id'])) {
    $sql = 'SELECT * FROM tasks WHERE id = ' . $_GET['id'];
} else {
    $sql = 'SELECT * FROM tasks';
}

?>
<style>
  table {
  border-collapse: collapse;
  width: 100%;
  max-width: 800px;
  margin: 0 auto;
}

thead {
  background-color: #333;
  color: white;
}

th {
  padding: 10px;
  text-align: left;
}

tbody tr:nth-child(even) {
  background-color: #f2f2f2;
}

td {
  padding: 10px;
}

td:first-child {
  font-weight: bold;
}

a {
  color: blue;
  text-decoration: none;
}

a:hover {
  text-decoration: underline;
}

</style>
<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Label</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($link->query($sql) as $row) { ?>
            <tr>
                <td>
                    <?php echo $row['id']; ?>
                </td>
                <td>
                    <?php echo $row['label']; ?>
                </td>
                <td>
                    <?php echo $row['description']; ?>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
