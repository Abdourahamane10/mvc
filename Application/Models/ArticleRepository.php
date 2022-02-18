<?php

namespace Application\Models;

require_once("Repository.php");

class ArticleRepository extends Repository
{
  function create()
  {
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

  function update()
  {
  }

  function delete()
  {
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
