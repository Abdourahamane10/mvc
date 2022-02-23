<?php

namespace Application\Controllers;

use Application\Models\ArticleRepository;
use Application\Models\Post;

class Articles
{
    public $view;

    function __construct()
    {
        $this->view = new \Application\Views\View();
    }

    //Ajouter un article à la base de données
    function ajouter()
    {
        if (!(isset($_POST["title"])) || !(isset($_POST["content"])) || !(isset($_POST["title"])) || !(isset($_POST["type"])) || !(isset($_POST["category"]))) {
            //On donne le nom de la vue que l'on va appler (on appelle la formulaire)
            $this->view->setVar("view", 'frontend/articlesView');
        } else {
            $content = filter_var($_POST["content"], FILTER_SANITIZE_STRING);
            $title = filter_var($_POST["title"], FILTER_VALIDATE_EMAIL);
            $name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
            $type = filter_var($_POST["type"], FILTER_SANITIZE_STRING);
            $category = filter_var($_POST["category"], FILTER_SANITIZE_STRING);

            $article_repository = new \Application\Models\ArticleRepository(); //On instancie un repository
            $article_repository->create(); //On ajoute un article dans la base de données

            //On donne le nom de la vue que l'on va appeler
            $this->view->setVar("view", 'frontend/article-accueil');

            //on appelle la template, qui va utiliser la view que l'on a choisie
            echo $this->view->render();
        }
    }

    //Editer un article
    function editer()
    {
        /*C'est moi qui l'ai completé (au départ vide)
        */
        if (!(isset($_POST["content"])) || !(isset($_POST["name"]))) {
            //On donne le nom de la vue que l'on va appler (on appelle la formulaire)
            $this->view->setVar("view", 'frontend/articlesView');
        } else {
            $content = filter_var($_POST["content"], FILTER_SANITIZE_STRING);
            $name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);

            $article_repository = new \Application\Models\ArticleRepository(); //On instancie un repository
            $article_repository->update($name); //On édite l'article de nom $name dans la base de données

            //On donne le nom de la vue que l'on va appeler
            $this->view->setVar("view", 'frontend/article-accueil');

            //on appelle la template, qui va utiliser la view que l'on a choisie
            echo $this->view->render();
        }
    }

    //Supprime un article de la base de données
    function supprimer()
    {
        if (!(isset($_POST["name"]))) {
            //On donne le nom de la vue que l'on va appler (on appelle la formulaire)
            $this->view->setVar("view", 'frontend/articlesView');
        } else {
            $name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
            $article_repository = new \Application\Models\ArticleRepository(); //On instancie un repository
            $article_repository->delete($name); //On supprime l'article de nom $name de la base de données
        }
    }
}
