<?php

namespace Models\Articles;
error_reporting(0);

use Exceptions\InvalidArgumentException;
use Models\ArticleModel;

class Articles
{


    /** @var string */
    private $title;

    /** @var string */
    private $text;

    /** @var int */
    private $user_id;

    /** @var array */
    private $articlData;

    private $request;



    public function __construct()
    {
        $this->request = new ArticleModel();
//        $this->articlData = $this->request->selectArticles();
//        $this->title = $this->articlData['title'];
//        $this->text = $this->articlData['text'];

        //var_dump($this->articlData);
        //return $this->validateConfirmed;
    }
    public function showArticle()
    {
        $this->articlData = $this->request->selectArticles();
//        $this->title = $this->articlData['title'];
//        $this->text = $this->articlData['text'];

        //var_dump($this->articlData);
        return $this->articlData;
    }


}