<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Info</title>
</head>

<body class="m-auto text-center container-fluid mb-5 pb-5">
    <?php
    $requirement = (float) 8.0;
    if (phpversion() >= $requirement) {
        echo 'Current PHP version: ' . phpversion();
        header("Location: ./pages/views");
    } else {
        echo 'Current PHP version: ' . phpversion() . ', but ' . $requirement . ' or above is required <br>Please update your (Linux|XAMPP) server using composer<br><br>';
        echo "if you still wish to continue, click "; ?><button class="btn btn-success" type="button" onclick="location.href='./pages/views'">here</button>
    <?php
        echo phpinfo();
    }
    ?>
</body>

</html>