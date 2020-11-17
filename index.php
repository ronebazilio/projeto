<!DOCTYPE HTML>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <title>Projeto</title>
  <style>
    .error {
      color: #FF0000;
    }
  </style>
</head>

<body>

  <?php
  // define variables and set to empty values
  $nameErr = $emailErr = $genderErr = $websiteErr = "";
  $name = $email = $gender = $comment = $website = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
      $nameErr = "Name is required";
    } else {
      $name = test_input($_POST["name"]);
      // check if name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
        $nameErr = "Only letters and white space allowed";
      }
    }

    if (empty($_POST["email"])) {
      $emailErr = "Email is required";
    } else {
      $email = test_input($_POST["email"]);
      // check if e-mail address is well-formed
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
      }
    }

    if (empty($_POST["website"])) {
      $website = "";
    } else {
      $website = test_input($_POST["website"]);
      // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
      if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $website)) {
        $websiteErr = "Invalid URL";
      }
    }

    if (empty($_POST["comment"])) {
      $comment = "";
    } else {
      $comment = test_input($_POST["comment"]);
    }

    if (empty($_POST["gender"])) {
      $genderErr = "Gender is required";
    } else {
      $gender = test_input($_POST["gender"]);
    }
  }

  function test_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  ?>
  <div class="container">
    <div class="row">
      <div class="col">
        <h2>PHP Form Validation Example</h2>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <p><span class="error">* required field</span></p>
      </div>
    </div>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <div class="form-group">
        <label for="name">Name:</label><span class="error">*</span>
        <input class="form-control" placeholder="Enter your name" type="text" name="name" value="<?php echo $name; ?>">
        <span class="error"><?php echo $nameErr; ?></span>
      </div>
      <div class="form-group">

        <label for="email">E-mail:</label><span class="error">*</span>
        <input type="text" class="form-control" placeholder="Enter your e-mail" name="email" value="<?php echo $email; ?>">
        <span class="error"><?php echo $emailErr; ?></span>
      </div>
      <div class="form-group">
        <label for="website">Website:</label><span class="error">*</span>
        <input type="text" class="form-control" placeholder="Enter your website" name="website" value="<?php echo $website; ?>">
        <span class="error"><?php echo $websiteErr; ?></span>
      </div>
      <div class="form-group">
        <label for="comment">Comment:</label>
        <textarea name="comment" class="form-control" placeholder="Enter your comment" rows="5" cols="40"><?php echo $comment; ?></textarea>
      </div>
      <div class="form-group">
        <label for="gender">Gender:</label><span class="error">*</span>

        <div class="form-check">
          <input type="radio" class="form-check-input" name="gender" <?php if (isset($gender) && $gender == "female") echo "checked"; ?> value="female">Female
        </div>
        <div class="form-check">
          <input type="radio" class="form-check-input" name="gender" <?php if (isset($gender) && $gender == "male") echo "checked"; ?> value="male">Male
        </div>
        <div class="form-check">
          <input type="radio" class="form-check-input" name="gender" <?php if (isset($gender) && $gender == "other") echo "checked"; ?> value="other">Other
        </div>
        <span class="error"><?php echo $genderErr; ?></span>
      </div>
      <input class="btn btn-primary" type="submit" name="submit" value="Submit">
    </form>
    <div class="row mt-2">
      <div class="col">
        <?php
        echo "<h2>Your Input:</h2>";
        echo $name;
        echo "<br>";
        echo $email;
        echo "<br>";
        echo $website;
        echo "<br>";
        echo $comment;
        echo "<br>";
        echo $gender;
        ?>
      </div>
    </div>


  </div>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>