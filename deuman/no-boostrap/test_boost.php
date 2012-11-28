<?php
$js.="
<script src=\"js/bootstrap/admin-js/jquery.js\"></script>
<script src=\"js/bootstrap/admin-js/bootstrap.js\"></script>
<script src=\"js/bootstrap/admin-js/bootstrap-tooltip.js\"></script>
<script src=\"js/bootstrap/admin-js/bootstrap-popover.js\"></script>

<script>
	$(document).ready(function(){
		$('#tt').popover();
		$('.tab_content').hide();
		$('ul.tabs li').each(function(i){
				if(i==0){
							$(this).addClass('active').show();
							$('#tab_popover').show();
						}		
				});
		$('ul.tabs li').click(function(){
			$('ul.tabs li').removeClass('active');
			$(this).addClass('active');
			$('.tab_content').hide();
			var activeTab = $(this).find('a').attr('href');
			$(activeTab).fadeIn();
		});
		
	});		
	  </script>";
$contenido = "
<link rel=\"stylesheet\" href=\"borrame/css/bootstrap.css\"> 
 
 
 
 <ul class=\"tabs\">
    <li ><a href=\"#tab_popover\" id=\"liPopOver\" >PopOver</a></li>
    <li><a href=\"#tab_botones\" id=\"liBotones\">Botones</a></li>
    <li><a href=\"#tab_iconos\" id=\"liIconos\">Iconos</a></li>
    <li><a href=\"#tab_formularios\" id=\"liFormularios\">Formularios</a></li>
	<li><a href=\"#tab_listas\" id=\"liListas\">Listas</a></li>
	<li><a href=\"#tab_alertas\" id=\"liAlertas\">Alertas</a></li>
	<li><a href=\"#tab_barras\" id=\"liBarras\">Progress bars</a></li>
</ul>
<table width=\"100%\"  border=\"0\" align=\"left\" cellpadding=\"2\" cellspacing=\"2\" class=\"tab_container textos\">
    
  <tr>
	  <td align=\"left\" class=\"datos_sgs tab_content\" id=\"tab_popover\" >
			<button data-original-title=\"A Title\" id=\"tt\"  class=\"btn btn-danger\"  rel=\"popover\" data-content=\"a=1<br /> b=2<br />\" data-original-title=\"A Title\">hover for popover</button>	  </td>
  </tr>
  <tr>
      <td align=\"left\" class=\"datos_sgs tab_content\" id=\"tab_botones\" >
			
			<table class=\"table table-bordered table-striped\">
					<thead>
						<tr>
							<th>Button</th>
							<th>class=\"\"</th>
							<th>Description</th>
						</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<button class=\"btn\" href=\"#\">Default</button>
								</td>
								<td>
									<code>btn</code>
								</td>
								<td>Standard gray button with gradient</td>
							</tr>
							<tr>
								<td>
									<button class=\"btn btn-primary\" href=\"#\">Primary</button>
								</td>
								<td>
									<code>btn btn-primary</code>
								</td>
								<td>Provides extra visual weight and identifies the primary action in a set of buttons</td>
							</tr>
							<tr>
								<td>
									<button class=\"btn btn-info\" href=\"#\">Info</button>
								</td>
								<td>
									<code>btn btn-info</code>
								</td>
								<td>Used as an alternative to the default styles</td>
							</tr>
							<tr>
								<td>
									<button class=\"btn btn-success\" href=\"#\">Success</button>
								</td>
								<td>
									<code>btn btn-success</code>
								</td>
								<td>Indicates a successful or positive action</td>
							</tr>
							<tr>
								<td>
									<button class=\"btn btn-warning\" href=\"#\">Warning</button>
								</td>
								<td>
									<code>btn btn-warning</code>
								</td>
								<td>Indicates caution should be taken with this action</td>
							</tr>
							<tr>
								<td>
									<button class=\"btn btn-danger\" href=\"#\">Danger</button>
								</td>
								<td>
									<code>btn btn-danger</code>
								</td>
								<td>Indicates a dangerous or potentially negative action</td>
							</tr>
							<tr>
								<td>
									<button class=\"btn btn-inverse\" href=\"#\">Inverse</button>
								</td>
								<td>
									<code>btn btn-inverse</code>
								</td>
							<td>Alternate dark gray button, not tied to a semantic action or use</td>
							</tr>
					</tbody>
				</table>
