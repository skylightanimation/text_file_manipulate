<?php 
    include_once ('action.php');
    $baseUrl = base_url();
    header("Location:".$baseUrl."/action.php?menu=note&action=list");
?>

<!DOCTYPE html>
<head>
    <title>Text File Manipulation | SkyLight_Animation</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"  crossorigin="anonymous"></script>
</head>
<body>
 <div class="container">
    <div  class="col-md-12">
        <h1><b>Note</b><hr></h1>
    </div>
    <form action="read()" method="post">
        <div  class="col-md-12">
            <div class="from-group">
                <label>Title</label>
                <input type="text" class="form-control" name="title" placeholder="Title">
            </div>
            <br>
            <div class="from-group">
                <label>Content</label>
                <textarea  rows="5" name="content" cols="30" class="form-control"></textarea>
            </div>
            <br>
            <center><input type="submit" name="submit" value="
                    Submit" class="btn btn-primary"></center>
        </div>
    </form>

    <div  class="col-md-12">
      <h2>Notes</h2>
      <p>Note Lists</p>            
      <table class="table table-bordered">
        <thead>
          <tr>
            <th><center>No</center></th>
            <th><center>Title</center></th>
            <th><center>Content</center></th>
          </tr>
        </thead>
        <tbody>
          
        </tbody>
      </table>
    </div>
</div>

</body>
</html> 