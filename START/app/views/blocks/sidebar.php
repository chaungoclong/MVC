<h4 class="navbar-brand"><?= $web_name ?? "" ?></h4>
<ul class="nav flex-column p-0">
  <li class="nav-item"><a class="nav-link" href="<?= WEB_PATH . '/class/list' ?>">CLASSROOM</a></li>
  <li class="nav-item"><a class="nav-link" href="<?= WEB_PATH . '/student/list' ?>">STUDENT</a></li>
</ul><br>
<div class="input-group">
  <input type="text" class="form-control" placeholder="Search Blog..">
  <span class="input-group-btn">
    <button class="btn btn-default" type="button">
      <span class="glyphicon glyphicon-search"></span>
    </button>
  </span>
</div>