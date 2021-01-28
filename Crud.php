<?php
class Crud {
    public $connect;
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $db = "crud-ajax";

    function __construct()
    {
        $this->database_connect();
    }

    // Making connection
    public function database_connect()
    {
        $this->connect = mysqli_connect($this->host, $this->username, $this->password, $this->db);

    }

    // Executes query
    public function exec_query($query) 
    {
        return mysqli_query($this->connect, $query);
    }

    public function get_data_in_table($query) 
    {
        $output = '';
        $result = $this->exec_query($query);
        $output .= '<table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="10%">Image</th>
                <th width="35%">First Name</th>
                <th width="35%">Last Name</th>
                <th width="10%">Action</th>
            </tr>
        </thead>
        <tbody>
    ';

        while($row = mysqli_fetch_object($result))
        {
        $output .= '
        <tr>
            <td><img src="upload/'.$row->image.'" width="50" height="30" /></td>
            <td>'.$row->first_name.'</td>
            <td>'.$row->last_name.'</td>
            <td><button type="button" name="update" id="'.$row->id.'" class="btn btn-outline-success btn-xs update"><i class="fas fa-pen">Update</i></button><span> </span>
            <button type="button" name="delete" id="'.$row->id.'" class="btn btn-outline-success btn-xs delete"><i class="fas fa-trash-alt">Delete</i></button></td>
        </tr>
            ';
        }
        $output .= '</table>';
        return $output;
    }
}
