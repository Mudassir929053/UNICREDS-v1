<!DOCTYPE html>
<html lang="en">


<?php
include 'pages-head.php';

include('../database/dbcon.php');
include('admin-function.php');

$admin_id = $_SESSION['sess_adminid'];
$mcid = $_GET['mcid'];
?>



</style>

<body>
    <!-- Wrapper -->
    <div id="db-wrapper">
        <!-- navbar vertical -->
        <?php
        unset($_SESSION['pages']);
        $_SESSION['pages'] = 'mcrequest';
        include('pages-sidebar.php');
        ?>
        <!-- Page Content -->
        <div id="page-content">
            <?php
            include 'pages-header.php';
            ?>
            <!-- Container fluid -->
            <div class="container-fluid p-4">
                <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                        <!-- Page header-->
                        <div class="border-bottom pb-4 mb-4 d-md-flex align-items-center justify-content-between">
                            <div class="mb-3 mb-md-0">
                                <h1 class="mb-1 h2 fw-bold">Micro-Credential Information</h1>
                                <!-- Breadcrumb -->
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">

                                        <li class="breadcrumb-item">
                                            <a href="#">Micro-Credential Details</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">
                                            All
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                            <?php
                            $querymc = $conn->query("SELECT * FROM microcredential 
                                            LEFT JOIN mc_learning_details on mc_learning_details.mcld_mc_id = mc_id
                                            LEFT JOIN mc_course_credit_transfer ON mc_course_credit_transfer.mccct_mc_id = mc_id
                                            LEFT JOIN mc_enrolment_session ON mc_enrolment_session.mces_mc_id = mc_id
                                            LEFT JOIN mc_mou ON mc_mou.mcm_mc_id = mc_id
                                            LEFT JOIN institution ON mc_owner = institution.institution_id
                                            LEFT JOIN university ON institution.institution_university_id = university.university_id    
                                            where mc_id = '$mcid' AND mc_deleted_date IS NULL;");

                            $num = 1;
                            if (mysqli_num_rows($querymc) > 0) {
                                while ($rows = mysqli_fetch_object($querymc)) {
                            ?>
                                    <div>
                                        <?php if ($rows->mc_status == "Processing") { ?>
                                      
                                        <?php } else { ?>
                                            <a class="btn btn-info waves-effect waves-light btn-sm shadow" href="pages-mcreq-edit.php?mcid=<?php echo $mcid; ?>">
                                                <i class="fe fe-edit fs-5 me-1"></i>Edit</a>
                                        <?php } ?>
                                        <?php if ($rows->mc_status == "Processing") { ?>
                                        <a class="btn btn-warning waves-effect waves-light btn-sm shadow text-dark" href="pages-mcreq-content.php?mcid=<?php echo $mcid; ?>">
                                           View Content </a>
                                        <?php } else { ?>    
                                        <a class="btn btn-warning waves-effect waves-light btn-sm shadow text-dark" href="pages-mcreq-content.php?mcid=<?php echo $mcid; ?>">
                                            <i class="fe fe-folder-plus fs-5 me-1"></i> Manage Content </a>
                                            <?php } ?>    
                                        <a class="btn btn-sm btn-secondary waves-effect waves-light shadow" href="pages-mcreq-list.php">
                                            <i class="mdi mdi-keyboard-backspace"></i> Back </a>
                                    </div>
                        </div>

                    </div>


                    <div class="col-lg-3 col-md-4 col-12">
                        <!-- Card -->
                        <div class="card mb-4 shadow-lg ">

                            <img src="../assets/images/microcredential/<?php echo $rows->mc_image; ?>" class="card-img-top rounded-top-md" alt="" height="300">

                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col lh-1">
                                        <span class="fs-4 mb-2 fw-semi-bold d-block text-dark-primary"><?php echo $rows->mc_title; ?></span>
                                    </div>
                                    <div class="col-auto">
                                        <span style="vertical-align: middle;" class="<?php if ($rows->mc_status == 'Published') {
                                                                                            echo "badge bg-success";
                                                                                        } else {
                                                                                            echo "badge bg-warning";
                                                                                        } ?>"><?php echo $rows->mc_status; ?>
                                        </span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-clock text-info fs-4"></i>
                                        <div class="ms-2">
                                            <h5 class="mb-0 text-body">Duration</h5>
                                        </div>
                                    </div>
                                    <div class="">
                                        <div>
                                            <p class="text-dark mb-0 fw-semi-bold"><?php echo $rows->mc_duration; ?></p>
                                        </div>
                                    </div>
                                </div>


                                <div class="d-flex justify-content-between align-items-center mt-1">
                                    <div class="d-flex align-items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-currency-dollar text-success" viewBox="0 0 16 16">
                                            <path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z" />
                                        </svg>
                                        <div class="ms-2">
                                            <h5 class="mb-0 text-body">Cost</h5>
                                        </div>
                                    </div>
                                    <div class="">
                                        <div>
                                            <?php if ($rows->mc_fee == 'Free' || $rows->mc_fee == 'free' || $rows->mc_fee == 'FREE') { ?>
                                                <p class="text-dark mb-0 fw-semi-bold"><?php echo $rows->mc_fee; ?></p>
                                            <?php } else { ?>
                                                <p class="text-dark mb-0 fw-semi-bold">RM <?php echo floatval($rows->mc_fee / 100); ?></p>
                                            <?php
                                            } ?>
                                        </div>
                                    </div>
                                </div>

                                <?php if ($rows->mc_enrollment_date == 'choosedate') {
                                ?>
                                    <div class="d-flex justify-content-between align-items-center mt-1">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-calendar-check text-primary fs-4"></i>
                                            <div class="ms-2">
                                                <h5 class="mb-0 text-body">Start Date</h5>
                                            </div>
                                        </div>
                                        <div class="">
                                            <div>
                                                <p class="text-dark mb-0 fw-semi-bold"><?php echo date('d/m/Y', strtotime($rows->mces_start_date)); ?></p>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="d-flex justify-content-between align-items-center mt-1">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-calendar-x text-danger fs-4"></i>
                                            <div class="ms-2">
                                                <h5 class="mb-0 text-body">End Date</h5>
                                            </div>
                                        </div>
                                        <div class="">
                                            <div>
                                                <p class="text-dark mb-0 fw-semi-bold"><?php echo date('d/m/Y', strtotime($rows->mces_end_date)); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php } else {
                                    }
                                ?>
                                <div class="d-flex justify-content-between align-items-center mt-1">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-shuffle text-secondary fs-4"></i>
                                        <div class="ms-2">
                                            <h5 class="mb-0 text-body">Credit transfer</h5>
                                        </div>
                                    </div>
                                    <div class="">
                                        <div>
                                            <span style="vertical-align: middle;" class="<?php if ($rows->mc_credit_transfer == 'Yes') {
                                                                                                echo "badge rounded-pill bg-light-success text-dark-success";
                                                                                            } else {
                                                                                                echo "badge rounded-pill bg-light-danger text-dark-danger";
                                                                                            } ?>"><?php echo $rows->mc_credit_transfer; ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <?php if ($rows->mc_level != NULL) {
                                ?>
                                    <div class="d-flex justify-content-between align-items-center mt-1">
                                        <div class="d-flex align-items-center">
                                            <!-- <i class="bi bi-clock text-info fs-4"></i> -->
                                            <i class="mdi mdi-school text-warning fs-4"></i>
                                            <div class="ms-2">
                                                <h5 class="mb-0 text-body"> Level</h5>
                                            </div>
                                        </div>
                                        <div class="">
                                            <div>
                                                <?php
                                                $arr = $rows->mc_level;
                                                $sprt = explode(",", $arr);

                                                if ($sprt != NULL) {
                                                    if ($arr != NULL) {
                                                        if (in_array("1", $sprt)) {
                                                            echo ' <p class="text-dark mb-0 fw-semi-bold" style="text-align: right;">Undergraduate</p>';
                                                        }

                                                        if (in_array("2", $sprt)) {
                                                            echo '<p class="text-dark mb-0 fw-semi-bold" style="text-align: right;">Postgraduate</p>';
                                                        }

                                                        if (in_array("3", $sprt)) {
                                                            echo '<p class="text-dark mb-0 fw-semi-bold" style="text-align: right;">Continuing and Professional Development</p>';
                                                        }
                                                    }
                                                } else {
                                                    echo '';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php } else {
                                    }
                                ?>



                                <hr>
                                <div class="row align-items-center g-0 mt-1 ">
                                    <div class="col-auto">
                                        <?php

                                        if ($rows->institution_logo != NULL) {
                                            $ProfilePic = '../assets/images/avatar/' . $rows->institution_logo;
                                        } else {
                                            $ProfilePic = '../assets/images/avatar/university_default.jpg';
                                        }
                                        ?>
                                        <img src="<?php echo $ProfilePic; ?>" alt="" class="rounded-circle avatar-sm me-3">
                                    </div>
                                    <div class="col lh-1">
                                        <h5 class="mb-1"><?php echo $rows->university_name; ?></h5>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-8 col-12">
                        <!-- Card -->
                        <div class="card mb-4 shadow-lg">

                            <div class="card-body">

                                <h4>
                                    About Micro-Credential
                                </h4>
                                <hr>


                                <!-- Accordion flush -->

                                <div class="accordion accordion-flush " id="accordionFlushExample">
                                    <div class="accordion-item shadow bg-light rounded mb-3">
                                        <h2 class="accordion-header" id="flush-headingOne">
                                            <button class="accordion-button collapsed bg-light-success" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                                <i>
                                                    <h4 class="accordion-header" id="headingOne"> Micro-Credential Description</h4>
                                                </i>
                                            </button>
                                        </h2>
                                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <?php echo $rows->mc_description; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item shadow bg-light rounded mb-3">
                                        <h2 class="accordion-header" id="flush-headingTwo">
                                            <button class="accordion-button collapsed bg-light-success" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                                <i>
                                                    <h4 class="accordion-header" id="headingTwo">Learning Outcome</h4>
                                                </i>
                                            </button>
                                        </h2>
                                        <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <?php echo $rows->mcld_learning_outcome; ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item shadow bg-light rounded mb-3">
                                        <h2 class="accordion-header" id="flush-headingThree">
                                            <button class="accordion-button collapsed bg-light-success" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                                <i>
                                                    <h4 class="accordion-header" id="headingThree">Intended Learners of the course</h4>
                                                </i>
                                            </button>
                                        </h2>
                                        <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <?php echo $rows->mcld_intended_learners; ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item shadow bg-light rounded mb-3">
                                        <h2 class="accordion-header" id="flush-headingFour">
                                            <button class="accordion-button collapsed bg-light-success" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                                                <i>
                                                    <h4 class="accordion-header" id="headingThree">Requirements or Prerequisites</h4>
                                                </i>
                                            </button>
                                        </h2>
                                        <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <?php echo $rows->mcld_prerequisites; ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item shadow bg-light rounded mb-3">
                                        <h2 class="accordion-header" id="flush-headingFive">
                                            <button class="accordion-button collapsed bg-light-success" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                                                <i>
                                                    <h4 class="accordion-header" id="headingThree">Specific skills/competencies that participants will be able to achieve</h4>
                                                </i>
                                            </button>
                                        </h2>
                                        <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <?php echo $rows->mcld_skills; ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item shadow bg-light rounded mb-3">
                                        <h2 class="accordion-header" id="flush-headingSix">
                                            <button class="accordion-button collapsed bg-light-success" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseSix">
                                                <i>
                                                    <h4 class="accordion-header" id="headingThree">Memorandum of Understanding</h4>
                                                </i>
                                            </button>
                                        </h2>
                                        <div id="flush-collapseSix" class="accordion-collapse collapse" aria-labelledby="flush-headingSix" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                            <a class="btn btn-outline-warning waves-effect waves-light btn-sm" href="../assets/attachment/microcredential/mouattachment/<?php echo $rows->mcm_attachment; ?>" target="_blank" data-bs-toggle="tooltip" data-placement="top" title="View MoU attachment"> 
                                            <i class="mdi mdi-folder-multiple-image fs-4" aria-hidden="true"></i> View MoU </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item shadow bg-light rounded mb-3">
                                        <h2 class="accordion-header" id="flush-headingSeven">
                                            <button class="accordion-button collapsed bg-light-success" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSeven" aria-expanded="false" aria-controls="flush-collapseSeven">
                                                <i>
                                                    <h4 class="accordion-header" id="headingThree">Collaboration</h4>
                                                </i>
                                            </button>
                                        </h2>
                                        <div id="flush-collapseSeven" class="accordion-collapse collapse" aria-labelledby="flush-headingSeven" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <?php echo $rows->mcm_collaboration ; ?>
                                            </div>
                                        </div>
                                    </div>

                                </div>


                            </div>

                        </div>

                        <?php if ($rows->mc_credit_transfer == 'Yes') { ?>

                            <div class="card mb-2 shadow-lg">

                                <div class="card-body">
                                    <h4>
                                        Credit Transfer Course
                                    </h4>
                                    <hr>
                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        <div>
                                            <h5 class="mb-0 text-body">Course Title</h5>
                                            <p class="text-dark mb-0 fw-semi-bold"><?php echo $rows->mccct_course_title; ?></p>
                                        </div>

                                        <div>
                                            <h5 class="mb-0 text-body">Course Code</h5>
                                            <p class="text-dark mb-0 fw-semi-bold"><?php echo $rows->mccct_course_code; ?></p>
                                        </div>

                                        <div>
                                            <h5 class="mb-0 text-body">Course Level</h5>
                                            <?php
                                            $arr = $rows->mccct_course_level;
                                            $sprt = explode(",", $arr);

                                            if ($sprt != NULL) {
                                                if ($arr != NULL) {
                                                    if (in_array("1", $sprt)) {
                                                        echo ' <p class="text-dark mb-0 fw-semi-bold">Undergraduate</p>';
                                                    }

                                                    if (in_array("2", $sprt)) {
                                                        echo '<p class="text-dark mb-0 fw-semi-bold">Postgraduate</p>';
                                                    }

                                                    if (in_array("3", $sprt)) {
                                                        echo '<p class="text-dark mb-0 fw-semi-bold">Continuing and Professional Development</p>';
                                                    }
                                                }
                                            } else {
                                                echo '';
                                            }
                                            ?>

                                        </div>

                                        <div>
                                            <h5 class="mb-0 text-body">Course Credit</h5>
                                            <?php if ($rows->mccct_course_credit != NULL) { ?>
                                                <p class="text-dark mb-0 fw-semi-bold"><?php echo $rows->mccct_course_credit; ?></p>
                                            <?php } else { ?>
                                                <p class="text-dark mb-0 fw-semi-bold">None</p>
                                            <?php } ?>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        <?php } else {
                                    } ?>

                    </div>


                </div>
            </div>


            <!-- Page Content -->

        <?php
                                }
                            } else {
        ?>
    <?php
                            }
    ?>

        </div>
    </div>



    <script src="../assets/js/theme.min.js"></script>
    <script src="../assets/js/ckeditor.js"></script>

    <script src="https://cdn.ckeditor.com/ckeditor5/29.2.0/classic/ckeditor.js"></script>


    <script>

    </script>
</body>

</html>