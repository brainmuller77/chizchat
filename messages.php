

<?php 
include("includes/header.php");
include("includes/page.php");
include("includes/audio.php");

$message_obj = new Message($con, $userLoggedIn);

if(isset($_GET['u'])){
	$user_to = $_GET['u'];
}
else {
	$user_to = $message_obj->getMostRecentUser();
	if($user_to == false)
		$user_to = 'new';
}

if($user_to != "new"){
	$user_to_obj = new User($con, $user_to);
}

if(isset($_POST['post_message'])) {

	if(isset($_POST['message_body'])) {
		
   	 $files = array_filter($_FILES['post_message_file']['name']); //something like that to be used before processing files.

// Count # of uploaded files in array
$total = count($_FILES['post_message_file']['name']);

// Loop through each file
for( $i=0 ; $i < $total ; $i++ ) {

  //Get the temp file path
  $tmpFilePath = $_FILES['post_message_file']['tmp_name'][$i];
 
  //Make sure we have a file path
  //if ($tmpFilePath != ""){
    //Setup our new file path
    $newFilePath = "../assets/images/chats/" . $_FILES['post_message_file']['name'][$i];

    //Upload the file into the temp dir
    if(move_uploaded_file($tmpFilePath, $newFilePath)) {


    }
	
   $body = mysqli_real_escape_string($con, $_POST['message_body']);
		$date = date("Y-m-d H:i:s");
		$message_obj->sendMessage($user_to, $body, $date,$newFilePath);

  }

	}
}
if (isset($_POST['audio_submit'])) {
  # code...
  $audio =  $_FILES['audio_submit']['tmp_name'];
  $audio = str_replace('data:audio/wav;base64,', '', $audio);
  $decoded = base64_decode($audio);
  $newFilePath = "../assets/images/chats/".$decoded.".wav";
 
  file_put_contents($newFilePath, $decoded);
  $body = mysqli_real_escape_string($con, $_POST['message_body']);
    $date = date("Y-m-d H:i:s");
    $message_obj->sendMessage($user_to, $body, $date,$newFilePath);

}

 

  
 ?>

 

	<div class="main_column column" id="main_column">
		<?php  
 

              
		if($user_to != "new"){
 $query = mysqli_query($con,"SELECT lastseen,status FROM users WHERE username = '$user_to'");
   if(!$query){
			printf("Error: %s\n", mysqli_error($con));
			exit();
		}
  while($row = mysqli_fetch_array($query)) {
  	# code...
  	$lastseen = $row['lastseen'];
  	 $dayofweek = date("d",strtotime($row['lastseen']));
      $date_month = date("M",strtotime($row['lastseen']));
      $day = date("D",strtotime($row['lastseen']));
       $sdate_time = date("d",strtotime($row['lastseen']));
      $sdate_month = date("m",strtotime($row['lastseen']));
      $sday = date("l",strtotime($row['lastseen']));
       $from = date("g",strtotime($row['lastseen']));
        $min = date("i",strtotime($row['lastseen']));
         $sfrom = date("g",strtotime($row['lastseen']));
        $sto = date("a",strtotime($row['lastseen']));
    $status = $row['status'];

    	//Timeframe
		$date_time_now = date("Y-m-d");
	//	echo $date_time_now;
		$start_date =date("Y-m-d",strtotime($row['lastseen'])); //Time of post
	//	echo $start_date;
		$end_date = new DateTime($date_time_now);  //Current time
	
	//	$intervals =strtotime($end_date)-  strtotime(($start_date)); 
		

    if (isset($_SESSION) && $status=="online") {
    	# code...
    	echo "<h4><a href='$user_to'>'<img style='border-radius: 55px; margin-right: 5px;width:10%;height:50px;' src='".$user_to_obj->getProfilePic()."'>'". $user_to_obj->getFirstAndLastName() ."</a>"."</h4>
               <span>".$status."</span>
			<hr>";
			echo "<div class='loaded_messages' id='scroll_messages'>";
				echo $message_obj->getMessages($user_to);
			echo "</div>";
    }else if ($status == "offline") {
    	if (substr($start_date,0, 10)===date('Y-m-d',strtotime('0 day'))) {
    		# code...
    		echo "<h4><a href='$user_to'>'<img style='border-radius: 55px; margin-right: 5px;width:10%;height:50px;' src='".$user_to_obj->getProfilePic()."'>'". $user_to_obj->getFirstAndLastName() ."</a>"."</h4>
               <span class='timestamp_smaller'> last seen today at ".$sfrom.":".$min.$sto. "</span>
			<hr>";
			echo "<div class='loaded_messages' id='scroll_messages'>";
				echo $message_obj->getMessages($user_to);
			echo "</div>";
     	}else if (substr($start_date,0, 10)===date('Y-m-d',strtotime('-1 day'))) {
    		echo "<h4><a href='$user_to'>'<img style='border-radius: 55px; margin-right: 5px;width:10%;height:50px;' src='".$user_to_obj->getProfilePic()."'>'". $user_to_obj->getFirstAndLastName() ."</a>"."</h4>
               <span class='timestamp_smaller'> last seen yesterday at ".$sfrom.":".$min.$sto. "</span>
			<hr>";
			echo "<div class='loaded_messages' id='scroll_messages'>";
				echo $message_obj->getMessages($user_to);
			echo "</div>";
    	}
    }else{
    	echo "<h4><a href='$user_to'>'<img style='border-radius: 55px; margin-right: 5px;width:10%;height:50px;' src='".$user_to_obj->getProfilePic()."'>'". $user_to_obj->getFirstAndLastName() ."</a>"."</h4>
               <span class='timestamp_smaller'> lastseen at ".$day.", ".$date_month." ".$dayofweek." ".$sfrom.":".$min.$sto. "</span>
			<hr>";
			echo "<div class='loaded_messages' id='scroll_messages'>";
				echo $message_obj->getMessages($user_to);
			echo "</div>";
    }
			
		}
	}
		else {
			echo "<h4>New Message</h4>";
		}
	
		?>



		<div class="message_post">
			<form action="" method="POST" enctype="multipart/form-data">
				<?php
				if($user_to == "new") {
					echo "Select the friend you would like to message <br><br>";
					?> 
					To: <input type='text' onkeyup='getUsers(this.value, "<?php echo $userLoggedIn; ?>")' name='q' placeholder='Name' autocomplete='off' id='seach_text_input'>



					<?php
					echo "<div class='results'></div>";

           echo $message_obj->getUsers();
				}
				else {
         echo "<div>

          <div id='output'></div>

          <p class='emoji-picker-container' style='width:500px;'>

            <textarea data-emojiable='true'
              data-emoji-input='unicode' type='text' name='message_body' id='message_textarea' placeholder='Write your message ...'> 
              </textarea>
                <input type='submit' name='post_message' class='info' id='message_submit' value='Send'><br>
             
             <input type='file' name='post_message_file[]' class='info' id='message_submit_file' value='Add file' multiple>
            
    <canvas id='analyser' width='102' height='50'></canvas>
    <canvas id='wavedisplay' width='102' height='50' display='none'></canvas>
    <img id='record' src='img/mic128.png' onclick='toggleRecording(this);'>
    <a id='save' href='#''><img src='img/save.svg'></a>
   <div>
    <h3>Recordings</h3>
    <ol id='audio_data' name='audio_data'></ol>
      <input type='submit' name='audio_submit' class='info' id='audio_submit' value='Send' style='display:none;'>
  </div>
          </p>
        
      
 
  

          </div>";
					
					
				}

				?>
			</form>

		</div>

		<script>
			var div = document.getElementById("scroll_messages");
			div.scrollTop = div.scrollHeight;
		</script>

	</div>

	<div class="user_details column" id="conversations">
			<h4>Chats</h4>

			<div class="loaded_conversations">
				<?php echo $message_obj->getConvos(); ?>
			</div>
			<br>
			<a href="messages.php?u=new">New Message</a>
    
    
  </div>
