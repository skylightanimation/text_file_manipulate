<?php include_once ('action.php'); ?>
<?php

    $data = readById($_GET['id']);
    if (count($data) == 0) {
        $url = base_url();
        header("Location:".$url);
    }

?>


<!DOCTYPE html>
<head>
    <title>Text File Manipulation | SkyLight_Animation</title>
    <?php include ('views/components/v_head.php'); ?>
</head>
<body>
 <div class="container">
    <div  class="col-md-12">
        <h1><b>Note</b><hr></h1>
    </div>
    <form  action="<?php echo base_url(); ?>/action.php?menu=note&action=overwrite" method="post">
        <div  class="col-md-12">
            <div class="from-group hidden">
                <label>ID</label>
                <input type="text" class="form-control" name="id" placeholder="id" value="<?php echo $data['id']; ?>">
            </div>
            <div class="from-group">
                <label>Title</label>
                <input type="text" class="form-control" name="title" placeholder="Title" value="<?php echo $data['title']; ?>">
            </div>
            <br>
            <div class="from-group">
                <label>Content</label>
                <textarea  rows="5" name="content" cols="30" class="form-control"><?php echo $data['content']; ?></textarea>
            </div>
            <br>
            <center><input type="submit" name="submit" value="
                    Save" class="btn btn-primary"></center>
        </div>
    </form>
</div>

</body>
</html> 