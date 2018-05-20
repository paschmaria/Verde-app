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
    <!-- Skycons -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/skycons/1396634940/skycons.min.js'></script>
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
                    <a class="dropdown-item" href="dashboard?logout='1'">
                      <i class="dropdown-icon fe fe-log-out"></i> Log out
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
                    <a href="./dashboard" class="nav-link"><i class="fe fe-home"></i> Home</a>
                  </li>
                  <li class="nav-item">
                    <a href="./register-farmer" class="nav-link active"><i class="fe fe-user-plus"></i> Register A Farmer</a>
                  </li>
                  <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-users"></i> Farmers</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="./empty" class="dropdown-item"><i class="fe fe-box"></i> Overview</a>
                      <!-- <a href="./empty" class="dropdown-item">Maps</a> -->
                      <a href="./empty" class="dropdown-item"><i class="fe fe-file-text"></i> Bio-data</a>
                      <a href="./empty" class="dropdown-item"><i class="fe fe-bar-chart-2"></i> Demography</a>
                      <a href="./empty" class="dropdown-item"><i class="fe fe-activity"></i> Crop Information</a>
                    </div>
                  </li>
                  <li class="nav-item">
                    <a href="./soil-test" class="nav-link"><i class="fe fe-layers"></i> Soil Analysis/Recommendations</a>
                  </li>
                  <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-send"></i> Push</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="./sms" class="dropdown-item"><i class="fe fe-message-square"></i> SMS</a>
                      <!-- <a href="./charts.html" class="dropdown-item">Charts</a> -->
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
              <div class="col-12">
                <form action="" method="post" class="card">
                  <div class="card-header">
                    <h3 class="card-title">Register New Farmer</h3>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-lg-6 col-md-6">
                        <h3>Farmer Information</h3>
                        <div class="row gutters-md">
                          <div class="col-lg-7 col-md-6 order-last order-sm-first">
                            <div class="form-group">
                              <label class="form-label">First name<span class="form-required">*</span></label>
                              <input type="text" class="form-control" required>
                            </div>
                            <div class="form-group">
                              <label class="form-label">Last name<span class="form-required">*</span></label>
                              <input type="text" class="form-control" required>
                            </div>
                            <div class="form-group">
                              <label class="form-label">Primary Phone Number<span class="form-required">*</span></label>
                              <input type="text" class="form-control" required>
                            </div>
                          </div>
                          <div class="col-lg-5 col-md-6 order-first order-sm-last m-h mb-4">
                            <div class="text-center pb-1">
                              <span>Click to add or change picture</span>
                            </div>
                            <div class="form-group m-0" style="height: calc(100% - 26px);">
                              <label for="farmer-pic-input" id="farmer-pic-wrapper" class="m-0">
                                <img src="./assets/images/image.png" alt="" class="img-fluid camera">
                                <div id="picPreview" class="p-1" style="height: inherit;"></div>
                              </label>
                              <input type="file" name="farmer-pic" id="farmer-pic-input" onchange="getPicture(this.files);" accept="image/*">
                            </div>
                          </div>
                        </div>
                        <script>
                          function getPicture(files) {
                             var camera = document.querySelector(".camera"),
                                preview = document.querySelector("#picPreview"),
                               imgInput = document.querySelector("#farmer-pic-input");
                            var file = files[0];
                            
                            // if (!file.type.startsWith('image/')){ continue }
                            var img = document.createElement("img"),
                                div = document.createElement("div");
                              
                            function createImage() {      
                              img.classList.add("farmer-pic", "img-fluid");
                              img.file = file;
                              div.style.height = "inherit";
                              div.appendChild(img);
                              preview.appendChild(div);
                              
                              var reader = new FileReader();
                              reader.onload = (function(myImg) {
                                return function(e) {
                                  myImg.src = e.target.result;
                                }; 
                              })(img);
                              reader.readAsDataURL(file);
                            }
                            var that = preview.childNodes[0];
                            if (preview.childNodes.length === 0) {
                              createImage();
                              camera.style.display = "none";
                            } else {
                              preview.removeChild(that);
                              createImage();
                              camera.style.display = "none";
                            }
                          }
                        </script>
                        <div class="form-group">
                          <label class="form-label">Secondary Phone Number</label>
                          <input type="tel" class="form-control">
                        </div>
                        <div class="form-group">
                          <label class="form-label">Email Address</label>
                          <input type="email" class="form-control">
                        </div>
                        <div class="form-group">
                          <label class="form-label">Date of birth<span class="form-required">*</span></label>
                          <div class="row gutters-xs">
                            <div class="col-5">
                              <select name="user[month]" class="form-control custom-select">
                                <option value="">Month</option>
                                <option value="1">January</option>
                                <option value="2">February</option>
                                <option value="3">March</option>
                                <option value="4">April</option>
                                <option value="5">May</option>
                                <option selected="selected" value="6">June</option>
                                <option value="7">July</option>
                                <option value="8">August</option>
                                <option value="9">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                              </select>
                            </div>
                            <div class="col-3">
                              <select name="user[day]" class="form-control custom-select">
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
                                <option selected="selected" value="20">20</option>
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
                              <select name="user[year]" class="form-control custom-select">
                                <option value="">Year</option>
                                <option value="2000">2000</option>
                                <option value="1999">1999</option>
                                <option value="1998">1998</option>
                                <option value="1997">1997</option>
                                <option value="1996">1996</option>
                                <option value="1995">1995</option>
                                <option value="1994">1994</option>
                                <option selected="selected" value="1993">1993</option>
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
                        <div class="row">
                          <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                              <div class="form-label">Gender<span class="form-required">*</span></div>
                              <div class="custom-controls-stacked">
                                <label class="custom-control custom-radio custom-control-inline">
                                  <input type="radio" class="custom-control-input" name="gender" value="male" checked>
                                  <span class="custom-control-label">Male</span>
                                </label>
                                <label class="custom-control custom-radio custom-control-inline">
                                  <input type="radio" class="custom-control-input" name="gender" value="female">
                                  <span class="custom-control-label">Female</span>
                                </label>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                              <label class="form-label">Highest Level of Education<span class="form-required">*</span></label>
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
                        </div>
                        <div class="row">
                          <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                              <label class="form-label">Family Size<span class="form-required">*</span></label>
                              <input type="number" class="form-control">
                            </div>
                          </div>
                          <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                              <label class="form-label">Annual Income Range (₦)<span class="form-required">*</span></label>
                              <div class="row">
                                <div class="col">
                                  <input type="range" id="incomeRange" class="form-control custom-range" step="5" min="0" max="1000000">
                                </div>
                                <div class="col">
                                  <input type="number" id="incomeBox" class="form-control" value="450000">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <script>
                          var slider = document.getElementById("incomeRange");
                          var output = document.getElementById("incomeBox");
                          output.value = slider.value;
                          slider.oninput = function() {
                            output.value = this.value;
                          }
                          output.oninput = function() {
                            slider.value = this.value;
                          }
                        </script>
                        <div class="row">
                          <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                              <label class="form-label">State<span class="form-required">*</span></label>
                              <select name="state" class="form-control custom-select">
                                <option value="">Select state</option>
                                <option value="1">Kano</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                              <label class="form-label">Town<span class="form-required">*</span></label>
                              <select name="town" class="form-control custom-select">
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
                      </div>
                      <div class="col-lg-6 col-md-6">
                        <h3>Field Information</h3>
                        <div class="form-group">
                          <label class="form-label">Location<span class="form-required">*</span></label>
                          <input type="number" id="longitude" class="form-control" placeholder="Longitude">
                          <input type="number" id="latitude" class="form-control mt-3" placeholder="Latitude">
                        </div>
                        <div class="mb-3">
                          <button type="button" id="farmLocation" class="btn btn-primary" onclick="getLocation();">Get Location</button>
                          <span class="col-auto align-self-center">
                            <span class="form-help" data-toggle="popover" data-placement="top" data-content="<p>Click button to update data using Google's location service. <span class='text-danger'>Please make sure your device location is turned on.</span></p>
                            <!-- <p class='mb-0'><a href=''>What does this mean?</a></p> -->
                            ">?</span>
                          </span>
                          <span id="error" class="text-danger"></span>
                        </div>
                        <script>
                          function getLocation() {
                            var long = document.getElementById("longitude"),
                                 lat = document.getElementById("latitude"),
                                 err = document.getElementById("error"),
                                 loc = document.getElementById("farmLocation");
                            
                            loc.innerHTML = "Locating…";

                            if (!navigator.geolocation){
                              err.innerHTML = "Your browser does not support geolocation!";
                              loc.innerHTML = "Get Location";
                              return;
                            }

                            function success(position) {
                              lat.value  = position.coords.latitude;
                              long.value = position.coords.longitude;

                              // var img = new Image();
                              // img.src = "https://maps.googleapis.com/maps/api/staticmap?center=" + latitude + "," + longitude + "&zoom=13&size=300x300&sensor=false";
                              err.innerHTML = "";
                              loc.innerHTML = "Get Location";
                            }

                            function error() {
                              err.innerHTML = "Unable to retrieve your location, kindly turn on device location.";
                              loc.innerHTML = "Get Location";
                              console.log('Error occurred. Error code: ' + error.code);
                              return;
                            }
                            
                            navigator.geolocation.getCurrentPosition(success, error);
                          }
                        </script>
                        <div class="form-group">
                          <label class="form-label">Total Land Area<span class="form-required">*</span></label>
                          <div class="input-group">
                            <input type="number" class="form-control" aria-label="Text input with select dropdown">
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
                          <div class="form-label">Farm Pictures<span class="form-required">*</span></div>
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" name="farm-pictures-input" onchange="handleFiles(this.files);" multiple>
                            <label class="custom-file-label">Choose files</label>
                          </div>
                          <ul id="imagesPreview" class="d-flex flex-row flex-wrap justify-content-around image-wrapper"></ul>
                        </div>
                        <script>
                          function handleFiles(files) {
                            var preview = document.querySelector("#imagesPreview");
                            for (var i = 0; i < files.length; i++) {
                              var file = files[i];
                              
                              if (!file.type.startsWith('image/')){ continue }
                              
                              var img = document.createElement("img"),
                                close = document.createElement("span"),
                                   li = document.createElement("li");
                                    
                              img.classList.add("farm-picture", "img-fluid", "p-1");
                              img.file = file;
                              close.classList.add("close");
                              li.appendChild(img);
                              li.appendChild(close);
                              preview.appendChild(li);
                              
                              var reader = new FileReader();
                              reader.onload = (function(myImg) {
                                return function(e) {
                                  myImg.src = e.target.result;
                                }; 
                              })(img);
                              reader.readAsDataURL(file);
                              preview.classList.add("border", "p-1");
                              var that;
                              close.onclick = function(e) {
                                // console.log(e);
                                that = this.parentElement;
                                e.path[2].removeChild(that);
                                if (e.path[2].childElementCount === 0) {
                                  preview.classList.remove("border", "p-1");
                                }
                              }
                            }
                          }
                        </script>
                        <div class="form-group">
                          <label class="form-label">Planted Crop(s) (Comma separated list)<span class="form-required">*</span></label>
                          <input type="text" class="form-control" name="crops" id="input-tags" value="Wheat">
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
                        <div class="row">
                          <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                              <label class="form-label">Av. Annual Production Volume<span class="form-required">*</span></label>
                              <div class="input-group">
                                <input type="number" class="form-control" aria-label="Text input with select dropdown">
                                <div class="input-group-append">
                                  <select name="land[area]" class="form-control custom-select">
                                    <option value="1">Tonnes</option>
                                    <option value="2">Kilogrammes</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                              <div class="form-label">Major source of Farm labour<span class="form-required">*</span></div>
                              <div class="custom-controls-stacked">
                                <label class="custom-control custom-radio custom-control-inline">
                                  <input type="radio" class="custom-control-input" name="farm-labour" value="family" checked>
                                  <span class="custom-control-label">Family</span>
                                </label>
                                <label class="custom-control custom-radio custom-control-inline">
                                  <input type="radio" class="custom-control-input" name="farm-labour" value="hired_hands">
                                  <span class="custom-control-label">Hired Hands</span>
                                </label>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- <script>
                          var list = document.getElementById("input-tags");
                          list.onchange = function(){
                            console.log(list.value);
                          }
                        </script> -->
                        <!-- <div class="form-group">
                          <label class="form-label">Planted Crop(s)</label>
                          <textarea class="form-control" name="crops" rows="4" placeholder="Comma separated list of farmer's crops..." style="margin-top: 0px; margin-bottom: 0px; height: 108px;"></textarea>
                        </div> -->
                      </div>
                    </div>
                  </div>
                  <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">Register</button>
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