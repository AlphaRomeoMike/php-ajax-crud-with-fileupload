<?php

include 'Crud.php';
$object = new Crud();
if(isset($_POST['action'])) {
    if($_POST["action"] == "Load") {
        echo $object->get_data_in_table("SELECT * FROM users");
    }
}
?>