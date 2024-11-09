<?php
include "config/checkers.php";
$cat_name = base64_decode($app->get_request('cat_name'));
$cat_fid = base64_decode($app->get_request('fid'));
//fetch the specializations
$query = "select * from specializations where id='$cat_fid'";
$fetch_departments = $app->fetch_query($query);
foreach ($fetch_departments as $fetch_department)
    ;
?>
<!doctype html>
<html class="no-js " lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

    <title> edit Specialization</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <!-- Favicon-->
    <link rel="stylesheet" href="../assets/plugins/bootstrap-select/css/bootstrap-select.css" />
    <link rel="stylesheet" href="../assets/plugins/summernote/dist/summernote.css" />
    <link rel="stylesheet" href="../assets/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.css">
    <!-- Custom Css -->
    <link rel="stylesheet" href="../assets/css/amaze.style.min.css">
</head>

<body class="font-ubuntu ">

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
        include "inc/rightside.php";
        ?>

        <!-- Main Content -->
        <div class="body_area after_bg sm">

            <div class="block-header">
                <div class="container">
                    <div class="row clearfix">
                        <div class="col-lg-6 col-md-12">
                            <ul class="breadcrumb pl-0 pb-0 ">
                                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                <li class="breadcrumb-item">Specialization</li>
                                <li class="breadcrumb-item active">Edit</li>
                            </ul>
                            <h1 class="mb-1 mt-1">
                                <?php echo htmlspecialchars($fetch_department->specializations_name); ?>
                            </h1>
                        </div>
                        <div class="col-lg-6 col-md-12 text-md-right">
                            <a href="emp-specialazion.php"><button class="btn btn-default hidden-xs ml-2">Manage
                                    Specialization</button></a>
                            <!-- <button class="btn btn-secondary hidden-xs ml-2">Department</button> -->
                        </div>

                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row clearfix">


                    <div class="col-lg-12">

                        <div class="card">
                            <div id="notificationContainer" style="width:500px"></div>
                            <!-- <form name="myForm" id="myForm" method="post"> -->
                            <form name="myForm" id="myForm" method="post" class="form mt-5">
                                <input type="hidden" name="postid" value="<?php echo $cat_fid; ?>">
                                <div class="body">
                                    <div class="row clearfix">

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input type="text" id="dpt" class="form-control" name="dpt"
                                                    placeholder="Name Of Specialization" required
                                                    value="<?php echo ($fetch_department['specializations_name']); ?>"
                                                    required>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-sm-12">
                                            <div class="mt-4">
                                                <button type="submit" id="reset-btn" class="btn btn-primary">Update
                                                    Specialization</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

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

    <script src="../assets/plugins/momentjs/moment.js"></script> <!-- Moment Plugin Js -->
    <script src="../assets/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.js"></script>

    <script src="../assets/bundles/mainscripts.bundle.js"></script><!-- Custom Js -->
    <script src="../assets/plugins/summernote/dist/summernote.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        //validate email


        $(document).ready(function () {
            function validateForm() {
                let dpt = document.forms["myForm"]["dpt"].value;

                if (dpt === "") {
                    Swal.fire({
                        title: "The Department Name Can Not Be Empty",
                        text: "Try Again!",
                        icon: "error"
                    });
                    return false;
                }


                if (dpt.length < 5) {
                    Swal.fire({
                        title: "Error!",
                        text: "Department must be at least 8 characters long.",
                        icon: "error",
                    });
                    return false;
                }

                return true; // Form is valid
            }


            $("#myForm").on('submit', (function (e) {
                validateForm();
                let check = validateForm();
                e.preventDefault();
                if (check == true) {
                    var btn = $("#reset-btn");
                    btn.attr('disabled', true).html("<i class='fa fa-spin fa-spinner'></i> Processing");
                    var datas = new FormData(this);
                    $.ajax({
                        url: "ajax/update_specialzation",
                        type: "post",
                        data: datas,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: (data) => {

                            if (data.trim() == "success") {
                                Swal.fire({
                                    title: "success!",
                                    text: "Specialization Updated, Please wait redirecting...!",
                                    icon: "success",
                                });
                                setTimeout(function () {
                                    var btn = $("#reset-btn");
                                    btn
                                        .attr("disabled", false)
                                        .html("Specialization Updated!");
                                    location.href = "emp-specialazion.php";
                                }, 3000);
                            } else {
                                Swal.fire({
                                    title: "Error!",
                                    text: "Posting Failed try again!",
                                    icon: "error",
                                });

                            }

                        },

                    });
                } else {

                }

            }));

        });
    </script>
</body>

</html>