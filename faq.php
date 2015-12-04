<?php

include_once("inc/HTMLTemplate.php");
include_once("inc/Connstring.php");

$content = <<<END

	<div class="row margin-top-100">
		
		<div class="col-md-3 col-sm-3 margin-top-100 panel panel-default panel-width-330px pull-left">
			<div class="panel-heading panel-heading-340px">
				FAQ - Frequently asked questions
			</div><!-- End panel heading-->

			<div class="panel-body height-410px pull-left quicksand">
					
				<h4 class="quicksand text-grey">Frågor som oftast ställas</h4>
				
				<!-- oftasts ställade frågor -->
				<p class="quicksand">
				<span class="glyphicon glyphicon-question-sign text-orange" aria-hidden="true"></span>
				Hur hittar jag min kompis här?
				</p>

				<p class="quicksand">
				<span class="glyphicon glyphicon-info-sign text-blue" aria-hidden="true"></span>
				Tasta in din kompis namn eller användarnamn i sökrutan, då kommer alla namn fram samt artiklar personen
				 har skrivit. 
				</p>
				
				<p class="quicksand">
				<span class="glyphicon glyphicon-question-sign text-orange" aria-hidden="true"></span>
				Hur blir jag vän med någon här?
				</p>
				
				<p class="quicksand">
				<span class="glyphicon glyphicon-info-sign text-blue" aria-hidden="true"></span>
				Klicka på den personens namn du vil bli vän med och skicka en vänanmodning vid att klicka på bli
				 vän knappen på personens profilsida. Sedan får personen ett meddelandet och kan välja att bli
				 vän med dig eller inte. Du får inget besked om personen väljer det sissta. 
				</p>

				Har du frågor som inte besvarats här, kontakta vänligen supporten.
					
			</div><!-- panel body -->

		</div><!-- col md 3 -->
		
		<div class="col-md-6 col-sm-6 margin-top-100 panel panel-default pull-left">

			<div class="panel-heading">
				FAQ - Frequently asked questions
			</div><!-- panel heading -->
			
			<div class="panel-body height-410px pull-left quicksand">
					
				<h4 class="quicksand text-bold">Frågor som oftast ställas:</h4>
				
				<!-- ordered list över oftasts ställade frågor -->
				<ol class="list-group" style="list-style: decimal inside;">
					<li class="list-unstyled">
						
							<span class="badge badge-warning">1</span>
								<li>
								<span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
				 				Hur hittar jag min kompis här?
				 				</li>
				
				<br>
				<br>
				<span class="badge badge-info">2</span> Med ömsesidigt respekt.
				<br><br>
				<span class="badge badge-info">3</span> Erfarna gamers utmanas att välkomma nybörjare.
				<br><br>
				<span class="badge badge-info">4</span> Inga spelgenrer är bättre än andra.
				<br><br>
				<span class="badge badge-info">5</span> Personliga påhopp tolereras ej. Alla stötliga inlägg rapporteras till moderatorer
				som hanterar busar.							
				<br><br>
				<span class="badge badge-info">6</span> Din mejl address samt namn distribuerar vi ej vidare till tredje part, den
				hanteras enligt PUL.					
				<br><br>
				<span class="badge badge-info">7</span> Ha roligt och prata entusiastiskt om dina favoritspel.
				Argumentera gärna varför de är dina favoriter!	
					
			</div><!-- panel body -->
			
		</div><!-- col md 6 -->
			
		<!-- right column -->
		<div class="col-md-3 margin-top-100 pull-left">
			<div class"margin-ads pull-left">
				<img src="images/ad_req.jpg" class="pull-right" width="300px">
			</div>
		</div><!-- col md 6 -->
	</div><!-- row -->

END;

echo $header;
echo $content;
echo $footer;
?>