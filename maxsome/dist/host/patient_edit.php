<?php
include "config/checkers.php";
$get_staff_id = $app->get_request('fid');
 $get_staff_name = $app->get_request('st');
 //sql command
 $query = "SELECT * FROM patient_data JOIN hmo ON patient_data.hmo_id = hmo.id WHERE patient_data.pid=$get_staff_id";
 $get_data_details = $app->fetch_query($query);
 foreach($get_data_details as $data);
?>
<!doctype html>
<html class="no-js " lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

    <title>:Edit Patient</title>
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
        <!-- <div class="page-loader-wrapper">
            <div class="loader">
                <div class="mt-3"><img class="zmdi-hc-spin w60" src="../assets/images/loader.svg" alt="Amaze"></div>
                <p>Please wait...</p>
            </div>
        </div> -->

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
                                <li class="breadcrumb-item">Patient</li>
                                <li class="breadcrumb-item active">Update</li>
                            </ul>
                            <h1 class="mb-1 mt-1" style="text-transform: capitalize;"><?php echo $data['patient_name'];  ?></h1>
                        </div>
                        <div class="col-lg-6 col-md-12 text-md-right">
                            <a href="patient_all.php"><button class="btn btn-default hidden-xs ml-2">Manage Patient</button></a>
                            <a href="patient-add.php"> <button class="btn btn-secondary hidden-xs ml-2">Add Patient</button></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">

            
                <div class="row clearfix">


                    <div class="col-lg-12">


                        <div class="card">

                        <div class="body d-flex">
                            <div class="profile-image mr-4">
                                <img src="../profile_pic/<?php echo ($data['photo']);  ?>" class="w90 rounded-circle shadow" alt="" style="">
                                
                            </div>
                            <div class="details">
                                <h5 class="mt-0 mb-0"><strong><?php echo $data['patient_name'];  ?></strong></h5>
                                <span class="text-muted font-13"><?php echo htmlspecialchars($data['hmo_name']);  ?></span>
                                <p class="mb-1"><?php echo htmlspecialchars($data['address']);  ?></p>
                            </div>
                        </div>


                            <div id="notificationContainer" style="width:500px"></div>
                            
                            <form name="myForm" id="myForm" method="post">
                                <form name="myForm" id="myForm" method="post" class="form mt-5">
                                    <div class="body">
                                        <div class="row clearfix">
                                            <input type="hidden" name="pid" value="<?php echo $get_staff_id; ?>" />

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <input type="text" id="fn" class="form-control" name="fn"
                                                        placeholder="Full Name" value="<?php echo $data['patient_name'];  ?>" required>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <input type="number" class="form-control" id="age" name="age"
                                                        placeholder="Age" required value="<?php echo $data['age'];  ?>">
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-sm-12">
                                                <div class="form-group">
                                                    <select class="form-control show-tick" id="account_type"
                                                        name="account_type">
                                                        <option value="<?php echo $data['account_type'];  ?>"><?php echo $data['account_type'];  ?></option>
                                                        <option value="vip">Vip</option>
                                                        <option value="standard">Standard</option>
                                                        <option value="regular">Regular</option>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-12">
                                                <div class="form-group">
                                                    <select class="form-control show-tick" name="hmo_id" id="hmo_id">
                                                        <option value="<?php echo $data['hmo_id'];  ?>"><?php echo $data['hmo_name'];  ?></option>
                                                        <?php
                                                        $query = "SELECT * FROM hmo";
                                                        $hmo = $app->fetch_query($query);

                                                        foreach ($hmo as $datas) {
                                                            ?>
                                                            <option value="<?php echo $datas['id']; ?>">
                                                                <?php echo $datas['hmo_name']; ?>
                                                            </option>

                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-3 col-sm-12">
                                                <div class="form-group">
                                                    <select class="form-control show-tick" name="retainer" id="retainer">
                                                        <option value="<?php echo $data['retainer']; ?>"><?php echo $data['retainer']; ?></option>
                                                        <option value="Individual">Individual</option>
                                                        <option value="Family">Family</option>
                                                        <option value="Organization">Organization</option>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-md-3 col-sm-12">
                                                <div class="form-group">
                                                    <select class="form-control show-tick" id="gender" name="gender">
                                                        <option value="<?php echo $data['sex']; ?>"><?php echo $data['sex']; ?></option>
                                                        <option>Male</option>
                                                        <option>Female</option>
                                                        <option>Others</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-md-3 col-sm-12">
                                                <label>Phone Number</label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $data['phone_no']; ?>"
                                                        placeholder="Phone Number">
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-sm-12">
                                                <label>Email Address</label>
                                                <div class="form-group">
                                                    <input type="email" class="form-control"  value="<?php echo $data['emails_patient']; ?>" id="email" name="email"
                                                        placeholder="Email Address">
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-sm-12">
                                                <label>Address</label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="address" value="<?php echo $data['address']; ?>" name="address"
                                                        placeholder="Address">
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-sm-12">
                                                <label>Select Marital Status</label>
                                                <div class="form-group">
                                                    <select class="form-control show-tick" name="marital_status"
                                                        id="marital_status">
                                                        <option value="<?php echo $data['marital_status']; ?>"><?php echo $data['marital_status']; ?></option>
                                                        <option>Single</option>
                                                        <option>Married</option>
                                                        <option>Divorced</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row clearfix">
                                            <div class="col-md-3 col-sm-12">
                                                <label>Next Of Kin</label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="nextofkin"
                                                        name="nextofkin" placeholder="Next Of Kin" value="<?php echo $data['next_kin']; ?>">
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-sm-12">
                                                <label>Tribe</label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="tribe" name="tribe"  value="<?php echo $data['tribe']; ?>"
                                                        placeholder="Tribe">
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-sm-12">
                                                <label>Occupation</label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="occupation"
                                                        name="occupation" placeholder="Occupation" value="<?php echo $data['occupation']; ?>">
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-sm-12">
                                                <label>Select Marital Status</label>
                                                <div class="form-group">
                                                    <select class="form-control show-tick" name="religion"
                                                        id="religion">
                                                        <option value="<?php echo $data['religion']; ?>"><?php echo $data['religion']; ?></option>
                                                        <option value="Christianity">Christianity</option>
                                                        <option value="Islam">Islam</option>
                                                        <option value="Buddhism">Buddhism</option>
                                                        <option value="Sikhism">Sikhism</option>
                                                        <option value="Jainism">Jainism</option>
                                                        <option value="Taoism">Taoism</option>
                                                        <option value="Hinduism">Hinduism</option>
                                                        <option value="Shinto">Shinto</option>
                                                        <option value="Other">Other</option>

                                                    </select>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row clearfix">
                                            <div class="col-sm-12">
                                                <div class="mt-4">
                                                    <button type="submit" id="reset-btn" class="btn btn-primary">Update
                                                        Patient</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                        </div>
                    </div>


                    <div class="col-lg-12">

<div class="card">
    <div id="notificationContainer" style="width:500px"></div>
    <form name="myForm009" id="myForm009" method="post" enctype="multipart/form-data">
            <div class="body">
                <div class="row clearfix">
                    <div class="col-12">
                        <input type="file" name="file">
                        <div class="mt-3"></div>
                    </div>
                    <input type="hidden" value="<?php echo base64_encode($get_staff_id+90000002);   ?>" name="staff_ids11" id="staff_ids11">
                    <div class="col-sm-12">
                        <div class="mt-4">
                            <button type="submit" id="upload-btn" class="btn btn-primary">Update
                                Profile Picture</button>
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
        $(document).ready(function () {
            function validateForm() {
                let fn = document.forms["myForm"]["fn"].value;
                let age = document.forms["myForm"]["age"].value;
                let phone = document.forms["myForm"]["phone"].value;
                let account_type = document.forms["myForm"]["account_type"].value;
                let email = document.forms["myForm"]["email"].value;

                if (fn === "") {
                    Swal.fire({
                        title: "The Fullname Can Not Be Empty",
                        text: "Try Again!",
                        icon: "error"
                    });
                    return false;
                }

                if (age === "") {
                    Swal.fire({
                        title: "The Age Can Not Be Empty",
                        text: "Try Again!",
                        icon: "error"
                    });
                    return false;
                }
                if (phone === "") {
                    Swal.fire({
                        title: "The Phone Number Can Not Be Empty",
                        text: "Try Again!",
                        icon: "error"
                    });
                    return false;
                }
                if (email === "") {
                    Swal.fire({
                        title: "The Email address Can Not Be Empty",
                        text: "Try Again!",
                        icon: "error"
                    });
                    return false;
                }
                if (fn.length < 5) {
                    Swal.fire({
                        title: "Error!",
                        text: "Fullname must be at least 8 characters long.",
                        icon: "error",
                    });
                    return false;
                }

                if (age >100) {
                    Swal.fire({
                        title: "Error!",
                        text: "Age must be at least 1 - 100",
                        icon: "error",
                    });
                    return false;
                }

                return true; // Form is valid
            }

            /* function to login user */
            $("#myForm").on('submit', (function (e) {
                // alert("eddwards");
                validateForm();
                let check = validateForm();
                e.preventDefault();
                if (check == true) {
                    var btn = $("#reset-btn");
                    btn.attr('disabled', true).html("<i class='fa fa-spin fa-spinner'></i> Processing");
                    var datas = new FormData(this);
                    $.ajax({
                        url: "ajax/update_patient",
                        type: "post",
                        data: datas,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: (data) => {
                            if (data.trim() == "success") {
                                Swal.fire({
                                    title: "success!",
                                    text: "Account Updated, Please wait redirecting...!",
                                    icon: "success",
                                });
                                setTimeout(function () {
                                    location.reload();
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


            //file upload function
            $("#myForm009").on('submit', (function (e) {
                validateForm();
                let check = validateForm();
                e.preventDefault();
                if (check == true) {
                    var btn = $("#upload-btn");
                    btn.attr('disabled', true).html("<i class='fa fa-spin fa-spinner'></i> Uploading");
                    var datas = new FormData(this);
                    $.ajax({
                        url: "ajax/patient_pic",
                        type: "post",
                        data: datas,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: (data) => {
                          
                            if (data.trim() == "success") {
                            Swal.fire({
                                title: "success!",
                                text: "Profile Picture Updated, Please wait redirecting...!",
                                icon: "success",
                            });
                                setTimeout(function () {
                                var btn = $("#upload-btn");
                                btn
                                .attr("disabled", false)
                                .html("Update Account");
                                location.reload();
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