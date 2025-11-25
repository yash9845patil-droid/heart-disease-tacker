<?php
require 'config.php';

// load dataset from DB
$stmt = $pdo->query("SELECT age, gender, bp, cholesterol, maxhr, heart_disease FROM dataset");
$dataset = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    // ensure numeric values
    $dataset[] = array_map(function($v){ return is_numeric($v)? (float)$v : $v; }, $row);
}

// then reuse the same functions: entropy(), chooseBestSplit(), buildTree()...
// finally save model.json as before
file_put_contents("model.json", json_encode($tree, JSON_PRETTY_PRINT));
echo "Model trained and saved to model.json\n";
