<?php

include_once("inc/HTMLTemplate.php");
include_once("inc/Connstring.php");
$grid = isset($_GET['grid']) ? $_GET['grid'] : "";
$commentid = isset($_GET['commentid']) ? $_GET['commentid'] : "";
$gr_flag = "";
$comment_flag = "";
$commentids = "";
$admit = "";

// Sätter flaggan till noll om innehållet inte är olämpligt
if(isset($_POST['ok']))
{
	$admit = <<<END
		UPDATE guidereviewinfo SET flag = 0
		WHERE grid = '{$grid}';
END;
	$res = $mysqli->query($admit) or die("Could not query database" . $mysqli->errno . 
	  " : " . $mysqli->error);
}

// Hämtar ut allt i guide recension som har flaggats som olämpligt
$query = <<<END

	SELECT * FROM guidereviewinfo
	WHERE flag = 1;
END;
	$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
		        " : " . $mysqli->error);

	if($res->num_rows > 0)
	{
		while($row = $res->fetch_object())
		{

			$grid = $row->grid;
			$title = utf8_decode(htmlspecialchars($row->title));

			$gr_flag .= <<<END
				
				<form action="admin.php?grid={$grid}" method="post">
					<a href="genre.php?grid={$grid}" class="pull-left">{$title}</a>
					
					<!-- Godkänn knappen grön -->
					<div class="pull-right">
						<button type="submit" name="ok" value="" class="pull-left margin-right-span-10px
						 btn btn-sm-span span-color-green">						
							<span class="glyphicon glyphicon-ok pull-right" aria-hidden="true"></span>						
						</button>
					</div>
					
					<!-- Radera knappen röd -->

					<div class="pull-right red-a-text">
						<a href="delete.php?grid={$grid}" class="delete btn btn-sm-span span-color-red
						 pull-left red-a-text" role="button">
							<span class="glyphicon glyphicon-remove pull-right" aria-hidden="true"></span>
						</a>
					</div>	
				</form>
END;
		}
	}

// Sätter flaggan till 0 om moderatorn finnar innehållet lämpligt
if(isset($_POST['okcomment']))
{
	$admit = <<<END
		UPDATE comment SET flag = 0
		WHERE commentid = '{$commentid}';
END;
	$res = $mysqli->query($admit) or die("Could not query database" . $mysqli->errno . 
	  " : " . $mysqli->error);
}

// Hämtar ut allt från kommentar som har flaggats som olämpligt
$query = <<<END

	SELECT * FROM comment
	WHERE flag = 1;
END;

	$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . 
		        " : " . $mysqli->error);

	if($res->num_rows > 0)
	{
		while($row = $res->fetch_object())
		{
			$commentgrid = $row->grid;
			$commentids = $row->commentid;
			$comment = utf8_decode(htmlspecialchars($row->comment));

			$comment_flag .= <<<END
				
				<form action="admin.php?commentid={$commentids}" method="post">
					
					<a href="genre.php?grid={$commentgrid}" class="pull-left">{$comment}</a>
					
					<!-- Radera det olämpliga innehållet från databasen -->

					<div class="pull-right red-a-text">
					<a href="delete.php?commentid={$commentids}" role="button" class="btn btn-sm-span span-color-red pull-left red-a-text">
						<span class="glyphicon glyphicon-remove pull-left" aria-hidden="true"></span>
					</a></button>
					</div>

					<!-- Godkänna innehållet och sätta flaggan till grön -->

					<div class="pull-right">
					<button type="submit" class="btn btn-sm-span span-color-green" name="okcomment" value="">
						<span class="glyphicon glyphicon-ok pull-left" aria-hidden="true"></span>
					</button>
					</div>
					
				</form>
END;
		}
	}

$content = <<<END

	<div class="row margin-top-100">			
		<div class="col-md-12 panel panel-default panel-guide-review height-410px">			
			<div class="panel-heading panel-heading-guide-review">			
				Admin Profil				
			</div><!-- panel heading -->
			
			<div class="panel-body">
				
				<h4 class="quicksand text-bold pull-left">Guider och recensioner</h4>
								
				<h4 class="quicksand text-bold pull-right">Radera / Behålla</h4>
				
				<p class="droid text-bold">
				{$comment_flag}<br><br>
				{$gr_flag}<br><br>
				<h4 class="quicksand text-bold">Kommentarer</h4>
				
				</p>
			</div><!-- panel body -->

		</div><!-- col md 12 -->
		
	</div><!-- row margin top 100 -->

	<!-- skript som sätter innehållet som lälmpligt -->
	<script>
		$(document).ready(function(){
			$(.admit).click(function(){
				{$admit}
			});

		})

	</script>
END;

echo $header;
echo $content;
echo $footer;
?>