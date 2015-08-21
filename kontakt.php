<?php

include_once("inc/Connstring.php");
include_once("inc/HTMLTemplate.php");
// OBS Denna kontaktform inspirerat av http://www.w3schools.com/php/showphp.asp?filename=demo_form_validation_complete

// define variables and set to empty values
$nameErr = $emailErr = $commentErr = "";
$name = $email = $comment = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (empty($_POST["name"])) {
     $nameErr = "Name is required";
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
     
   if (empty($_POST["comment"])) {
     $commentErr = "Comment is required";
   } else {
     $name = test_input($_POST["comment"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
       $commentErr = "Only letters and white space allowed"; 
     }
   }

}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

?>

<div class="row margin-top-100">  
      
  <div class="col-md-2">
  </div>  
            
  <div class="col-md-6 col-sm-6 search-content panel-width-550px panel panel-default">
    <div class="panel-heading panel-heading-560px">
      Kontakt
    </div><!-- panel heading -->

    <div class="panel-body quicksand">
      <h2 class="quicksand text-bold">GameTeam</h2>
      <p class="text-normal quicksand">

      <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"> 
         Namn <input type="text" name="name" value="<?php echo $name;?>">
         <p>* <?php echo $nameErr;?></p>
         <br><br>
         Mejl <input type="text" name="email" value="<?php echo $email;?>">
         <p>* <?php echo $emailErr;?></p>
         <br><br>
         
         Kommentar: <textarea name="comment" rows="5" cols="40" value="<?php echo $comment;?>">
         </textarea>
         <p>* <?php echo $commentErr;?></p>
         <br><br>
         
         <br><br>
         <input type="submit" name="submit" value="Submit"> 
      </form>
    </div><!-- panel body -->
  </div><!-- col md 6 -->
</div><!-- row -->
</body>
</html>

<?php

echo $header;
echo $content;
echo $footer;
?>