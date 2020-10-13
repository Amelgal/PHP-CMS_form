

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<?php
$flowers =
    array( array("розы", 100 , 15),
    array("тюльпаны", 60 , 25),
    array("орхидеи", 180 , 7)
);

foreach ($flowers as $key => $value){
    //var_dump($flowers[$key][0]);

    ?>
    <form action="test_index.php">

        <?php //if( == 'розы'):?>
        <input type="text" value="<?= $flowers[$key][0] ?>">
        <?php //endif; ?>

    </form>

<?php

}


?>

</body>
</html>
