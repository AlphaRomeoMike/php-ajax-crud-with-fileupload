<?php
include 'Crud.php';
$object = new Crud();
if(isset($_POST['action'])) 
{
    if($_POST["action"] == "Load") 
    {
        echo $object->get_data_in_table("SELECT * FROM users");
    }
    if($_POST['action'] == "Insert")
    {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $image = $_FILES['user_image'];
        $first_name = mysqli_real_escape_string($object->connect, $first_name);
        $last_name = mysqli_real_escape_string($object->connect, $last_name);
        $image = $object->upload_file($image);
        $query = "INSERT INTO users (first_name, last_name, image) VALUES ('$first_name', '$last_name', '$image')";
        $object->exec_query($query);
        
    }
}
?>