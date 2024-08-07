<?php

$servername = "talsprddb02.int.its.rmit.edu.au";
$username = "COSC3046_2402_G11";
$password = "6g27lTiEeGA1";
$dbname = "COSC3046_2402_G11";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, firstName, lastName, email, username, status FROM userData WHERE username != 'admin'";

$result = $conn->query($sql);

echo "<div class='table-container'>";
if ($result->num_rows > 0) {
    echo "<table class='styled-table'>";
    echo "<thead><tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Username</th><th>Status</th><th>Action</th></tr></thead>";
    echo "<tbody>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row["id"]) . "</td>
                <td>" . htmlspecialchars($row["firstName"]) . "</td>
                <td>" . htmlspecialchars($row["lastName"]) . "</td>
                <td>" . htmlspecialchars($row["email"]) . "</td>
                <td>" . htmlspecialchars($row["username"]) . "</td>
                <td>" . htmlspecialchars($row["status"]) . "</td>
                <td>";
        if ($row["status"] == "active") {
            echo "<form action='../PHP/lockuser.php' method='post' style='display:inline;'>
                    <input type='hidden' name='userId' value='" . htmlspecialchars($row["id"]) . "'>
                    <button type='submit' class='lockBTN'>Lock</button>
                  </form>";
        } else {
            echo "<form action='../PHP/unlockuser.php' method='post' style='display:inline;'>
                    <input type='hidden' name='userId' value='" . htmlspecialchars($row["id"]) . "'>
                    <button type='submit' class='unlockBTN'>Unlock</button>
                  </form>";
        }
        echo "</td></tr>";
    }
    echo "</tbody>";
    echo "</table>";
} else {
    echo "<p>No records found.</p>";
}
echo "</div>";

$conn->close();
?>