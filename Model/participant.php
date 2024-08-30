<?PHP
class participant
{   private $id_participant;
    private $nom;
    private $email;
    private $tel;
    private $codep;
    private $id_formation;
    

    


    function __construct($nom,$email,$tel,$codep,$id_formation)
    {   $this->nom = $nom; 
        $this->email = $email;
		$this->tel = $tel;
        $this->codep = $codep;
        $this->id_formation = $id_formation;
    }
    // getter 
    function getiparticipant_nom()
    {
        return $this->nom;
    }
    function getiparticipant_email()
    {
        return $this->email;
    }
    function getiparticipant_tel()
    {
        return $this->tel;
    }
    function getiparticipant_codep()
    {
        return $this->codep;
    }
    function getiparticipant_id_formation()
    {
        return $this->id_formation;
    }
    // setter 
     function setiparticipant_nom($nom)
    {
        return $this->nom= $nom;
    }
    function setiparticipant_email($email)
    {
        return $this->email= $email;
    }
    function setiparticipant_tel($tel)
    {
        return $this->tel= $tel;
    }
    function setiparticipant_codep($codep)
    {
        return $this->codep= $codep;
    }
    function setiparticipant_id_formation($id_formation)
    {
        return $this->id_formation= $id_formation;
    }
}
  ?>
