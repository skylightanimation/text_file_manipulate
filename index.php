<?php 
    include_once ('action.php');
    $baseUrl = base_url();
    header("Location:".$baseUrl."/action.php?menu=note&action=list");
?>S