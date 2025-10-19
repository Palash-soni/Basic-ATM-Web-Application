<?php
session_start();
$_SESSION['uid'] = '';

include("config.php");
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "atm";
// $conn = new mysqli($servername, $username, $password, $dbname);

$custName = "";
$cmnt = "";
$PIN = 0;

if (isset($_POST['create'])) {

    try {

        $custName = $_POST['username'];

        $PIN = $_POST['PIN'];
        $balance = $_POST['balance'];
        $_SESSION['Balance'] = $balance;

        $sql = "insert into customers (UserName,PIN,Balance) values ('$custName','$PIN','$balance');";
        $result = $conn->query($sql);

        $sql = "create table $custName (transaction_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,Description Text NOT NULL,closing_balance text);";
        $result = $conn->query($sql);

        $sql = "insert into $custName (Description,closing_balance) values ('Account Created','$balance');";
        $result = $conn->query($sql);

        header("location:index.php");


    } catch (Exception) {
        $cmnt = "User Name Already Exist";
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 20px;

        }

        .atm-container {
            background-color: #005f9e;
            border-radius: 20px;
            width: 100%;
            max-width: 500px;
            height: 700px;
            padding: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            position: relative;
            overflow: hidden;
            color: white;
        }

        .atm-header {
            text-align: center;
            padding: 10px 0;
            border-bottom: 2px solid rgba(255, 255, 255, 0.2);
            margin-bottom: 20px;
        }

        button,
        input[type="submit"] {
            background-color: #4a90e2;
            border: none;
            border-radius: 5px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover,
        input[type="submit"]:hover {
            background-color: #357ab8;
        }

        .input {
            text-align: center;
            border: none;
            padding: 1rem;
            font-size: 1.1rem;
            margin-left: 60px;
            width: 320px;
            /* padding-left: 150px; */
            /* margin-left: 10px; */
            border-radius: 1rem;
            background: #e8e8e8;
            box-shadow: 20px 20px 60px #c5c5c5,
                -20px -20px 60px #ffffff;
            transition: 0.3s;
        }

        .input:focus {
            outline-color: #4870f3;
            background: #e8e8e8;
            box-shadow: inset 20px 20px 60px #c5c5c5,
                inset -20px -20px 60px #ffffff;
            transition: 0.3s;
        }

        .label {
            /* padding-top: 100px; */
            padding-left: 50px;
            color: #357ab8;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 25px;
        }

        /* From Uiverse.io by TCdesign-dev */
        #bottone5 {
            align-items: center;
            background-color: #005f9e;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: .25rem;
            box-shadow: rgba(0, 0, 0, 0.02) 0 1px 3px 0;
            box-sizing: border-box;
            color: rgba(255, 255, 255, 0.85);
            cursor: pointer;
            display: inline-flex;
            font-family: system-ui, -apple-system, system-ui, "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 16px;
            font-weight: 600;
            justify-content: center;
            line-height: 1.25;
            min-height: 3rem;
            padding: calc(.875rem - 1px) calc(1.5rem - 1px);
            text-decoration: none;
            transition: all 250ms;
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
            vertical-align: baseline;
            width: 150px;
            margin-left: 150px;
            margin-top: 40px;
            height: 60px;
            text-wrap: wrap;
        }


        #bottone5:hover,
        #bottone5:focus {
            border-color: rgba(0, 0, 0, 0.15);
            box-shadow: rgba(0, 0, 0, 0.1) 0 4px 12px;
            color: rgba(255, 255, 255, 0.65);
        }

        #bottone5:hover {
            transform: translateY(-1px);
        }

        #bottone5:active {
            background-color: #F0F0F1;
            border-color: rgba(0, 0, 0, 0.15);
            box-shadow: rgba(0, 0, 0, 0.06) 0 2px 4px;
            color: rgba(0, 0, 0, 0.65);
            transform: translateY(0);
        }

        a {
            /* margin-top: 300px; */
            margin-left: 100px;
        }


        .atm-screen {
            background-color: #e1f5fe;
            height: 480px;
            padding-top: 40px;
            border-radius: 10px;
            padding: 15px;
            margin-top: 70px;
            margin-bottom: 0px;
            overflow-y: auto;
            color: #333;
        }

        h3 {
            margin-top: 20px;
            text-align: center;
            color: #7b2303ff;
            font-size: 2rem;
            animation: blink infinite 2s ease-in-out;
        }

        @keyframes blink {
            0% {
                opacity: 0;
            }

            50% {
                opacity: 1;
            }

            100% {
                opacity: 0;
            }
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
</head>

<body>
    <div class="atm-container">
        <div class="atm-header">
            <h2>Create New User</h2>
        </div>
        <div class="atm-screen">
            <form method="post" autocomplete="off">
                <label for="username" class="label">UserName:</label><br><br>
                <input type="text" name="username" class="input" id="user" required>
                <br>
                <br>

                <label for="pin" class="label">Set Your PIN:</label><br><br>
                <input type="number" name="PIN" class="input" id="pin" required>
                <br>
                <br>
                <label for="Deposit" class="label">Deposit:</label><br><br>
                <input type="number" name="balance" class="input" id="deposit" required>


                <input type="submit" name="create" id="bottone5" value="Submit">
            </form>
            <?php echo "<br><div class='ab'><h3>" . $cmnt . "</h3></div>"; ?>
        </div>
    </div>

</body>

</html>