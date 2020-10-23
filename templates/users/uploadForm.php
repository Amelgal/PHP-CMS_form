<?php

unset($_GET['route']);
setcookie("GET", serialize($_GET), 0, '/');

$cookiesGet = unserialize($_COOKIE['GET']);

if ($cookiesGet['get']!="1"): ?>
    <form method="GET" action="<?= $_SERVER[REDIRECT_URL]?>">
        <div class="c1">
            <p>You wish to continue filling out the registration form?</p>
        </div>
        <input type="submit" name="Save" value="Ok">
        <input type="submit" name="Close" value="Not Ok">
        <input type="hidden" name="get" value="1">
    </form>
<?php endif;?>