<div class=\"row\">
<div class=\"span4\">
<div class=\"btn-toolbar\" style=\"margin-bottom: 9px\">
<div class=\"btn-group\">
<button class=\"btn\" href=\"#\">
<i class=\"icon-align-left\"></i>
</button>
<button class=\"btn\" href=\"#\">
<i class=\"icon-align-center\"></i>
</button>
<button class=\"btn\" href=\"#\">
<i class=\"icon-align-right\"></i>
</button>
<button class=\"btn\" href=\"#\">
<i class=\"icon-align-justify\"></i>
</button>
</div>
</div>
<p>
<button class=\"btn\" href=\"#\">
<i class=\"icon-refresh\"></i>
Refresh
</button>
<button class=\"btn btn-success\" href=\"#\">
<i class=\"icon-shopping-cart icon-white\"></i>
Checkout
</button>
<button class=\"btn btn-danger\" href=\"#\">
<i class=\"icon-trash icon-white\"></i>
Delete
</button>
</p>
<p>
<button class=\"btn btn-large\" href=\"#\">
<i class=\"icon-comment\"></i>
Comment
</button>
<button class=\"btn btn-small\" href=\"#\">
<i class=\"icon-cog\"></i>
Settings
</button>
<button class=\"btn btn-small btn-info\" href=\"#\">
<i class=\"icon-info-sign icon-white\"></i>
More Info
</button>
</p>

	<div class=\"btn-group\" >
	<button class=\"btn btn-primary\" href=\"#\">
		<i class=\"icon-user icon-white\"></i>
		User
	</button>
<button class=\"btn btn-primary dropdown-toggle\" href=\"#\" data-toggle=\"dropdown\">
<span class=\"caret\"></span>
</button>
		<ul class=\"dropdown-menu\">
			<li>
			<a href=\"#\">
				<i class=\"icon-pencil\"></i>
				Edit
			</a>
			</li>
			<li>
			<a href=\"#\">
				<i class=\"icon-trash\"></i>
				Delete
			</a>
			</li>
			<li>
			<a href=\"#\">
				<i class=\"icon-ban-circle\"></i>
				Ban
			</a>
			</li>
			<li class=\"divider\"></li>
			<li>
			<a href=\"#\">
				<i class=\"i\"></i>
				Make admin
			</a>
			</li>
	</ul>
	

</div>

</div>


	





