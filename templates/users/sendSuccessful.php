<?php
// шаблон при успешной загрузке данных в БД
include __DIR__ . '/../header.php'; ?>

<div class="div">
    <?php
    if($sent):?>
        <p>Successfully</p>
        <p>You have registered <?= $nameUser; ?></p>
        <?php
        echo "Message has been sent successfully</br>";
        echo "Успешно переданых изображений ".$successfulImage."\n";
    endif;
    ?>

</div>

<?php include __DIR__ . '/../footer.php'; ?>
