<?php
include("includes/header.php");

if(isset($_POST['post'])){


  $imageName = $_FILES['fileToUpload']['name'];
  //Get the temp file path
  $tmpFilePath = $_FILES['fileToUpload']['tmp_name'];

  //Make sure we have a file path
  if ($tmpFilePath != ""){
    //Setup our new file path
    $newFilePath = "assets/images/group_cover/" . $_FILES['fileToUpload']['name'];

    //Upload the file into the temp dir
    if(move_uploaded_file($tmpFilePath, $newFilePath)) {


    }
     $post = new Groups($con, $userLoggedIn);
    $post->create_group($userLoggedIn, $newFilePath);
      //Handle other code here
  }
 
}
 


?>


    
     

<div class="container">

	<div class="user_details column"  style="height: 400px; overflow: auto;">
  
  <div class="trends">
    <button type="button" class="btn btn-primary" onclick="show();">Create New Group</button>
    <div id="groups_form" style="display: none;">
      <form action="groups.php" method="POST" enctype="multipart/form-data">
      <input type="text" name="groupname" class="form-control" placeholder="Enter Group Name">  
      <textarea class="form-control" name="groupdes">Add Description</textarea>
      <select class="form-control" id="group_type" name="group_type">
        <option  class="form-control" >Select..</option>
        <option value="private">Private</option>
        <option value="public">Public</option>
      </select>
       <div class="image-upload">
        
          <label for="fileToUpload">
            <img src="assets/images/backgrounds/plus_sign.png" style="height: 8vh;margin-left: 40px;margin-bottom: 11px;"><br>
<p style="margin-left: 8px;color: turquoise;position:inherit;">Add cover photo</p>
<input type="file" name="fileToUpload" id="fileToUpload" value="post" style="display:block;">
          </label>
          <br>
  
 <input type="submit" name="post" value="Save"> 
        </div>
      </form>
      
    </div>
    <br>
    <div>Available Groups
<?php
$posts = new Groups($con, $userLoggedIn);
$posts->new_group();

?>
    </div>

</div>
</div>
</div>
<script type="text/javascript">
 function show() {
  var x = document.getElementById("groups_form");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
</script>