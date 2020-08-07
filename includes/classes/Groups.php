<?php

/**
 * 
 */
class Groups
{
	private $user_obj;
	private $con;

	public function __construct($con, $user){
		$this->con = $con;
		$this->user_obj = new User($con, $user);
	}

	public function create_group($username, $imageName){

	$time = date("Y-m-d H:i:s");
			//Get username
			$username = $this->user_obj->getUsername();

  $groupname = $_POST['groupname'];
  $groupdes = $_POST['groupdes'];
  $grouptype = $_POST['group_type'];

  $query=mysqli_query($this->con, "INSERT into groups values(NULL, '$groupname', ',' , '$time', '$groupdes','$grouptype','admin','$username','$imageName')");
   if(!$query){
      printf("Error: %s\n", mysqli_error($this->con));
      exit();
    }
  $returned_id = mysqli_insert_id($this->con);
	}

	public function new_group(){

		
$data_query = mysqli_query($this->con, "SELECT id,groupname,group_image FROM groups");
while($row = mysqli_fetch_array($data_query)) {
                 $id = $row['id'];
				$groupname = $row['groupname'];
				$group_image = $row['group_image'];

				echo "<a href=''>
				<div class='user_details column'>
		  <img src='$group_image;'>

		<div class='user_details_left_right'>
			
			$groupname
			
		</div>

	</div>
	</a>";
	}
	} 


}

?>