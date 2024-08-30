<?php
class Manager
{
    private $id;
    private $name;
    private $email;
    private $password;
    private $department_id;
    private $image; // New property for the manager's image

    function __construct($name, $email, $password, $department_id, $image)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->department_id = $department_id;
        $this->image = $image; // Initialize the image property
    }

    // Getters
    function getName()
    {
        return $this->name;
    }

    function getEmail()
    {
        return $this->email;
    }

    function getPassword()
    {
        return $this->password;
    }

    function getDepartmentId()
    {
        return $this->department_id;
    }

    function getImage()
    {
        return $this->image;
    }

    // Setters
    function setName($name)
    {
        $this->name = $name;
    }

    function setEmail($email)
    {
        $this->email = $email;
    }

    function setPassword($password)
    {
        $this->password = $password;
    }

    function setDepartmentId($department_id)
    {
        $this->department_id = $department_id;
    }

    function setImage($image)
    {
        $this->image = $image;
    }
}
?>
