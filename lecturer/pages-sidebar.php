  <!-- Sidebar -->
  <nav class="navbar-vertical navbar">
      <div class="nav-scroller">
          <!-- Brand logo -->
          <a class="navbar-brand" href="dashboard.php">
              <img src="../assets/images/logo/logo_unicreds.png" alt="" />
          </a>
          <!-- Navbar nav -->
          <ul class="navbar-nav flex-column" id="sideNavbar">
              <li class="nav-item">
                  <a class="<?php
                            if ($_SESSION['pages'] == 'dashboard') {
                                echo ('active');
                            }
                            ?> nav-link  " href="dashboard.php">
                      <i class="nav-icon mdi mdi-view-dashboard me-2"></i> Dashboard
                  </a>

              </li>

              <li class="nav-item">
                  <a class="<?php
                            if ($_SESSION['pages'] == 'mc') {
                                echo ('active');
                            }
                            ?> nav-link " href="pages-microcredential-list.php">
                      <i class="nav-icon fe fe-book me-2"></i>
                      Micro-Credential
                  </a>

              </li>

              <li class="nav-item">
                  <a class="<?php
                            if ($_SESSION['pages'] == 'course') {
                                echo ('active');
                            }
                            ?> nav-link  " href="pages-course-list.php">
                      <i class="nav-icon fe fe-book-open me-2"></i> Course
                  </a>

              </li>

              <li class="nav-item">
                  <div class="nav-divider"></div>
              </li>

              <li class="nav-item">
                  <a class="<?php
                            if ($_SESSION['pages'] == 'announcement') {
                                echo ('active');
                            }
                            ?> nav-link" href="pages-announcement.php">
                      <i class="nav-icon mdi mdi-bullhorn me-2"></i> Announcement
                  </a>
              </li>  

              <!-- Nav item -->
              <li class="nav-item">
                  <a class="nav-link " href="#!" data-bs-toggle="collapse" data-bs-target="#navForum" aria-expanded="false" aria-controls="navForum">
                  <i class="nav-icon mdi mdi-comment-multiple-outline me-2"></i> Forum
                  </a>
                  <div id="navForum" class="collapse <?php
                                                        if ($_SESSION['pages'] == 'forummc' || $_SESSION['pages'] == 'forumcourse') {
                                                            echo ('show');
                                                        } ?>" data-bs-parent="#sideNavbar">
                      <ul class="nav flex-column">

                          <li class="nav-item">
                              <a class="<?php
                                        if ($_SESSION['pages'] == 'forumcourse') {
                                            echo ('active');
                                        }
                                        ?> nav-link" href="pages-forum-course.php">Course</a>
                          </li>
                          <li class="nav-item">
                              <a class="<?php
                                        if ($_SESSION['pages'] == 'forummc') {
                                            echo ('active');
                                        }
                                        ?> nav-link " href="pages-forum-mc.php">Micro-Credential</a>
                          </li>

                      </ul>
                  </div>
              </li>
 

          </ul>
      </div>
  </nav>