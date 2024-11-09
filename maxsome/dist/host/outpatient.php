<?php
include "config/checkers.php";
?>
<!doctype html>
<html class="no-js " lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">
    <title>:: Maxsomeware :: outpatient</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Favicon-->
    <!-- Custom Css -->
    <link rel="stylesheet" href="../assets/css/amaze.style.min.css">
    <link rel="stylesheet" href="../assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css">
</head>

<body class="font-ubuntu h_menu">

    <div id="body" class="theme-blue">

        <!-- Page Loader -->
        <div class="page-loader-wrapper">
            <div class="loader">
                <div class="mt-3"><img class="zmdi-hc-spin w60" src="../assets/images/loader.svg" alt="Amaze"></div>
                <p>Please wait...</p>
            </div>
        </div>

        <div class="overlay"></div>

        <!-- Top Bar -->

        <?php
        include "inc/nav.php";
        include "inc/header.php";
        // include "inc/rightside.php";
        ?>
        <!-- Right Sidebar -->

        <!-- Main Content -->
        <div class="body_area after_bg">

            <div class="container">
                <br>
                <div class="row clearfix row-deck">
                    <div class="col-xl-3 col-lg-4 col-md-12">
                        <div class="card activities">
                            <div class="header">
                                <h2><strong>Outpatient Activities</strong> <small>Manage Outpatient Account Activities
                                        Here</small></h2>
                            </div>
                            <div class="body">
                                <ul class="list-unstyled activity mb-0">
                                    <li>
                                        <a href="patient_hmoview.php">
                                            <i class="zmdi zmdi-file bg-blue"></i>
                                            <div class="info">
                                                <h4>My Queue</h4>
                                                <small>Manage My Queue Request here</small>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="hmo_request_app">
                                            <i class="zmdi zmdi-file-text bg-red"></i>
                                            <div class="info">
                                                <h4>All Queue</h4>
                                                <small>Manage All Queue here</small>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="hmo_request_app_paid.php">
                                            <i class="zmdi zmdi-file-text bg-red"></i>
                                            <div class="info">
                                                <h4>Specialist Queue</h4>
                                                <small>Manage Specialist Queue here</small>
                                            </div>
                                        </a>
                                    </li>


                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-9 col-md-12">
                        <div class="card">
                            <div class="header">
                                <h2>Outpatient Users / All Request</h2>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table table-hover js-basic-example dataTable mb-0">
                                        <thead>
                                            <tr>
                                                <th>
                                                    SN
                                                </th>
                                                <th>Patient Names</th>
                                                <th>Age/Sex</th>
                                                <th>Specialty</th>
                                                <th>Doctor</th>
                                                <th>Folder status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            //get today date
                                            $today = date("Y-m-d");


                                             $sql_outpatient = "SELECT 
    a.tittle, 
    a.doc_id, 
    a.id, 
    a.description, 
    a.appointment_date, 
    a.status, 
    s.firstname, 
    s.lastname, 
    s.sex, 
    s.photo AS staff_photo, 
    p.photo AS patient_photo, 
    p.pid, 
    spe.specializations_name, 
    p.patient_name 
FROM 
    appointment a 
LEFT JOIN 
    staffs_accounts s ON a.doc_id = s.staff_id 
LEFT JOIN 
    patient_data p ON a.pid = p.pid 
LEFT JOIN 
    specializations spe ON a.specialist_id = spe.id 
WHERE 
    a.assigned_doc_id = '$id' 
    AND a.status = '0' 
    AND DATE(a.appointment_date) = '$today';
 ";
                                            $fetch_query = $app->fetch_query($sql_outpatient);
                                            // Create for each employee loop in php
                                            $count = 1;
                                            foreach ($fetch_query as $key => $value) {
                                                ?>
                                                <tr>
                                                    <td class="width45">
                                                        <?php echo $count++; ?>
                                                    </td>
                                                    <td class="d-flex">

                                                        <div class="ml-2">
                                                            <h6 class="mb-0" style="text-transform: capitalize;">
                                                                <?php echo $app->stringFormat($value['patient_name'], 20); ?>
                                                               
                                                            </h6>
                                                            <span class="text-muted">
                                                                PID-<?php echo $value['pid']; ?>
                                                            </span>
                                                        </div>
                                                    </td>

                                                    <td><span>
                                                            <?php echo $value['sex']; ?>
                                                        </span></td>
                                                    <td><span>
                                                            <?php echo $value['specializations_name']; ?>
                                                        </span></td>
                                                    <td><span> <?php echo $app->stringFormat($value['firstname'], 20); ?>
                                                                <?php echo $app->stringFormat($value['lastname'], 20); ?>
                                                        </span></td>
                                                    
                                                    <td>
                                                        <label for="">
                                                            <?php 
                                                            if($value['status']==0){

                                                            echo "Open"; 
                                                            }else{
                                                                 echo "Closed"; 
 
                                                            }
                                                            
                                                            ?>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <div class="dropdown show">
                                                            <a class="btn btn-secondary dropdown-toggle" href="#"
                                                                role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false">
                                                                Action
                                                            </a>

                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">

                                                                <a class="dropdown-item" href="patient_profile.php?fid=<?php echo $value['pid']; ?>&&st=<?php echo base64_encode($app->stringFormat($value['patient_name'], 20)); ?>
                                                                ">Scan case note</a>

                                                                <a class="dropdown-item" href="patient_edit.php?fid=<?php echo $value['pid']; ?>&&st=<?php echo base64_encode($app->stringFormat($value['patient_name'], 20)); ?>
                                                                ">Open Folder</a>

                                                                <a class="dropdown-item" href="patient_lab_profile.php?fid=<?php echo $value['pid']; ?>&&st=<?php echo base64_encode($app->stringFormat($value['patient_name'], 20)); ?>
                                                                ">Close Folder</a>

                                                            </div>
                                                        </div>

                                                    </td>

                                                </tr>
                                                <?php
                                            }
                                            ?>


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                include "inc/footer.php";
                ?>

            </div>
        </div>

    </div>

    <!-- Jquery Core Js -->
    <script src="../assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js -->
    <script src="../assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js -->

    <script src="../assets/bundles/datatablescripts.bundle.js"></script>

    <script src="../assets/bundles/mainscripts.bundle.js"></script><!-- Custom Js -->
    <script src="../../js/pages/tables/jquery-datatable.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>