</div>

			
	  </td>
  </tr>	  
  <tr>
		<td align=\"left\" class=\"datos_sgs tab_content\" id=\"tab_iconos\">
			<div class=\"row\">
	<div class=\"span3\">
		<ul style=\"list-style:none;\">
			<li>
			<i class=\"icon-glass\"></i>
			icon-glass
			</li>
			<li>
			<i class=\"icon-music\"></i>
			icon-music
			</li>
			<li>
			<i class=\"icon-search\"></i>
			icon-search
			</li>
			<li>
			<i class=\"icon-envelope\"></i>
			icon-envelope
			</li>
			<li>
			<i class=\"icon-heart\"></i>
			icon-heart
			</li>
			<li>
			<i class=\"icon-star\"></i>
			icon-star
			</li>
			<li>
			<i class=\"icon-star-empty\"></i>
			icon-star-empty
			</li>
			<li>
			<i class=\"icon-user\"></i>
			icon-user
			</li>
			<li>
			<i class=\"icon-film\"></i>
			icon-film
			</li>
			<li>
			<i class=\"icon-th-large\"></i>
			icon-th-large
			</li>
			<li>
			<i class=\"icon-th\"></i>
			icon-th
			</li>
			<li>
			<i class=\"icon-th-list\"></i>
			icon-th-list
			</li>
			<li>
			<i class=\"icon-ok\"></i>
			icon-ok
			</li>
			<li>
			<i class=\"icon-remove\"></i>
			icon-remove
			</li>
			<li>
			<i class=\"icon-zoom-in\"></i>
			icon-zoom-in
			</li>
			<li>
			<i class=\"icon-zoom-out\"></i>
			icon-zoom-out
			</li>
			<li>
			<i class=\"icon-off\"></i>
			icon-off
			</li>
			<li>
			<i class=\"icon-signal\"></i>
			icon-signal
			</li>
			<li>
			<i class=\"icon-cog\"></i>
			icon-cog
			</li>
			<li>
			<i class=\"icon-trash\"></i>
			icon-trash
			</li>
			<li>
			<i class=\"icon-home\"></i>
			icon-home
			</li>
			<li>
			<i class=\"icon-file\"></i>
			icon-file
			</li>
			<li>
			<i class=\"icon-time\"></i>
			icon-time
			</li>
			<li>
			<i class=\"icon-road\"></i>
			icon-road
			</li>
			<li>
			<i class=\"icon-download-alt\"></i>
			icon-download-alt
			</li>
			<li>
			<i class=\"icon-download\"></i>
			icon-download
			</li>
			<li>
			<i class=\"icon-upload\"></i>
			icon-upload
			</li>
			<li>
			<i class=\"icon-inbox\"></i>
			icon-inbox
			</li>
			<li>
			<i class=\"icon-play-circle\"></i>
			icon-play-circle
			</li>
			<li>
			<i class=\"icon-repeat\"></i>
			icon-repeat
			</li>
			<li>
			<i class=\"icon-refresh\"></i>
			icon-refresh
			</li>
			<li>
			<i class=\"icon-list-alt\"></i>
			icon-list-alt
			</li>
			<li>
			<i class=\"icon-lock\"></i>
			icon-lock
			</li>
			<li>
			<i class=\"icon-flag\"></i>
			icon-flag
			</li>
			<li>
			<i class=\"icon-headphones\"></i>
			icon-headphones
			</li>
			</ul>
			</div>
			<div class=\"span3\">
			<ul style=\"list-style:none;\">
			<li>
			<i class=\"icon-volume-off\"></i>
			icon-volume-off
			</li>
			<li>
			<i class=\"icon-volume-down\"></i>
			icon-volume-down
			</li>
			<li>
			<i class=\"icon-volume-up\"></i>
			icon-volume-up
			</li>
			<li>
			<i class=\"icon-qrcode\"></i>
			icon-qrcode
			</li>
			<li>
			<i class=\"icon-barcode\"></i>
			icon-barcode
			</li>
			<li>
			<i class=\"icon-tag\"></i>
			icon-tag
			</li>
			<li>
			<i class=\"icon-tags\"></i>
			icon-tags
			</li>
			<li>
			<i class=\"icon-book\"></i>
			icon-book
			</li>
			<li>
			<i class=\"icon-bookmark\"></i>
			icon-bookmark
			</li>
			<li>
			<i class=\"icon-print\"></i>
			icon-print
			</li>
			<li>
			<i class=\"icon-camera\"></i>
			icon-camera
			</li>
			<li>
			<i class=\"icon-font\"></i>
			icon-font
			</li>
			<li>
			<i class=\"icon-bold\"></i>
			icon-bold
			</li>
			<li>
			<i class=\"icon-italic\"></i>
			icon-italic
			</li>
			<li>
			<i class=\"icon-text-height\"></i>
			icon-text-height
			</li>
			<li>
			<i class=\"icon-text-width\"></i>
			icon-text-width
			</li>
			<li>
			<i class=\"icon-align-left\"></i>
			icon-align-left
			</li>
			<li>
			<i class=\"icon-align-center\"></i>
			icon-align-center
			</li>
			<li>
			<i class=\"icon-align-right\"></i>
			icon-align-right
			</li>
			<li>
			<i class=\"icon-align-justify\"></i>
			icon-align-justify
			</li>
			<li>
			<i class=\"icon-list\"></i>
			icon-list
			</li>
			<li>
			<i class=\"icon-indent-left\"></i>
			icon-indent-left
			</li>
			<li>
			<i class=\"icon-indent-right\"></i>
			icon-indent-right
			</li>
			<li>
			<i class=\"icon-facetime-video\"></i>
			icon-facetime-video
			</li>
			<li>
			<i class=\"icon-picture\"></i>
			icon-picture
			</li>
			<li>
			<i class=\"icon-pencil\"></i>
			icon-pencil
			</li>
			<li>
			<i class=\"icon-map-marker\"></i>
			icon-map-marker
			</li>
			<li>
			<i class=\"icon-adjust\"></i>
			icon-adjust
			</li>
			<li>
			<i class=\"icon-tint\"></i>
			icon-tint
			</li>
			<li>
			<i class=\"icon-edit\"></i>
			icon-edit
			</li>
			<li>
			<i class=\"icon-share\"></i>
			icon-share
			</li>
			<li>
			<i class=\"icon-check\"></i>
			icon-check
			</li>
			<li>
			<i class=\"icon-move\"></i>
			icon-move
			</li>
			<li>
			<i class=\"icon-step-backward\"></i>
			icon-step-backward
			</li>
			<li>
			<i class=\"icon-fast-backward\"></i>
			icon-fast-backward
			</li>
			</ul>
			</div>
			<div class=\"span3\">
			<ul style=\"list-style:none;\">
			<li>
			<i class=\"icon-backward\"></i>
			icon-backward
			</li>
			<li>
			<i class=\"icon-play\"></i>
			icon-play
			</li>
			<li>
			<i class=\"icon-pause\"></i>
			icon-pause
			</li>
			<li>
			<i class=\"icon-stop\"></i>
			icon-stop
			</li>
			<li>
			<i class=\"icon-forward\"></i>
			icon-forward
			</li>
			<li>
			<i class=\"icon-fast-forward\"></i>
			icon-fast-forward
			</li>
			<li>
			<i class=\"icon-step-forward\"></i>
			icon-step-forward
			</li>
			<li>
			<i class=\"icon-eject\"></i>
			icon-eject
			</li>
			<li>
			<i class=\"icon-chevron-left\"></i>
			icon-chevron-left
			</li>
			<li>
			<i class=\"icon-chevron-right\"></i>
			icon-chevron-right
			</li>
			<li>
			<i class=\"icon-plus-sign\"></i>
			icon-plus-sign
			</li>
			<li>
			<i class=\"icon-minus-sign\"></i>
			icon-minus-sign
			</li>
			<li>
			<i class=\"icon-remove-sign\"></i>
			icon-remove-sign
			</li>
			<li>
			<i class=\"icon-ok-sign\"></i>
			icon-ok-sign
			</li>
			<li>
			<i class=\"icon-question-sign\"></i>
			icon-question-sign
			</li>
			<li>
			<i class=\"icon-info-sign\"></i>
			icon-info-sign
			</li>
			<li>
			<i class=\"icon-screenshot\"></i>
			icon-screenshot
			</li>
			<li>
			<i class=\"icon-remove-circle\"></i>
			icon-remove-circle
			</li>
			<li>
			<i class=\"icon-ok-circle\"></i>
			icon-ok-circle
			</li>
			<li>
			<i class=\"icon-ban-circle\"></i>
			icon-ban-circle
			</li>
			<li>
			<i class=\"icon-arrow-left\"></i>
			icon-arrow-left
			</li>
			<li>
			<i class=\"icon-arrow-right\"></i>
			icon-arrow-right
			</li>
			<li>
			<i class=\"icon-arrow-up\"></i>
			icon-arrow-up
			</li>
			<li>
			<i class=\"icon-arrow-down\"></i>
			icon-arrow-down
			</li>
			<li>
			<i class=\"icon-share-alt\"></i>
			icon-share-alt
			</li>
			<li>
			<i class=\"icon-resize-full\"></i>
			icon-resize-full
			</li>
			<li>
			<i class=\"icon-resize-small\"></i>
			icon-resize-small
			</li>
			<li>
			<i class=\"icon-plus\"></i>
			icon-plus
			</li>
			<li>
			<i class=\"icon-minus\"></i>
			icon-minus
			</li>
			<li>
			<i class=\"icon-asterisk\"></i>
			icon-asterisk
			</li>
			<li>
			<i class=\"icon-exclamation-sign\"></i>
			icon-exclamation-sign
			</li>
			<li>
			<i class=\"icon-gift\"></i>
			icon-gift
			</li>
			<li>
			<i class=\"icon-leaf\"></i>
			icon-leaf
			</li>
			<li>
			<i class=\"icon-fire\"></i>
			icon-fire
			</li>
			<li>
			<i class=\"icon-eye-open\"></i>
			icon-eye-open
			</li>
			</ul>
			</div>
			<div class=\"span3\">
			<ul style=\"list-style:none;\">
			<li>
			<i class=\"icon-eye-close\"></i>
			icon-eye-close
			</li>
			<li>
			<i class=\"icon-warning-sign\"></i>
			icon-warning-sign
			</li>
			<li>
			<i class=\"icon-plane\"></i>
			icon-plane
			</li>
			<li>
			<i class=\"icon-calendar\"></i>
			icon-calendar
			</li>
			<li>
			<i class=\"icon-random\"></i>
			icon-random
			</li>
			<li>
			<i class=\"icon-comment\"></i>
			icon-comment
			</li>
			<li>
			<i class=\"icon-magnet\"></i>
			icon-magnet
			</li>
			<li>
			<i class=\"icon-chevron-up\"></i>
			icon-chevron-up
			</li>
			<li>
			<i class=\"icon-chevron-down\"></i>
			icon-chevron-down
			</li>
			<li>
			<i class=\"icon-retweet\"></i>
			icon-retweet
			</li>
			<li>
			<i class=\"icon-shopping-cart\"></i>
			icon-shopping-cart
			</li>
			<li>
			<i class=\"icon-folder-close\"></i>
			icon-folder-close
			</li>
			<li>
			<i class=\"icon-folder-open\"></i>
			icon-folder-open
			</li>
			<li>
			<i class=\"icon-resize-vertical\"></i>
			icon-resize-vertical
			</li>
			<li>
			<i class=\"icon-resize-horizontal\"></i>
			icon-resize-horizontal
			</li>
			<li>
			<i class=\"icon-hdd\"></i>
			icon-hdd
			</li>
			<li>
			<i class=\"icon-bullhorn\"></i>
			icon-bullhorn
			</li>
			<li>
			<i class=\"icon-bell\"></i>
			icon-bell
			</li>
			<li>
			<i class=\"icon-certificate\"></i>
			icon-certificate
			</li>
			<li>
			<i class=\"icon-thumbs-up\"></i>
			icon-thumbs-up
			</li>
			<li>
			<i class=\"icon-thumbs-down\"></i>
			icon-thumbs-down
			</li>
			<li>
			<i class=\"icon-hand-right\"></i>
			icon-hand-right
			</li>
			<li>
			<i class=\"icon-hand-left\"></i>
			icon-hand-left
			</li>
			<li>
			<i class=\"icon-hand-up\"></i>
			icon-hand-up
			</li>
			<li>
			<i class=\"icon-hand-down\"></i>
			icon-hand-down
			</li>
			<li>
			<i class=\"icon-circle-arrow-right\"></i>
			icon-circle-arrow-right
			</li>
			<li>
			<i class=\"icon-circle-arrow-left\"></i>
			icon-circle-arrow-left
			</li>
			<li>
			<i class=\"icon-circle-arrow-up\"></i>
			icon-circle-arrow-up
			</li>
			<li>
			<i class=\"icon-circle-arrow-down\"></i>
			icon-circle-arrow-down
			</li>
			<li>
			<i class=\"icon-globe\"></i>
			icon-globe
			</li>
			<li>
			<i class=\"icon-wrench\"></i>
			icon-wrench
			</li>
			<li>
			<i class=\"icon-tasks\"></i>
			icon-tasks
			</li>
			<li>
			<i class=\"icon-filter\"></i>
			icon-filter
			</li>
			<li>
			<i class=\"icon-briefcase\"></i>
			icon-briefcase
			</li>
			<li>
			<i class=\"icon-fullscreen\"></i>
			icon-fullscreen
			</li>
		</ul>
	</div>
