<?php include __DIR__ . '/../header.php'; ?>

    <div class="div">
        <?php
        if($sent):?>
        <p>Successfully</p>
        <p>You have registered <?= $sentUser['name']; ?></p>
            <?php
                echo "Message has been sent successfully";
            endif;
            ?>

    </div>

<?php include __DIR__ . '/../footer.php'; ?>
