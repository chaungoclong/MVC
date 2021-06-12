<!DOCTYPE html>
<html lang="en">
<head>
  <?php block("blocks.head", ["title" => config("app.title")]); ?>
</head>
<body>

<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-3 sidenav">
       <?php block("blocks.sidebar", ["web_name" => config("app.web_name")]); ?>
    </div>

    <div class="col-sm-9">
    	{{content}}
    </div>
  </div>
</div>

<footer class="container-fluid">
 	 <?php block("blocks.footer"); ?>
</footer>

</body>
</html>