</div>
		</td>
  </tr>
   <tr>
		<td align=\"left\" class=\"datos_sgs tab_content\" id=\"tab_formularios\">
			<div class=\"span4\">
					
					<div class=\"control-group\">
						<label class=\"control-label\" for=\"inputIcon\">Email address</label>
							<div class=\"controls\">
								<div class=\"input-prepend\">
									<span class=\"add-on\">
									<i class=\"icon-envelope\"></i>
									</span>
									<input id=\"inputIcon\" class=\"span2\" type=\"text\">
								</div>
							</div>
					</div>
					
			</div>
		</td>
  </tr>
  <tr>
	  <td align=\"left\" class=\"datos_sgs tab_content\" id=\"tab_listas\">
	  
	  <div class=\"span4\">
<div class=\"well\" style=\"padding: 8px 0;\">
<ul class=\"nav nav-list\">
<li class=\"active\">
<a href=\"#\">
<i class=\"icon-home icon-white\"></i>
Home
</a>
</li>
<li>
<a href=\"#\">
<i class=\"icon-book\"></i>
Library
</a>
</li>
<li>
<a href=\"#\">
<i class=\"icon-pencil\"></i>
Applications
</a>
</li>
<li>
<a href=\"#\">
<i class=\"i\"></i>
Misc
</a>
</li>
</ul>
</div>
</div>
	  
			
	  </td>
  </tr>
  
