<!DOCTYPE html>
<html lang="en">
<head>
    <title>PHP Forms Handling</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

    <?php
    //define variables and set to empty values
    $nameErr = $emailErr = $websiteErr = $genderErr ="";
    $name = $email = $gender = $website ="";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
            $nameErr = "name is required";
        } else {
            $name = test_input($_POST["name"]);
            //check if name only consists of letters and whitespace
            if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
                $nameErr = "only letters and whitespace allowed";
            }
        }
        if (empty($_POST["email"])) {
            $emailErr = "email is required";
        } else {
            $email = test_input($_POST["email"]);
            //check if the email address is well formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "invalid email format";
            }
        }
        if (empty($_POST["website"])) {
            $websiteErr = "web link is required";
        } else {
            $website = test_input($_POST["website"]);
            //check if the web link is valid
            if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
                $websiteErr = "invalid web link";
            }
        }
        if (empty($_POST["comment"])) {
            $comment = "";
        } else {
            $comment = test_input($_POST["comment"]);
        }
    }
    ?>
    <center>
    <div class="header">
        <h2>Register</h2>
        </center>
    </div>
    <center>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
<h2>Name</h2>
<input type="text" name="name" value="<?php echo $name; ?>">
<span class="error">* <?php echo $nameErr; ?></span>
<br>
<h2>Email</h2>
<input type="text" name="email" value="<?php echo $name; ?>">
<span class="error">* <?php echo $emailErr; ?></span>
<br>
<h2>Website</h2>
<input type="text" name="website" value="<?php echo $website; ?>">
<span class="error">* <?php echo $websiteErr; ?></span>
<br>
<h2>Gender</h2>
<input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked"; ?> value="female"> Female
<input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked"; ?> value="male"> Male
<input type="radio" name="gender" <?php if (isset($gender) && $gender=="other") echo "checked"; ?> value="other"> Other
<br><br>
<input type="submit" name="submit" value="submit">
        </center>
</form>
</body>
</html>