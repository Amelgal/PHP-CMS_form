<?php
// шаблон сообщения, который отправляется на почту
?>
<!Doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
You filled out the form, here is your data.<br>
<hr/>
Hello, <?= $sentData['name'] ?><br>
Email: <?= $sentData['email'] ?><br>
Birth data: <?= $sentData['birth_date'] ?><br>
Gender: <?= $sentData['gender'] ?><br>
Your address: <?= $sentData['adress'] ?><br>
Course: <?= $sentData['cours'] ?><br>
Your comment: <?= $sentData['comment'] ?><br>
Also attached your files to the message<br>"

</body>
</html>
