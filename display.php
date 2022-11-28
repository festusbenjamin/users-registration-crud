<?php
include './database/connection.php';


if(isset($_POST['sendDisplay'])){
    $table = '<table class="table">
    <thead class="table-dark">
      <tr>
        <th scope="col">SI no</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Mobile</th>
        <th scope="col">Residence</th>
        <th scope="col">Operations</th>
      </tr>
    </thead>';

    $sql = 'select * from `users`';

    $result = mysqli_query($con,$sql);

    $number = 1;
    
    while($row = mysqli_fetch_assoc($result)){
        $id = $row['id'];
        $name = $row['name'];
        $email = $row['email'];
        $mobile = $row['mobile'];
        $residence = $row['residence'];

        $table.='<tr>
        <td scope="row">'.$number.'</td>
        <td>'.$name.'</td>
        <td>'.$email.'</td>
        <td>'.$mobile.'</td>
        <td>'.$residence.'</td>
        <td>
            <button class="btn btn-secondary" onclick="getUser('.$id.')">Update</button>
            <button class="btn btn-danger" onclick="deleteUser('.$id.')">Delete</button>
        </td>
      </tr>';
      $number++;
    };

        $table.='</table>';

        echo $table;
}

?>