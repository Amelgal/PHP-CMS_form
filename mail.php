<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <?php
    var_dump($_POST);
    echo "Hello,". $_POST[full_name][first_n].' '. $_POST[full_name][middle_n].' '.$_POST[full_name][last_n];
    ?>
</body>
</html>


