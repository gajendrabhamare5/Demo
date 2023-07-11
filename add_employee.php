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
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form id="quickForm" action="insertemployee.php"  method="POST" enctype="multipart/form-data">
                                    <div class="card-body">
                                    <!-- <span class="error">* Required Field</span> -->
                                        <div class="form-group">
                                            <label for="name">Employee Name <span class="error">* </span></label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Employee Name">
                                        </div>

                                        <div class="form-group">
                                            <label for="department">Select Department <span class="error">* </span></label>
                                            <select class="custom-select form-control-border" id="department" name="department">
                                                <option>Select Department </option>
                                                <?php

                                               // $department_query = $conn->query("SELECT * FROM `departments`");

                                               $department_query = $conn->query("SELECT * FROM departments WHERE department_id ");

                                                if (!$department_query) {
                                                    die("Query Error: " . $conn->error);
                                                }
                                                // echo "select * from department";
                                                if ($department_query->num_rows > 0) {
                                                    while ($department_data =  $department_query->fetch_assoc()) {

                                                        $department = $department_data['department'];

                                                        echo '<option value="' . $department . '">' . $department . '</option>';
                                                    }
                                                }

                                                ?>


                                            </select>

                                            <div>
                                                <div class="form-group">
                                                    <label for="age">Age <span class="error">* </span></label>
                                                    <input type="text" class="form-control" id="age" name="age" placeholder="Age">
                                                </div>

                                                <div class="form-group">
                                                    <label for="salary">Salary<span class="error">* </span> </label>
                                                    <input type="text" class="form-control" id="salary" name="salary" placeholder="Salary">

                                                </div>



                                            </div>

                                            <div class="card-footer">
                                                <button type="submit"  name="submit" value="Submit" class="btn btn-primary">Submit</button>
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

<script>
    $(function() {
      // $.validator.setDefaults({
      //   submitHandler: function () {
      //     alert( "Form successful submitted!" );
      //   }
      // });
      $('#quickForm').validate({
        rules: {
          name: {
            required: true,

          },
          department: {
            required: true,

          },
          age: {
            required: true,

          },
          salary: {
            required: true
          },

        },
        messages: {
            name: {
            required: "Please enter a name",

          },
          department: {
            required: "Please Select Department",

          },
          age: {
            required: "Please enter a age",

          },
          salary: {
            required: "Please enter a salary",

          },
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }
      });
    });
  </script>
  <script>
    $(function() {

      bsCustomFileInput.init();

    });
  </script>

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