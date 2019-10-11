<?php
// verification code (need to added in registration)
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


function semestercode()
    //semester code....dynamic semester name(current)

{
    $semestercode = "";
    $year = date("Y", time());
    $month = date("F", time());
    if ($month == "May" || $month == "June" || $month == "July" || $month == "August") {
        $semestercode = "summer" . $year;
        return $semestercode;
    } elseif ($month == "January" || $month == "February" || $month == "March" || $month == "April") {
        $semestercode = "spring" . $year;
        return $semestercode;
    } elseif ($month == "September" || $month == "October" || $month == "November" || $month == "December") {
        $semestercode = "fall" . $year;
        return $semestercode;

    }

}

function validate($data) {
    $data = trim($data); //space cancelation
    $data = stripcslashes($data); //remove special character
    $data = htmlspecialchars($data);  // html tag remover
    // $data = clean($data);

    return $data;
}

function clean($string) {  //remove (-) in string.......uses in form data
    $string = str_replace('', '-', $string); // Replaces all spaces with hyphens.
    preg_replace('/[^A-Za-z0-9\-]/', '', $string);

    return true; // Removes special chars.
}

function redirect_to($new_location) {
    header("Location: " . $new_location);
    exit;
}

function logedin() {
    if (isset($_SESSION['id'])) {
        return TRUE;
    }
}

?>