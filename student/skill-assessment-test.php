<?php
    include('function/student-function.php');
?>
<!DOCTYPE html>
<html lang="en">
<?php
    include('pages-head.php');
?>

<body>
    <!-- Navbar -->
<?php
    include('pages-topbar.php');

  
?>

    <!-- Page Header -->
    <div class="bg-info py-4 py-lg-6">
        <div class="container">
            <div class="row align-items-center">
            
            </div>
        </div>
    </div>

    <!-- Page Content -->
    <div class="py-6">
        <div class="container">
            <div class="row">
                <!-- Manage Content -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-4">
                    <div class="row d-lg-flex justify-content-between align-items-center">
                      
                        
                      
                        <div id="job-filter" class="d-inline-flex align-items-center justify-content-end col-md-9 col-lg-9 col-xl-9">
                           
                            <!-- <div class="d-inline-flex col-md-3 col-lg-3 col-xl-3 justify-content-end me-2">
                            <select class="selectpicker" data-width="100%" name="st_industry_field" required>
                            <option value="">Choose</option>
                            <?php
                            $query1 = $conn->query("SELECT * FROM industry_field");


                            if (mysqli_num_rows($query1) > 0) {
                              while ($rows = mysqli_fetch_object($query1)) {

                            ?>
                                <option value="<?php echo $rows->industry_field_id; ?>"><?php echo $rows->industry_field_name; ?> </option>

                              <?php }
                            } else {
                              ?>
                            <?php

                            } ?>
                          </select>
                            </div> -->
                            <!-- Date Posted  -->
                            <!-- <div class="d-inline-flex col-md-3 col-lg-3 col-xl-3 justify-content-end me-2">
                                <select id="date-posted-filter" class="selectpicker" data-width="100%" autocomplete="off" title="Date posted">
                                    <optgroup label="Date posted">
                                        <option value="anytime" selected>Anytime</option>
                                        <option value="24h">Last 24 hours</option>
                                        <option value="3d">Last 3 days</option>
                                        <option value="7d">Last 7 days</option>
                                        <option value="14d">Last 14 days</option>
                                        <option value="30d">Last 30 days</option>
                                    </optgroup>
                                </select>
                            </div> -->

                             <!-- <div class="d-inline-flex justify-content-end col-md-1 col-lg-1 col-xl-1">
                                <button class="btn btn-outline-warning btn-sm">Reset</button>
                            </div> 
                            <div class="d-inline-flex justify-content-end col-md-1 col-lg-1 col-xl-1">
                                <button id="apply-filter" class="btn btn-info btn-sm">Apply</button>
                            </div> -->
                        </div>
                    </div>
                </div>

                <!-- Job Offers -->
                

                <!-- Job Description -->
                <div class="col-xl-12 col-lg-12 col-md-12 col-12 mb-4 mb-xl-0">
                    <div id="job-desc-card" class="card">
                        <div class="card-header border-bottom">
                            <h4 class="mb-0">Quiz Description</h4>
                        </div>
                        <div class="card-body px-5 mb-4 scrollbar" style="min-height: 300px; max-height: 600px;">
                            
                        <h3 class="mb-2 ">Quiz</h3>
                                    <p style="text-align: justify; text-justify: inter-word;">
                                        A quiz is a quick and informal assessment of student knowledge. Quizzes are often used in higher education environments 
                                        to briefly test a students' level of comprehension regarding course material, providing teachers with insights into student progress 
                                        and any existing knowledge gaps.
                                    </p>
                                  
                                   
                                    <!-- Quiz Lists -->
                            <?php
                            
                                $skQuiz = $skInfo->fetch_quiz($suID);
 
                                if($skQuiz === NULL) {
                            ?>
                                    <!-- ## No Contents -->
                                    <div class="mt-4 mb-4 text-center">
                                        <h3 class="display-5">Sorry! There's no content available.</h3>
                                        <p class="lead">The instructor will add this soon.</p>
                                    </div>
                            <?php
                                } else {
                                    for($i = 0; $i < count($skQuiz); $i++) {
                                        $checkIcon = "";
                                        
                                        // Check if the quiz already attempted or not.
                                        $skResult = $skInfo->fetch_quiz_result($skQuiz[$i]["st_id"]);
                                        if($skResult !== NULL) {
                                            $checkIcon = '<span class="badge rounded-pill bg-success" data-bs-toggle="tooltip" data-placement="top" title="Completed">Completed</span>';
                                            $attempt = "<span class='text-dark'>1</span>";
                                            $score = "<span class='text-dark'>".$skResult["susatqrs_grade"]."</span>";
                                            $attemptBtn = "collapse";
                                            $reviewBtn = "";
                                        } else {
                                            $attempt = 0;
                                            $score = 0;
                                            $attemptBtn = "";
                                            $reviewBtn = "collapse";
                                        }
                                        ?>
                                    <div class="card border">
                                        <div class="card-header m-2" id="quizHeading<?= $i + 1 ?>">
                                            <h4 class="mb-0">
                                                <a href="#" class="d-flex align-items-center text-inherit text-decoration-none active collapsed" data-bs-toggle="collapse" 
                                                  data-bs-target="#quizCollapse<?= $i + 1 ?>" aria-expanded="false" aria-controls="quizCollapse<?= $i + 1 ?>">
                                                    <div class="me-auto">
                                                        <?= $skQuiz[$i]["st_title"] ?>
                                                        <?= $checkIcon ?>
                                                    </div>
                                                    <span class="chevron-arrow ms-4">
                                                        <i class="fe fe-chevron-down fs-4"></i>
                                                    </span>
                                                </a>
                                            </h4>
                                            <p class="mb-0">
                                                <small>Date created: <?= date_format(date_create($skQuiz[$i]["st_created_date"]), "d/m/Y") ?></small>
                                            </p>
                                        </div>
                                        <!-- ## to show the content = add 'show' to [class] -->
                                        <div id="quizCollapse<?= $i + 1 ?>" class="collapse" aria-labelledby="quizHeading<?= $i + 1 ?>" data-bs-parent="#quiz">
                                            <div class="card-body">
                                                <?= $skQuiz[$i]["st_instruction"] ?>
                                            </div>
                                            <div class="card-body">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                      <tr>
                                                        <th class="table-primary" scope="row">Attempts</th>
                                                        <td><?= $attempt ?></td>
                                                      </tr>
                                                      <tr>
                                                        <th class="table-primary" scope="row">Time limit</th>
                                                        <td><?= $skQuiz[$i]["st_duration"] !== NULL ? durationFormat($skQuiz[$i]["st_duration"], '%2d Hours and %2d Minutes') : "<em class='text-muted'>Not set</em>" ?></td>
                                                      </tr>
                                                      <tr>
                                                        <th class="table-primary" scope="row">Score</th>
                                                        <td><?= $score ?>%</td>
                                                      </tr>
                                                    </tbody>
                                                </table>
                                                <!-- Attempt quiz -->
                                                <div class="d-grid gap-2 col-6 mx-auto">
                                                    <button type="button" class="btn btn-primary <?= $attemptBtn ?>"
                                                        onclick="window.open('skill-quiz-attempt-main.php?st_id=<?= $skQuiz[$i]['st_id'] ?>', '_self');">
                                                        Start Attempt
                                                    </button>
                                                    <button type="button" class="btn btn-success <?= $reviewBtn ?>"
                                                        onclick="window.open('skill-quiz-attempt-review.php?st_id=<?= $skQuiz[$i]['st_id'] ?>', '_self');">
                                                        Quiz Review
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <?php }}?>
                                    </div> <!-- Job details -->
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	
<!-- Footer -->
<?php
    require_once("pages-footer.php");
?>

    <!-- Script -->
    <!-- Theme JS -->
    <script src="../assets/js/theme.min.js"></script>
    <!-- Job Search JS -->
    <script src="js/search-job.js"></script>

</body>

</html>