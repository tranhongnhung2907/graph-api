<?php

if(isset($_POST["value"]) && !empty($_POST["value"])){	

	include('systems/config.php');
	//Get last strtotime until
	$lastUntil = $_POST['value'];
	$lastNumber = $_POST['number'];
	//echo $lastNumber;
    $graph_url_load_more = "https://graph.facebook.com/v2.4/1173636692750000/feed?fields=full_picture,message,updated_time,from,likes&limit=21&icon_size=16&access_token=".$config['token']."&unt".$lastUntil."";
	//echo $graph_url_load_more;
    $feed_load_more = json_decode(file_get_contents($graph_url_load_more));
	$feed_paging_load_more = json_decode(file_get_contents($graph_url_load_more));

	foreach($feed_load_more->data as $data)
    {           
                @$content2 .= '
				
				<div class="col-lg-4 list-item-load" id="'.$data->from->id.'">
                <!--Card-->
                <div class="card wow fadeIn" data-wow-delay="0.2s">

                    <!--Card image-->
					<a href="'.$data->full_picture.'" class="image-link" title="'.$data->from->name.'">
						<img class="img-fluid" src="'.$data->full_picture.'" alt="'.$data->from->name.'">
					</a>



                    <!--Card content-->
                    <div class="card-body">
                        <!--Title-->
                        <div class="info-left"><img class="circle" src="https://graph.facebook.com/'.$data->from->id.'/picture?type=large" alt="" aria-label="" role="img"></div>
						<div class="info-right"><h5 class="card-title"><a href="https://facebook.com/'.$data->from->id.'" target="_blank">'.$data->from->name.'</a></h5></div>
                        <!--Text-->
                        <p class="card-text">'.$data->message.'</p>
                        
                    </div>

                </div>

				</div>
                ';	      
    }
	
	$paging_next2 .= '
				
					<input type="hidden" id="paging_next_2" name="paging_next_2" value="'.$feed_paging_load_more->paging->next.'"/>
				
                ';	
	
}	
?>

<?php echo $content2; ?>
<?php echo $paging_next2; ?>

<!-- SCRIPTS -->

    <!-- JQuery -->
    <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>

    <!-- Bootstrap dropdown -->
    <script type="text/javascript" src="js/popper.min.js"></script>

    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
	
	<script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
	<script src="js/jquery.viewbox.min.js"></script>
	
	<script>


	fuckAdminVsbg = document.getElementById("100002516348305");
	if ( fuckAdminVsbg ) {
	   $('#100002516348305').hide();
	}


	$(function(){
		$('.image-link').viewbox({
			// template
	  template: '<div class="viewbox-container"><div class="viewbox-body"><div class="viewbox-header"></div><div class="viewbox-content"></div><div class="viewbox-footer"></div></div></div>',

	  // loading spinner
	  loader: '<div class="loader"><div class="spinner"><div class="double-bounce1"></div><div class="double-bounce2"></div></div></div>',
	  setTitle: true,
			margin: 20,
			resizeDuration: 300,
			openDuration: 200,
			closeDuration: 200,
			closeButton: true,
			navButtons: true,
			closeOnSideClick: true,
			nextOnContentClick: true
		});
	});
	</script>