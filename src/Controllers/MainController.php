<?php

//На данный момент этот класс выступает в качестве заглушки, с возможностью дальнейшего улучшения main.php

namespace Controllers;

use View\View;


class MainController
{
    private $view;



    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../templates');
    }
    public function main()
    {

        $this->view->renderHtml('main/main.php', []);

    }

}
