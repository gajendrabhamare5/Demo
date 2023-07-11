<?php
include("conn.php");

// Define error variables
$nameError = $departmentError = $ageError = $salaryError = "";

if (isset($_POST['submit'])) {
  // Retrieve form data
  $name = $_POST["name"];
  $department = $_POST['department'];
  $age = $_POST['age'];
  $salary = $_POST['salary'];

  // Validate name field
  if (empty($name)) {
    $nameError = "Name is required.";
  }

  // Validate department field
  if ($department == "Select Department") {
    $departmentError = "Please select a department.";
  }

  // Validate age field
  if (empty($age)) {
    $ageError = "Age is required.";
  } elseif (!is_numeric($age)) {
    $ageError = "Age must be a number.";
  }

  // Validate salary field
  if (empty($salary)) {
    $salaryError = "Salary is required.";
  } elseif (!is_numeric($salary)) {
    $salaryError = "Salary must be a number.";
  }

  // Proceed with database insertion if there are no errors
  if (empty($nameError) && empty($departmentError) && empty($ageError) && empty($salaryError)) {
    // Perform the database insertion

    // Escape special characters to prevent SQL injection
    $name = mysqli_real_escape_string($conn, $name);
    $department = mysqli_real_escape_string($conn, $department);
    $age = mysqli_real_escape_string($conn, $age);
    $salary = mysqli_real_escape_string($conn, $salary);

    // Construct and execute the insert query
    $sql = "INSERT INTO `employees`(`employee_id`, `name`, `department`, `age`, `salary`) VALUES ('', '$name', '$department', '$age', '$salary')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
      header("Location: view_employee.php");
      exit();
    } else {
      echo "Can not add employee. Some error occurred.";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard1</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">


    <?php
    include 'conn.php';
    include "header.php";
    include "sidebar.php";
    // ini_set('display_errors', 1);
    // ini_set('display_startup_errors', 1);
    // error_reporting(E_ALL);

    ?>


    <style>
      .error {
        color: #FF0000;
      }
    </style>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Employee</h1>
            </div><!-- /.col -->

          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-6">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Add Employee</h3>
                </div>

                <form id="quickForm" action="add_employee.php" method="POST" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="name">Employee Name <span class="error">*</span></label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Employee Name" required pattern="[A-Za-z\s]+">
                    <span class="error"><?php echo $nameError; ?></span>
                  </div>

                  <div class="form-group">
                    <label for="department">Select Department <span class="error">*</span></label>
                    <select class="custom-select form-control-border" id="department" name="department">
                      <option>Select Department</option>
                      <?php
                      $department_query = $conn->query("SELECT * FROM departments WHERE department_id ");

                      if (!$department_query) {
                        die("Query Error: " . $conn->error);
                      }

                      if ($department_query->num_rows > 0) {
                        while ($department_data =  $department_query->fetch_assoc()) {
                          $department = $department_data['department'];
                          echo '<option value="' . $department . '">' . $department . '</option>';
                        }
                      }
                      ?>
                    </select>
                    <span class="error"><?php echo $departmentError; ?></span>
                  </div>

                  <div class="form-group">
                    <label for="age">Age <span class="error">*</span></label>
                    <input type="number" class="form-control" id="age" name="age" placeholder="Age">
                    <span class="error"><?php echo $ageError; ?></span>
                  </div>

                  <div class="form-group">
                    <label for="salary">Salary<span class="error">*</span></label>
                    <input type="number" class="form-control" id="salary" name="salary" placeholder="Salary">
                    <span class="error"><?php echo $salaryError; ?></span>
                  </div>

                  <div class="card-footer">
                    <button type="submit" name="submit" value="Submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php
    include "footer.php";
    ?>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="plugins/moment/moment.min.js"></script>
  <script src="plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.js"></script>
  <!-- AdminLTE for demo purposes -->
  <!-- <script src="dist/js/demo.js"></script> -->
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="dist/js/pages/dashboard.js"></script>
</body>

</html>