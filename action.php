<?php

require 'config.php';


if(isset($_GET['menu']) && isset($_GET['action'])) {
  handler();
}
// if(isset($_POST['title']) && isset($_POST['content'])) {

//   function died($error) {
//     echo "Error : <br />";
//     echo $error."<br /><br />";
//     die();
//   }
 
//   $regex = "/^[A-Za-z .'-]+$/";
//   $error_message = '';
//   $title = $_POST['title'];
//   $content = $_POST['content'];


//   if(!preg_match($regex, $title)) {
//     $error_message = 'Title eliminate.<br />';
//   } 

//   if(!preg_match($regex, $content)) {
//     $error_message = 'Content eliminate.<br />';
//   }



//   if(strlen($error_message) > 0) {
//     died($error_message);
//   }

//   // echo __DIR__;



//   echo "access";
// }

function createId(){
  $id = 0;
  $getData = read();
  $count = count($getData);
  $lastString = $getData[$count-1]['id'];
  $id = (int)$lastString;
  $id = $id+1;

  return  $id;

}

function createRow($title, $content){
  $id = createId();
  $data = '';

  if($id > 0){
    $data = "\n".$id."|".$title."|".$content;
  }  else{
    $data = $id."|".$title."|".$content;
  }

  return $data;
}

function getRowIndex($id)
{
  $index = 0;
  $getData = read();
  foreach ($getData as $key => $row) {
    if ($row['id'] == $id) {
      // echo $key;
      $index = $key;
      return $index;
    }
  }

}


// updateRow(14, 'Update Data', 'Save Upddate Data');
function updateRow($id, $title, $content){
  $data = '';
  $dataTemp = array();
  $getData = read();

  $index = getRowIndex($id);

  // array_replace($array1, $array2);

  // $ar = array_replace($ar,
  //     array_fill_keys(
  //         array_keys($ar, $value),
  //         $replacement
  //     )
  // );

  $getData[$index]['id'] = $id;
  $getData[$index]['title'] = $title;
  $getData[$index]['content'] = $content."\n";

  // echo json_encode($getData);

  // unset($getData[$index]);

  // echo $index;

  foreach ($getData as $key => $row) {
    // if($key > 0){
    //   // $data = $data."\n".$row['id']."|".$row['title']."|".$row['content'];
    // }  else{
      $data = $data.$row['id']."|".$row['title']."|".$row['content'];
    // }
  }
  // echo $data;
  return $data;
}


// removeRow(14);
function removeRow($id){
  $data = '';
  $getData = read();
  // foreach ($getData as $key => $row) {
  //   if ($row['id'] == $id) {
  //     return $row;
  //   }
  // }

  $index = getRowIndex($id);

  // echo  $index;

  unset($getData[$index]);

  foreach ($getData as $key => $row) {
    if($key > 0){
      $data = $data."\n".$row['id']."|".$row['title']."|".$row['content'];
    }  else{
      $data = $data.$row['id']."|".$row['title']."|".$row['content'];
    }
  }

  // echo $data;
  return $data;
  // echo json_encode($getData);
  // echo json_encode($pop);

  // $count = count($getData);
  // $lastString = $getData[$count-1]['id'];
  // $id = (int)$lastString;
  // $id = $id+1;

  // return  $id;
}





function read(){
  $data = array();
  require 'config.php';
  $pathfile = $path."/".$filename;

  $accessData = fopen($pathfile, "r") or die("Unable to open file!");
  // echo fgets($accessData);

  while(!feof($accessData)) {
    $rowArray = array();
    $row = fgets($accessData);
    // echo json_encode($row);
    $rowdata = explode('|', $row);


    $rowArray['id'] = $rowdata[0];
    $rowArray['title'] = $rowdata[1];
    $rowArray['content'] = $rowdata[2];

    array_push($data, $rowArray);

    // print($rowdata);
    // print_r($rowdata);
    // echo json_encode($rowdata);
  }
  fclose($accessData);

  return $data;
  // echo json_encode($data);
}


function readById($id){
  $data =array();
  $getData = read();

  foreach ($getData as $key => $row) {
    if ($row['id'] == $id) {
      return $row;
    }
  }

  return $data;
}



function overwrite($value){
  require 'config.php';
  $pathfile = $path."/".$filename;

  $accessData = fopen($pathfile, "w") or die("Unable to open file!");
  // $txt = "Mickey Mouse\n";
  fwrite($accessData, $value);
  // $txt = "Minnie Mouse\n";
  // fwrite($myfile, $txt);
  fclose($accessData);
}

function write($value){
  require 'config.php';

  // echo "? ";
  $pathfile = $path."/".$filename;
  $accessData = fopen($pathfile, "a") or die("Unable to open file!");

  // $txt = "Donald Duck\n";
  // fwrite($myfile, $txt);
  // $txt = "Goofy Goof\n";
  fwrite($accessData, $value);
  fclose($accessData);
}


