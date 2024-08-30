<?php
class Department
{
    private $id;
    private $name;
    private $id_category; // This represents the foreign key from the Category table
    private $description;

    // Constructor
    function __construct($name, $id_category, $description)
    {
        $this->name = $name;
        $this->id_category = $id_category;
        $this->description = $description;
    }

    // Getter methods
    function getDepartmentId()
    {
        return $this->id;
    }

    function getDepartmentName()
    {
        return $this->name;
    }

    function getDepartmentCategoryId()
    {
        return $this->id_category;
    }

    function getDepartmentDescription()
    {
        return $this->description;
    }

    // Setter methods
    function setDepartmentId($id)
    {
        $this->id = $id;
    }

    function setDepartmentName($name)
    {
        $this->name = $name;
    }

    function setDepartmentCategoryId($id_category)
    {
        $this->id_category = $id_category;
    }

    function setDepartmentDescription($description)
    {
        $this->description = $description;
    }
}
?>