<tr>
	<td align=\"left\" class=\"datos_sgs tab_content\" id=\"tab_alertas\">
		
		<table>
		<tr>
		<td>
			<div class=\"span4\">
				<h3>Error on Danger </h3>
			
				<div class=\"alert alert-error\">
				<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
				<strong>Oh snap!</strong>
				Change a few things up and try submitting again.
				</div>
		</td>
		<td>
			<div class=\"span4\">
			<h3> Class </h3>
				<code>
					alert alert-error
				</code>
			</div>
		</td>
		</tr>
		
		<tr>
		<td>
			<div class=\"span4\">
				<h3>Success</h3>
				<div class=\"alert alert-success\">
				<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
				<strong>Well done!</strong> You successfully read this important alert message.
				</div>
			</div>
		</td>
		<td>
			<div class=\"span4\">
				<h3> Class </h3>
				<code>
					alert alert-success
				</code>
			</div>
		</td>
		</tr>
		
		<tr>
		<td>
		<div class=\"span4\">
		  <h3>Information</h3>
		  <div class=\"alert alert-info\">
			<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
			<strong>Heads up!</strong> This alert needs your attention, but it's not super important.
		  </div>
		</div>
		</td>
		
		<td>
			<div class=\"span4\">
				<h3> Class </h3>
				<code>
					alert alert-info
				</code>
			</div>
		</td>
		
		
		</tr>
		
		<tr>
		<td>
	  <div class=\"span4\">
		  <h3>Warning</h3>
		  <div class=\"alert alert-block\">
			<button class=\"close\">&times;</button>
			<h4 class=\"alert-heading\">Warning!</h4>
			<p>Best check yo self, you're not looking too good. Nulla vitae elit libero, a pharetra augue. Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</p>
		  </div>
	  </div>
	  </td>
	  
		<td>
			<div class=\"span4\">
				<h3> Class </h3>
				<code>
					alert alert-block
				</code>
			</div>
		</td>
	  
	  </tr>
	  </table>
	</td>

