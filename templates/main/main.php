<?php
// шаблон для главной странички
include rootPath() . '/templates/header.php'; ?>

<table class="layout">
    <tr>
        <td>
            <?php foreach ($articles as $article): ?>
                <h2><?= $article['title'] ?></h2>
                <p><?= $article['text'] ?></p>
                <hr>
            <?php endforeach;?>
        </td>

        <td width="300px" class="sidebar">
            <div class="sidebarHeader">Меню</div>
            <ul>
                <li><a href="/">Главная страница</a></li>
            </ul>
        </td>
    </tr>

</table>

<?php include rootPath() . '/templates/footer.php'; ?>
