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
                    <a href="./soil-test" class="nav-link"><i class="fe fe-layers"></i> Soil Analysis/Recommendations</a>
                  </li>
                  <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-send"></i> Push</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="./sms" class="dropdown-item"><i class="fe fe-message-square"></i> SMS</a>
                      <!-- <a href="./charts.html" class="dropdown-item">Charts</a> -->
                      <a href="./voice" class="dropdown-item active"><i class="fe fe-phone-outgoing"></i> Voice Calls</a>
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
                <h3 class="page-title mb-5">Voice Calls</h3>
                <div>
                  <div class="list-group list-group-transparent mb-0">
                    <!-- <a href="#" class="list-group-item list-group-item-action d-flex align-items-center active">
                      <span class="icon mr-3"><i class="fe fe-inbox"></i></span>Inbox <span class="ml-auto badge badge-primary">14</span>
                    </a> -->
                    <a href="./voice-history" class="list-group-item list-group-item-action d-flex align-items-center">
                      <span class="icon mr-3"><i class="fe fe-send"></i></span>Sent Calls <span class="ml-auto badge badge-secondary">14</span>
                    </a>
                    <a href="./voice-reports" class="list-group-item list-group-item-action d-flex align-items-center">
                      <span class="icon mr-3"><i class="fe fe-alert-circle"></i></span>Delivery Reports <span class="ml-auto badge badge-primary">3</span>
                    </a>
                    <a href="./voice-drafts" class="list-group-item list-group-item-action d-flex align-items-center">
                      <span class="icon mr-3"><i class="fe fe-file"></i></span>Drafts <span class="ml-auto badge badge-secondary">7</span>
                    </a>
                    <a href="./voice-trash" class="list-group-item list-group-item-action d-flex align-items-center">
                      <span class="icon mr-3"><i class="fe fe-trash-2"></i></span>Trash <span class="ml-auto badge badge-secondary">1</span>
                    </a>
                  </div>
                  <div class="mt-6 mb-6">
                    <a href="./voice" class="btn btn-secondary btn-block">Make new Voice Call</a>
                  </div>
                </div>
              </div>
              <div class="col-md-9">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Make new Voice Call</h3>
                  </div>
                  <div class="card-body">
                    <form method="post" action="./voice_upload.php" enctype="multipart/form-data">
                      <div class="form-group">
                        <div class="row align-items-center">
                          <label class="col-sm-2">To:</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="recipients" placeholder="Comma separated phone numbers...">
                          </div>
                        </div>
                      </div>
                      <script>
                        require(['jquery', 'selectize'], function ($, selectize) {
                          var REGEX_PHONE = '([0-9]{11}(?: |\-)|(?:\+|00)[0-9]{13}(?: |\-)|((?:[0-9]{2}){4})|((?: |\-)[0-9]{3}(?: |\-)[0-9]{4}))';

                          $('#recipients').selectize({
                              persist: false,
                              maxItems: null,
                              valueField: 'phone',
                              labelField: 'name',
                              searchField: ['name', 'phone'],
                              options: [
                                  {phone: '08106129023', name: 'Onuorah Paschal'},
                                  {phone: '09098762345', name: 'Nurudeen Dawodu'},
                                  {phone: '08056785432', name: 'Ismail Samson'}
                              ],
                              render: {
                                  item: function(item, escape) {
                                      return '<div>' +
                                          (item.name ? '<span class="name">' + escape(item.name) + '</span>' : '') +
                                          (item.phone ? '<span class="phone">' + escape(item.phone) + '</span>' : '') +
                                      '</div>';
                                  },
                                  option: function(item, escape) {
                                      var label = item.name;
                                      var caption = item.name ? item.phone : null;
                                      return '<div>' +
                                          '<span class="label">' + escape(label) + '</span>' +
                                          (caption ? '<span class="caption">' + escape(caption) + '</span>' : '') +
                                      '</div>';
                                  }
                              },
                              createFilter: function(input) {
                                  var match, regex;

                                  // phone
                                  regex = new RegExp('^' + REGEX_PHONE + '$', 'i');
                                  match = input.match(regex);
                                  if (match) return !this.options.hasOwnProperty(match[0]);

                                  // name <phone>
                                  regex = new RegExp('^([^<]*)\<' + REGEX_PHONE + '\>$', 'i');
                                  match = input.match(regex);
                                  if (match) return !this.options.hasOwnProperty(match[2]);

                                  return false;
                              },
                              create: function(input) {
                                  if ((new RegExp('^' + REGEX_PHONE + '$', 'i')).test(input)) {
                                      return {phone: input};
                                  }
                                  var match = input.match(new RegExp('^([^<]*)\<' + REGEX_PHONE + '\>$', 'i'));
                                  if (match) {
                                      return {
                                          phone : match[2],
                                          name  : $.trim(match[1])
                                      };
                                  }
                                  alert('Invalid Phone Number');
                                  return false;
                              }
                          });
                        })
                      </script>
                      <div class="form-group">
                        <div class="row align-items-center">
                          <label class="col-sm-2">From:</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control">
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="custom-switch">
                          <input type="checkbox" id="tts-checkbox" name="tts-checkbox" class="custom-switch-input">
                          <span class="custom-switch-indicator"></span>
                          <span class="custom-switch-description">Switch between Recording Voice and Uploading Media.</span>
                        </label>
                      </div>
                      <div class="form-group" id="voice" style="display: none;">
                        <label for="deviceLabel">Record Voice message: </label>
                        <canvas class="visualizer"></canvas>
                        <div id="buttons" class="mb-2">
                          <button type="button" class="btn btn-secondary btn-record">Record</button>
                          <button type="button" class="btn btn-secondary btn-stop">Stop</button>
                        </div>
                        <div id="soundClip"></div>
                      </div>
                      <div id="media" class="form-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" name="audio_file">
                          <label class="custom-file-label">Upload Media file</label>
                        </div>
                      </div>
                      <script>
                        // Toggle handler
                        require(['jquery'], function($){
                          $(document).ready(function(){
                            var ttsCheckbox = document.getElementById("tts-checkbox"),
                                   mediaBox = document.getElementById("media"),
                                    voiceBox = document.getElementById("voice");

                            ttsCheckbox.addEventListener('change', function(e){
                              if (!e.target.checked) {
                                mediaBox.style.display = "block";
                                voiceBox.style.display = "none";
                              } else {
                                mediaBox.style.display = "none";
                                voiceBox.style.display = "block";
                              }
                            })
                          })
                        })
                        
                        // Voice recorder handler
                        var record = document.querySelector('.btn-record'),
                              stop = document.querySelector('.btn-stop'),
                            canvas = document.querySelector('.visualizer'),
                          voiceBox = document.querySelector('#voice'),
                        soundClips = document.querySelector('#soundClip');

                        stop.disabled = true;

                        // visualiser setup - create web audio api context and canvas
                        var audioCtx = new (window.AudioContext || webkitAudioContext)(),
                           canvasCtx = canvas.getContext("2d");
                        
                        // Record voice
                        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                          navigator.mediaDevices.getUserMedia ({
                              // only audio needed
                              audio: true
                            }).then(function(stream) {
                              var mediaRecorder = new MediaRecorder(stream);

                              visualize(stream);
                              record.onclick = function() {
                                mediaRecorder.start();
                                // console.log(mediaRecorder.state);
                                // console.log("recorder started");
                                record.classList.add("btn-danger");
                                record.classList.remove("btn-secondary");

                                stop.disabled = false;
                                record.disabled = true;
                              }

                              var message = [];
                              mediaRecorder.ondataavailable = function(e) {
                                message.push(e.data);
                              }

                              stop.onclick = function() {
                                mediaRecorder.stop();
                                // console.log(mediaRecorder.state);
                                // console.log("recorder stopped");
                                record.classList.add("btn-secondary");
                                record.classList.remove("btn-danger");

                                stop.disabled = true;
                                record.disabled = false;
                              }

                              mediaRecorder.onstop = function(e) {
                                var messageName = prompt('Enter a name for your message','Weather update'),
                               messageContainer = document.createElement('div'),
                                   messageLabel = document.createElement('p'),
                                   deleteButton = document.createElement('button'),
                                          audio = document.createElement('audio');
                                        
                                messageContainer.classList.add('message');
                                deleteButton.classList.add("btn", "btn-danger")

                                function setAttributes(el, attrs) {
                                  for (const key in attrs) {
                                    el.setAttribute(key, attrs[key])
                                  }
                                }
                                setAttributes(audio, {"controls" : "", "name" : "recorded_message"})
                                deleteButton.innerHTML = "Delete";
                                messageLabel.innerHTML = messageName;

                                messageContainer.appendChild(audio);
                                messageContainer.appendChild(messageLabel);
                                messageContainer.appendChild(deleteButton);
                                soundClips.appendChild(messageContainer);

                                var blob = new Blob(message, { 'type' : 'audio/ogg; codecs=opus' }),
                                audioURL = window.URL.createObjectURL(blob);

                                message = [];
                                audio.src = audioURL;
                                deleteButton.onclick = function(e) {
                                  var eTgt = e.target;
                                  eTgt.parentNode.parentNode.removeChild(eTgt.parentNode);
                                }
                              }
                            }).catch(function(err) {
                              alert('The following getUserMedia error occured: ' + err);
                            }
                          );
                        } else {
                          alert('Voice Recording not supported on your browser, please upload media file!');
                        }

                        function visualize(stream) {
                          var source = audioCtx.createMediaStreamSource(stream),
                            analyser = audioCtx.createAnalyser();
                          analyser.fftSize = 2048;
                          var bufferLength = analyser.frequencyBinCount,
                                 dataArray = new Uint8Array(bufferLength);

                          source.connect(analyser);
                          //analyser.connect(audioCtx.destination);
                          draw()
                          canvas.width = 200;
                          function draw() {
                            var WIDTH = canvas.width,
                               HEIGHT = canvas.height;
                            // console.log(WIDTH)
                            requestAnimationFrame(draw);
                            analyser.getByteTimeDomainData(dataArray);

                            canvasCtx.fillStyle = 'rgb(200, 200, 200)';
                            canvasCtx.fillRect(0, 0, WIDTH, HEIGHT);
                            canvasCtx.lineWidth = 2;
                            canvasCtx.strokeStyle = 'rgb(0, 0, 0)';
                            canvasCtx.beginPath();

                            var sliceWidth = WIDTH * 1.0 / bufferLength,
                                         x = 0;

                            for(var i = 0; i < bufferLength; i++) {   
                              var v = dataArray[i] / 128.0;
                              var y = v * HEIGHT/2;

                              if(i === 0) {
                                canvasCtx.moveTo(x, y);
                              } else {
                                canvasCtx.lineTo(x, y);
                              }

                              x += sliceWidth;
                            }

                            canvasCtx.lineTo(canvas.width, canvas.height/2);
                            canvasCtx.stroke();
                          }
                        }

                        window.onresize = function() {
                          canvas.width = voiceBox.offsetWidth;
                        }

                        window.onresize();
                      </script>
                      <div class="btn-list mt-4 text-right">
                        <button type="button" class="btn btn-secondary btn-space">Save as Draft</button>
                        <button type="submit" class="btn btn-primary btn-space">Send message</button>
                      </div>
                    </form>
                  </div>
                </div>
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