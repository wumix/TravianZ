<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       editResources.php                                           ##
##  Developed by:  aggenkeech                                                  ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2012. All rights reserved.                ##
##                                                                             ##
#################################################################################
if (!isset($_SESSION)) session_start();
if($_SESSION['access'] < 9) die("Access Denied: You are not Admin!");
include_once("../../config.php");

$GLOBALS["link"] = mysqli_connect(SQL_SERVER, SQL_USER, SQL_PASS);
mysqli_select_db($GLOBALS["link"], SQL_DB);

$session = $_POST['admid'];
$id = $_POST['did'];

$sql = mysqli_query($GLOBALS["link"], "SELECT * FROM ".TB_PREFIX."users WHERE id = ".$session."");
$access = mysqli_fetch_array($sql);
$sessionaccess = $access['access'];

if($sessionaccess != 9) die("<h1><font color=\"red\">Access Denied: You are not Admin!</font></h1>");

mysqli_query($GLOBALS["link"], "UPDATE ".TB_PREFIX."vdata SET 
	wood  = '".$_POST['wood']."', 
	clay  = '".$_POST['clay']."', 
	iron  = '".$_POST['iron']."', 
	crop  = '".$_POST['crop']."', 
	maxstore  = '".$_POST['maxstore']."', 
	maxcrop   = '".$_POST['maxcrop']."' 
	WHERE wref = '".$id."'") or die(mysqli_error());

header("Location: ../../../Admin/admin.php?p=village&did=".$id."");
?>