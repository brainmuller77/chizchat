<?php

/**
 * 
 */
class Events
{
	private $user_obj;
	private $con;
	private $events;

	public function __construct($con, $user){
		$this->con = $con;
		$this->user_obj = new User($con, $user);
	}
	public function addevent(){
 $title = $_POST['etitle'];
  $location = $_POST['elocation'];
  $details = $_POST['edetails'];
  $startdate = $_POST['sdate'];
   $startdate = date("Y-m-d H:i",strtotime($startdate));
  $enddate = $_POST['edate'];
   $enddate = date("Y-m-d H:i",strtotime($enddate));

  $query=mysqli_query($this->con, "INSERT into events values(NULL, '$title','$startdate','$enddate','$details','$location','no')");
   if(!$query){
      printf("Error: %s\n", mysqli_error($this->con));
      exit();
    }
  $returned_id = mysqli_insert_id($this->con);
	}
	
	public function editevent(){
		
	}

	public function getNewEvents() {
		
		$date_time_now = date("Y-m-d H:i:s");
		$query = mysqli_query($this->con, "SELECT * FROM events WHERE end_event > '$date_time_now'");
		 if(!$query){
      printf("Error: %s\n", mysqli_error($this->con));
      exit();
    }
		return mysqli_num_rows($query);
	}

	public function getClassArray() {
		$classcode = $_POST['classnames'];
		$query = mysqli_query($this->con, "SELECT classmembers FROM class WHERE classcode='$classcode'");
		$row = mysqli_fetch_array($query);
		return $row['classmembers'];
	}

	public function isClassMember($username_to_check) {
		$usernameComma = "," . $username_to_check . ",";

		if((strstr($this->row['classmembers'], $usernameComma) || $username_to_check == $this->user['username'])) {
			return true;
		}
		else {
			return false;
		}
	}
}


?>