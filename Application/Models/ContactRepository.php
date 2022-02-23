<?php

namespace Application\Models;

require_once("Repository.php");

//C'est moi qui l'ai rajouté
require("Application\Controllers\Frontend.php");

class ContactRepository extends Repository
{
    //Crée un contact dans la base de données
    function create()
    {
        $this->db->prepare('INSERT INTO `contact`(`contact_name`, `contact_email`, `contact_message`, `contact_date`) VALUES(`$name`, `$email`, `$message`, `$date`)');
    }

    function read($name)
    {
        //--------------'SELECT date_article FROM mes_articles ORDER BY id DESC LIMIT 1'-----------------
        /* if ($name = null) {
            $statement = $this->db->prepare('SELECT * FROM posts WHERE post_type="article" AND post_date >= (SELECT post_date FROM posts WHERE post_type="article")'); //C'est moi qui a rajouté
        } else {
            $statement = $this->db->prepare('SELECT * FROM posts WHERE post_type="article" AND post_name="' . $name . '"');
        }
        try {

            $statement->execute();
        } catch (\PDOException $e) {
            echo "Statement failed: " . $e->getMessage();
            return false;
        }

        return $statement->fetch();*/
    }

    function update()
    {
    }

    function delete()
    {
    }

    function all($categories = array())
    {
        /*$statement = $this->db->prepare('SELECT * FROM posts WHERE post_type="article"');
        if ($categories != null) {
            $statement = $statement . 'AND post_category="' . $categories . '"';
        }

        try {

            $statement->execute();
        } catch (\PDOException $e) {
            echo "Statement failed: " . $e->getMessage();
            return false;
        }

        return $statement->fetchAll();*/
    }
}
