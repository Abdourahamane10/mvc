<?php

namespace Application\Controllers;

use Application\Models\ArticleRepository;

//C'est moi qui l'ai ajouté
use Application\Models\ContactRepository;

class Frontend
{

    public $view;

    function __construct()
    {
        $this->view = new \Application\Views\View();
    }

    /**
     * Affiche la page d'accueil
     */
    function index()
    {
        //Exemple de récupération d'une page en base de données
        $page_repository = new \Application\Models\PageRepository(); //on instancie un repository
        $donnees_page_accueil = $page_repository->read('accueil'); //on récupère les données depuis la base de données

        $page_accueil = new \Application\Models\Page($donnees_page_accueil); //on instancie un objet page (Un modèle) avec les données récupérées par le repository

        //On passe notre objet à la vue. Dans la fichier de la vue, on pourra utiliser la variable $page
        $this->view->setVar('page', $page_accueil);


        //Autre exemple pour passer des données à la View
        /***********************************************/
        //À compléter
        //On doit récupérer les articles depuis la base de données et les initialiser
        //puis les passer à la view

        $article_repository = new \Application\Models\ArticleRepository(); //on instancie un repository
        $donnees_articles = $article_repository->all(); //on récupère les données depuis la base de données

        $articles = [];
        foreach ($donnees_articles as $donnees_dun_article) {
            $articles[] = new \Application\Models\Article($donnees_dun_article);
            //print_r($donnees_dun_article);
        }

        //On passe notre objet à la vue. Dans la fichier de la vue, on pourra utiliser la variable $articles
        $this->view->setVar('articles', $articles); //Dans ma vue ça sera disponible dans this->data['articles']



        /***********************************************/
        //$posts = ['un article', 'un autre article']; //ceci devrait être remplacer par des articles récupérés depuis la base de données
        //$this->view->setVar('posts', $posts);

        //On donne le nom de la vue que l'on veut appeler
        $this->view->setVar('view', 'frontend/accueil');


        //on appelle la template, qui va utiliser la view que l'on a choisie
        //La fonction render utilise template.php par défaut, mais on peut lui spécifier une autre template en paramètre
        echo $this->view->render();
    }

    /**
     * Affiche une page
     * @param String $name: l'url de la page (colonne)
     */
    function page($name = "accueil")
    {
        if (isset($_GET['name']) and $_GET['name'] != "") $name = $_GET['name'];

        $page = new \Application\Models\Page([]);

        $this->view->setVar('page', $page);
        $this->view->setVar('view', 'frontend/' . $name);

        //on appelle la template, qui va utiliser la view que l'on a choisie
        echo $this->view->render();
    }

    /**
     * Affiche la page des articles
     * @param String $category : Permet de trier les articles par catégorie
     */
    function articles($category = null)
    {

        /***********************************************/
        //À compléter
        //On doit récupérer les articles depuis la base de données et les initialiser
        //puis les passer à une view
        /***********************************************/

        $category = isset($_GET[$category]) ? $_GET[$category] : null;
        $article_repository = new \Application\Models\ArticleRepository(); //On instancie un repository
        $donnees_articles = $article_repository->all($category); //On récupère les données des articles de categorie $category depuis la base de données
        $articles = [];
        foreach ($donnees_articles as $donnees_dun_article) {
            $articles[] = new \Application\Models\Article($donnees_dun_article);
        }

        //On passe notre objet à la vue.
        $this->view->setVar('articles', $articles);
        //On donne le nom de la vue que l'on va appeller
        $this->view->setVar("view", 'frontend/accueil');

        /*if (isset($_GET[$category])) {
            if ($_GET[$category] == null) {
                $article_repository = new \Application\Models\ArticleRepository(); //on instancie un repository
                $donnees_articles = $article_repository->all(); //on récupère les données depuis la base de données

                $articles = [];
                foreach ($donnees_articles as $donnees_dun_article) {
                    $articles[] = new \Application\Models\Article($donnees_dun_article);
                    //print_r($donnees_dun_article);
                }

                //On passe notre objet à la vue. Dans le fichier de la vue, on pourra utiliser la variable $articles
                $this->view->setVar('articles', $articles); //Dans ma vue ça sera disponible dans this->data['articles']
                //On donne le nom de la vue que l'on veut appeler
                $this->view->setVar("view", 'frontend/accueil');
                //On appelle la template qui va utiliser la vue que l'on a choisie
                $this->view->render();
            } else {
                $article_repository = new \Application\Models\articleRepository(); //On instancie un repository
                $donnees_dun_article = $article_repository->read_category($category); //On récupère les données depuis la base des données
                $article = new \Application\Models\Article($donnees_dun_article);
                //On passe notre objet à la vue.
                $this->view->setVar('article', $article);
                //On donne le nom de la vue que l'on va appeller
                $this->view->setVar("view", 'frontend/article-accueil');
            }
        }*/

        //on appelle la template, qui va utiliser la view que l'on a choisie
        echo $this->view->render();
    }

