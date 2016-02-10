<?php
/*****************************************************************
*        DO NOT REMOVE                                           *
*        =============                                           *
*PetClinic Management Software                                   *
*Copyrighted 2015-2016 by Michael Avila                          *
*Distributed under the terms of the GNU General Public License   *
*This program is distributed in the hope that it will be useful, *
* but WITHOUT ANY WARRANTY; without even the implied warranty of *
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.           *
*****************************************************************/
session_start();
$logFileName = "user";
$headerTitle="USER LOG";
require_once "includes/common.inc";
/*
_FILES["myFile"]["name"] stores the original filename from the client
$_FILES["myFile"]["type"] stores the file’s mime-type
$_FILES["myFile"]["size"] stores the file’s size (in bytes)
$_FILES["myFile"]["tmp_name"] stores the name of the temporary file
$_FILES[“myFile”][“error”] stores any error code resulting from the transfer
*/
define("UPLOAD_DIR", "/wamp/www/petclinic/uploads/");
require_once "includes/expire.inc";
/*
// show upload form
if ($_SERVER["REQUEST_METHOD"] == "GET") {
?>
<em>Only GIF, JPG, and PNG files are allowed.</em>
<form action="upload.php" method="post" enctype="multipart/form-data">
 <input type="file" name="myFile"/>
 <br/>
 <input type="submit" value="Upload"/>
</form>
<?php
}
*/
// process file upload
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_FILES["myFile"])) {
    $myFile = $_FILES["myFile"];
    if ($myFile["error"] !== UPLOAD_ERR_OK) {
        echo "<p>An error occurred.</p>";
        exit;
    }
    // verify the file type
    $fileType = exif_imagetype($_FILES["myFile"]["tmp_name"]);
    $allowed = array(IMAGETYPE_PNG);
    if (!in_array($fileType, $allowed)) {
        echo "<p>File type is not permitted.</p>";
        exit;
    }
    // ensure a safe filename
    $name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);
    // don't overwrite an existing file
    $i = 0;
    $parts = pathinfo($name);
    while (file_exists(UPLOAD_DIR . $name)) {
        $i++;
        $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
    }
    // preserve file from temporary directory
    $success = move_uploaded_file($myFile["tmp_name"], UPLOAD_DIR . $name);
    if (!$success) {
        echo "<p>Unable to save file.</p>";
        exit;
    }
    // set proper permissions on the new file
    chmod(UPLOAD_DIR . $name, 0644);
    
	$petid = $_COOKIE['petid'];
	$petid = "pet".str_pad($petid, 5, "00000", STR_PAD_LEFT).".png";
	chdir("./uploads");
	rename($name, $petid);
	chdir("..");
	require_once "password.php";
	$mysqli = new mysqli('localhost', $user, $password, '');
	$sql = "USE petclinic;";
	if ($mysqli->query($sql) === TRUE) {
	} else {
		echo "Error selecting to use petlinic" . $mysqli->error;
		exit(1);
	}
	$emplnumber = $_COOKIE['employeenumber'];
	$editpetnum = $_POST["petid"];
	$sql = "UPDATE pet SET `picture` = \"Y\" WHERE `petnumber` = ".$petid.";";
	$result = $mysqli->query($sql);
	if ($result == FALSE)
	{
          put_errormsg("Pet Picture Upload Failed");          
          redirect("mainmenu.php");
		exit();
	}
	$mysqli->close();
     put_errormsg("Uploaded file saved as ".$petid);
     redirect("maintmenu.php");
}
?>