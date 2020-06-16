<!-- fixed-top-->
<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-light">
  <div class="navbar-wrapper">
    <div class="navbar-container content">
      <div class="collapse navbar-collapse show" id="navbar-mobile">
        <ul class="nav navbar-nav mr-auto float-left">
          <li class="nav-item d-block d-md-none"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu"></i></a></li>
          <li class="nav-item d-none d-md-block"><a class="nav-link nav-link-expand" href="#"><i class="ficon ft-maximize"></i></a></li>
          <li class="nav-item dropdown navbar-search"><a class="nav-link dropdown-toggle hide" data-toggle="dropdown" href="#"><i class="ficon ft-search"></i></a>
            <ul class="dropdown-menu">
              <li class="arrow_box">
                <form>
                  <div class="input-group search-box">
                    <div class="position-relative has-icon-right full-width">
                      <input class="form-control" id="search" type="text" placeholder="Search here...">
                      <div class="form-control-position navbar-search-close"><i class="ft-x"> </i></div>
                    </div>
                  </div>
                </form>
              </li>
            </ul>
          </li>
        </ul>
        <ul class="nav navbar-nav float-right">
          <li class="dropdown dropdown-notification nav-item"><a onclick="notificationRead()" class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon ft-mail"> </i></a>
            <div class="dropdown-menu dropdown-menu-right" style="padding:10px;">
              <div class="arrow_box_right">
                <?php
                $query_notifications = "SELECT *, e.date as DATE_DEPASSEMENT FROM notification n, infected i, emplacement e where n.infected_cin = i.CIN and n.emplacement_id = e.id LIMIT 10;";
                $r = mysqli_query($db, $query_notifications);
                foreach ($r as $notification) {
                  if ($notification['treated']) {
                ?>
                    <a class="dropdown-item" style="margin-bottom:5px" href="#"><i class="la la-check-circle-o"></i> <?php echo $notification['firstname'] . " " . $notification['lastname'] . " a dépassé sa zone le " . $notification['DATE_DEPASSEMENT']; ?></a>
                  <?php
                  } else {
                  ?>
                    <a style="background-color:#ebebeb;margin-bottom:5px" class="dropdown-item" href="#"><i class="la la-check-circle-o"></i> <?php echo $notification['firstname'] . " " . $notification['lastname'] . " a dépassé sa zone le " . $notification['DATE_DEPASSEMENT']; ?></a>
                <?php
                  }
                }
                ?>
              </div>
            </div>
          </li>
          <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown"> <span class="avatar avatar-online"><img src="/projet/template/theme-assets/images/portrait/small/avatar-s-19.png" alt="avatar"><i></i></span></a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="arrow_box_right"><span class="user-name text-bold-700 ml-1" style="padding:20px 0;display:block;"><?php echo $_SESSION['username']; ?></span></span>
                <div class="dropdown-divider"></div><a class="dropdown-item" href="logout.php"><i class="ft-power"></i> Logout</a>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>

<script>
  function notificationRead(id) {
    var http = new XMLHttpRequest();
    var url = 'notification_read.php';
    http.open('GET', url, true);

    //Send the proper header information along with the request

    http.onreadystatechange = function() { //Call a function when the state changes.
      if (http.readyState == 4 && http.status == 200) {
        // alert(http.responseText);
      }
    }
    http.send();
  }
</script>