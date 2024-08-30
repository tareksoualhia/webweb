<?PHP
include 'configg.php';
class formationC 

{
	public function inscription($formation,$con)
	{       
		 $sql = "INSERT INTO formation (formation_name,formation_categorie,description) values (:formation_name, :formation_categorie, :description)";
        try {
            $req = $con->prepare($sql);
            $req->bindValue(':formation_name', $formation->getformation_name());
            $req->bindValue(':formation_categorie', $formation->getformation_categorie());
			$req->bindValue(':description', $formation->getdescription());
            $req->execute();
        } catch (Exception $e) {
            echo 'erreur: ' . $e->getMessage();
        }
	}}

function random_num($length)
{

	$text = "";
	if($length < 5)
	{
		$length = 5;
	}

	$len = rand(4,$length);

	for ($i=0; $i < $len; $i++) { 
		# code...
		$text .= rand(0,9);
	}

	return $text;
}{

////////////////////////////////////////////////////////////
function get_all_formations()
{
	$con=config::getConnexion();
    $sql = "SELECT * FROM `formation`";
	try {
        $resultp = $con->query($sql);
		return $resultp;
    } catch (Exception $e) {
        echo "Error " . $e->getMessage();
        exit();
    }
}

function inscrire()
{
	if(isset($_GET['inscri'])){
		$con=config::getConnexion();
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
      //something was posted
      $nom = trim($_POST['nom']);
      $email = trim($_POST['email']);
      $tel = $_POST['tel'];
      $id_formation= $_POST['id_formation'];
      if(!empty($nom) && !empty($email) && !empty($tel))
      {
        //save to database
        $sql = "insert into participant (nom,email,tel,id_formation) values ('$nom','$email','$tel','$id_formation')";
		try{  
			$query=$con->prepare($sql);
			$query->execute();
			header("Location: index.php");
		}catch (Exception $e){
			die('Erreur: '.$e->getMessage());
		}        
      }
    }
	}
}

