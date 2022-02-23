<?php

namespace Application\Models;

require_once("Repository.php");

//C'est moi qui l'ai rajouté
require_once("Application\Controllers\Articles.php");

class ArticleRepository extends Repository
{
  function create()
  {
    /*C'est moi qui l'ai completée (au départ vide)
    */
    $date = date('m-d-Y h:i:s a', time());
    $this->db->prepare('INSERT INTO `posts`(`posts_date`, `posts_content`, `posts_title`, `posts_status`, `post_name`, `posts_type`, `posts_category`) VALUES(`$date`, `$content`, `$title`, `publish`, `$name`, `$type`, `$category`)');
  }

  function read($name)
  {
    //C'est moi qui a rajouté
    //--------------'SELECT date_article FROM mes_articles ORDER BY id DESC LIMIT 1'-----------------
    if ($name = null) {
      $statement = $this->db->prepare('SELECT * FROM posts WHERE post_type="article" AND post_date >= (SELECT post_date FROM posts WHERE post_type="article")');
    } else {
      $statement = $this->db->prepare('SELECT * FROM posts WHERE post_type="article" AND post_name="' . $name . '"');
    }
    try {

      $statement->execute();
    } catch (\PDOException $e) {
      echo "Statement failed: " . $e->getMessage();
      return false;
    }

    return $statement->fetch();
  }

  function update($name)
  {
    /*C'est moi qui l'ai completé (au départ vide)
    */
    $this->db->prepare('UPDATE `posts` SET `post_content`=`$content` WHERE post_name="' . $name . '#');
  }

  function delete($name)
  {
    /*C'est moi qui l'ai completé (au depart vide)
    */
    $this->db->prepare('DELETE FROM `posts` WHERE posts_type="article" AND posts_name="' . $name . '"');
  }
  //C'est moi qui l'a completé (Au depart vide)
  //$categories = array()
  function all($categories = array())
  {
    $statement = $this->db->prepare('SELECT * FROM posts WHERE post_type="article"');
    if ($categories != null) {
      $statement = $statement . 'AND post_category="' . $categories . '"';
    }

    try {

      $statement->execute();
    } catch (\PDOException $e) {
      echo "Statement failed: " . $e->getMessage();
      return false;
    }

    return $statement->fetchAll();
  }

  //C'est moi qui l'ai crée
  //Fonction pour récupérer les articles de la catégorie $category
  /*function read_category($category)
  {
    $statement = $this->db->prepare('SELECT * FROM posts WHERE post_type="article" AND post_category="' . $category . '"');

    try {

      $statement->execute();
    } catch (\PDOException $e) {
      echo "Statement failed: " . $e->getMessage();
      return false;
    }

    return $statement->fetch();
  }*/
}
