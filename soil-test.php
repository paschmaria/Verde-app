<?php 
  include('functions.php');
  if(!$_SESSION['user']){ 
      header("Location: ./login.php"); 
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
                    <span class="avatar avatar-blue">PT</span>
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
                    <a class="dropdown-item" href="./profile">
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
                    <a href="./soil-test" class="nav-link active"><i class="fe fe-layers"></i> Soil Analysis/Recommendations</a>
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
              <div class="col-md-3">
                <h3 class="page-title mb-5">Soil Analysis And Recommendations</h3>
                <div>
                  <div class="list-group list-group-transparent mb-0">
                    <a href="./nutrient" class="list-group-item list-group-item-action d-flex align-items-center">
                      <span class="icon mr-3"><i class="fe fe-file-text"></i></span>Nutrient Management Guide
                    </a>
                    <a href="./resources.html" class="list-group-item list-group-item-action d-flex align-items-center">
                      <span class="icon mr-3"><i class="fe fe-book"></i></span>Crop/Soil Management Resources
                    </a>
                  </div>
                  <div class="mt-6 mb-6">
                    <a href="./soil-test" class="btn btn-secondary btn-block">Conduct Fresh Analysis</a>
                  </div>
                </div>
              </div>
              <div class="col-md-9">
                <form action="" method="post" class="card">
                  <div class="card-header">
                    <h3 class="card-title">Soil Test/Analysis</h3>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-lg-6 col-md-6">
                        <h3>Farm Information</h3>
                        <div class="form-group">
                          <label class="form-label">Farmer Name<span class="form-required">*</span></label>
                          <div class="row gutters-xs">
                            <div class="col-6">
                              <input type="text" class="form-control" placeholder="First name" required>
                            </div>
                            <div class="col-6">
                              <input type="text" class="form-control" placeholder="Last name" required>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="form-label">Farm Location<span class="form-required">*</span></label>
                          <div class="row gutters-xs">
                            <div class="col-6">
                              <select name="location[state]" class="form-control custom-select" required>
                                <option value="">State</option>
                                <option value="1">Kano</option>
                              </select>
                            </div>
                            <div class="col-6">
                              <select name="location[town]" class="form-control custom-select" required>
                                <option value="">Select town or village</option>
                                <option value="1">Ajingi</option>
                                <option value="2">Albasu</option>
                                <option value="3">Bagwai</option>
                                <option value="4">Bari</option>
                                <option value="5">Dala</option>
                                <option value="6">Dambatta</option>
                                <option value="7">Garko</option>
                                <option value="8">Gaya</option>
                                <option value="9">Kabo</option>
                                <option value="10">Kano</option>
                                <option value="11">Madobi</option>
                                <option value="12">Rano</option>
                                <option value="13">Rimin Gado</option>
                                <option value="14">Shanono</option>
                                <option value="15">Sumaila</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="form-label">Farm Size<span class="form-required">*</span></label>
                          <div class="input-group">
                            <input type="number" class="form-control" aria-label="Text input with select dropdown" required>
                            <div class="input-group-append">
                              <select name="land[area]" class="form-control custom-select">
                                <option value="1">Acre</option>
                                <option value="2">Hectare</option>
                                <option value="3">Square Metre</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="form-label">Date of last Fertilizer application<span class="form-required">*</span></label>
                          <div class="row gutters-xs">
                            <div class="col-5">
                              <select name="fertilizer[month]" class="form-control custom-select" required>
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
                              <select name="fertilizer[day]" class="form-control custom-select" required>
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
                              <select name="fertilizer[year]" class="form-control custom-select" required>
                                <option value="">Year</option>
                                <option value="2018">2018</option>
                                <option value="2017">2017</option>
                                <option value="2016">2016</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="form-label">Type of Soil Tillage<span class="form-required">*</span></label>
                          <select name="tillage" class="form-control custom-select" required>
                            <option value="">Choose type</option>
                            <option value="1">Conventional Tillage</option>
                            <option value="2">Conservation Tillage</option>
                            <option value="3">No-till</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label class="form-label">Planted Crop(s)<span class="form-required">*</span></label>
                          <input type="text" class="form-control" name="crops" id="input-tags" value="Wheat" required>
                        </div>
                        <script>
                          require(['jquery', 'selectize'], function ($, selectize) {
                            $('#input-tags').selectize({
                                plugins: ['remove_button'],
                                delimiter: ',',
                                persist: false,
                                create: function (input) {
                                    return {
                                        value: input,
                                        text: input
                                    }
                                }
                            });
                          });
                        </script>
                      </div>
                      <div class="col-lg-6 col-md-6">
                        <h3>Sample Information</h3>
                        <div class="row">
                          <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                              <label class="form-label">Amt. of Samples Collected<span class="form-required">*</span></label>
                              <input type="number" class="form-control" required>
                            </div>
                          </div>
                          <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                              <label class="form-label">Av. Sample Size<span class="form-required">*</span></label>
                              <div class="input-group">
                                <input type="number" class="form-control" aria-label="Text input with select dropdown" required>
                                <div class="input-group-append">
                                  <select name="sample_size" class="form-control custom-select">
                                    <option value="1">mg</option>
                                    <option value="2">g</option>
                                    <option value="3">kg</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="form-label">Sampled Soil Depth (cm)<span class="form-required">*</span></label>
                          <div>
                            <label class="custom-control custom-checkbox custom-control-inline">
                              <input type="checkbox" class="custom-control-input" name="" value="0_2">
                              <span class="custom-control-label">0-15</span>
                            </label>
                            <label class="custom-control custom-checkbox custom-control-inline">
                              <input type="checkbox" class="custom-control-input" name="" value="2_4">
                              <span class="custom-control-label">15-30</span>
                            </label>
                            <label class="custom-control custom-checkbox custom-control-inline">
                              <input type="checkbox" class="custom-control-input" name="" value="4_6">
                              <span class="custom-control-label">30-45</span>
                            </label>
                            <label class="custom-control custom-checkbox custom-control-inline">
                              <input type="checkbox" class="custom-control-input" name="" value="6_8">
                              <span class="custom-control-label">>45</span>
                            </label>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="form-label">Sampled Soil Type<span class="form-required">*</span></label>
                          <select name="soil_type" class="form-control custom-select" required>
                            <option value="">Choose type</option>
                            <option value="clay">Clay</option>
                            <option value="loam">Loam</option>
                            <option value="sand">Sand</option>
                            <option value="silt">Silt</option>
                            <option value="sandy_clay">Sandy Clay</option>
                            <option value="silty_clay">Silty Clay</option>
                            <option value="clay_loam">Clay Loam</option>
                            <option value="loamy_sand">Loamy Sand</option>
                            <option value="sandy_loam">Sandy Loam</option>
                            <option value="silt_loam">Silt Loam</option>
                            <option value="silt_clay_loam">Silt Clay Loam</option>
                            <option value="sandy_clay_loam">Sandy Clay Loam</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label class="form-label">Soil pH<span class="form-required">*</span></label>
                          <div class="row">
                            <div class="col">
                              <input type="range" id="pHRange" class="form-control custom-range" step="1" min="0" max="14">
                            </div>
                            <div class="col">
                              <input type="number" id="pHBox" class="form-control" value="14" required>
                            </div>
                          </div>
                        </div>
                        <script>
                          var slider = document.getElementById("pHRange");
                          var output = document.getElementById("pHBox");
                          output.value = slider.value;
                          slider.oninput = function() {
                            output.value = this.value;
                          }
                          output.oninput = function() {
                            slider.value = this.value;
                          }
                        </script>
                        <h3>Soil Nutrient Element Ratings</h3>
                        <div class="form-group">
                          <label class="form-label">Nitrogen (g/kg)<span class="form-required">*</span></label>
                          <div class="selectgroup w-100">
                            <label class="selectgroup-item">
                              <input type="radio" name="nitrogen" class="selectgroup-input" checked="">
                              <span class="selectgroup-button"><0.5</span>
                            </label>
                            <label class="selectgroup-item">
                              <input type="radio" name="nitrogen" class="selectgroup-input">
                              <span class="selectgroup-button">0.6 - 1.5</span>
                            </label>
                            <label class="selectgroup-item">
                              <input type="radio" name="nitrogen" class="selectgroup-input">
                              <span class="selectgroup-button">1.5 - 2.0</span>
                            </label>
                            <label class="selectgroup-item">
                              <input type="radio" name="nitrogen" class="selectgroup-input">
                              <span class="selectgroup-button">>2.0</span>
                            </label>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="form-label">Phosphorus (Bray-1-P) (mg/kg)<span class="form-required">*</span></label>
                          <div class="selectgroup w-100">
                            <label class="selectgroup-item">
                              <input type="radio" name="phosphorus" class="selectgroup-input" checked="">
                              <span class="selectgroup-button"><3.0</span>
                            </label>
                            <label class="selectgroup-item">
                              <input type="radio" name="phosphorus" class="selectgroup-input">
                              <span class="selectgroup-button">3.0 - 7.0</span>
                            </label>
                            <label class="selectgroup-item">
                              <input type="radio" name="phosphorus" class="selectgroup-input">
                              <span class="selectgroup-button">8.0 - 20</span>
                            </label>
                            <label class="selectgroup-item">
                              <input type="radio" name="phosphorus" class="selectgroup-input">
                              <span class="selectgroup-button">>20</span>
                            </label>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="form-label">Potassium (Exc. K) (cmol/kg)<span class="form-required">*</span></label>
                          <div class="selectgroup w-100">
                            <label class="selectgroup-item">
                              <input type="radio" name="potassium" class="selectgroup-input" checked="">
                              <span class="selectgroup-button"><0.2</span>
                            </label>
                            <label class="selectgroup-item">
                              <input type="radio" name="potassium" class="selectgroup-input">
                              <span class="selectgroup-button">0.21 - 0.3</span>
                            </label>
                            <label class="selectgroup-item">
                              <input type="radio" name="potassium" class="selectgroup-input">
                              <span class="selectgroup-button">0.31 - 0.6</span>
                            </label>
                            <label class="selectgroup-item">
                              <input type="radio" name="potassium" class="selectgroup-input">
                              <span class="selectgroup-button">>0.6</span>
                            </label>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="form-label">Organic Carbon (g/kg)<span class="form-required">*</span></label>
                          <div class="selectgroup w-100">
                            <label class="selectgroup-item">
                              <input type="radio" name="carbon" class="selectgroup-input" checked="">
                              <span class="selectgroup-button"><4.0</span>
                            </label>
                            <label class="selectgroup-item">
                              <input type="radio" name="carbon" class="selectgroup-input">
                              <span class="selectgroup-button">4.0 - 10</span>
                            </label>
                            <label class="selectgroup-item">
                              <input type="radio" name="carbon" class="selectgroup-input">
                              <span class="selectgroup-button">10 - 14</span>
                            </label>
                            <label class="selectgroup-item">
                              <input type="radio" name="carbon" class="selectgroup-input">
                              <span class="selectgroup-button">>14</span>
                            </label>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="form-label">Zinc (DPTA) (mg/kg)<span class="form-required">*</span></label>
                          <div class="selectgroup w-100">
                            <label class="selectgroup-item">
                              <input type="radio" name="zinc" class="selectgroup-input" checked="">
                              <span class="selectgroup-button">0</span>
                            </label>
                            <label class="selectgroup-item">
                              <input type="radio" name="zinc" class="selectgroup-input">
                              <span class="selectgroup-button"><1.0</span>
                            </label>
                            <label class="selectgroup-item">
                              <input type="radio" name="zinc" class="selectgroup-input">
                              <span class="selectgroup-button">1.0 - 5.0</span>
                            </label>
                            <label class="selectgroup-item">
                              <input type="radio" name="zinc" class="selectgroup-input">
                              <span class="selectgroup-button">>5.0</span>
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">Submit</button>
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