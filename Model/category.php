<?php
class Category
{   
    private $id;
    private $name;
    private $description;

    // Constructor
    function __construct($name, $description)
    {
        $this->name = $name;
        $this->description = $description;
    }

    // Getter methods
    function getCategoryId()
    {
        return $this->id;
    }

    function getCategoryName()
    {
        return $this->name;
    }

    function getCategoryDescription()
    {
        return $this->description;
    }

    // Setter methods
    function setCategoryId($id)
    {
        $this->id = $id;
    }

    function setCategoryName($name)
    {
        $this->name = $name;
    }

    function setCategoryDescription($description)
    {
        $this->description = $description;
    }
}
?>
