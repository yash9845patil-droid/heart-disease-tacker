<?php
require 'config.php'; // gives $pdo

// Load trained model
$model = json_decode(file_get_contents("model.json"), true);

// Get user input (sanitize)
$input = [
    "age" => isset($_POST['age']) ? (float)$_POST['age'] : 0,
    "gender" => isset($_POST['gender']) ? (int)$_POST['gender'] : 0,
    "bp" => isset($_POST['bp']) ? (float)$_POST['bp'] : 0,
    "cholesterol" => isset($_POST['cholesterol']) ? (float)$_POST['cholesterol'] : 0,
    "maxhr" => isset($_POST['maxhr']) ? (float)$_POST['maxhr'] : 0
];

function predict($node, $input) {
    if (isset($node["label"])) {
        return (int)$node["label"];
    }
    $attr = $node["attribute"];
    if ($input[$attr] <= $node["value"]) {
        return predict($node["left"], $input);
    } else {
        return predict($node["right"], $input);
    }
}

$pred_label = predict($model, $input);
$prediction_text = $pred_label === 1 ? "High chance of Heart Disease" : "Low chance of Heart Disease";

// Save to DB
$stmt = $pdo->prepare("INSERT INTO predictions (age, gender, bp, cholesterol, maxhr, predicted_label, prediction_text) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->execute([
    $input['age'],
    $input['gender'],
    $input['bp'],
    $input['cholesterol'],
    $input['maxhr'],
    $pred_label,
    $prediction_text
]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Prediction Result</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <h1>Prediction Result</h1>
    <nav>
      <a href="index.html">Home</a>
      <a href="about.html">About</a>
    </nav>
  </header>
  <main>
    <h2><?php echo htmlspecialchars($prediction_text); ?></h2>
    <p>Based on the values you entered: </p>
    <ul>
      <li>Age: <?php echo htmlspecialchars($input['age']); ?></li>
      <li>Gender: <?php echo $input['gender'] == 1 ? 'Male' : 'Female'; ?></li>
      <li>Blood Pressure: <?php echo htmlspecialchars($input['bp']); ?></li>
      <li>Cholesterol: <?php echo htmlspecialchars($input['cholesterol']); ?></li>
      <li>Max Heart Rate: <?php echo htmlspecialchars($input['maxhr']); ?></li>
    </ul>
  </main>
</body>
</html>
