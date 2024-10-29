<?php
include 'db.php';
$result = $conn->query("SELECT * FROM plans");

while ($plan = $result->fetch_assoc()) {
    echo "<div class='plan'>";
    echo "<h3>" . $plan['name'] . "</h3>";
    echo "<p>Price: " . $plan['price'] . " PKR</p>";
    echo "<a href='user/create_portfolio.php?plan_id=" . $plan['id'] . "'>Select</a>";
    echo "</div>";
}
?>
