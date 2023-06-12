<?php
/**
* Classe DAO ArticleDAO
*
* @author jef
*/

class ArticleDAO extends DAO {
  
  /**
  * Constructeur
  */
  function __construct() {
    parent::__construct();
  }
  
  /**
  * Lecture d'un article par son ID
  * @param int ID du article
  * @return \Article
  * @throws Exception
  */
    function find($id) {
    $sql = "select * from Articles where id= :id";
    try {
      $params = array(":id" => $id);
      $sth=$this->executer($sql,$params); 
      $row = $sth->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      die("Erreur lors de la requête SQL : " . $e->getMessage());
    }
    $Article=null;
    if($row) {
      $Article = new Article($row);
    }
       // Retourne l'objet métier
    return $Article;
  } // function find()
  

  function findAll() {
    $sql = "select * from Articles";
    try {
      $sth=$this->executer($sql); 
      $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      die("Erreur lors de la requête SQL : " . $e->getMessage());
    }
    $articles = array();
    foreach ($rows as $row) {
      $Articles[] = new Article($row);
    }
    // Retourne un tableau d'objets "article"
    return $Articles;
  } // function findAll()
  
  /**
  * Lecture de tous les articles d'un ID région
  * @param int $id_article
  * @return \Article
  * @throws Exception
  */
  function findAllByIdarticle($id_article) {
    $sql = "select * from Articles where id_article = :id_article";
    try {
      $params = array(":id_article" => $id_article);
      $sth=$this->executer($sql,$params);
      $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      die("Erreur lors de la requête SQL : " . $e->getMessage());
    }
    $Articles = array();
    foreach ($rows as $row) {
      $Articles[] = new Article($row);
    }
    // Retourne un tableau d'objets
    return $Articles;
  } //findAllByIdarticle()


  /**
  * Modification d'un article
  * @param \Article
  * @return int Nombre de mises à jour
  * @throws Exception
  */
  /*
  function updateIdarticle(Article $Article) {
    $sql = "update Articles set id_article=:id_article where id=:id";
    $params = array(
      ":id" => $Article->get_Id(),
    


    );
    $sth = $this->executer($sql, $params); // On passe par la méthode de la classe mère
    $nb = $sth->rowcount();
    return $nb;  // Retourne le nombre de mise à jour
  } // update()
*/
} // Class ArticleDAO