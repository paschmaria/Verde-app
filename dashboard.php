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
                    <a href="./dashboard" class="nav-link active"><i class="fe fe-home"></i> Home</a>
                  </li>
                  <li class="nav-item">
                    <a href="./register-farmer" class="nav-link"><i class="fe fe-user-plus"></i> Register A Farmer</a>
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
            <div class="page-header">
              <h1 class="page-title">
                Dashboard
              </h1>
              <p>Weekly Reports</p>
            </div>
            <div class="row row-cards row-deck">
              <div class="col-6 col-sm-4 col-lg-2">
                <div class="card">
                  <div class="card-body p-3 text-center">
                    <div class="text-right text-green">
                      6%
                      <i class="fe fe-chevron-up"></i>
                    </div>
                    <div class="h1 m-0">7</div>
                    <div class="text-muted mb-4">Farmers Registered</div>
                  </div>
                </div>
              </div>
              <div class="col-6 col-sm-4 col-lg-2">
                <div class="card">
                  <div class="card-body p-3 text-center">
                    <div class="text-right text-red">
                      -3%
                      <i class="fe fe-chevron-down"></i>
                    </div>
                    <div class="h1 m-0">17</div>
                    <div class="text-muted mb-4">SMS sent</div>
                  </div>
                </div>
              </div>
              <div class="col-6 col-sm-4 col-lg-2">
                <div class="card">
                  <div class="card-body p-3 text-center">
                    <div class="text-right text-green">
                      9%
                      <i class="fe fe-chevron-up"></i>
                    </div>
                    <div class="h1 m-0">43</div>
                    <div class="text-muted mb-4">Voice Calls made</div>
                  </div>
                </div>
              </div>
              <div class="col-6 col-sm-4 col-lg-2">
                <div class="card">
                  <div class="card-body p-3 text-center">
                    <div class="text-right text-green">
                      3%
                      <i class="fe fe-chevron-up"></i>
                    </div>
                    <div class="h1 m-0">4 bags</div>
                    <div class="text-muted mb-4">Fertilizers Sold</div>
                  </div>
                </div>
              </div>
              <div class="col-6 col-sm-4 col-lg-2">
                <div class="card">
                  <div class="card-body p-3 text-center">
                    <div class="text-right text-red">
                      -2%
                      <i class="fe fe-chevron-down"></i>
                    </div>
                    <div class="h1 m-0">2 bags</div>
                    <div class="text-muted mb-4">Seeds Sold</div>
                  </div>
                </div>
              </div>
              <div class="col-6 col-sm-4 col-lg-2">
                <div class="card">
                  <div class="card-body p-3 text-center">
                    <div class="text-right text-red">
                      -1%
                      <i class="fe fe-chevron-down"></i>
                    </div>
                    <div class="h1 m-0">3 Bags</div>
                    <div class="text-muted mb-4">Herbicides Sold</div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row row-cards row-deck">
              <div class="col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Weather Forecast for:</h3>
                    <div class="card-options">
                      <select id="stateToggle" name="location" class="form-control custom-select">
                        <option value="">Location</option>
                        <option data-location='{"longitude":"2.5284488", "latitude":"11.6827587"}' value="1">Kebbi</option>
                        <option data-location='{"longitude":"6.3327384", "latitude":"10.2546175"}' value="2">Kaduna</option>
                        <option selected="selected" data-location='{"longitude":"8.4708578", "latitude":"11.9978786"}' value="3">Kano</option>
                        <option data-location='{"longitude":"8.2489528", "latitude":"11.9910136"}' value="4">Jigawa</option>
                        <option data-location='{"longitude":"10.8600634", "latitude":"11.8592838"}' value="5">Borno</option>
                      </select>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="dimmer active">
                      <div class="loader"></div>
                      <div class="dimmer-content">
                        <div id="chart-rainfall-temperature" style="height: 25rem"></div>
                      </div>
                    </div>
                  </div>
                  <!-- <div class="card-footer">
                    <div class="selectgroup selectgroup-pills">
                      <label class="selectgroup-item">
                        <input type="checkbox" name="value" value="HTML" class="selectgroup-input" checked>
                        <span class="selectgroup-button selectgroup-button-icon"><i class="fe fe-sun"></i></span>
                      </label>
                      <label class="selectgroup-item">
                        <input type="checkbox" name="value" value="CSS" class="selectgroup-input" checked>
                        <span class="selectgroup-button selectgroup-button-icon"><i class="fe fe-cloud-rain"></i></span>
                      </label>
                      <label class="selectgroup-item">
                        <input type="checkbox" name="value" value="PHP" class="selectgroup-input">
                        <span class="selectgroup-button selectgroup-button-icon"><i class="fe fe-cloud-drizzle"></i></span>
                      </label>
                      <label class="selectgroup-item">
                        <input type="checkbox" name="value" value="JavaScript" class="selectgroup-input">
                        <span class="selectgroup-button selectgroup-button-icon"><i class="fe fe-cloud-snow"></i></span>
                      </label>
                    </div>
                  </div> -->
                </div>
              </div>
              <div class="col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Weather Forecast</h3>
                    <div class="card-options">
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="dimmer active">
                      <div class="loader"></div>
                      <div class="dimmer-content">
                        <div id="chart-wind-humidity" style="height: 25rem"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row row-cards row-deck">
              <div class="col-lg-3 col-md-6 col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Message Costs</h3>
                  </div>
                  <div class="card-body">
                    <div id="chart-donut" style="height: 14rem;"></div>
                  </div>
                </div>
                <script>
                  require(['c3', 'jquery'], function(c3, $) {
                    $(document).ready(function(){
                      var chart = c3.generate({
                        bindto: '#chart-donut', // id of chart wrapper
                        data: {
                          columns: [
                              // each columns data
                            ['data1', 34],
                            ['data2', 215]
                          ],
                          type: 'donut', // default type of chart
                          colors: {
                            'data1': tabler.colors["blue"],
                            'data2': tabler.colors["blue-light"]
                          },
                          names: {
                              // name of each serie
                            'data1': 'SMS',
                            'data2': 'Voice Calls'
                          }
                        },
                        axis: {
                        },
                        legend: {
                          show: true, //show legend
                        },
                        padding: {
                          bottom: 0,
                          top: 0
                        },
                      });
                    });
                  });
                </script>
              </div>
              <div class="col-lg-3 col-md-6 col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Sales</h3>
                  </div>
                  <div class="card-body">
                    <div id="chart-pie" style="height: 14rem;"></div>
                  </div>
                </div>
                <script>
                  require(['c3', 'jquery'], function(c3, $) {
                    $(document).ready(function(){
                      var chart = c3.generate({
                        bindto: '#chart-pie', // id of chart wrapper
                        data: {
                          columns: [
                              // each columns data
                            ['data1', 32000],
                            ['data2', 120000],
                            ['data3', 15000]
                          ],
                          type: 'pie', // default type of chart
                          colors: {
                            'data1': tabler.colors["green-darker"],
                            'data2': tabler.colors["green"],
                            'data3': tabler.colors["green-light"]
                          },
                          names: {
                              // name of each serie
                            'data1': 'NPK Fertilizers',
                            'data2': 'Seeds',
                            'data3': 'Herbicides'
                          }
                        },
                        axis: {
                        },
                        legend: {
                          show: true //show legend
                        },
                        padding: {
                          bottom: 0,
                          top: 0
                        },
                      });
                    });
                  });
                </script>
              </div>
              <div class="col-lg-3 col-md-6 col-12">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Total Message Costs</h3>
                    </div>
                    <div class="card-body text-center">
                      <!-- <div class="h5">Total Message Costs</div> -->
                      <div class="display-4 font-weight-bold mb-4">₦249</div>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-red" style="width: 28%"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Total Revenue</h3>
                    </div>
                    <div class="card-body text-center">
                      <!-- <div class="h5">Total Revenue</div> -->
                      <div class="display-4 font-weight-bold mb-4">₦167,000</div>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-blue" style="width: 84%"></div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">7 days Weather Report</h3>
                    <div class="card-options">
                      <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                      <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                    </div>
                  </div>
                  <div class="card-body text-center">
                    <div class="dimmer active">
                      <div class="loader"></div>
                      <div class="dimmer-content">
                        <div class="row w-cols"></div>
                      </div>
                    </div>                    
                  </div>
                </div>
              </div>
              <script>
                require(['c3', 'jquery'], function(c3, $) {
                  $(document).ready(function(){
                    function weatherCharts(date, rain, temp, wind, hum) {
                      var chart1 = c3.generate({
                        bindto: '#chart-rainfall-temperature', // id of chart wrapper
                        data: {
                          json: {
                            data1: rain,
                            data2: temp
                          },
                          axes: {
                            data1: 'y',
                            data2: 'y2'
                          },
                          type: 'bar', // default type of chart
                          types: {
                            data2: 'spline'
                          },
                          colors: {
                            'data1': tabler.colors["orange-darker"],
                            'data2': tabler.colors["cyan"]
                          },
                          names: {
                              // name of each serie
                            'data1': 'Rainfall (mm/h)',
                            'data2': 'Max Temp. (°C)'
                          }
                        },
                        axis: {
                          y: {
                            label: {
                              text: 'Rainfall (mm/h)',
                              position: 'outer-middle'
                            },
                            // tick: {
                            //   format: function (d) { return d + 'mm/h'; }
                            // },
                            inner: false
                          },
                          x: {
                            type: 'category',
                            // name of each category
                            categories: date
                          },
                          y2: {
                            show: true,
                            label: { // ADD
                              text: 'Max Temp. (°C)',
                              position: 'outer-middle'
                            },
                            // tick: {
                            //   format: function (d) { return d + '°C'; }
                            // },
                            inner: false
                          }
                        },
                        tooltip: {
                          format: {
                            title: function (x) {
                              return '';
                            }
                          }
                        },
                        padding: {
                          bottom: 20,
                          top: 20
                        },
                        point: {
                          show: true
                        }
                      });
                      var chart2 = c3.generate({
                        bindto: '#chart-wind-humidity', // id of chart wrapper
                        data: {
                          json: {
                            data1: wind,
                            data2: hum
                          },
                          axes: {
                            data1: 'y',
                            data2: 'y2'
                          },
                          type: 'bar', // default type of chart
                          types: {
                            data2: 'spline'
                          },
                          colors: {
                            'data1': tabler.colors["purple-darker"],
                            'data2': tabler.colors["red"]
                          },
                          names: {
                              // name of each serie
                            'data1': 'Wind (m/s)',
                            'data2': 'Humidity'
                          }
                        },
                        axis: {
                          y: {
                            label: {
                              text: 'Wind (m/s)',
                              position: 'outer-middle'
                            },
                            // tick: {
                            //   format: function (d) { return d + 'm/s'; }
                            // },
                            inner: false
                          },
                          x: {
                            type: 'category',
                            // name of each category
                            categories: date
                          },
                          y2: {
                            show: true,
                            label: { // ADD
                              text: 'Humidity',
                              position: 'outer-middle'
                            },
                            tick: {
                              // format: function (d) { return d + '°C'; }
                            },
                            inner: false
                          }
                        },
                        transition: {
                            duration: 1000
                        },
                        tooltip: {
                          format: {
                            title: function (x) {
                              return '';
                            }
                          }
                        },
                        padding: {
                          bottom: 20,
                          top: 20
                        },
                        point: {
                          show: true
                        }
                      });
                    }
                    function skycons() {
                      var i,
                          e,
                          icons = new Skycons({
                            "color": "#467fcf",
                            "resizeClear": true
                          }),
                          list  = [ // all used icons
                            "clear-day",
                            "clear-night",
                            "partly-cloudy-day",
                            "partly-cloudy-night",
                            "cloudy",
                            "rain",
                            "sleet",
                            "snow",
                            "wind",
                            "fog"
                          ];

                      for(i = list.length; i--;) {
                        var weatherType = list[i],
                            elements    = document.getElementsByClassName(weatherType);

                        // loop through the elements and set them up
                        for (e = elements.length; e--;) {
                          icons.set(elements[e], weatherType);
                        }
                      }

                      // animate the icons
                      icons.play();
                    }

                    var stateToggle = $("#stateToggle"),
                               long = stateToggle.find(":selected").data("location").longitude,
                                lat = stateToggle.find(":selected").data("location").latitude;

                    weatherReport(long, lat);

                    function weatherReport(longitude, latitude) {
                      
                      var apiKey = 'ebb41009b925db9ab7200157af5cfaae',
                             url = 'https://api.darksky.net/forecast/',
                            lati = latitude,
                           longi = longitude,
                        api_call = url + apiKey + "/" + lati + "," + longi + "?format=jsonp&extend=hourly&units=si&callback=?";

                      var days = [
                        'Sun',
                        'Mon',
                        'Tue',
                        'Wed',
                        'Thur',
                        'Fri',
                        'Sat'
                      ];
                      
                      var sunday = [],
                          monday = [],
                         tuesday = [],
                       wednesday = [],
                        thursday = [],
                          friday = [],
                        saturday = [];

                      // Call to the DarkSky API to retrieve JSON
                      $.getJSON(api_call, function(forecast) {
                        // console.log(forecast);
                        
                        // Loop through hourly forecasts
                        for(var j = 0, k = forecast.hourly.data.length; j < k; j++) {

                          var hourly_date    = new Date(forecast.hourly.data[j].time * 1000),
                              hourly_day     = days[hourly_date.getDay()],
                              hourly_temp    = forecast.hourly.data[j].temperature;

                          // push 24 hour forecast values to our empty days array
                          switch(hourly_day) {
                            case 'Sun':
                              sunday.push(hourly_temp);
                              break;
                            case 'Mon':
                              monday.push(hourly_temp);
                              break;
                            case 'Tue':
                              tuesday.push(hourly_temp);
                              break;
                            case 'Wed':
                              wednesday.push(hourly_temp);
                              break;
                            case 'Thur':
                              thursday.push(hourly_temp);
                              break;
                            case 'Fri':
                              friday.push(hourly_temp);
                              break;
                            case 'Sat':
                              saturday.push(hourly_temp);
                              break;
                            default: console.log(hourly_date.toLocaleTimeString());
                              break;
                          }
                        }

                        var dayArr = [],
                          precipArr = [],
                            tempArr = [],
                            windArr = [],
                           humidArr = [];
                        
                        // Loop through daily forecasts
                        for(var i = 0, l = forecast.daily.data.length; i < l - 1; i++) {
                          var date = new Date(forecast.daily.data[i].time * 1000),
                               day = days[date.getDay()],
                              time = forecast.daily.data[i].time,
                              wind = forecast.daily.data[i].windSpeed,
                           tempMax = Math.round(forecast.daily.data[i].temperatureMax),
                           skicons = forecast.daily.data[i].icon,
                           summary = forecast.daily.data[i].summary,
                          humidity = forecast.daily.data[i].humidity,
                         precipInt = forecast.daily.data[i].precipIntensity;

                          $(".w-cols").append(
                            `<div class="col-md-2">
                                <div class="shade-${skicons}">
                                  <div class="front">
                                    <div clss="graphic">
                                      <canvas class="${skicons}" width="140"></canvas>  
                                    </div>
                                    <div>
                                      <b>Day</b>: ${date.toLocaleDateString()}
                                    </div>
                                    <div>
                                      <b>Max. Temp</b>: ${tempMax}°C
                                    </div>
                                    <div>
                                      <b>Wind Speed</b>: ${wind}m/s
                                    </div>
                                    <div>
                                      <b>Humidity</b>: ${humidity}
                                    </div>
                                    <div>
                                      <b>Precipitation</b>: ${precipInt}mm/h
                                    </div>
                                    <p class="summary">${summary}</p>                                    
                                  </div>
                                </div>
                              </div>`
                          )
                          
                          dayArr.push(day);
                          precipArr.push(precipInt);
                          tempArr.push(tempMax);
                          windArr.push(wind);
                          humidArr.push(humidity);
                        };

                        // console.log(day);
                        $(".dimmer").removeClass("active");
                        weatherCharts(dayArr, precipArr, tempArr, windArr, humidArr);
                        skycons();
                      })
                    }
  
                    $("#stateToggle").change(function(e) {
                      
                      var long = $(this).find(":selected").data("location").longitude,
                           lat = $(this).find(":selected").data("location").latitude;

                      // console.log($(".dimmer"));
                      $(".dimmer").addClass("active");
                      $(".w-cols").find(".col-md-2").remove();
                      weatherReport(long, lat);
                    })
                  })
                })
              </script>
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Invoices</h3>
                    <div class="card-options">
                      <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                      <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                    </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                      <thead>
                        <tr>
                          <th class="w-1">No.</th>
                          <th>Invoice Subject</th>
                          <th>Farmer</th>
                          <th>Created</th>
                          <th>Status</th>
                          <th>Price</th>
                          <th></th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><span class="text-muted">0001</span></td>
                          <td><a href="invoice.html" class="text-inherit">Seeds and Fertilizers</a></td>
                          <td>
                            Musa Ibrahim
                          </td>
                          <td>
                            15 Apr 2018
                          </td>
                          <td>
                            <span class="status-icon bg-success"></span> Paid, delivered
                          </td>
                          <td>₦68,000</td>
                          <td class="text-right">
                            <a href="javascript:void(0)" class="btn btn-secondary btn-sm">Manage</a>
                            <div class="dropdown">
                              <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">Actions</button>
                            </div>
                          </td>
                          <td>
                            <a class="icon" href="javascript:void(0)">
                              <i class="fe fe-edit"></i>
                            </a>
                          </td>
                        </tr>
                        <tr>
                          <td><span class="text-muted">0002</span></td>
                          <td><a href="invoice.html" class="text-inherit">Seeds</a></td>
                          <td>
                            Jide Afolayan
                          </td>
                          <td>
                            12 Apr 2018
                          </td>
                          <td>
                            <span class="status-icon bg-warning"></span> Paid, undelivered
                          </td>
                          <td>₦60,000</td>
                          <td class="text-right">
                            <a href="javascript:void(0)" class="btn btn-secondary btn-sm">Manage</a>
                            <div class="dropdown">
                              <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">Actions</button>
                            </div>
                          </td>
                          <td>
                            <a class="icon" href="javascript:void(0)">
                              <i class="fe fe-edit"></i>
                            </a>
                          </td>
                        </tr>
                        <tr>
                          <td><span class="text-muted">0003</span></td>
                          <td><a href="invoice.html" class="text-inherit">Fertilizers</a></td>
                          <td>
                            Mohammed Abdullahi
                          </td>
                          <td>
                            23 Mar 2018
                          </td>
                          <td>
                            <span class="status-icon bg-warning"></span> Pending
                          </td>
                          <td>₦8,000</td>
                          <td class="text-right">
                            <a href="javascript:void(0)" class="btn btn-secondary btn-sm">Manage</a>
                            <div class="dropdown">
                              <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">Actions</button>
                            </div>
                          </td>
                          <td>
                            <a class="icon" href="javascript:void(0)">
                              <i class="fe fe-edit"></i>
                            </a>
                          </td>
                        </tr>
                        <tr>
                          <td><span class="text-muted">0004</span></td>
                          <td><a href="invoice.html" class="text-inherit">Herbicides</a></td>
                          <td>
                            Yusuf Saheed
                          </td>
                          <td>
                            2 Mar 2018
                          </td>
                          <td>
                            <span class="status-icon bg-secondary"></span> Pending
                          </td>
                          <td>₦15,000</td>
                          <td class="text-right">
                            <a href="javascript:void(0)" class="btn btn-secondary btn-sm">Manage</a>
                            <div class="dropdown">
                              <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">Actions</button>
                            </div>
                          </td>
                          <td>
                            <a class="icon" href="javascript:void(0)">
                              <i class="fe fe-edit"></i>
                            </a>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div> -->
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