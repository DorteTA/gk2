<?php

include_once("inc/Connstring.php");
include_once("inc/HTMLTemplate.php");


// define variables and set to empty values
$nameErr = $emailErr = $websiteErr = "";
$name = $email = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (empty($_POST["name"])) {
     $nameErr = "Du måste fylla i namn.";
   } else {
     $name = test_input($_POST["name"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
       $nameErr = "Only letters and white space allowed"; 
     }
   }
   
   if (empty($_POST["email"])) {
     $emailErr = "Email is required";
   } else {
     $email = test_input($_POST["email"]);
     // check if e-mail address is well-formed
     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       $emailErr = "Invalid email format"; 
     }
   }
     
   if (empty($_POST["website"])) {
     $website = "";
   } else {
     $website = test_input($_POST["website"]);
     // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
     if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
       $websiteErr = "Invalid URL"; 
     }
   }

   if (empty($_POST["comment"])) {
     $comment = "";
   } else {
     $comment = test_input($_POST["comment"]);
   }

}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}


$content = <<<END

<div class="row margin-top-100">	
			
	<div class="col-md-2">
	</div>	
						
	<div class="col-md-6 col-sm-6 search-content panel-width-550px panel panel-default">
		<div class="panel-heading panel-heading-560px">
			Kontakt
		</div><!-- panel heading -->

		<div class="panel-body">
			<h2 class="quicksand text-bold">GameTeam</h2>
			<p class="text-normal quicksand">
			<p class="text-red">* Måste ifyllas.</span></p>
			<form method="post" class="text-normal quicksand" action="kontakt2.php"> 
			   Namn <input type="text" name="name" class="form-control" value="{$name}">
			   <span class="error">* <?php echo $nameErr;?></span>
			   <br><br>
			   Mejl <input type="text" name="email" class="form-control" value="$email">
			   <span class="error">* <?php echo $emailErr;?></span>
			   <br><br>
			   Webbplats <input type="text" name="website" value="$website">
			   <span class="error"><?php echo $websiteErr;?></span>
			   <br><br>
			   Kommentar <textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
			   <br><br>
			   <input type="submit" name="submit" value="Submit"> 
			</form>
		</div><!-- panel body -->
	</div><!-- col md 6 -->
</div><!-- row -->
</body>
</html>

END;						

echo $header;
echo $content;
echo $footer;

?>