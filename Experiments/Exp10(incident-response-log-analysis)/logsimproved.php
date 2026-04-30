<?php 
session_start();

$conn = new mysqli("127.0.0.1","root","","test");

if ($conn->connect_error) {
    die("connection failed:" . mysqli_connect_error());
}

$msg = "";

/* 🔹 BLOCK CONFIG */
$max_attempts = 3;
$block_time = 60; // seconds

/* 🔹 INIT SESSION */
if (!isset($_SESSION['attempts'])) {
    $_SESSION['attempts'] = 0;
}

if (!isset($_SESSION['last_attempt'])) {
    $_SESSION['last_attempt'] = time();
}

/* 🔹 LOG FUNCTION */
function writeLog($message) {
    $logFile = __DIR__ . "/logs/login.log";
    $time = date("Y-m-d H:i:s");
    $ip = $_SERVER['REMOTE_ADDR'];

    $entry = "[$time] [IP: $ip] $message\n";
    file_put_contents($logFile, $entry, FILE_APPEND);
}

/* 🔴 BLOCK CHECK */
if ($_SESSION['attempts'] >= $max_attempts) {
    if (time() - $_SESSION['last_attempt'] < $block_time) {
        $msg = "<p class='message error'>Too many attempts. Try again after 1 minute.</p>";
        writeLog("BLOCKED attempt");
    } else {
        $_SESSION['attempts'] = 0; // reset after cooldown
    }
}

if(isset($_POST['login']) && $_SESSION['attempts'] < $max_attempts) {

    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $stmt = mysqli_prepare($conn,"SELECT * FROM login WHERE username = ? AND password = ?");

    mysqli_stmt_bind_param($stmt, "ss" , $username , $password);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($result)>0) {

        $_SESSION['attempts'] = 0; // reset on success
        writeLog("SUCCESS login for user: $username");

        $msg = "<p class='message success'>Login Successful</p>";
    }
    else {

        $_SESSION['attempts'] += 1;
        $_SESSION['last_attempt'] = time();

        writeLog("FAILED login for user: $username");

        $remaining = $max_attempts - $_SESSION['attempts'];

        if ($remaining > 0) {
            $msg = "<p class='message error'>Login Failed. Attempts left: $remaining</p>";
        } else {
            $msg = "<p class='message error'>Too many attempts. You are blocked for 1 minute.</p>";
        }
    }
} 
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>

<style>
* {
    box-sizing: border-box;
}

body {
    font-family: Arial;
    background: #eef2f7;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container {
    background: white;
    padding: 25px;
    width: 320px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

h2 {
    text-align: center;
    margin-bottom: 15px;
}

input {
    width: 100%;
    padding: 10px;
    margin: 8px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
}

button {
    width: 100%;
    padding: 10px;
    background: #2d89ef;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    margin-top: 5px;
}

button:hover {
    background: #1c6ed5;
}

.message {
    text-align: center;
    font-weight: bold;
    margin-bottom: 10px;
}

.success { color: green; }
.error { color: red; }

</style>

</head>

<body>

<div class="container">
    <h2>Login</h2>

    <?php echo $msg; ?>

    <form method="POST">
        <input type="text" name="username" placeholder="Enter Username" required>
        <input type="password" name="password" placeholder="Enter Password" required>
        <button type="submit" name="login">Login</button>
    </form>
</div>

</body>
</html>