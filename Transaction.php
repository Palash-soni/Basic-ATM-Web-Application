<?php

session_start();

include("config.php");
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "atm";
// $conn = new mysqli($servername, $username, $password, $dbname);
$i = 1;
$uid = $_SESSION['UserName'];
$sql = "SELECT transaction_time,Description,closing_balance FROM $uid";
$result = $conn->query($sql);

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ATM Machine</title>
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
      width: 400px;
      /* padding-left: 200px; */
      margin-left: 10px;
      margin-top: 30px;
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
      margin-top: 15px;
      padding-left: 60px;
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
      /* margin-left: 150px; */
      color: white;
      text-decoration: none;
    }


    .atm-screen {
      background-color: #e1f5fe;
      height: 450px;
      padding-top: 50px;
      border-radius: 10px;
      padding: 15px;
      margin-top: 70px;
      margin-bottom: 0px;
      overflow-y: auto;
      color: #333;
    }

    td,
    th {
      padding: 10px;
    }

    #bottone51 {
      align-items: center;
      background-color: #e1f5fe;
      border: 1px solid rgba(0, 0, 0, 0.1);
      border-radius: .25rem;
      box-shadow: rgba(0, 0, 0, 0.02) 0 1px 3px 0;
      box-sizing: border-box;
      color: #005f9e;
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
      width: 200px;
      margin-left: 135px;
      margin-top: 15px;
      height: 60px;
      text-wrap: wrap;
    }


    #bottone51:hover,
    #bottone51:focus {
      border-color: rgba(0, 0, 0, 0.15);
      box-shadow: rgba(0, 0, 0, 0.1) 0 4px 12px;

    }

    #bottone51:hover {
      transform: translateY(-1px);
    }

    #bottone51:active {
      background-color: #F0F0F1;
      border-color: rgba(0, 0, 0, 0.15);
      box-shadow: rgba(0, 0, 0, 0.06) 0 2px 4px;
      color: rgba(0, 0, 0, 0.65);
      transform: translateY(0);
    }
  </style>
</head>

<body>
  <div class="atm-container">
    <div class="atm-header">
      <h2>YOUR TRANSACTIONS</h2>
    </div>
    <div class="atm-screen">

      <table cellspacing="0" borderstyle="1" style="width: 100%;text-align:center;">
        <tr style='background-color:#8cbdd3ff; font-size: 1.1rem;'>
          <th style="width:33%;">Time of Transaction</th>
          <th style="width:40%;">Description</th>
          <th style="width:30%;">Closing Balance</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
          // output data of each row
          while ($row = $result->fetch_assoc()) {
            if ($i % 2 == 0) {
              echo "<tr style='background-color:#8cbdd3ff;'><td>" . $row["transaction_time"] . "</td> <td>" . $row["Description"] . "</td><td> " . $row["closing_balance"] . "</td></tr>";
            } else {
              echo "<tr><td>" . $row["transaction_time"] . "</td> <td>" . $row["Description"] . "</td><td> " . $row["closing_balance"] . "</td></tr>";

            }
            $i++;
          }
        } else {
          echo "0 results";
        }

        ?>
      </table>

    </div>

    <a href="Home.php"><button id="bottone51">Home</button></a>

  </div>
</body>

</html>