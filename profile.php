<?php 
  include('functions.php');
  if(!$_SESSION['user']){ 
      header("Location: ./login"); 
      exit; 
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en" />
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#817729">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <link rel="icon" href="assets/images/favico.ico" type="image/x-icon"/>
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favico.ico" />
    <title>Verde - Agricultural Extension and Analytics</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
    <script src="./assets/js/require.min.js"></script>
    <script>
      setTimeout(hideURLbar, 0);
      function hideURLbar(){
        window.scrollTo(0,1);
      }
      requirejs.config({
          baseUrl: '.'
      });
      
    </script>
    <!-- Dashboard Core -->
    <link href="./assets/css/dashboard.css" rel="stylesheet" />
    <script src="./assets/js/dashboard.js"></script>
    <!-- c3.js Charts Plugin -->
    <link href="./assets/plugins/charts-c3/plugin.css" rel="stylesheet" />
    <script src="./assets/plugins/charts-c3/plugin.js"></script>
    <!-- Google Maps Plugin -->
    <link href="./assets/plugins/maps-google/plugin.css" rel="stylesheet" />
    <script src="./assets/plugins/maps-google/plugin.js"></script>
    <!-- Input Mask Plugin -->
    <script src="./assets/plugins/input-mask/plugin.js"></script>
  </head>
  <body class="">
    <div class="page">
      <div class="page-main">
        <div class="header py-4">
          <div class="container">
            <div class="d-flex">
              <a class="header-brand" href="./dashboard">
                <img src="./assets/images/logo.png" class="header-brand-img" alt="[VERDE]">
              </a>
              <div class="d-flex order-lg-2 ml-auto">
                <div class="dropdown d-none d-md-flex">
                  <a class="nav-link icon" data-toggle="dropdown">
                    <i class="fe fe-bell"></i>
                    <span class="nav-unread"></span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                    <a href="#" class="dropdown-item d-flex">
                      <!-- <span class="avatar mr-3 align-self-center" style="background-image: url(demo/faces/male/41.jpg)"></span> -->
                      <div>
                        <p>New farmer signed on - <strong>Musa Abdullahi</strong></p>
                        <div class="small text-muted">10 minutes ago</div>
                      </div>
                    </a>
                    <a href="#" class="dropdown-item d-flex">
                      <div>
                        <p>50 messages sent to farmers in <strong>Kano State</strong></p>
                        <div class="small text-muted">1 hour ago</div>
                      </div>
                    </a>
                    <a href="#" class="dropdown-item d-flex">
                      <div>
                        <p>5 voice calls were not picked.</p>
                        <div class="small text-muted">2 hours ago</div>
                      </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item text-center text-muted-dark">Mark all as read</a>
                  </div>
                </div>
                <div class="dropdown">
                  <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                    <span class="avatar avatar-blue">
                        PT
                    </span>
                    <span class="ml-2 d-none d-lg-block">
                      <span class="text-primary">
                        <?php 
                          if ($_SESSION['user']['firstname']) {
                            echo $_SESSION['user']['firstname'].' '.$_SESSION['user']['lastname'];
                          } else {
                            echo ucfirst($_SESSION['user']['username']);
                          }
                        ?>  
                      </span>
                      <small class="text-muted d-block mt-1">
                        <?php echo ucfirst($_SESSION['user']['user_type']); ?>
                      </small>
                    </span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                    <a class="dropdown-item active" href="./profile">
                      <i class="dropdown-icon fe fe-user"></i> Profile
                    </a>
                    <a class="dropdown-item" href="#">
                      <i class="dropdown-icon fe fe-settings"></i> Settings
                    </a>
                    <a class="dropdown-item" href="#">
                      <span class="float-right"><span class="badge badge-primary">6</span></span>
                      <i class="dropdown-icon fe fe-mail"></i> Inbox
                    </a>
                    <!-- <a class="dropdown-item" href="#">
                      <i class="dropdown-icon fe fe-send"></i> Message
                    </a> -->
                    <div class="dropdown-divider"></div>
                    <!-- <a class="dropdown-item" href="#">
                      <i class="dropdown-icon fe fe-help-circle"></i> Need help?
                    </a> -->
                    <a class="dropdown-item" href="../login.html">
                      <i class="dropdown-icon fe fe-log-out"></i> Sign out
                    </a>
                  </div>
                </div>
              </div>
              <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
                <span class="header-toggler-icon"></span>
              </a>
            </div>
          </div>
        </div>
        <div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
          <div class="container">
            <div class="row align-items-center">
              <div class="col-lg-3 ml-auto">
                <form class="input-icon my-3 my-lg-0">
                  <input type="search" class="form-control header-search" placeholder="Search&hellip;" tabindex="1">
                  <div class="input-icon-addon">
                    <i class="fe fe-search"></i>
                  </div>
                </form>
              </div>
              <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                  <li class="nav-item">
                    <a href="./dashboard" class="nav-link"><i class="fe fe-home"></i> Dashboard</a>
                  </li>
                  <li class="nav-item">
                    <a href="./register-farmer" class="nav-link"><i class="fe fe-user-plus"></i> Register A Farmer</a>
                  </li>
                  <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-users"></i> Farmers</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="./farmer-overview" class="dropdown-item"><i class="fe fe-box"></i> Overview</a>
                      <a href="./farmer-biodata" class="dropdown-item"><i class="fe fe-file-text"></i> Bio-data</a>
                      <a href="./farmer-demography" class="dropdown-item"><i class="fe fe-bar-chart-2"></i> Demographics</a>
                      <a href="./farmer-cropinfo" class="dropdown-item"><i class="fe fe-activity"></i> Crop Information</a>
                    </div>
                  </li>
                  <li class="nav-item">
                    <a href="./soil-test" class="nav-link"><i class="fe fe-layers"></i> Soil Analysis/Recommendations</a>
                  </li>
                  <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-send"></i> Push</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="./sms" class="dropdown-item"><i class="fe fe-message-square"></i> SMS</a>
                      <!-- <a href="./charts" class="dropdown-item">Charts</a> -->
                      <a href="./voice" class="dropdown-item"><i class="fe fe-phone-outgoing"></i> Voice Calls</a>
                    </div>
                  </li>
                  <li class="nav-item dropdown">
                    <a href="./reports" class="nav-link"><i class="fe fe-file-text"></i> Reports</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="my-3 my-md-5">
          <div class="container">
            <div class="row">
              <div class="col-lg-4">
                <div class="card card-profile">
                  <div class="card-header">
                  </div>
                  <div class="card-body text-center">
                    <img class="card-profile-img" src="./assets/images/user.png">
                    <h3 class="mb-3">
                        <?php
                            if ($_SESSION['user']['firstname']) {
                                echo $_SESSION['user']['firstname'].' '.$_SESSION['user']['lastname'];
                            } else {
                                echo "User";
                            }
                        ?>
                    </h3>
                    <p class="mb-4">
                      <small class="d-block">
                        @<?php
                            echo $_SESSION['user']['username'];
                        ?>
                      </small>
                      <span>
                          <?php
                            echo ucfirst($_SESSION['user']['user_type']);
                          ?>
                      </span>
                    </p>
                    <a href="mailto:<?php echo $_SESSION['user']['email'];?>" class="btn-sm btn-outline-primary btn">
                        <?php
                            echo $_SESSION['user']['email'];
                        ?>
                    </a>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">My Profile</h3>
                  </div>
                  <div class="card-body">
                     <div class="">
                      <h5>About Me</h5>
                      <p>
                        <?php
                            if ($_SESSION['user']['bio']) {
                                echo $_SESSION['user']['bio'];
                            } else {
                                echo "N/A";
                            }
                        ?>
                      </p>
                    </div>
                    <div class="">
                      <h5>Phone number</h5>
                      <p>
                        <?php
                            if ($_SESSION['user']['phone']) {
                                echo $_SESSION['user']['phone'];
                            } else {
                                echo "N/A";
                            }
                        ?>
                      </p>
                    </div>
                    <div class="row">
                      <div class="col-md-6 col-sm-12">
                        <h5>Date of Birth</h5>
                        <p>
                            <?php
                                if ($_SESSION['user']['date_of_birth']) {
                                    echo $_SESSION['user']['date_of_birth'];
                                } else {
                                    echo "N/A";
                                }
                            ?>
                        </p>
                      </div>
                      <div class="col-md-6 col-sm-12">
                        <h5>Gender</h5>
                        <p>
                            <?php
                                if ($_SESSION['user']['gender']) {
                                    echo $_SESSION['user']['gender'];
                                } else {
                                    echo "N/A";
                                }
                            ?>
                        </p>
                      </div>
                    </div>
                    <div class="">
                      <h5>Highest Educational Level</h5>
                      <p>
                        <?php
                            if ($_SESSION['user']['education']) {
                                echo $_SESSION['user']['education'];
                            } else {
                                echo "N/A";
                            }
                        ?>
                      </p>
                    </div>
                    <div class="">
                      <h5>Degree - If available</h5>
                      <p>
                        <?php
                            if ($_SESSION['user']['degree']) {
                                echo $_SESSION['user']['degree'];
                            } else {
                                echo "N/A";
                            }
                        ?>
                      </p>
                    </div>
                    <div class="">
                      <h5>Address</h5>
                      <p>
                        <?php
                            if ($_SESSION['user']['address']) {
                                echo $_SESSION['user']['address'];
                            } else {
                                echo "N/A";
                            }
                        ?>
                      </p>
                    </div>
                    <div class="">
                      <h5>State of Residence</h5>
                      <p>
                        <?php
                            if ($_SESSION['user']['state']) {
                                echo $_SESSION['user']['state'];
                            } else {
                                echo "N/A";
                            }
                        ?>
                      </p>
                    </div>
                    <div class="">
                      <h5>Local Government Area (LGA)</h5>
                      <p>
                        <?php
                            if ($_SESSION['user']['lga']) {
                                echo $_SESSION['user']['lga'];
                            } else {
                                echo "N/A";
                            }
                        ?>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-8">
                <form class="card">
                  <div class="card-body">
                    <h3 class="card-title">Edit Profile</h3>
                    <div class="row">
                      <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                          <label class="form-label">First Name<span class="form-required">*</span></label>
                          <input type="text" class="form-control" placeholder="First Name" required>
                        </div>
                      </div>
                      <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                          <label class="form-label">Last Name<span class="form-required">*</span></label>
                          <input type="text" class="form-control" placeholder="Last Name" required>
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                          <label class="form-label">Date of Birth<span class="form-required">*</span></label>
                          <div class="row gutters-xs">
                            <div class="col-5">
                              <select name="user[month]" class="form-control custom-select" required>
                                <option value="">Month</option>
                                <option value="1">January</option>
                                <option value="2">February</option>
                                <option value="3">March</option>
                                <option value="4">April</option>
                                <option value="5">May</option>
                                <option value="6">June</option>
                                <option value="7">July</option>
                                <option value="8">August</option>
                                <option value="9">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                              </select>
                            </div>
                            <div class="col-3">
                              <select name="user[day]" class="form-control custom-select" required>
                                <option value="">Day</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>
                              </select>
                            </div>
                            <div class="col-4">
                              <select name="user[year]" class="form-control custom-select" required>
                                <option value="">Year</option>
                                <option value="2000">2000</option>
                                <option value="1999">1999</option>
                                <option value="1998">1998</option>
                                <option value="1997">1997</option>
                                <option value="1996">1996</option>
                                <option value="1995">1995</option>
                                <option value="1994">1994</option>
                                <option value="1993">1993</option>
                                <option value="1992">1992</option>
                                <option value="1991">1991</option>
                                <option value="1990">1990</option>
                                <option value="1989">1989</option>
                                <option value="1988">1988</option>
                                <option value="1987">1987</option>
                                <option value="1986">1986</option>
                                <option value="1985">1985</option>
                                <option value="1984">1984</option>
                                <option value="1983">1983</option>
                                <option value="1982">1982</option>
                                <option value="1981">1981</option>
                                <option value="1980">1980</option>
                                <option value="1979">1979</option>
                                <option value="1978">1978</option>
                                <option value="1977">1977</option>
                                <option value="1976">1976</option>
                                <option value="1975">1975</option>
                                <option value="1974">1974</option>
                                <option value="1973">1973</option>
                                <option value="1972">1972</option>
                                <option value="1971">1971</option>
                                <option value="1970">1970</option>
                                <option value="1969">1969</option>
                                <option value="1968">1968</option>
                                <option value="1967">1967</option>
                                <option value="1966">1966</option>
                                <option value="1965">1965</option>
                                <option value="1964">1964</option>
                                <option value="1963">1963</option>
                                <option value="1962">1962</option>
                                <option value="1961">1961</option>
                                <option value="1960">1960</option>
                                <option value="1959">1959</option>
                                <option value="1958">1958</option>
                                <option value="1957">1957</option>
                                <option value="1956">1956</option>
                                <option value="1955">1955</option>
                                <option value="1954">1954</option>
                                <option value="1953">1953</option>
                                <option value="1952">1952</option>
                                <option value="1951">1951</option>
                                <option value="1950">1950</option>
                                <option value="1949">1949</option>
                                <option value="1948">1948</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-5">
                        <div class="form-group">
                          <label class="form-label">Username</label>
                          <input type="text" class="form-control" disabled="" placeholder="Username" value="<?php echo $_SESSION['user']['username'];?>">
                        </div>
                      </div>
                      <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                          <label class="form-label">Phone Number<span class="form-required">*</span></label>
                          <input type="number" class="form-control" placeholder="Phone Number" required>
                        </div>
                      </div>
                      <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                          <label class="form-label">Email address<span class="form-required">*</span></label>
                          <input type="email" class="form-control" placeholder="Email" required>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="form-label">Address<span class="form-required">*</span></label>
                          <input type="text" class="form-control" placeholder="Address" required>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-12">
                        <div class="form-group">
                          <label class="form-label">Highest Level of Education<span class="form-required">*</span></label>
                          <select name="education" class="form-control custom-select" required>
                            <option value="">Select</option>
                            <option value="1">None</option>
                            <option value="2">Quaranic</option>
                            <option value="3">Primary</option>
                            <option value="4">Secondary</option>
                            <option value="5">Tertiary</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-12">
                        <div class="form-group">
                          <label class="form-label">Degree - If available</label>
                          <select name="education" class="form-control custom-select">
                            <option value="">Select</option>
                            <option value="1">None</option>
                            <option value="2">Quaranic</option>
                            <option value="3">Primary</option>
                            <option value="4">Secondary</option>
                            <option value="5">Tertiary</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                          <label class="form-label">State of Residence<span class="form-required">*</span></label>
                          <select name="state" class="form-control custom-select" required>
                            <option value="">Select state</option>
                            <option value="1">Kano</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="form-label">Local Government Area<span class="form-required">*</span></label>
                          <select name="town" class="form-control custom-select" required>
                            <option value="">Select LGA</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group mb-0">
                          <label class="form-label">About Me</label>
                          <textarea rows="5" class="form-control" placeholder="Brief description about you..."></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">Update Profile</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-12 col-lg-auto mt-3 mt-lg-0 text-center">
              Copyright © 2018 <a href="../index.html" target="_blank" class="text-primary">Plurimus Technologies</a>. All rights reserved.
            </div>
          </div>
        </div>
      </footer>
    </div>
  </body>
</html>