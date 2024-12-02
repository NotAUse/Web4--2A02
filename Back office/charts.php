
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Evenement</title>
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />
    <link
      rel="icon"
      href="/kaiadmin-lite-1.2.0/view/assets/img/kaiadmin/favicom.ico"
      type="image/x-icon"
    />

    <!-- Fonts and icons -->
    <script src="/kaiadmin-lite-1.2.0/view/assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["/kaiadmin-lite-1.2.0/view/assets/css/fonts.min.css"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="/kaiadmin-lite-1.2.0/view/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/kaiadmin-lite-1.2.0/view/assets/css/plugins.min.css" />
    <link rel="stylesheet" href="/kaiadmin-lite-1.2.0/view/assets/css/kaiadmin.min.css" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="/kaiadmin-lite-1.2.0/view/assets/css/demo.css" />
  </head>
  <body>

    <div class="wrapper">
      <!-- Sidebar -->
      <div class="sidebar" data-background-color="dark">
        <div class="sidebar-logo">
          <!-- Logo Header -->
          <div class="logo-header" data-background-color="dark">
            <a href="/kaiadmin-lite-1.2.0/view/index.html" class="logo">
              <img
                src="/kaiadmin-lite-1.2.0/view/assets/img/kaiadmin/logo_light.svg"
                alt="navbar brand"
                class="navbar-brand"
                height="20"
              />
            </a>
            <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar">
                <i class="gg-menu-right"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                <i class="gg-menu-left"></i>
              </button>
            </div>
            <button class="topbar-toggler more">
              <i class="gg-more-vertical-alt"></i>
            </button>
          </div>
          <!-- End Logo Header -->
        </div>
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
          <div class="sidebar-content">
            <ul class="nav nav-secondary">
              <li class="nav-item">
                <a
                  data-bs-toggle="collapse"
                  href="#dashboard"
                  class="collapsed"
                  aria-expanded="false"
                >
                  <i class="fas fa-home"></i>
                  <p>Dashboard</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="dashboard">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="../../demo1/index.html">
                        <span class="sub-item">Dashboard 1</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="nav-section">
                <span class="sidebar-mini-icon">
                  <i class="fa fa-ellipsis-h"></i>
                </span>
                <h4 class="text-section">Components</h4>
              </li>
              
              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#forms">
                  <i class="fas fa-pen-square"></i>
                  <p>Forms</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="forms">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="/kaiadmin-lite-1.2.0/view/assets/forms/forms.html">
                        <span class="sub-item">Basic Form</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              
              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#maps">
                  <i class="fas fa-map-marker-alt"></i>
                  <p>Maps</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="maps">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="/kaiadmin-lite-1.2.0/view/assets/maps/googlemaps.html">
                        <span class="sub-item">Google Maps</span>
                      </a>
                    </li>
                    
                  </ul>
                </div>
              </li>
              <li class="nav-item active submenu">
                <a data-bs-toggle="collapse" href="#charts">
                  <i class="far fa-chart-bar"></i>
                  <p>Events</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse show" id="charts">
                  <ul class="nav nav-collapse">
                    <li class="active">
                      <a href="/kaiadmin-lite-1.2.0/view/assets/charts.php">
                        <span class="sub-item">ComeEvents</span>
                      </a>
                    </li>
                    
                  </ul>
                </div>
              </li>
              
          </div>
        </div>
      </div>
      <!-- End Sidebar -->

      <div class="main-panel">
        <div class="main-header">
          <div class="main-header-logo">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="dark">
              <a href="/kaiadmin-lite-1.2.0/view/index.html" class="logo">
                <img
                  src="../assets/img/kaiadmin/logo_light.svg"
                  alt="navbar brand"
                  class="navbar-brand"
                  height="20"
                />
              </a>
              <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                  <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                  <i class="gg-menu-left"></i>
                </button>
              </div>
              <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
              </button>
            </div>
            <!-- End Logo Header -->
          </div>
          <!-- Navbar Header -->
          <nav
            class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom"
          >
            <div class="container-fluid">
              <nav
                class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex"
              >
                <div class="input-group">
                  <div class="input-group-prepend">
                    <button type="submit" class="btn btn-search pe-1">
                      <i class="fa fa-search search-icon"></i>
                    </button>
                  </div>
                  <input
                    type="text"
                    placeholder="Search ..."
                    class="form-control"
                  />
                </div>
              </nav>

              <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                <li
                  class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none"
                >
                  <a
                    class="nav-link dropdown-toggle"
                    data-bs-toggle="dropdown"
                    href="#"
                    role="button"
                    aria-expanded="false"
                    aria-haspopup="true"
                  >
                    <i class="fa fa-search"></i>
                  </a>
                  <ul class="dropdown-menu dropdown-search animated fadeIn">
                    <form class="navbar-left navbar-form nav-search">
                      <div class="input-group">
                        <input
                          type="text"
                          placeholder="Search ..."
                          class="form-control"
                        />
                      </div>
                    </form>
                  </ul>
                </li>
                <li class="nav-item topbar-icon dropdown hidden-caret">
                  <a
                    class="nav-link dropdown-toggle"
                    href="#"
                    id="messageDropdown"
                    role="button"
                    data-bs-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                  >
                    <i class="fa fa-envelope"></i>
                  </a>
                  <ul
                    class="dropdown-menu messages-notif-box animated fadeIn"
                    aria-labelledby="messageDropdown"
                  >
                    <li>
                      <div
                        class="dropdown-title d-flex justify-content-between align-items-center"
                      >
                        Messages
                        <a href="#" class="small">Mark all as read</a>
                      </div>
                    </li>
                    <li>
                      <div class="message-notif-scroll scrollbar-outer">
                        <div class="notif-center">
                          <a href="#">
                            <div class="notif-img">
                              <img
                                src="../assets/img/jm_denis.jpg"
                                alt="Img Profile"
                              />
                            </div>
                            <div class="notif-content">
                              <span class="subject">Jimmy Denis</span>
                              <span class="block"> Are you sure? </span>
                              <span class="time">1 minutes ago</span>
                            </div>
                          </a>
                          <a href="#">
                            <div class="notif-img">
                              <img
                                src="/kaiadmin-lite-1.2.0/view/assets/img/chadengle.jpg"
                                alt="Img Profile"
                              />
                            </div>
                            <div class="notif-content">
                              <span class="subject">Chad</span>
                              <span class="block"> Ok, Thanks ! </span>
                              <span class="time">15 minutes ago</span>
                            </div>
                          </a>
                          <a href="#">
                            <div class="notif-img">
                              <img
                                src="/kaiadmin-lite-1.2.0/view/assets/img/mlane.jpg"
                                alt="Img Profile"
                              />
                            </div>
                            <div class="notif-content">
                              <span class="subject">Jhon Doe</span>
                              <span class="block">
                                +5 new messages
                              </span>
                              <span class="time">1 minutes ago</span>
                            </div>
                          </a>
                          <a href="#">
                            <div class="notif-img">
                              <img
                                src="/kaiadmin-lite-1.2.0/view/assets/img/talha.jpg"
                                alt="Img Profile"
                              />
                            </div>
                            <div class="notif-content">
                              <span class="subject">Talha</span>
                              <span class="block"> You have the best service </span>
                              <span class="time">4 minutes ago</span>
                            </div>
                          </a>
                        </div>
                      </div>
                    </li>
                    <li>
                      <a class="see-all" href="javascript:void(0);"
                        >See all messages<i class="fa fa-angle-right"></i>
                      </a>
                    </li>
                  </ul>
                </li>
                <li class="nav-item topbar-icon dropdown hidden-caret">
                  <a
                    class="nav-link dropdown-toggle"
                    href="#"
                    id="notifDropdown"
                    role="button"
                    data-bs-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                  >
                    <i class="fa fa-bell"></i>
                    <span class="notification">4</span>
                  </a>
                  <ul
                    class="dropdown-menu notif-box animated fadeIn"
                    aria-labelledby="notifDropdown"
                  >
                    <li>
                      <div class="dropdown-title">
                        You have 4 new notification
                      </div>
                    </li>
                    <li>
                      <div class="notif-scroll scrollbar-outer">
                        <div class="notif-center">
                          <a href="#">
                            <div class="notif-icon notif-primary">
                              <i class="fa fa-user-plus"></i>
                            </div>
                            <div class="notif-content">
                              <span class="block"> New user registered </span>
                              <span class="time">8 minutes ago</span>
                            </div>
                          </a>
                          <a href="#">
                            <div class="notif-icon notif-success">
                              <i class="fa fa-comment"></i>
                            </div>
                            <div class="notif-content">
                              <span class="block">
                                Mohamed commented on Admin
                              </span>
                              <span class="time">15 minutes ago</span>
                            </div>
                          </a>
                          <a href="#">
                            <div class="notif-img">
                              <img
                                src="/kaiadmin-lite-1.2.0/view/assets/img/bg-404.jpeg"
                                alt="Img Profile"
                              />
                            </div>
                            <div class="notif-content">
                              <span class="block">
                                Ines send messages to you
                              </span>
                              <span class="time">15 minutes ago</span>
                            </div>
                          </a>
                          <a href="#">
                            <div class="notif-icon notif-danger">
                              <i class="fa fa-heart"></i>
                            </div>
                            <div class="notif-content">
                              <span class="block"> Mariem liked Admin </span>
                              <span class="time">20 minutes ago</span>
                            </div>
                          </a>
                        </div>
                      </div>
                    </li>
                    <li>
                      <a class="see-all" href="javascript:void(0);"
                        >See all notifications<i class="fa fa-angle-right"></i>
                      </a>
                    </li>
                  </ul>
                </li>
                <li class="nav-item topbar-icon dropdown hidden-caret">
                  <a
                    class="nav-link"
                    data-bs-toggle="dropdown"
                    href="#"
                    aria-expanded="false"
                  >
                    <i class="fas fa-layer-group"></i>
                  </a>
                  <div class="dropdown-menu quick-actions animated fadeIn">
                    <div class="quick-actions-header">
                      <span class="title mb-1">Quick Actions</span>
                      <span class="subtitle op-7">Shortcuts</span>
                    </div>
                    <div class="quick-actions-scroll scrollbar-outer">
                      <div class="quick-actions-items">
                        <div class="row m-0">
                          <a class="col-6 col-md-4 p-0" href="#">
                            <div class="quick-actions-item">
                              <div class="avatar-item bg-danger rounded-circle">
                                <i class="far fa-calendar-alt"></i>
                              </div>
                              <span class="text">Calendar</span>
                            </div>
                          </a>
                          <a class="col-6 col-md-4 p-0" href="#">
                            <div class="quick-actions-item">
                              <div
                                class="avatar-item bg-warning rounded-circle"
                              >
                                <i class="fas fa-map"></i>
                              </div>
                              <span class="text">Maps</span>
                            </div>
                          </a>
                          <a class="col-6 col-md-4 p-0" href="#">
                            <div class="quick-actions-item">
                              <div class="avatar-item bg-info rounded-circle">
                                <i class="fas fa-file-excel"></i>
                              </div>
                              <span class="text">Reports</span>
                            </div>
                          </a>
                          <a class="col-6 col-md-4 p-0" href="#">
                            <div class="quick-actions-item">
                              <div
                                class="avatar-item bg-success rounded-circle"
                              >
                                <i class="fas fa-envelope"></i>
                              </div>
                              <span class="text">Emails</span>
                            </div>
                          </a>
                          <a class="col-6 col-md-4 p-0" href="#">
                            <div class="quick-actions-item">
                              <div
                                class="avatar-item bg-primary rounded-circle"
                              >
                                <i class="fas fa-file-invoice-dollar"></i>
                              </div>
                              <span class="text">Invoice</span>
                            </div>
                          </a>
                          <a class="col-6 col-md-4 p-0" href="#">
                            <div class="quick-actions-item">
                              <div
                                class="avatar-item bg-secondary rounded-circle"
                              >
                                <i class="fas fa-credit-card"></i>
                              </div>
                              <span class="text">Payments</span>
                            </div>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>

                <li class="nav-item topbar-user dropdown hidden-caret">
                  <a
                    class="dropdown-toggle profile-pic"
                    data-bs-toggle="dropdown"
                    href="#"
                    aria-expanded="false"
                  >
                    <div class="avatar-sm">
                      <img
                        src="../assets/img/vortex.png"
                        alt="..."
                        class="avatar-img rounded-circle"
                      />
                    </div>
                    <span class="profile-username">
                      <span class="op-7">Hi,</span>
                      <span class="fw-bold">Group Vortex</span>
                    </span>
                  </a>
                  <ul class="dropdown-menu dropdown-user animated fadeIn">
                    <div class="dropdown-user-scroll scrollbar-outer">
                      <li>
                        <div class="user-box">
                          <div class="avatar-lg">
                            <img
                              src="../assets/img/profile.jpg"
                              alt="image profile"
                              class="avatar-img rounded"
                            />
                          </div>
                          <div class="u-text">
                            <h4>Hizrian</h4>
                            <p class="text-muted">Vortex@gmail.com</p>
                            <a
                              href="profile.html"
                              class="btn btn-xs btn-secondary btn-sm"
                              >View Profile</a
                            >
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">My Profile</a>
                        <a class="dropdown-item" href="#">My Balance</a>
                        <a class="dropdown-item" href="#">Inbox</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Account Setting</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Logout</a>
                      </li>
                    </div>
                  </ul>
                </li>
              </ul>
            </div>
          </nav>
          <!-- End Navbar -->
        </div>


        <div class="container">
          <div class="page-inner">
            <h3 class="fw-bold mb-3">Upcoming Events in Tunisia</h3>
            <div class="page-category">
              Heres a list of exciting upcoming events across Tunisia. For more information, please visit the official websites.
            </div>
            <div class="row">
              <?php
              require_once '../../cnx.php';// Include the PDO connection file
              $pdo = config::getConnexion();
              $sql = "SELECT * FROM events";
              $stmt = $pdo->query($sql);
            
              foreach ($stmt as $row) {
                  echo '<div class="col-md-6">
                          <div class="card">
                            <div class="card-header">
                              <div class="card-title">Event: ' . htmlspecialchars($row['Nom']) . '</div>
                            </div>
                            <div class="card-body">
                              <p>Description: ' . htmlspecialchars($row['description']) . '</p>
                              <p>Location: ' . htmlspecialchars($row['localisation']) . '</p>
                              <p>Category: ' . htmlspecialchars($row['category']) . '</p>
                              <p>Price: ' . htmlspecialchars($row['price']) . '</p>
                              <p>Contact Info: ' . htmlspecialchars($row['contact_info']) . '</p>
                              <div class="card-action">
                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modifyEventModal">Modify</button>
                                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteEventModal">Delete</button>
                                
                              </div>
                            </div>
                          </div>
                        </div>';
              }
              ?>

            </div>
                 
              </div>
              <div class="card-action">
                <center>
                  <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addEventModal">Add</button>
                </center>
              </div>

              <!-- Add Event Modal -->
              
              <div class="modal fade" id="addEventModal" tabindex="-1" aria-labelledby="addEventLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <form id="addEventForm" method="post" enctype="multipart/form-data">
                      <div class="modal-header">
                        <h5 class="modal-title" id="addEventLabel">Add Event</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <input type="text" name="Nom" placeholder="Event Name" class="form-control mb-2" id="Nom"/>
                        <textarea name="description" placeholder="Description" class="form-control mb-2" id="description"></textarea>
                        <input type="text" name="localisation" placeholder="Location" class="form-control mb-2" id="localisation"/>
                        <select name="category" class="form-control mb-2" id="category">
                          <option value="">Select Category</option>
                          <option value="Festival">Festival</option>
                          <option value="Concert">Musical</option>
                          <option value="Concert">Concert</option>
                          <option value="Concert">Stand-up</option>
                        </select>
                        <input type="number" name="price" placeholder="Price" class="form-control mb-2" id="price"/>
                        <input type="text" name="contact_info" placeholder="Contact Info" class="form-control mb-2" id="contact_info"/>
                        <!--<div class="profile-pic-container">
                            <img id="profilePic" src="default-avatar.png" alt="Photo de Profil" class="profile-pic">
                            <label for="profilePicUpload" class="edit-pic-btn">!!!!✏️!!!!</label>
                            <input type="file" name="img" id="profilePicUpload" accept="img/*" style="display:none;">
                        </div>-->
                        <input type="hidden" name="clientValidated" id="clientValidated" value="false">

                        <p id="errorMessage" style="color:red;display:none;"></p>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" onclick="saisie()">Add Event</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- Modify Modal -->
              <div class="modal fade" id="modifyEventModal" tabindex="-1" aria-labelledby="modifyEventLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="POST" id="modifyEventForm">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modifyEventLabel">Modify Event</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="action" value="modify">
                               
                                <div class="mb-3">
                                    <label for="Nom" class="form-label">Event Name</label>
                                    <input type="text" class="form-control" id="Nom" name="Nom">
                                </div> 
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="localisation" class="form-label">Location</label>
                                    <input type="text" class="form-control" id="localisation" name="localisation">
                                </div>
                                <div class="mb-3">
                                    <label for="category" class="form-label">Category</label>
                                    <input type="text" class="form-control" id="category" name="category" >
                                </div>
                                <div class="mb-3">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="number" class="form-control" id="price" name="price" >
                                </div>
                                <div class="mb-3">
                                    <label for="contact_info" class="form-label">Contact Info</label>
                                    <input type="text" class="form-control" id="contact_info" name="contact_info">
                                </div>
                                <input type="hidden" name="action" value="modify">
                                <input type="hidden" name="eventId" value="123">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

              <!-- Delete Event Modal -->

              <div class="modal fade" id="deleteEventModal" tabindex="-1" aria-labelledby="deleteEventLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                  <form method="POST" style="display:inline;" id="deleteEventForm">
                      <input type="hidden" name="action" value="delete">
                      <input type="hidden" name="eventId" value="123">
                      <input type="hidden" name="id_event" value="<?php echo $row['id_event']; ?>">
                      <center><span style="display: inline"><h3> Are you sure ?  </h3></span>
                      <button type="submit" class="btn btn-danger" style="display: inline">Yes</button>
                      </center>
                  </form>

                  </div>
                </div>
              </div>


              <!-- tnajem tzid lehne -->
            </div>
          </div>
        </div>
        
          
        
        <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center pagination-lg">
          <li class="page-item disabled">
            <a class="page-link">Previous</a>
          </li> 
          <li class="page-item"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item">
            <a class="page-link" href="#">Next</a>
          </li>
        </ul>
      </nav>
        <footer class="footer">
          <div class="container-fluid d-flex justify-content-between">
            <nav class="pull-left">
              <ul class="nav">
                <li class="nav-item">
                  <a class="nav-link" href="">
                    TuniVerse
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#"> Help </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#"> Licenses </a>
                </li>
              </ul>
            </nav>
            <div class="copyright">
              2024, made with <i class="fa fa-heart heart text-danger"></i> by
              <a href="">TuniVerse</a>
            </div>
            <div>
              Distributed by
              <a target="_blank" href="">Vortex</a>.
            </div>
          </div>
        </footer>
      </div>

      <!-- Custom template | don't include it in your project! -->
      <div class="custom-template">
        <div class="title">Settings</div>
        <div class="custom-content">
          <div class="switcher">
            <div class="switch-block">
              <h4>Logo Header</h4>
              <div class="btnSwitch">
                <button
                  type="button"
                  class="selected changeLogoHeaderColor"
                  data-color="dark"
                ></button>
                <button
                  type="button"
                  class="selected changeLogoHeaderColor"
                  data-color="blue"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="purple"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="light-blue"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="green"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="orange"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="red"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="white"
                ></button>
                <br />
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="dark2"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="blue2"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="purple2"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="light-blue2"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="green2"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="orange2"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="red2"
                ></button>
              </div>
            </div>
            <div class="switch-block">
              <h4>Navbar Header</h4>
              <div class="btnSwitch">
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="dark"
                ></button>
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="blue"
                ></button>
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="purple"
                ></button>
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="light-blue"
                ></button>
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="green"
                ></button>
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="orange"
                ></button>
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="red"
                ></button>
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="white"
                ></button>
                <br />
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="dark2"
                ></button>
                <button
                  type="button"
                  class="selected changeTopBarColor"
                  data-color="blue2"
                ></button>
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="purple2"
                ></button>
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="light-blue2"
                ></button>
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="green2"
                ></button>
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="orange2"
                ></button>
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="red2"
                ></button>
              </div>
            </div>
            <div class="switch-block">
              <h4>Sidebar</h4>
              <div class="btnSwitch">
                <button
                  type="button"
                  class="selected changeSideBarColor"
                  data-color="white"
                ></button>
                <button
                  type="button"
                  class="changeSideBarColor"
                  data-color="dark"
                ></button>
                <button
                  type="button"
                  class="changeSideBarColor"
                  data-color="dark2"
                ></button>
              </div>
            </div>
          </div>
        </div>
        <div class="custom-toggle">
          <i class="icon-settings"></i>
        </div>
      </div>
      <!-- End Custom template -->
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script>
      $(document).ready(function () {
        // Add Event
        $('#addEventForm').submit(function (e) {
          e.preventDefault();
          $.ajax({
            url: '../../controler/events.php', // Ensure the path matches your project structure
            type: 'POST',
            data: $(this).serialize() + '&action=add',
            success: function (response) {
              alert(response); // Display server response
              location.reload(); // Refresh to show updated events
            },
            error: function () {
              alert('Error adding event');
            },
          });
        });
        // Modify Event
        $('#modifyEventForm').submit(function (e) {
          e.preventDefault();
          $.ajax({
            url: '../../controler/events.php', 
            type: 'POST',
            data: $(this).serialize() + '&action=modify',
            success: function (response) {
              alert(response); 
              location.reload(); 
            },
            error: function () {
              alert('Error modifiying event');
            },
          });
        });

        // Delete Event
        $('#deleteEventForm').submit(function (e) {
          e.preventDefault();
          $.ajax({
            url: '../../controler/events.php',
            type: 'POST',
            data: $(this).serialize() + '&action=delete',
            success: function (response) {
              alert(response);
              location.reload();
            },
            error: function () {
              alert('Error deleting event');
            },
          });
        });
      });
      </script>
    <script src="../assets/js/cntrl.js" defer></script>

    <!--   Core JS Files   -->
    <script src="/kaiadmin-lite-1.2.0/view/assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="/kaiadmin-lite-1.2.0/view/assets/js/core/popper.min.js"></script>
    <script src="/kaiadmin-lite-1.2.0/view/assets/js/core/bootstrap.min.js"></script>
    <!-- Chart JS -->
    <script src="/kaiadmin-lite-1.2.0/view/assets/js/plugin/chart.js/chart.min.js"></script>
    <!-- jQuery Scrollbar -->
    <script src="/kaiadmin-lite-1.2.0/view/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <!-- Kaiadmin JS -->
    <script src="/kaiadmin-lite-1.2.0/view/assets/js/kaiadmin.min.js"></script>
    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="/kaiadmin-lite-1.2.0/view/assets/js/setting-demo2.js"></script>
    <script>
      var lineChart = document.getElementById("lineChart").getContext("2d"),
        barChart = document.getElementById("barChart").getContext("2d"),
        pieChart = document.getElementById("pieChart").getContext("2d"),
        doughnutChart = document
          .getElementById("doughnutChart")
          .getContext("2d"),
        radarChart = document.getElementById("radarChart").getContext("2d"),
        bubbleChart = document.getElementById("bubbleChart").getContext("2d"),
        multipleLineChart = document
          .getElementById("multipleLineChart")
          .getContext("2d"),
        multipleBarChart = document
          .getElementById("multipleBarChart")
          .getContext("2d"),
        htmlLegendsChart = document
          .getElementById("htmlLegendsChart")
          .getContext("2d");

      var myLineChart = new Chart(lineChart, {
        type: "line",
        data: {
          labels: [
            "Jan",
            "Feb",
            "Mar",
            "Apr",
            "May",
            "Jun",
            "Jul",
            "Aug",
            "Sep",
            "Oct",
            "Nov",
            "Dec",
          ],
          datasets: [
            {
              label: "Active Users",
              borderColor: "#1d7af3",
              pointBorderColor: "#FFF",
              pointBackgroundColor: "#1d7af3",
              pointBorderWidth: 2,
              pointHoverRadius: 4,
              pointHoverBorderWidth: 1,
              pointRadius: 4,
              backgroundColor: "transparent",
              fill: true,
              borderWidth: 2,
              data: [
                542, 480, 430, 550, 530, 453, 380, 434, 568, 610, 700, 900,
              ],
            },
          ],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          legend: {
            position: "bottom",
            labels: {
              padding: 10,
              fontColor: "#1d7af3",
            },
          },
          tooltips: {
            bodySpacing: 4,
            mode: "nearest",
            intersect: 0,
            position: "nearest",
            xPadding: 10,
            yPadding: 10,
            caretPadding: 10,
          },
          layout: {
            padding: { left: 15, right: 15, top: 15, bottom: 15 },
          },
        },
      });

      var myBarChart = new Chart(barChart, {
        type: "bar",
        data: {
          labels: [
            "Jan",
            "Feb",
            "Mar",
            "Apr",
            "May",
            "Jun",
            "Jul",
            "Aug",
            "Sep",
            "Oct",
            "Nov",
            "Dec",
          ],
          datasets: [
            {
              label: "Sales",
              backgroundColor: "rgb(23, 125, 255)",
              borderColor: "rgb(23, 125, 255)",
              data: [3, 2, 9, 5, 4, 6, 4, 6, 7, 8, 7, 4],
            },
          ],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          scales: {
            yAxes: [
              {
                ticks: {
                  beginAtZero: true,
                },
              },
            ],
          },
        },
      });

      var myPieChart = new Chart(pieChart, {
        type: "pie",
        data: {
          datasets: [
            {
              data: [50, 35, 15],
              backgroundColor: ["#1d7af3", "#f3545d", "#fdaf4b"],
              borderWidth: 0,
            },
          ],
          labels: ["New Visitors", "Subscribers", "Active Users"],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          legend: {
            position: "bottom",
            labels: {
              fontColor: "rgb(154, 154, 154)",
              fontSize: 11,
              usePointStyle: true,
              padding: 20,
            },
          },
          pieceLabel: {
            render: "percentage",
            fontColor: "white",
            fontSize: 14,
          },
          tooltips: false,
          layout: {
            padding: {
              left: 20,
              right: 20,
              top: 20,
              bottom: 20,
            },
          },
        },
      });

      var myDoughnutChart = new Chart(doughnutChart, {
        type: "doughnut",
        data: {
          datasets: [
            {
              data: [10, 20, 30],
              backgroundColor: ["#f3545d", "#fdaf4b", "#1d7af3"],
            },
          ],

          labels: ["Red", "Yellow", "Blue"],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          legend: {
            position: "bottom",
          },
          layout: {
            padding: {
              left: 20,
              right: 20,
              top: 20,
              bottom: 20,
            },
          },
        },
      });

      var myRadarChart = new Chart(radarChart, {
        type: "radar",
        data: {
          labels: ["Running", "Swimming", "Eating", "Cycling", "Jumping"],
          datasets: [
            {
              data: [20, 10, 30, 2, 30],
              borderColor: "#1d7af3",
              backgroundColor: "rgba(29, 122, 243, 0.25)",
              pointBackgroundColor: "#1d7af3",
              pointHoverRadius: 4,
              pointRadius: 3,
              label: "Team 1",
            },
            {
              data: [10, 20, 15, 30, 22],
              borderColor: "#716aca",
              backgroundColor: "rgba(113, 106, 202, 0.25)",
              pointBackgroundColor: "#716aca",
              pointHoverRadius: 4,
              pointRadius: 3,
              label: "Team 2",
            },
          ],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          legend: {
            position: "bottom",
          },
        },
      });

      var myBubbleChart = new Chart(bubbleChart, {
        type: "bubble",
        data: {
          datasets: [
            {
              label: "Car",
              data: [
                { x: 25, y: 17, r: 25 },
                { x: 30, y: 25, r: 28 },
                { x: 35, y: 30, r: 8 },
              ],
              backgroundColor: "#716aca",
            },
            {
              label: "Motorcycles",
              data: [
                { x: 10, y: 17, r: 20 },
                { x: 30, y: 10, r: 7 },
                { x: 35, y: 20, r: 10 },
              ],
              backgroundColor: "#1d7af3",
            },
          ],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          legend: {
            position: "bottom",
          },
          scales: {
            yAxes: [
              {
                ticks: {
                  beginAtZero: true,
                },
              },
            ],
            xAxes: [
              {
                ticks: {
                  beginAtZero: true,
                },
              },
            ],
          },
        },
      });

      var myMultipleLineChart = new Chart(multipleLineChart, {
        type: "line",
        data: {
          labels: [
            "Jan",
            "Feb",
            "Mar",
            "Apr",
            "May",
            "Jun",
            "Jul",
            "Aug",
            "Sep",
            "Oct",
            "Nov",
            "Dec",
          ],
          datasets: [
            {
              label: "Python",
              borderColor: "#1d7af3",
              pointBorderColor: "#FFF",
              pointBackgroundColor: "#1d7af3",
              pointBorderWidth: 2,
              pointHoverRadius: 4,
              pointHoverBorderWidth: 1,
              pointRadius: 4,
              backgroundColor: "transparent",
              fill: true,
              borderWidth: 2,
              data: [30, 45, 45, 68, 69, 90, 100, 158, 177, 200, 245, 256],
            },
            {
              label: "PHP",
              borderColor: "#59d05d",
              pointBorderColor: "#FFF",
              pointBackgroundColor: "#59d05d",
              pointBorderWidth: 2,
              pointHoverRadius: 4,
              pointHoverBorderWidth: 1,
              pointRadius: 4,
              backgroundColor: "transparent",
              fill: true,
              borderWidth: 2,
              data: [10, 20, 55, 75, 80, 48, 59, 55, 23, 107, 60, 87],
            },
            {
              label: "Ruby",
              borderColor: "#f3545d",
              pointBorderColor: "#FFF",
              pointBackgroundColor: "#f3545d",
              pointBorderWidth: 2,
              pointHoverRadius: 4,
              pointHoverBorderWidth: 1,
              pointRadius: 4,
              backgroundColor: "transparent",
              fill: true,
              borderWidth: 2,
              data: [10, 30, 58, 79, 90, 105, 117, 160, 185, 210, 185, 194],
            },
          ],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          legend: {
            position: "top",
          },
          tooltips: {
            bodySpacing: 4,
            mode: "nearest",
            intersect: 0,
            position: "nearest",
            xPadding: 10,
            yPadding: 10,
            caretPadding: 10,
          },
          layout: {
            padding: { left: 15, right: 15, top: 15, bottom: 15 },
          },
        },
      });

      var myMultipleBarChart = new Chart(multipleBarChart, {
        type: "bar",
        data: {
          labels: [
            "Jan",
            "Feb",
            "Mar",
            "Apr",
            "May",
            "Jun",
            "Jul",
            "Aug",
            "Sep",
            "Oct",
            "Nov",
            "Dec",
          ],
          datasets: [
            {
              label: "First time visitors",
              backgroundColor: "#59d05d",
              borderColor: "#59d05d",
              data: [95, 100, 112, 101, 144, 159, 178, 156, 188, 190, 210, 245],
            },
            {
              label: "Visitors",
              backgroundColor: "#fdaf4b",
              borderColor: "#fdaf4b",
              data: [
                145, 256, 244, 233, 210, 279, 287, 253, 287, 299, 312, 356,
              ],
            },
            {
              label: "Pageview",
              backgroundColor: "#177dff",
              borderColor: "#177dff",
              data: [
                185, 279, 273, 287, 234, 312, 322, 286, 301, 320, 346, 399,
              ],
            },
          ],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          legend: {
            position: "bottom",
          },
          title: {
            display: true,
            text: "Traffic Stats",
          },
          tooltips: {
            mode: "index",
            intersect: false,
          },
          responsive: true,
          scales: {
            xAxes: [
              {
                stacked: true,
              },
            ],
            yAxes: [
              {
                stacked: true,
              },
            ],
          },
        },
      });

      // Chart with HTML Legends

      var gradientStroke = htmlLegendsChart.createLinearGradient(
        500,
        0,
        100,
        0
      );
      gradientStroke.addColorStop(0, "#177dff");
      gradientStroke.addColorStop(1, "#80b6f4");

      var gradientFill = htmlLegendsChart.createLinearGradient(500, 0, 100, 0);
      gradientFill.addColorStop(0, "rgba(23, 125, 255, 0.7)");
      gradientFill.addColorStop(1, "rgba(128, 182, 244, 0.3)");

      var gradientStroke2 = htmlLegendsChart.createLinearGradient(
        500,
        0,
        100,
        0
      );
      gradientStroke2.addColorStop(0, "#f3545d");
      gradientStroke2.addColorStop(1, "#ff8990");

      var gradientFill2 = htmlLegendsChart.createLinearGradient(500, 0, 100, 0);
      gradientFill2.addColorStop(0, "rgba(243, 84, 93, 0.7)");
      gradientFill2.addColorStop(1, "rgba(255, 137, 144, 0.3)");

      var gradientStroke3 = htmlLegendsChart.createLinearGradient(
        500,
        0,
        100,
        0
      );
      gradientStroke3.addColorStop(0, "#fdaf4b");
      gradientStroke3.addColorStop(1, "#ffc478");

      var gradientFill3 = htmlLegendsChart.createLinearGradient(500, 0, 100, 0);
      gradientFill3.addColorStop(0, "rgba(253, 175, 75, 0.7)");
      gradientFill3.addColorStop(1, "rgba(255, 196, 120, 0.3)");

      var myHtmlLegendsChart = new Chart(htmlLegendsChart, {
        type: "line",
        data: {
          labels: [
            "Jan",
            "Feb",
            "Mar",
            "Apr",
            "May",
            "Jun",
            "Jul",
            "Aug",
            "Sep",
            "Oct",
            "Nov",
            "Dec",
          ],
          datasets: [
            {
              label: "Subscribers",
              borderColor: gradientStroke2,
              pointBackgroundColor: gradientStroke2,
              pointRadius: 0,
              backgroundColor: gradientFill2,
              legendColor: "#f3545d",
              fill: true,
              borderWidth: 1,
              data: [
                154, 184, 175, 203, 210, 231, 240, 278, 252, 312, 320, 374,
              ],
            },
            {
              label: "New Visitors",
              borderColor: gradientStroke3,
              pointBackgroundColor: gradientStroke3,
              pointRadius: 0,
              backgroundColor: gradientFill3,
              legendColor: "#fdaf4b",
              fill: true,
              borderWidth: 1,
              data: [
                256, 230, 245, 287, 240, 250, 230, 295, 331, 431, 456, 521,
              ],
            },
            {
              label: "Active Users",
              borderColor: gradientStroke,
              pointBackgroundColor: gradientStroke,
              pointRadius: 0,
              backgroundColor: gradientFill,
              legendColor: "#177dff",
              fill: true,
              borderWidth: 1,
              data: [
                542, 480, 430, 550, 530, 453, 380, 434, 568, 610, 700, 900,
              ],
            },
          ],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          legend: {
            display: false,
          },
          tooltips: {
            bodySpacing: 4,
            mode: "nearest",
            intersect: 0,
            position: "nearest",
            xPadding: 10,
            yPadding: 10,
            caretPadding: 10,
          },
          layout: {
            padding: { left: 15, right: 15, top: 15, bottom: 15 },
          },
          scales: {
            yAxes: [
              {
                ticks: {
                  fontColor: "rgba(0,0,0,0.5)",
                  fontStyle: "500",
                  beginAtZero: false,
                  maxTicksLimit: 5,
                  padding: 20,
                },
                gridLines: {
                  drawTicks: false,
                  display: false,
                },
              },
            ],
            xAxes: [
              {
                gridLines: {
                  zeroLineColor: "transparent",
                },
                ticks: {
                  padding: 20,
                  fontColor: "rgba(0,0,0,0.5)",
                  fontStyle: "500",
                },
              },
            ],
          },
          legendCallback: function (chart) {
            var text = [];
            text.push('<ul class="' + chart.id + '-legend html-legend">');
            for (var i = 0; i < chart.data.datasets.length; i++) {
              text.push(
                '<li><span style="background-color:' +
                  chart.data.datasets[i].legendColor +
                  '"></span>'
              );
              if (chart.data.datasets[i].label) {
                text.push(chart.data.datasets[i].label);
              }
              text.push("</li>");
            }
            text.push("</ul>");
            return text.join("");
          },
        },
      });

      var myLegendContainer = document.getElementById("myChartLegend");

      // generate HTML legend
      myLegendContainer.innerHTML = myHtmlLegendsChart.generateLegend();

      // bind onClick event to all LI-tags of the legend
      var legendItems = myLegendContainer.getElementsByTagName("li");
      for (var i = 0; i < legendItems.length; i += 1) {
        legendItems[i].addEventListener("click", legendClickCallback, false);
      }
    </script>
  </body>
</html>
