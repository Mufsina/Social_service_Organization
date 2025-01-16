<?php
require('connect.php');    // ডাটাবেস সংযোগ ফাইল
require('config_db.php');  // ফাংশনগুলির জন্য কনফিগ ফাইল

// সেশন শুরু করা
session_start();

// চেক করা যদি সেশন অনুযায়ী admin লগিন হয়ে থাকে
if (isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] === true) {
    header('Location: dashboard.php');
    exit;
}

// লগিন প্রক্রিয়া
if (isset($_POST['login'])) {
    // ফর্ম ডেটা ফিল্টার করা
    $frm_data = filteration($_POST);  // ফিল্টারেশন ফাংশন ব্যবহার করা
    
    // ইউজার নাম এবং পাসওয়ার্ড চেক করা ডাটাবেসে
    $query = "SELECT * FROM `admin_c` WHERE `admin_name` = ? AND `admin_pass` = ?";
    $values = [$frm_data['admin_name'], $frm_data['admin_pass']];
    
    // SELECT কুয়েরি চালানো
    $res = select($query, $values, "ss");
    
    // রেজাল্ট চেক করা
    if ($res->num_rows == 1) {
        $row = mysqli_fetch_assoc($res);
        $_SESSION['adminLogin'] = true;
        $_SESSION['adminId'] = $row['sr_no'];
        header('Location: dashboard.php'); // ড্যাশবোর্ডে রিডাইরেক্ট
        exit;
    } else {
        // লগিন ব্যর্থ হলে
        alert('danger', 'Login failed - Invalid User!');
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        /* Background */
        body {
            background-size: cover;
            background-position: center;
            font-family: 'Arial', sans-serif;
        }

        .login-form {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
            background-color: rgba(255, 255, 255, 0.8);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            border-radius: 10px;
            animation: slideIn 0.5s ease-in-out;
        }

        .login-form h4 {
            background-color: #4CAF50;
            color: #fff;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 30px;
            font-size: 1.5rem;
            text-align: center;
        }

        .login-form input {
            border-radius: 5px;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
            margin-bottom: 20px;
            padding: 10px;
            width: 100%;
            font-size: 1rem;
            outline: none;
            transition: all 0.3s ease;
        }

        .login-form input:focus {
            border: 2px solid #4CAF50;
            transform: translateY(-5px);
        }

        .login-form button {
            width: 100%;
            background: linear-gradient(135deg, #4CAF50, #45a049);
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background 0.3s ease;
        }

        .login-form button:hover {
            background: linear-gradient(135deg, #45a049, #4CAF50);
        }

        @keyframes slideIn {
            0% {
                transform: translate(-50%, -60%);
                opacity: 0;
            }
            100% {
                transform: translate(-50%, -50%);
                opacity: 1;
            }
        }

        .alert {
            margin-top: 20px;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
        }

        .logo {
            display: block;
            margin: 0 auto 20px;
            width: 100px;
            height: auto;
        }
    </style>
</head>
<body>

    <div class="login-form">
        <!-- Logo -->
        <img src="lo.png" alt="Logo" class="logo"> <!-- Replace this with your logo URL -->
        
        <form method="POST">
            <h4>Admin Login</h4>
            <div>
                <input name="admin_name" required type="text" class="form-control shadow-none text-center" placeholder="Admin Name">
            </div>
            <div>
                <input name="admin_pass" required type="password" class="form-control shadow-none text-center" placeholder="Password">
            </div>
            <button name="login" type="submit">LOGIN</button>
        </form>
    </div>

    <!-- Alert Section -->
    <?php
    if (isset($_SESSION['alert'])) {
        echo '<div class="alert alert-' . $_SESSION['alert']['type'] . '">' . $_SESSION['alert']['message'] . '</div>';
        unset($_SESSION['alert']);  // alert after showing it
    }
    ?>

    <script src="script.js" defer></script>
</body>
</html>
