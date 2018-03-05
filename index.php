<html>
<?php
        error_reporting(1);
        $conn = new mysqli("localhost", "root", "", "test");
    if ($conn->connect_error) {
        die("Error: ".$conn->connect_error);
    }
if (ISSET($_POST['upd'])) {
    extract($_POST);
        $target_dir = "test_upload/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    if ($imageFileType != "mp4" && $imageFileType != "avi" && $imageFileType != "mov" && $imageFileType != "3gp" && $imageFileType != "mpeg") {
        echo "File Format Not Suppoted";
    } else {
        $video_path = $_FILES['fileToUpload']['name'];
        $insert = $conn->query("insert into video(video_name) values('$video_path')");
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$target_file);
        echo "uploaded ";
    }
    }
    //display all uploaded video
if (ISSET($_POST['disp'])) {
        $query = $conn->query("select * from video");
            while ($all_video = $query->fetch_assoc()) {
?>
	<video width="300" height="200" controls>
	<source src="test_upload/<?php echo $all_video['video_name']; ?>" type="video/mp4">
	</video> 	
    <?php } } ?>
    <form method="post" enctype="multipart/form-data">
        <table border="1">
            <tr><td>Upload  Video</td></tr>
            <tr><td>
                <input type="file" name="fileToUpload"/>
            </td></tr>
            <tr><td>
                <input type="submit" value="Uplaod Video" name="upd"/>
                <input type="submit" value="Display Video" name="disp"/>
            </td></tr>
        </table>
    </form>
</html>