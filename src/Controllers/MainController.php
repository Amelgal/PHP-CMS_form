<?php

//На данный момент этот класс выступает в качестве заглушки, с возможностью дальнейшего улучшения main.php

namespace Controllers;

class MainController extends AbstractController
{
    public function ActionMainPage()
    {
        $this->view->renderHtml('main/main.php', []);
    }

}
