<?php
$hname = 'localhost';        // হোস্টনেম
$uname = 'root';             // ইউজারনেম
$pass = '';                  // পাসওয়ার্ড
$db = 'social_service_organization';  // ডাটাবেস নাম

// ডাটাবেস সংযোগ তৈরি করা
$con = mysqli_connect($hname, $uname, $pass, $db);

// সংযোগ চেক করা
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

/**
 * Function to filter and sanitize data
 * 
 * @param array $data
 * @return array
 */
function filteration($data) {
    foreach ($data as $key => $value) {
        // বিভিন্ন স্যানিটাইজেশন
        $data[$key] = trim($value);
        $data[$key] = stripslashes($value);
        $data[$key] = htmlspecialchars($value);
        $data[$key] = strip_tags($value);
    }
    return $data;
}

/**
 * Function to execute a SELECT query with prepared statements
 * 
 * @param string $sql
 * @param array $values
 * @param string $datatypes
 * @return mysqli_result|false
 */
function select($sql, $values, $datatypes) {
    global $con;  

    if ($stmt = mysqli_prepare($con, $sql)) {
        
        mysqli_stmt_bind_param($stmt, $datatypes, ...$values);

        
        if (mysqli_stmt_execute($stmt)) {
            $res = mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        } else {
            mysqli_stmt_close($stmt);
            die("Query execution failed: " . mysqli_error($con));
        }
    } else {
        die("Query preparation failed: " . mysqli_error($con));
    }
}
?>
