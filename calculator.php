<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Calculator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 50px;
        }
        form {
            display: inline-block;
            text-align: left;
        }
        input, select {
            padding: 10px;
            margin: 5px;
            width: 100%;
        }
        button {
            padding: 10px;
            width: 100%;
            background-color:rgb(19, 10, 99);
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: rgb(19, 10, 99);
        }
        .result {
            margin-top: 20px;
            font-size: 20px;
            color: #333;
        }
    </style>
</head>
<body>
    <h1 style="color:blue">PHP Simple Calculator:-</h1>
    <form method="POST">
        <label for="number1">Enter First Number:</label>
        <input type="number" id="number1" name="number1" required>

        <label for="number2">Enter Second Number:</label>
        <input type="number" id="number2" name="number2" required>

        <label for="operation">Select Operation:</label>
        <select id="operation" name="operation" required>
            <option value="add">Addition (+)</option>
            <option value="subtract">Subtraction (-)</option>
            <option value="multiply">Multiplication (×)</option>
            <option value="divide">Division (÷)</option>
        </select>

        <button type="submit">Calculate</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $number1 = $_POST["number1"];
        $number2 = $_POST["number2"];
        $operation = $_POST["operation"];
        $result = "";

        // Perform the calculation based on the selected operation
        switch ($operation) {
            case "add":
                $result = $number1 + $number2;
                break;
            case "subtract":
                $result = $number1 - $number2;
                break;
            case "multiply":
                $result = $number1 * $number2;
                break;
            case "divide":
                if ($number2 != 0) {
                    $result = $number1 / $number2;
                } else {
                    $result = "Error: Division by zero is not allowed!";
                }
                break;
            default:
                $result = "Invalid Operation!";
        }

        // Display the result
        echo "<div class='result'>Result: <strong>$result</strong></div>";
    }
    ?>
</body>
</html>
