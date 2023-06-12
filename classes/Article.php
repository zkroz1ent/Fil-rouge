<?php
class article {

private $nom ;
private $description ;
private $prix;
private $quantite;


public function __construct($nom, $description,$prix){
  
  $this->nom = $nom;
  $this->description = $description;
  $this->prix = $prix;
}

public function get_Id(){
  return $this->id;
}


public function getNom(){
  return $this->nom;
}

public function setNom($nom){
  $this->nom = $nom;
}

public function getDescription(){
  return $this->description;
}
public function setDescription($description){
  $this->description = $description;
}

public function getPrix(){
  return $this->prix;
}
public function setPrix($prix){
  $this->prix = $prix;
}

public function getQuantite(){
  return $this->quantite;
}
public function setQuantite($quantite){
  $this->quantite = $quantite;
}


public function fill(array $tableau)
{
    foreach ($tableau as $cle => $valeur) {
        $methode = 'set_' . $cle;
        if (method_exists($this, $methode)) {
            $this->$methode($valeur);
        }
    }
}

/**
 * Retourne un tableau du contenu de l'objet
 *
 * @return array
 */
public function dump()
{
    return get_object_vars($this);
}

/**
 * Affiche la liste des propriétés de l'objet courant
 *
 * @return string les propriétés sous la forme d'une liste à puce HTML
 */
public function afficher()
{
    $tableau = $this->dump();
    $html = '<ul>';
    foreach ($tableau as $cle=>$valeur) {
        $html .= '<li>' . $cle . ' = '.$valeur. '</li>';
    }
    $html .= '</ul>';
    return $html;
}


}
