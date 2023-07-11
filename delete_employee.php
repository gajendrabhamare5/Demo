<?php
include('conn.php');

 $delete_id = @$_GET['delete'];

$sql = "DELETE FROM `employees` WHERE `employee_id`='$delete_id'";


 if ($conn->query($sql) === TRUE) {
    ?>
    <script>
       window.location = "view_employee.php";
         if(!alert('Employee Deleted successfully.')){window.location = "view_employee.php";}

     </script>
   <?php
         }
     else {
      ?>
     <script>
        window.location = "view_employee.php";
            if(!alert('Can not deleted employee.Some error occured')){window.location = "view_employee.php";}

       </script>
   <?php
     }


?>