function get_single_formation()
{
		if(isset($_GET['detail'])){
		$id=$_GET['detail'];
		$con=config::getConnexion();
        $sql="SELECT * FROM `formation` WHERE `id` ='$id'";
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


function get_formation()
{
		if(isset($_GET['search'])){
		$name=$_GET['search'];
		$con=config::getConnexion();
		$sql="SELECT * FROM `formation` WHERE `nom` ='$name'";
		try {
			$resultp = $con->query($sql);
			return $resultp;
		} catch (Exception $e) {
			echo "Error " . $e->getMessage();
			exit();
		}
		}
		else{
			$resultp=get_all_formations();
			return $resultp;
		}
}


function butt ( )
{
	if(isset($_GET['search'])){
	echo '<div class="col-lg-12">
	<div class="main-button-red">
	  <a href="index.php">All formation</a>
	</div>
  </div>';
	}
}

function deletef ( )
{
	if(isset($_GET['delete'])){
        $id = $_GET['delete'];
		$con=config::getConnexion();
        $sql ="DELETE FROM `formation` WHERE `id` = '$id' ";
        try{  
			$query=$con->prepare($sql);
			$query->execute();
			header("Location:listeformation.php");
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
        $formateur = trim($_POST['formateur']);
        $date= $_POST['date'];
        $prix= (float) $_POST['prix'];
        $lien=trim($_POST['lien']);
		$image=trim($_POST['image']);
		if(!empty($nom) && !empty($formateur) && !empty($date))
		{
			//save to database
            $sql= "UPDATE `formation` SET `nom`='$nom',`lien`='$lien',`prix`='$prix',`description`='$description',`formateur`='$formateur',`date`='$date',`image`='$image' WHERE id='$id'";
			try{  
				$query=$con->prepare($sql);
				$query->execute();
				header("Location:listeformation.php");
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
        $formateur = trim($_POST['formateur']);
        $date= $_POST['date'];
        $prix= (float) $_POST['prix'];
        $image=trim($_POST['image']);
        $lien=trim($_POST['lien']);
		if(!empty($nom) && !empty($date) && !empty($prix))
		{
			//save to database
			$sql = "insert into formation (nom,description,formateur,date,prix,lien,image) values ('$nom','$description','$formateur','$date','$prix','$lien','$image')";
			try{  
				$query=$con->prepare($sql);
				$query->execute();
				header("Location:listeformation.php");
			}catch (Exception $e){
				die('Erreur: '.$e->getMessage());
			}
		}
	}
}
}

function get_participations()
{
	$con=config::getConnexion();
	try {
        // Create sql statment
        $sql = " select * from participant";
        $resultp = $con->query($sql);
		return $resultp;
    } catch (Exception $e) {
        echo "Error " . $e->getMessage();
        exit();
    }
}

function deletep ()
{
	$con=config::getConnexion();
	if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        $sql ="DELETE FROM `participant` WHERE `id_participant` = '$id' ";
		try{  
			$query=$con->prepare($sql);
			$query->execute();
            header("Location:inscris.php");
		}catch (Exception $e){
			die('Erreur: '.$e->getMessage());
		}
	}
}

function related_formation ($categorie)
{
	try {
		$con=config::getConnexion();
        // Create sql statment
        $sql = " select * from formations where `categorie`='$categorie' limit 3";
        $resultp = $con->query($sql);
		return $resultp;
    } catch (Exception $e) {
        echo "Error " . $e->getMessage();
        exit();
    }
}

function get_single_prod_rate ($prod)
{
	try {
		$con=config::getConnexion();
        // Create sql statment
        $sql = "SELECT * FROM `rates` WHERE `formation`='$prod' limit 3";
        $resultp = $con->query($sql);
		return $resultp;
    } catch (Exception $e) {
        echo "Error " . $e->getMessage();
        exit();
    }
}

function get_single_prod_message ($prod)
{
	try {
		$con=config::getConnexion();
        // Create sql statment
        $sql = "SELECT * FROM `rate_des` WHERE `formation`='$prod' limit 3";
        $resultp = $con->query($sql);
		return $resultp;
    } catch (Exception $e) {
        echo "Error " . $e->getMessage();
        exit();
    }
}

function single_prod_note ($prod)
{
	$resultp=get_single_prod_rate ($prod);
	$n=$resultp->rowCount();
	$final_rate='NAN';
	$s=0;
	if($n>0)
	{
	foreach ($resultp as $sr)
	{
		$s+=$sr['rate'];
	}
	$final_rate=$s/$n;
	}
	return $final_rate;
}

function stock_info ($s)
{
	$sotckinfo='';
    $stockclass='';
    if($s<=0){
    $sotckinfo="Outofstock";
    $stockclass="danger";
	}else{
    $sotckinfo='Instock';
    $stockclass='success';
	}
	echo"<h4><span class='badge badge-$stockclass-lighten'>$sotckinfo</span></h4>";
}

function delete_prod()
{
	if(isset($_GET['delete'])){
	$con=config::getConnexion();
	if(isset($_GET['delete'])){
        $formation_id = $_GET['delete'];
        $sql ="DELETE FROM `formations` WHERE `formation_id` = '$formation_id' ";
        try {
			$query=$con->prepare($sql);
			$query->execute();
			header("Location:apps-ecommerce-formations.php");
		} catch (Exception $e) {
			echo "Error " . $e->getMessage();
			exit();
		}
}}
}

function add_prod ()
{
	if(isset($_GET['add'])){
	$con=config::getConnexion();
	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$formation_name    = trim($_POST['formation_name']);
		$photo    = trim($_POST['photo']);
		$categorie = trim($_POST['categorie']);
        $formation_description = trim($_POST['formation_description']);
        $quantity     = (int) $_POST['quantity'];
        $formation_price   = (float) $_POST['formation_price'];
		if(!empty($formation_name) && !empty($quantity) && !empty($formation_price))
		{

			//save to database
            $formation_id = random_num(20);
			$sql = "insert into formations (formation_name,categorie,formation_description,quantity,formation_price,photo) values ('$formation_name','$categorie','$formation_description','$quantity','$formation_price','$photo')";
			try {
				$query=$con->prepare($sql);
				$query->execute();
				header("Location:apps-ecommerce-formations.php");
			} catch (Exception $e) {
				echo "Error " . $e->getMessage();
				exit();
			}
			header("Location: apps-ecommerce-formations.php");
			die;
		}
	}
}
}

function update_prod ()
{
	if(isset($_GET['update'])){
	$con=config::getConnexion();
	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
        $formation_id=(int) $_POST['formation_id'];
		$formation_name    = trim($_POST['formation_name']);
		$photo    = trim($_POST['photo']);
		$categorie = trim($_POST['categorie']);
        $formation_description = trim($_POST['formation_description']);
        $quantity     = (int) $_POST['quantity'];
        $formation_price   = (float) $_POST['formation_price'];
		if(!empty($formation_name) && !empty($quantity) && !empty($formation_price))
		{
			//save to database
            $sql= "UPDATE `formations` SET `formation_name`='$formation_name',`categorie`='$categorie',`formation_description`='$formation_description',`quantity`='$quantity',`photo`='$photo',`formation_price`='$formation_price' WHERE formation_id='$formation_id'";
			try {
				$query=$con->prepare($sql);
				$query->execute();
				header("Location:apps-ecommerce-formations.php");
			} catch (Exception $e) {
				echo "Error " . $e->getMessage();
				exit();
			}
			header("Location: apps-ecommerce-formations.php");
			die;
		}
	}
}
}

function search_prod()
{
	if(isset($_GET['input'])){
		$con=config::getConnexion();
        $formation_name = $_GET['input'];
        $sql="SELECT * FROM `formations` WHERE `formation_name` ='$formation_name'";
        try{  
			$query=$con->prepare($sql);
			$query->execute();
			return $query;
		}catch (Exception $e){
			die('Erreur: '.$e->getMessage());
		}
	}
}

function top_sold ()
{
		$con=config::getConnexion();
        $sql="SELECT * FROM `formations` ORDER BY number_of_orders DESC LIMIT 3";
        try{  
			$query=$con->prepare($sql);
			$query->execute();
			return $query;
		}catch (Exception $e){
			die('Erreur: '.$e->getMessage());
		}
}

function stock_notif ()
{
	$resultp=get_all_formations();
	foreach ($resultp as $prod) : 
		if ($prod['quantity']<10)
		{
			$con=config::getConnexion();
			$id=$prod['formation_id'];
			$sql="INSERT INTO `stock_notif`( `prod`) VALUES ('$id')";
			try{  
				$query=$con->prepare($sql);
				$query->execute();
			}catch (Exception $e){
				die('Erreur: '.$e->getMessage());
			}
		}
	endforeach ;
}

function get_notification ()
{
	try {
		$con=config::getConnexion();
        // Create sql statment
        $sql = "SELECT * FROM `stock_notif`";
        $resultp = $con->query($sql);
		return $resultp;
    } catch (Exception $e) {
        echo "Error " . $e->getMessage();
        exit();
    }
}

function delete_notif ()
{
	if(isset($_GET['deletenotif'])){
		$con=config::getConnexion();
        $sql="DELETE FROM `stock_notif` WHERE 1";
        try{  
			$query=$con->prepare($sql);
			$query->execute();
			header("Location: apps-ecommerce-formations.php");
		}catch (Exception $e){
			die('Erreur: '.$e->getMessage());
		}
	}
}
////////////////////////////////////////
}