    /**
     * Affiche la page d'un article
     * @param String $name : Le nom de l'article à afficher
     */
    function article($name = null)
    {

        /***********************************************/
        //À compléter
        //On doit récupérer l'article depuis la base de données puis l'initialiser
        //puis le passer à une view
        /***********************************************/

        $name = isset($_GET[$name]) ? $_GET[$name] : null;
        $article_repository = new \Application\Models\ArticleRepository(); //On instancie un repository
        $donnees_article = $article_repository->read($name); //On récupère les données de l'article de nom $name depuis la base de données
        $article = new \Application\Models\Article($donnees_article);

        //On passe notre objet à la vue
        $this->view->setVar('article', $article);

        //On donne le nom de la vue que l'on va appeller
        $this->view->setVar("view", 'fronted/accueil');

        //on appelle la template, qui va utiliser la view que l'on a choisie
        echo $this->view->render();
    }

    /**
     * Affiche et traite le formulaire de contact
     */
    function contact()
    {

        /***********************************************/
        //À compléter
        //On doit appeler le formulaire s'il n'y a pas de $_POST
        //S'il y a du $_POST, on doit le vérifier, l'enregistrer en base de données puis afficher un message
        /***********************************************/
        if (!(isset($_POST["lname"])) || !(isset($_POST["email"])) || !(isset($_POST["message"])) || !(isset($_POST["date"]))) {
            //On donne le nom de la vue que l'on va appler (on appelle la formulaire)
            $this->view->setVar("view", 'frontend/contactView');
        } else {
            $name = filter_var($_POST["lname"], FILTER_SANITIZE_STRING);
            $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
            $message = filter_var($_POST["message"], FILTER_SANITIZE_STRING);
            $date = filter_var($_POST["date"], FILTER_SANITIZE_STRING);

            $contact_repository = new \Application\Models\ContactRepository(); //On instancie un repository
            $contact_repository->create(); //On enregistre un contact dans la base de données

            //On donne le nom de la vue que l'on va appeler
            $this->view->setVar("view", 'frontend/contact-accueil');
        }



        //on appelle la template, qui va utiliser la view que l'on a choisie
        echo $this->view->render();
    }

    /**
     * Traite le formulaire de newsletter
     */
    function newsletter()
    {

        /***********************************************/
        if (!(isset($_POST["newsletter_email"]))) {
            $this->view->setVar("view", 'frontend/newsletterView');
        } else {
            $email = var_dump($_POST["newsletter_email"], FILTER_VALIDATE_EMAIL);

            $newsletter_repository = new \Application\Models\NewsletterRepository(); //On instancie un repository
            $newsletter_repository->create();

            //On donne le nom de la vue que l'on va appler
            $this->view->setVar("view", 'frontend/newsletter-accueil');
        }

        /***********************************************/

        //on appelle la template, qui va utiliser la view que l'on a choisie
        echo $this->view->render();
    }
}
