
<?php
include 'configg.php';

class employe
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
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $department_id = (int) $_POST['department_id']; // Foreign key referencing the department
            $image = trim($_POST['image']);

            // Validate that required fields are not empty
            if (!empty($name) && !empty($email) && !empty($password) && !empty($department_id)) {
                // Prepare the SQL query to insert the new employe into the database
                $sql = "INSERT INTO employe (name, email, password, department_id, image) VALUES ('$name', '$email', '$password', '$department_id', '$image')";

                try {
                    $query = $con->prepare($sql);
                    $query->execute();

                    // Redirect to the employe list page after successful insertion
                    header("Location: listeemploye.php");
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

function get_all_employes()
{
    // Get the database connection
    $con = config::getConnexion();

    // SQL query to select all employes and their department names
    $sql = "
        SELECT employe.id, employe.name, employe.email, employe.image, department.name AS department_name
        FROM employe
        JOIN department ON employe.department_id = department.id
    ";

    try {
        // Execute the query and return the result set
        $result = $con->query($sql);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        // Handle any errors that occur during the query execution
        echo "Error: " . $e->getMessage();
        exit();
    }
}
function delete()
{
    if (isset($_GET['delete'])) {
        // Get the employe ID from the URL parameter
        $id = $_GET['delete'];

        // Get the database connection
        $con = config::getConnexion();

        // Prepare the SQL statement to delete the employe
        $sql = "DELETE FROM `employe` WHERE `id` = :id";
        
        try {
            // Prepare the query
            $query = $con->prepare($sql);
            
            // Bind the parameter
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            
            // Execute the query
            $query->execute();
            
            // Redirect to the employe list page after successful deletion
            header("Location: listeemploye.php");
            exit(); // Ensure to exit after redirect
        } catch (Exception $e) {
            // Handle potential errors
            die('Erreur: ' . $e->getMessage());
        }
    }
}
function get_single_employe()
{
    if (isset($_GET['detail'])) {
        $id = $_GET['detail'];
        $con = config::getConnexion();

        // Prepare SQL query to fetch the employe with the given ID
        $sql = "SELECT m.*, d.name AS department_name
                FROM employe m
                JOIN department d ON m.department_id = d.id
                WHERE m.id = :id";

        try {
            $query = $con->prepare($sql);
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            $query->execute();

            // Fetch the result
            $employe = $query->fetch();
            return $employe;
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
            $email = trim($_POST['email']);
            $password = trim($_POST['password']); // New password (can be empty)
            $department_id = (int) $_POST['department_id'];

            // Prepare SQL statement to update the employe in the database
            if (!empty($password)) {
                // Hash the password before storing it
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                $sql = "UPDATE `employe` 
                        SET `name` = :name, 
                            `email` = :email, 
                            `password` = :password,
                            `department_id` = :department_id 
                        WHERE `id` = :id";
                
                $params = [
                    ':name' => $name,
                    ':email' => $email,
                    ':password' => $hashed_password,
                    ':department_id' => $department_id,
                    ':id' => $id
                ];
            } else {
                $sql = "UPDATE `employe` 
                        SET `name` = :name, 
                            `email` = :email, 
                            `department_id` = :department_id 
                        WHERE `id` = :id";
                
                $params = [
                    ':name' => $name,
                    ':email' => $email,
                    ':department_id' => $department_id,
                    ':id' => $id
                ];
            }

            try {
                $query = $con->prepare($sql);
                $query->execute($params);

                // Redirect to the employe list page after successful update
                header("Location: listeemploye.php");
                exit(); // Ensure to exit after redirect
            } catch (Exception $e) {
                die('Erreur: ' . $e->getMessage());
            }
        }
    }
}



?>
