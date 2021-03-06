<?php

include_once("inc/HTMLTemplate.php");
include_once("inc/Connstring.php");

$keeper = $_SESSION['keeperid'];
$grid = "";
$latestguide = "";
$latestreview = "";
$toplistreview = "";
$toplistguide = "";
$title = "";
$text = "";
$grade = "";
$title	= "";
$text	= "";
$admindelete = "";
//test
$genretype = "";
$genre = "";
$topplistreview_nummer = "";
$topplistguide_nummer = "";

// Hämtar ut fem poster där grade är NULL 
$query = <<<END

	SELECT * 
	FROM guidereviewinfo
	WHERE grade IS NULL
	ORDER BY timestamp DESC
	LIMIT 5;

END;

$res = $mysqli->query($query) or die();

date_default_timezone_set("Europe/Stockholm");


while($row = $res->fetch_object())
{
	$grid 	= $row->grid;
	$title	= utf8_decode($row->title);
	$text 	= utf8_decode($row->text);
	$subtext = substr($text, 0, 160);
	$grade  = $row->grade;
	$date 	= strtotime($row->timestamp);
	$date	= date("d M Y H:i", $date);

	if($_SESSION['roletype'] == 1)
	{
	$admindelete = <<<END
	
	<button class="delete"><a href="delete.php?grid={$grid}">x</a></button>
END;
	}

	$latestguide .= <<<END
	
				<ul class="media-list margin-left-topplista">
  				<li class="media">
    				<div class="media-left">
      				</div>
    				<div class="media-body">
      					<h4 class="media-heading quicksand text-bold"><a href="genre.php?grid={$grid}">{$title}</a>
						<li class="views">{$admindelete}</li>
						<br>
						<h5 class="media-heading quicksand text-14px text-black">{$subtext}...</h5>
    				</div><!-- media body -->
  				</li><!-- media -->
			</ul><!-- media list -->

						
END;

}
// Hämtar ut fem poster där grade är större än 0
$query = <<<END

	SELECT *, SUBSTRING(text,0,20)
	FROM guidereviewinfo
	WHERE grade > 0
	ORDER BY timestamp DESC
	LIMIT 5;

END;

$res = $mysqli->query($query) or die();

date_default_timezone_set("Europe/Stockholm");


while($row = $res->fetch_object())
{
	$grid 	= $row->grid;
	$title	= utf8_decode($row->title);
	$text 	= utf8_decode($row->text);
	$subtext = substr($text, 0, 160);
	$grade  = $row->grade;
	$date 	= strtotime($row->timestamp);
	$date	= date("d M Y H:i", $date);

	if($_SESSION['roletype'] == 1)
	{
	$admindelete = <<<END
	<button class="delete"><a href="delete.php?grid={$grid}">x</a></button>
END;
	}

	$latestreview .= <<<END

			<ul class="media-list margin-left-topplista">
  				<li class="media">
    				<div class="media-left">
      				</div>
    				<div class="media-body">
      					<h4 class="media-heading quicksand text-bold"><a href="genre.php?grid={$grid}">{$title}</a>
						<li class="views">{$admindelete}</li>
						<br>
						<h5 class="media-heading quicksand text-14px text-black">{$subtext}...</h5>
    				</div><!-- media body -->
  				</li><!-- media -->
			</ul><!-- media list -->
END;
}



// Hämtar ut fem poster där grade är NULL och de grid som förekommer mest i tabellen userclick visas.

$query = <<<END

	SELECT userclick.grid, count(userclick.grid) AS counter, guidereviewinfo.title, guidereviewinfo.text, guidereviewinfo.grade
  	FROM userclick, guidereviewinfo
	WHERE userclick.grid = guidereviewinfo.grid
	AND guidereviewinfo.grade IS NULL
 	GROUP by userclick.grid
 	ORDER BY counter DESC
 	LIMIT 5;

END;
$result = $mysqli->query($query);

if($result->num_rows > 0)
{
        while($row = $result->fetch_object())
        {
        	$grid 	= $row->grid;
			$title	= utf8_decode($row->title);
			$text 	= utf8_decode($row->text);
			$subtext = substr($text, 0, 160);

			if($_SESSION['roletype'] == 1)
			{
				$admindelete = <<<END
				<button class="delete"><a href="delete.php?grid={$grid}">x</a></button>
END;
			}
			//Adderar 1 till topplistguide numret
			$topplistguide_nummer = $topplistguide_nummer+1;
			
                $toplistguide .=<<<END

                <ul class="media-list margin-left-topplista">
					<li class="media">
						<div class="media-left">
						</div>
						<div class="media-body">
							<ul class="list style margin-left-zero">
								<ol class="margin-left-zero">
									<li class="list-style pull-left"><span class="badge text-white" aria-hidden="true">{$topplistguide_nummer}</span></li>
								</ol>
							</ul>
							<h4 class="media-heading quicksand text-bold"><a href="genre.php?grid={$grid}">{$title}</a>
							<ol class="pull-left">
								<li><span class="badge primary pull-left"></span></li>
							</ol>
							<br>
							<h5 class="media-heading quicksand text-14px text-black">{$subtext}...</h5>
						</div><!-- media body -->
					</li><!-- media -->
				</ul><!-- media list -->
END;
        }
}

