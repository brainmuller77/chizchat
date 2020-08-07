<!doctype html>
<html>
<head>
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Audio Recorder</title>

	<script src="js/audiodisplay.js"></script>
	<script src="js/recorderjs/recorder.js"></script>
	<script src="js/main.js"></script>
	<style>
	canvas { 
		display: none;
background: #202020;
width: 126px;
height: 25px;
margin-top: -158px;
margin-right: 406px;
		
	}

	
	#record { 
	height: 26px;
width: 39px;
position: absolute;
border: none;
color: #5CACCF;
border-radius: 5px;
margin-top: -25px;
margin-left: 246px;
}
	#record.recording { 
		background: red;
		background: -webkit-radial-gradient(center, ellipse cover, #ff0000 0%,lightgrey 75%,lightgrey 100%,#7db9e8 100%); 
		background: -moz-radial-gradient(center, ellipse cover, #ff0000 0%,lightgrey 75%,lightgrey 100%,#7db9e8 100%); 
		background: radial-gradient(center, ellipse cover, #ff0000 0%,lightgrey 75%,lightgrey 100%,#7db9e8 100%); 
	}
	#save, #save img
	 {height: 9vh;
margin-top: -25px;
margin-left: 236px;
}
	#save { opacity: 2.25;}
	#save[download] { opacity: 3;}
	#viz {
		height: 14%;
width: 13%;
		display: flex;
		flex-direction: column;
		justify-content: space-around;
		align-items: center;
	}
	@media (orientation: landscape) {
		body { flex-direction: row;}
		#controls { flex-direction: column; height: 100%; width: 10%;}
		#viz { height: 46%;
width: 151%;}
	}

	</style>
</head>
<body>
	
</body>
</html>