</tr>

<tr>
	<td align=\"left\" class=\"datos_sgs tab_content\" id=\"tab_barras\">
		<table>
		<tr>
			<td>
			<div class=\"span4\">
			  <h3>Basic</h3>
			  <p>Default progress bar with a vertical gradient.</p>
			  <div class=\"progress\">
				<div class=\"bar\" style=\"width: 60%;\"></div>
			  </div>
		  </div>
		  </td>
		  
		  <td>
			<div class=\"span4\">
				<h3> Class </h3>
			<code>
				progress	
			</code>
			</div>
		  </td>
		  
		
		</tr>
		
		
		<tr>
			<td>
		  <div class=\"span4\">
			  <h3>Striped</h3>
			  <p>Uses a gradient to create a striped effect (no IE).</p>
			  <div class=\"progress progress-striped\">
				<div class=\"bar\" style=\"width: 20%;\"></div>
			  </div>
		  </div>
		  </td>
		   <td>
			<div class=\"span4\">
				<h3> Class </h3>
				<code>
					progress progress-striped	
				</code>
			</div>
		  </td>

		</tr>
		<tr>
			<td>
			 <div class=\"span4\">
				  <h3>Animated</h3>
				  <p>Takes the striped example and animates it (no IE).</p>
				  <div class=\"progress progress-striped active\">
					<div class=\"bar\" style=\"width: 45%\"></div>
				  </div>
			</div>	  
			</td>
			 <td>
	 			<div class=\"span4\">
				<h3> Class </h3>
					<code>
						progress progress-striped active
					</code>
				</div>
		  </td>
		</tr>
	  </table>
	</td>
</tr>
 
 </table>



			   ";
?>