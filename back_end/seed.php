<?php
include 'connection.php';

$userArr = [
    ['name' => 'John', 'age' => 18],
    ['name' => 'Bob', 'age' => 26],
    ['name' => 'Alan', 'age' => 32],
    ['name' => 'Doe', 'age' => 58],
    ['name' => 'Dean', 'age' => 66],
    ['name' => 'Rick', 'age' => 45],
    ['name' => 'Daniel', 'age' => 2],
];

$stmt = $conn->prepare("INSERT INTO users (name, age) VALUES (?, ?)");

if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("si", $name, $age);

foreach ($userArr as $data) {
    $name = $data['name'];
    $age = $data['age'];
    if (!$stmt->execute()) {
        echo "Execute failed: " . $stmt->error;
    }}

echo "Test data inserted successfully!";

$stmt->close();
$conn->close();