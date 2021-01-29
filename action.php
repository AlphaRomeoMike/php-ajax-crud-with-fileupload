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

    if($_POST["action"] == "Fetch Single Data")
    {
        $output[] = '';
        $u_id = $_POST['user_id'];
        $query = "SELECT * FROM users WHERE id = $u_id";
        $result = $object->exec_query($query);
        while($row = mysqli_fetch_array($result))
        {
            $output["first_name"]   = $row["first_name"];
            $output["last_name"]    = $row["last_name"];
            $output["user_image"]   = $row["image"];
            $output["image"]        = '<img src="upload/'.$row['image'].'" height="20" width="30" class="img-thumbnail" />';
        }
        echo json_encode($output);
    }
}
?>