function checkRegex($value){
  $regex = "/^[A-Za-z]+$/";
  // $error_message = '';
  $result = false;
  // echo $value;
  if (!empty($value)) {
    if(!preg_match($regex, $value)) {
      // $error_message = 'Title eliminate.<br />';
      $result = false;
    } else{
      $result = true;
    }

  } else{
    $result = false;
  }
  // echo $result;

  return $result;
}


function base_url(){
  require 'config.php';
  return $ssl."://".$hostname.":".$port."/".$dashboard_path;
}

function getMappingMenuActionIndex($menuValue, $actionValue){

  require 'config.php';
  $index = null;

  foreach ($menu_action as $key => $row) {
      if ($row['menu'] == $menuValue && $row['action'] == $actionValue) {
          // $index = $key;
          // echo $key;
          return $key;
      }
  }
}



function access(){
  require 'config.php';
  $result = array();
  $access = '';
  $message = '';
  $status = false;

  if (!isset($_GET['menu']) &&  !isset($_GET['action'])) {
    $url = base_url();
    // echo $url;
    header("Location:".$url);
  }
  

  $getMenu = $_GET['menu'];
  $getAction = $_GET['action'];




  $checkMenuRegex = checkRegex($getMenu);
  $checkActionRegex = checkRegex($getAction);
  $index = null;

  if ($checkMenuRegex == true && $checkActionRegex == true ) {
    $checkMenu = in_array($getMenu, $menu);
    $checkAction = in_array($getAction, $action);


    if ($checkMenu == true && $checkAction == true) {
      $getMenuIndex = array_search($getMenu, $menu);
      $getActionIndex = array_search($getAction, $action);

      $getIndexMenuAction = getMappingMenuActionIndex($getMenuIndex, $getActionIndex);
      // echo json_encode($getIndexMenuAction);
      if ($getIndexMenuAction >=0 ) {
          
        // $getIndexMenuAction = in_array($getIndexAction['menu'], $menu_action[$getPage]);
        // $checkMenu = in_array($getPage, $menu);
        // echo json_encode($getIndexMenuAction);

        $access = 'success';
        $message = 'success';
        $status = true;
       
      }else{
        $message = 'Mapping Menu not Found!!!';
          $status = false;
      }

    }else{
      $message = 'Data Master Not Found!!!';
      $status = false;
    }
  }else{
    $url = base_url();
    // echo $url;
    header('Location:'.$url);
    // $message = 'Data Master Not Found!!!';
    // $status = false;
  }

  // echo "<br>getMenu : ".json_encode($getMenu);
  // echo "<br>getAction : ".json_encode($getAction);

  // echo "<br> checkMenu : ".json_encode($checkMenu);
  // echo "<br> checkAction : ".json_encode($checkAction);
  // echo '<br> getMenuIndex : '.$getMenuIndex;
  // echo '<br> getActionIndex : '.$getActionIndex;
  // echo "<br> getIndexMenuAction (maping) : ".$getIndexMenuAction;
  // echo "<br> MenuAction (Arr) : ".json_encode($menu_action[$getIndexMenuAction]);


  if ($menu_action[$getIndexMenuAction]['type'] == $type[0]) {
    $result['view'] = $menu_action[$getIndexMenuAction]['view'];
  }

  $result['type'] = $type[$menu_action[$getIndexMenuAction]['type']];
  $result['access'] = $access;
  $result['message'] = $message;
  $result['status'] = $status;

  return $result;
}


function handler(){
  require 'config.php';
  $baseUrl = base_url();

  $data = access();
  // echo json_encode($data);

    if ($data['type'] == $type[0]) {

      if ($_GET['action'] == $action[5]) {

        // echo $_GET['id'];
        if (!isset($_GET['id'])) {
           
            header("Location:".$baseUrl);
        }
      }
      include ($data['view']);
    }else if ($data['type'] == $type[1]) {
      if ($_GET['action'] == $action[1]) {
        // echo json_encode($_POST['content']);
        // echo json_encode($_POST['title']);
        if(isset($_POST['content']) && isset($_POST['title'])) {
          $content = $_POST['content'];
          $title = $_POST['title'];

          $push = createRow($title, $content);
          write($push);
          header("Location:".$baseUrl."/action.php?menu=note&action=list");
        }else{
          header("Location:".$baseUrl);
        }
        

      }elseif ($_GET['action'] == $action[2]) {

        // echo json_encode($_POST['id']);
        // echo json_encode($_POST['content']);
        // echo json_encode($_POST['title']);

        if(isset($_POST['content']) && isset($_POST['title']) && isset($_POST['id'])) {
          $content = $_POST['content'];
          $title = $_POST['title'];
          $id = $_POST['id'];

          // echo 'HELLO';

          $push = updateRow($id, $title, $content);
          overwrite($push);
          header("Location:".$baseUrl."/action.php?menu=note&action=list");
        }else{
          header("Location:".$baseUrl);
        }


      } 


    }
}



// $testValue = '12|Test12|Hello World';

// write();
// $test = read();
// echo json_encode($test);
// echo '<br><br>';

// overwrite($testValue);
// $test1 = read();
// echo json_encode($test1);
// echo '<br><br>';





// if () {
//   # code...
// }




?>