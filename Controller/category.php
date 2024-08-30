<?php
include 'configg.php';

class Category
{
   
 

   
}


function ajouter()
{
    if (isset($_GET['add'])) {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            // Get the database connection
            $con = config::getConnexion();

            // Retrieve and sanitize form data
            $name = trim($_POST['name']);
            $description = trim($_POST['description']);

            // Validate that required fields are not empty
            if (!empty($name) && !empty($description)) {
                // Prepare SQL statement to insert the new category into the database
                $sql = "INSERT INTO category (name, description) VALUES (:name, :description)";
                
                try {
                    $query = $con->prepare($sql);
                    $query->bindParam(':name', $name);
                    $query->bindParam(':description', $description);
                    $query->execute();

                    // Redirect to the category list page after successful insertion
                    header("Location: listecategory.php");
                } catch (Exception $e) {
                    die('Erreur: ' . $e->getMessage());
                }
            } else {
                // Handle the case where required fields are missing (optional)
                echo "Please fill in all required fields.";
            }
        }
    }
}
function get_all_categories()
{
    $con = config::getConnexion();
    $sql = "SELECT * FROM `category`";
    try {
        $result = $con->query($sql);
        return $result;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        exit();
    }
}

function deletec ( )
{
	if(isset($_GET['delete'])){
        $id = $_GET['delete'];
		$con=config::getConnexion();
        $sql ="DELETE FROM `category` WHERE `id` = '$id' ";
        try{
			$query=$con->prepare($sql);
			$query->execute();
			header("Location:listecategory.php");
		}catch (Exception $e){
			die('Erreur: '.$e->getMessage());
		}
        }
}
function update()
{
    if (isset($_GET['update'])) {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            // Get the database connection
            $con = config::getConnexion();
            $id = $_GET['update'];
            $name = trim($_POST['name']);
            $description = trim($_POST['description']);

            // Ensure required fields are not empty
            if (!empty($name) && !empty($description)) {
                // Prepare the SQL statement to update the category
                $sql = "UPDATE `category` SET `name` = :name, `description` = :description WHERE id = :id";
                try {
                    $query = $con->prepare($sql);
                    $query->bindParam(':name', $name);
                    $query->bindParam(':description', $description);
                    $query->bindParam(':id', $id);
                    $query->execute();

                    // Redirect to the category list after update
                    header("Location: listecategory.php");
                } catch (Exception $e) {
                    die('Erreur: ' . $e->getMessage());
                }
            } else {
                echo "Please fill in all required fields.";
            }
        }
    }
}

function get_single_category()
{
    if (isset($_GET['detail'])) {
        $id = $_GET['detail'];
        $con = config::getConnexion();
        $sql = "SELECT * FROM `category` WHERE `id` = :id";
        try {
            $query = $con->prepare($sql);
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            $query->execute();
            $category = $query->fetch();
            return $category;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
}

?>
