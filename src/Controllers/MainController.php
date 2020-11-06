<?php

//На данный момент этот класс выступает в качестве заглушки, с возможностью дальнейшего улучшения main.php

namespace Controllers;

use Models\ArticleModel;
use Models\Articles\Articles;

class MainController extends AbstractController
{

    public function ActionMainPage()
    {
        $objArticles = new Articles();
        $articles = $objArticles ->showArticle();
        $this->view->renderHtml('main/main.php', ['articles' => $articles]);
    }

}
