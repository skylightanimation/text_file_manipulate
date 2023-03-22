<?php include_once ('action.php'); ?>

<!DOCTYPE html>
<head>
    <title>Text File Manipulation | SkyLight_Animation</title>
    <?php include ('views/components/v_head.php'); ?>
</head>
<body>
 <div class="container">
    <div  class="col-md-12">
        <h1><b>Note</b> 
            <div class="pull-right">
            <a href="<?php echo base_url() ?>/action.php?menu=note&action=add" class="btn btn-success"><span> Add</span></a>
            </div>
        </h1>
        <p> Note Lists</p>
    </div>
    <div  class="col-md-12">
        <hr>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th><center>No</center></th>
            <th><center>Title</center></th>
            <th><center>Content</center></th>
            <th><center>Action</center></th>
          </tr>
        </thead>
        <tbody>
            <?php 
                $data = read();
            ?>

            <?php if (count($data) > 0): ?>
                <?php foreach ($data as $key => $row): ?>
                    <tr>
                        <td><center><?php echo $key+1; ?> </center></td>
                        <td><?php echo $row['title']; ?> </td>
                        <td><?php echo $row['content']; ?> </td>
                        <td>
                            <center>
                            <a href="<?php echo base_url() ?>/action.php?menu=note&action=edit&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                            <!-- <a href="<?php //echo base_url() ?>/action.php?menu=note&action=remove&id=<?php //echo $row['id']; ?>" class="btn btn-sm btn-danger">Delete</a> -->
                            </center>
                        </td>
                    </tr>
                <?php endforeach ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Data Empty !!!</td>
                </tr>
            <?php endif ?>


        </tbody>
      </table>
    </div>
</div>

</body>
</html> 