<div class="user_details column" id="online_users">
			<h4>Users Online</h4>
<div class="online_users">
			<?php
		
		  $query = mysqli_query($con,"SELECT username,status,profile_pic,first_name,last_name FROM users WHERE status = 'online'");
		  if(!$query){
			printf("Error: %s\n", mysqli_error($con));
			exit();
		}
		while ($row = mysqli_fetch_array($query)) {
			# code...
		
		   	# code...
		   	$username = $row['username'];
            $status = $row['status'];
		   echo"<a href='messages.php?u=$username'> <div class='user_found_online'>
								<img src='" . $row['profile_pic'] . "' style='border-radius: 35px; margin-right: 5px;width:12%;height:8%;'>
								" . $row['first_name'] ." ".$row['last_name'].  "
								<span class='timestamp_smaller_online' id='grey' ></span>
								
								</div>
								</a>";
		   } 

   
	?>
			</div>
		</div>

 <script type="text/javascript">

     $(function () {
                // Initializes and creates emoji set from sprite sheet
                window.emojiPicker = new EmojiPicker({
                    pickerPosition:"top",
                    emojiable_selector: '[data-emojiable=true]',
                    assetsPath: 'vendor/emoji-picker/lib/img/',
                    popupButtonClasses: 'icon-smile'
                });

                window.emojiPicker.discover();
            });
     $("#message_body").keypress(function(){
      numMilliseconds = 500;
        if ($("message_body") ==""){
          $("#typing").text("User textbox is empty");
        }
        $("#typing").text("User is typing").delay(numMilliseconds).queue(function(){
          $("#typing").text("User has stopped typing");
        })
     });
  </script>