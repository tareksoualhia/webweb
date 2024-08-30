<?PHP
class formation
{   private $id;
    private $nom;
    private $description;
    private $date;
    private $prix;
    private $formateur;
    private $lien;
    private $image;

    


    function __construct($nom,$description,$date,$prix,$formateur,$lien,$image)
    {   $this->nom = $nom; 
        $this->description = $description;
		$this->date = $date;
        $this->prix = $prix;
        $this->formateur = $formateur;
        $this->lien = $lien;
        $this->image = $image;

    }
    // getter 
    function getiformation_nom()
    {
        return $this->nom;
    }
    function getiformation_description()
    {
        return $this->description;
    }
    function getiformation_date()
    {
        return $this->date;
    }
    function getiformation_prix()
    {
        return $this->prix;
    }
    function getiformation_formateur()
    {
        return $this->formateur;
    }
    function getiformation_lien()
    {
        return $this->lien;
    }
    function getiformation_image()
    {
        return $this->image;
    }
    // setter 
     function setiformation_nom($nom)
    {
        return $this->nom= $nom;
    }
    function setiformation_description($description)
    {
        return $this->description= $description;
    }
    function setiformation_date($date)
    {
        return $this->date= $date;
    }
    function setiformation_prix($prix)
    {
        return $this->prix= $prix;
    }
    function setiformation_formateur($formateur)
    {
        return $this->formateur= $formateur;
    }
    function setiformation_lien($lien)
    {
        return $this->lien= $lien;
    }
    function setiformation_image($image)
    {
        return $this->image= $image;
    }
}
  ?>
