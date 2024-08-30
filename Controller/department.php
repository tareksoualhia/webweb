<?php
include 'configg.php';

class Category
{
   
 

   
}

function ajouter()
{
    if (isset($_GET['add'])) {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            // Obtenir la connexion à la base de données
            $con = config::getConnexion();

            // Récupérer et assainir les données du formulaire
            $name = trim($_POST['name']);
            $id_category = (int) $_POST['id_category'];
            $description = trim($_POST['description']);
            $nb_emp = (int) $_POST['nb_emp']; // Récupérer le nombre d'employés

            // Valider que les champs requis ne sont pas vides
            if (!empty($name) && !empty($id_category)) {
                // Préparer la requête SQL pour insérer le nouveau département dans la base de données
                $sql = "INSERT INTO department (name, id_category, description, nb_emp) VALUES (:name, :id_category, :description, :nb_emp)";
                
                try {
                    $query = $con->prepare($sql);
                    $query->bindParam(':name', $name);
                    $query->bindParam(':id_category', $id_category);
                    $query->bindParam(':description', $description);
                    $query->bindParam(':nb_emp', $nb_emp); // Lier le nombre d'employés
                    $query->execute();

                    // Rediriger vers la page de liste des départements après l'insertion réussie
                    header("Location: listedepartment.php");
                } catch (Exception $e) {
                    die('Erreur: ' . $e->getMessage());
                }
            } else {
                // Gérer le cas où les champs requis sont manquants (optionnel)
                echo "Veuillez remplir tous les champs requis.";
            }
        }
    }
}

function getAllCategories()
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





function get_all_departments()
{
    // Get the database connection
    $con = config::getConnexion();

    // SQL query to select all departments
    $sql = "SELECT * FROM `department`";

    try {
        // Execute the query and return the result set
        $result = $con->query($sql);
        return $result;
    } catch (Exception $e) {
        // Handle any errors that occur during the query execution
        echo "Error: " . $e->getMessage();
        exit();
    }
}
function get_single_department()
{
    if (isset($_GET['detail'])) {
        $id = $_GET['detail'];
        $con = config::getConnexion();

        // Prepare SQL query to fetch the department with the given ID
        $sql = "SELECT d.*, c.name AS category_name
                FROM department d
                JOIN category c ON d.id_category = c.id
                WHERE d.id = :id";

        try {
            $query = $con->prepare($sql);
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            $query->execute();

            // Fetch the result
            $department = $query->fetch();
            return $department;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
    return null; // Return null if no ID is provided
}
function update()
{
    if (isset($_GET['update'])) {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            // Get the database connection
            $con = config::getConnexion();

            // Retrieve and sanitize form data
            $id = $_GET['update'];
            $name = trim($_POST['name']);
            $description = trim($_POST['description']);
            $id_category = (int) $_POST['id_category'];
            $nb_emp = (int) $_POST['nb_emp']; // Number of employees

            // Validate that required fields are not empty
            if (!empty($name) && !empty($id_category)) {
                // Prepare SQL statement to update the department in the database
                $sql = "UPDATE `department` 
                        SET `name` = :name, 
                            `description` = :description, 
                            `id_category` = :id_category,
                            `nb_emp` = :nb_emp 
                        WHERE `id` = :id";
                
                try {
                    $query = $con->prepare($sql);
                    $query->bindParam(':name', $name);
                    $query->bindParam(':description', $description);
                    $query->bindParam(':id_category', $id_category);
                    $query->bindParam(':nb_emp', $nb_emp);
                    $query->bindParam(':id', $id, PDO::PARAM_INT);
                    $query->execute();

                    // Redirect to the department list page after successful update
                    header("Location: listedepartment.php");
                    exit(); // Make sure to exit after redirect
                } catch (Exception $e) {
                    die('Erreur: ' . $e->getMessage());
                }
            } else {
                // Handle the case where required fields are missing (optional)
                echo "Veuillez remplir tous les champs requis.";
            }
        }
    }
}

function delete()
{
    if (isset($_GET['delete'])) {
        // Get the department ID from the URL parameter
        $id = $_GET['delete'];

        // Get the database connection
        $con = config::getConnexion();

        // Prepare the SQL statement to delete the department
        $sql = "DELETE FROM `department` WHERE `id` = :id";
        
        try {
            // Prepare the query
            $query = $con->prepare($sql);
            
            // Bind the parameter
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            
            // Execute the query
            $query->execute();
            
            // Redirect to the department list page after successful deletion
            header("Location: listedepartment.php");
            exit(); // Ensure to exit after redirect
        } catch (Exception $e) {
            // Handle potential errors
            die('Erreur: ' . $e->getMessage());
        }
    }
}
function getDepartments($sort = '', $search = '') {
    $con = config::getConnexion();

    // Base SQL query
    $sql = "SELECT d.*, c.name AS category_name
            FROM department d
            JOIN category c ON d.id_category = c.id";

    // Append search condition if search term is provided
    if (!empty($search)) {
        $search = "%" . $search . "%"; // Prepare search term for SQL LIKE clause
        $sql .= " WHERE d.name LIKE :search";
    }

    // Append sorting clause based on 'sort' parameter
    if ($sort == 'nb_emp') {
        $sql .= " ORDER BY d.nb_emp DESC"; // Sort by number of employees in descending order
    } else {
        $sql .= " ORDER BY d.name"; // Default sorting by department name
    }

    try {
        $query = $con->prepare($sql);
        if (!empty($search)) {
            $query->bindParam(':search', $search, PDO::PARAM_STR);
        }
        $query->execute();
        return $query->fetchAll(); // Fetch all results
    } catch (Exception $e) {
        die('Erreur: ' . $e->getMessage());
    }
}

function get_department_stats() {
    $con = config::getConnexion();
    $sql = "SELECT name, nb_emp FROM department";
    
    try {
        $query = $con->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        die('Erreur: ' . $e->getMessage());
    }
}
?>
