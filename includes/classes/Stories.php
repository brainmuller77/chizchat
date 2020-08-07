<?php
class Stories {
	private $user_obj;
	private $con;

	public function __construct($con, $user){
		$this->con = $con;
		$this->user_obj = new User($con, $user);
	}



	public function submitPost($username, $imageName) {
		

			//Current date and time
			$time = date("Y-m-d H:i:s");
			//Get username
			$username = $this->user_obj->getUsername();
               
          
            	$caption = $_POST['caption'];
            
            $queries = mysqli_query($this->con, "SELECT id from stories where display = 'yes' and username = '$username'");
            if($row = mysqli_fetch_array($queries)){
            	$id = $row['id'];
            	$query_1 =  mysqli_query($this->con, "UPDATE STORIES SET DISPLAY = 'no' WHERE id = '$id'");
            }
			
			//insert post 
			$query = mysqli_query($this->con, "INSERT INTO stories VALUES(NULL, '$username','$time','$caption','$imageName','no','no','yes')");
			$returned_id = mysqli_insert_id($this->con);

	

	

			

		}
	public function loadStories() {

	//	$page = $data['page']; 
		$userLoggedIn = $this->user_obj->getUsername();
		

		/*if($page == 1) 
			$start = 0;
		else 
			$start = ($page - 1) * $limit;
*/

		$str = ""; //String to return 
$data_query = mysqli_query($this->con, "SELECT * FROM stories WHERE deleted = 'no' and time_up ='no' and display='yes' ORDER BY time_posted DESC");

if(mysqli_num_rows($data_query) > 0) {


			$num_iterations = 0; //Number of results checked (not necasserily posted)
			$count = 1;
	

					
			while($row = mysqli_fetch_array($data_query)) {
                 $id = $row['id'];
				$caption = $row['caption'];
				$added_by = $row['username'];
				$date_time = $row['time_posted'];
				$imagePath = $row['image'];
     // 	array_push($convos, $rows['username']);

                $user_details_query = mysqli_query($this->con, "SELECT first_name, last_name, profile_pic FROM users WHERE username='$added_by'");
					$user_row = mysqli_fetch_array($user_details_query);
					$first_name = $user_row['first_name'];
					$last_name = $user_row['last_name'];
					$profile_pic = $user_row['profile_pic'];

					if($userLoggedIn == $added_by){
						$delete_button = "<button class='delete_button btn-danger' id='post$id'>X</button>";
					}
					else {
						$delete_button = "";
					}



				
               

               //Timeframe
					
              $date_time_now = date("Y-m-d H:i:s");
					$start_date = new DateTime($date_time); //Time of post
					$end_date = new DateTime($date_time_now); //Current time
					$interval = $start_date->diff($end_date); //Difference between dates 
				if($interval->y >= 1) {
						if($interval->y == 1)
							$time_message = $interval->y . " year ago"; //1 year ago
						else 
							$time_message = $interval->y . " years ago"; //1+ year ago
					}

                   	else if ($interval->m >= 1) {
						if($interval->d == 0) {
							$days = " ago";
						}
						else if($interval->d == 1) {
							$days = $interval->d . " day ago";
						}
						else {
							$days = $interval->d . " days ago";
						}


						if($interval->m == 1) {
							$time_message = $interval->m . " month ". $days;
						}
						else {
							$time_message = $interval->m . " months ". $days;
						}

					}
                   else if($interval->d >= 1) {
						if($interval->d == 1) {
							$time_message = "Yesterday";
						}
						else {
							$time_message = $interval->d . " days ago";
						}
					}

                     else if($interval->h >= 1) {
						if($interval->h == 1) {
							$time_message = $interval->h . " hour ago";
						}
						else {
							$time_message = $interval->h . " hours ago";
						}
					}
					else if($interval->i >= 1) {
						if($interval->i == 1) {
							$time_message = $interval->i . " minute ago";
						}
						else {
							$time_message = $interval->i . " minutes ago";
						}
					}

					else {
						if($interval->s < 30) {
							$time_message = "Just now";
						}
						else {
							$time_message = $interval->s . " seconds ago";
						} 
					}


						$newFilePath = "http://localhost/social/" . $imagePath;
                    $imageFileType = pathinfo($newFilePath, PATHINFO_EXTENSION);
                             
					if($imagePath != "" && $imageFileType == "jpg" || $imageFileType == "jpeg" || $imageFileType == "png" || $imageFileType == "gif" || $imageFileType == "bmp") {
						$imageDiv = "<a href='#'><div class='postedImage' style='border-radius: 50%; margin-right: 5px; width:100%;height:auto;'>
										<img src='$imagePath'>
									</div></a>";
					}
					
					else if($imagePath != "" && $imageFileType == "mp4" || $imageFileType == "avi" || $imageFileType == "webm" || $imageFileType == "mkv" || $imageFileType == "mpeg"){
						$imageDiv ="<a href='#'><iframe width='35' height='35' src ='".$imagePath."' controls='true' frameborder='0'></iframe></a>";
					}
					
					else {
						$imageDiv = "";
					}
				
   
					if($userLoggedIn == $added_by) {?>
				
 <div>Your Story</div>
 
 <?php
						 echo "<a href='stories/slider.php'> 
						
						 <div>$added_by</div>
								<div class='user_found_messages' style='height: auto;width: 12%;padding-top: 10%;border-radius: 50%;background: royalblue;'>
	                              
								<img src='$imagePath' style='height:18%;border-radius: 59%;padding-top: 10%;margin-top: -107px;margin-left: -8px;width: 116%;'>

								
								</div>
								<div class='inner-arc' style='background:red;height:2px;width:22px;transform:var(--center) rotate(20deg);border-color:green'></div>
								
								</a>
							<span>$time_message</span>
							<hr>";
					}else{
						 echo "<a href='stories/slider.php'> 
						
						 <div>$added_by</div>
								<div class='user_found_messages' id='stories' style='height: auto;width: 12%;padding-top: 10%;border-radius: 50%;background: royalblue;'>
	                              
								<img src='$imagePath' style='height:18%;border-radius: 59%;padding-top: 10%;margin-top: -107px;margin-left: -8px;width: 116%;'>

								
								</div>
								<div class='inner-arc' style='background:red;height:2px;width:22px;transform:var(--center) rotate(20deg);border-color:green'></div>
								
							</a>
							<span>$time_message</span>
							
							<hr>";
					}
                     
                    
					
                               
						
				

			}//end while loop
			
			}
		}

}



	?>