
<?php

include("conn.php");

 if(isset($_POST['submit'])) {

    // $con = new mysqli("localhost","root","","shreemee_attendance");

  $name =  $_POST["name"];
if ( $name==""){
    echo "name is requ";
}


   $department =  $_POST['department'];

    $age  = $_POST['age'];

   $salary  = $_POST['salary'];

 $sql = "INSERT INTO `employees`(`employee_id`, `name`, `department`,`age`,`salary`) VALUES ('','$name','$department','$age','$salary');";


  $result = mysqli_query($conn,$sql);



   if ($result)

  {




      ?>



   <script>

       window.location = "view_employee.php";


   </script>
   <?php
       }

   else {
    ?>

     <script>

        window.location = "index.php";

          alert("Can not add employee. Some error occured");

          setTimeout(() => {

      window.location = "index.php";

    }, 1000);



     </script>

   <?php

   }



//    echo ("<script>location.href='attendancepanel.php'</script>");

  }





?>