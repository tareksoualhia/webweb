<?PHP
class produitC
{   private $id;
    private $nom;
    private $prix;
    private $quantité;
    private $image;
    private $description;


    function __construct($nom,$prix,$quantité,$image,$description)
    {   $this->nom = $nom;
        $this->prix = $prix;
        $this->quantité=$quantité;
        $this->image = $image;
        $this->description = $description;

    }
    // getter
    function getiproduit_nom()
    {
        return $this->nom;
    }
    function getiproduit_quantité()
    {
      return $this->quantité;
    }
    function getiproduit_description()
    {
        return $this->description;
    }

    function getiproduit_prix()
    {
        return $this->prix;
    }

    function getiproduit_image()
    {
        return $this->image;
    }
    // setter
     function setiproduit_nom($nom)
    {
        return $this->nom= $nom;
    }
    function setiproduit_description($description)
    {
        return $this->description= $description;
    }
    function setiproduit_quantité($quantité)
    {
        return $this->quantité= $quantité;
    }
    function setiproduit_prix($prix)
    {
        return $this->prix= $prix;
    }
    function setiproduit_image($image)
    {
        return $this->image= $image;
    }
}
  ?>
