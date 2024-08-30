<?PHP
include 'configg.php';
class produitC

{
	public function inscription($produit,$con)
	{
		 $sql = "INSERT INTO produit (produit_name,produit_categorie,description) values (:produit_name, :produit_categorie, :description)";
        try {
            $req = $con->prepare($sql);
            $req->bindValue(':produit_name', $produit->getproduit_name());
            $req->bindValue(':produit_categorie', $produit->getproduit_categorie());
			$req->bindValue(':description', $produit->getdescription());
            $req->execute();
        } catch (Exception $e) {
            echo 'erreur: ' . $e->getMessage();
        }
	}}


function get_all_products()
{
	$con=config::getConnexion();
    $sql = "SELECT * FROM `products`";
	try {
        $resultp = $con->query($sql);
		return $resultp;
    } catch (Exception $e) {
        echo "Error " . $e->getMessage();
        exit();
    }
}

function get_single_product()
{
		if(isset($_GET['detail'])){
		$id=$_GET['detail'];
		$con=config::getConnexion();
        $sql="SELECT * FROM `products` WHERE `id` ='$id'";
        try{
			$query=$con->prepare($sql);
			$query->execute();
		}catch (Exception $e){
			die('Erreur: '.$e->getMessage());
		}
		$m = $query->fetch();
		return $m;
	}
}


function deletepr ( )

{
	if(isset($_GET['delete'])){
        $id = $_GET['delete'];
		$con=config::getConnexion();
        $sql ="DELETE FROM `products` WHERE `products`.`id` = '$id' ";
        try{
			$query=$con->prepare($sql);
			$query->execute();
			header("Location:listeproduits.php");
		}catch (Exception $e){
			die('Erreur: '.$e->getMessage());
		}
        }
}

function update ()
{
	if(isset($_GET['update'])){
	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$con=config::getConnexion();
		$id=$_GET['update'];
        $nom = trim($_POST['nom']);
	    	$description = trim($_POST['description']);
        $quantité=(float)$_POST['quantité'];
        $prix= (float) $_POST['prix'];
	    	$image=trim($_POST['image']);
		if(!empty($nom) && !empty($quantité) && !empty($prix))
		{
			//save to database
            $sql= "UPDATE `products` SET `nom`='$nom',`prix`='$prix',`description`='$description',`quantité`='$quantité',`image`='$image' WHERE id='$id'";
			try{
				$query=$con->prepare($sql);
				$query->execute();
				header("Location:listeproduits.php");
			}catch (Exception $e){
				die('Erreur: '.$e->getMessage());
			}
		}
	}
}
}

function ajouter ()
{
	if(isset($_GET['add'])){
		if($_SERVER['REQUEST_METHOD'] == "POST")
		{
		//something was posted
		$con=config::getConnexion();
    $nom = trim($_POST['nom']);
    $description = trim($_POST['description']);
    $quantité=(float)$_POST['quantité'];
    $prix= (float) $_POST['prix'];
    $image=trim($_POST['image']);
		if(!empty($nom) && !empty($quantité) && !empty($prix))
		{
			//save to database
			$sql = "insert into products (nom,description,quantité,prix,image) values ('$nom','$description','$quantité','$prix','$image')";
			try{
				$query=$con->prepare($sql);
				$query->execute();
				header("Location:listeproduits.php");
			}catch (Exception $e){
				die('Erreur: '.$e->getMessage());
			}
		}
	}
}
}


////////////////////////////////////////

?>
