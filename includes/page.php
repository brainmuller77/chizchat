<html>
<head>
<link href="vendor/emoji-picker/lib/css/emoji.css" rel="stylesheet">
<link href="style.css" rel="stylesheet">

<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<script src="vendor/emoji-picker/lib/js/config.js"></script>
<script src="vendor/emoji-picker/lib/js/util.js"></script>
<script src="vendor/emoji-picker/lib/js/jquery.emojiarea.js"></script>
<script src="vendor/emoji-picker/lib/js/emoji-picker.js"></script>
</head>

<style>
	

body {
	font-family: Arial;
	color: #212121;
}

.output-container {
	width: 600px;
	margin: 0 auto;
}

.comment-form-container {
	border: #e0dfdf 1px solid;
	padding: 30px;
	border-radius: 3px;
}

.input-row {
	margin-bottom: 20px;
}

.input-field {
	width: 100%;
	border-radius: 3px;
	padding: 10px;
	border: #e0dfdf 1px solid;
    box-sizing: border-box;
}

.btn-submit {
	padding: 10px 20px;
    background: #2083f3;
    border: #137aea 1px solid;
    color: #f0f0f0;
    border-radius: 3px;
}

.output-container ul {
	list-style-type: none;
}

.comment-row {
	border-bottom: #e0dfdf 1px solid;
	margin-bottom: 15px;
	padding: 15px;
}

.outer-comment {
	padding: 30px;
	border: #dedddd 1px solid;
    border-radius: 3px;
}

span.commet-row-label {
	font-style: italic;
}

span.posted-by {
	text-decoration: underline;
}

.comment-info {
	font-size: 0.9em;
	color: #a7a7a7;
}

.comment-text {
	margin: 10px 0px;
}

.btn-reply {
	text-decoration: underline;
    color: #a7a7a7;
    font-size: 0.9em;
    cursor: pointer;
}

#comment-message {
	margin-left: 20px;
	color: #189a18;
	display: none;
}
.icon-smile:before {
    content: " ";
    width: 16px;
    height: 16px;
    display: flex;
    background: url(icon-smile.png);
}
</style>

<body>
	
	

		

			

		
	
	<script>
		$(function () {
                // Initializes and creates emoji set from sprite sheet
                window.emojiPicker = new EmojiPicker({
                    emojiable_selector: '[data-emojiable=true]',
                    assetsPath: 'vendor/emoji-picker/lib/img/',
                    popupButtonClasses: 'icon-smile'
                });

                window.emojiPicker.discover();
            });

	</script>
	</body>