// Hämtar ut fem poster där grade är större än 0 och de grid som förekommer mest i tabellen userclick visas.
$query = <<<END

	SELECT userclick.grid, count(userclick.grid) AS counter, guidereviewinfo.title, guidereviewinfo.text, guidereviewinfo.grade
  	FROM userclick, guidereviewinfo
  	WHERE userclick.grid = guidereviewinfo.grid
  	AND grade > 0
 	GROUP by grid
	ORDER BY counter DESC
	LIMIT 5;
END;

$res = $mysqli->query($query);

if($res->num_rows > 0){

	while($row = $res->fetch_object())
	{
	
	$grid 	= $row->grid;
	$title	= utf8_decode($row->title);
	$text 	= utf8_decode($row->text);
	$subtext = substr($text, 0, 160);
	$grade  = $row->grade;

	if($_SESSION['roletype'] == 1)
	{
	$admindelete = <<<END
	<button class="delete"><a href="delete.php?grid={$grid}">x</a></button>
END;
	}

	//Adderar 1 till topplistrecension numret
	$topplistreview_nummer = $topplistreview_nummer+1;

	$toplistreview .= <<<END

			<ul class="media-list">
 				<ul class="media-list margin-left-topplista">
					<li class="media">
						<div class="media-left">
							
						</div><!-- media left -->
						<div class="media-body">
							<ul class="list style margin-left-zero">
								<ol class="margin-left-zero">
									<li class="list-style pull-left">
										<span class="badge badge-info text-white" aria-hidden="true">
											{$topplistreview_nummer}
										</span>
									</li>
								</ol>
							</ul>
							<h4 class="media-heading quicksand text-bold">
								<a href="genre.php?grid={$grid}">
									{$title}
								</a>							
								<br>
							</h4>
							<h5 class="media-heading quicksand text-14px text-black">
								{$subtext}...
							</h5>
						</div><!-- media body -->
					</li><!-- media -->
				</ul><!-- media list -->
END;

	}
}

$content = <<<END
				
			
				<div class="wrapper margin-top-100">

					<div class="row">

						<!-- left column -->
						<div class="content-left pull-left">

							<div class ="panel panel-default panel-width-240px pull-left">

								<div class="panel-heading panel-heading-250px quicksand">Senaste guider</div>

				  					<div class="panel-body height-410px">

				  							<p>{$latestguide}</p>
				  					</div><!-- panel body -->

								</div><!-- panel heading -->

							</div><!-- panel -->


					
		  				<!-- center column -->
						<div class="content-center pull-left">

							<div class ="panel panel-default panel-width-240px pull-left">

								<div class="panel-heading panel-heading-250px">Senaste recensioner</div>

				  					<div class="panel-body height-410px">

				  							<p>{$latestreview}</p>
				  					</div><!-- panel body -->

								</div><!-- panel heading -->

							</div><!-- panel -->		  				

		  				<!-- right column -->
						<div class="content-right margin-right-15px pull-right">

							<div class ="ads">

								<img src="images/ad_req.jpg" class="ads pull-right" width="300px">

							</div><!-- ads -->

		  				</div><!-- content left kolumn -->

		  				</div><!-- content center kolumn -->
		  				
		  				</div><!-- content right kolumn -->

					</div><!-- row -->

					<div class="row">

						<!-- left column row 2 -->
						<div class="content-left pull-left">

							<div class ="panel panel-default panel-width-240px pull-left">

								<div class="panel-heading panel-heading-250px">Topplista guider</div>

				  					<div class="panel-body height-410px">

				  							<p>{$toplistguide}</p>
				  					</div><!-- panel body -->

								</div><!-- panel heading -->

							</div><!-- panel -->
					
		  				<!-- center column  row 2 -->
						<div class="content-center pull-left">

							<div class ="panel panel-default panel-width-240px pull-left">

								<div class="panel-heading panel-heading-250px">Topplista recensioner</div>

				  					<div class="panel-body height-410px">

				  							<p>{$toplistreview}</p>
				  					</div><!-- panel body -->

								</div><!-- panel heading -->

							</div><!-- panel -->		  				

		  				<!-- right column row 2 -->
						<div class="content-right margin-right-15px pull-right">

							<div class ="ads">

								<img src="images/ad_req.jpg" class="ads pull-right" width="300px">

							</div><!-- ads -->	

		  				</div><!-- content right kolumn row 2 -->

		  				</div><!-- content center kolumn row 2 -->
		  				
		  				</div><!-- content left kolumn row 2 -->

		  				{$genre}

					</div><!-- row -->

					<div class="row ads-row">
						<div class="content-full pull-left">

							<div class ="ads">

								<img src="images/ad_req.jpg" class="ads pull-left" width="300px">
								<img src="images/ad_req.jpg" class="ads pull-left" width="300px">

							</div><!-- ads -->	

		  				</div>
					</div>

				</div><!-- wrapper --> 

							
						
					
	
	

  
  
END;



echo $header;
echo $content;
echo $footer;
?>