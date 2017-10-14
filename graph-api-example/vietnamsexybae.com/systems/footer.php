 <!--Footer-->
    <footer class="page-footer center-on-small-only">

        <!--Footer Links-->
        
        <!--/.Footer Links-->

        <!--Call to action-->
        <div class="call-to-action">         
            <ul>
                <li>
                    <h5></h5>
                </li>
                <li><a target="_blank" href="#" class="btn btn-info" rel="nofollow">Sign up!</a></li>
                
            </ul>
        </div>
        <!--/.Call to action-->

        <!--Copyright-->
        <div class="footer-copyright">
            <div class="container-fluid">
                © 2017 Copyright 

            </div>
        </div>
        <!--/.Copyright-->

    </footer>
    <!--/.Footer-->


    <!-- SCRIPTS -->

    <!-- JQuery -->
    <script type="text/javascript" src="./js/jquery-3.1.1.min.js"></script>

    <!-- Bootstrap dropdown -->
    <script type="text/javascript" src="./js/popper.min.js"></script>

    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="./js/bootstrap.min.js"></script>

    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="./js/mdb.min.js"></script>
	
	<script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
	<script src="./js/jquery.viewbox.min.js"></script>

    <script>
        new WOW().init();
		
    </script>

</body>
<script type="text/javascript">
	function increment(n){

	  n++;
	  return n;
	}			
	
	
	$(document).ready(function(){
		$(window).scroll(function() {
		   if($(window).scrollTop() + $(window).height() == $(document).height()) {
				var successCount = 0;
				var numberplus = successCount++;
				var data = 'https://graph.facebook.com/v2.10/1173636692750000/feed?fields=full_picture,from,caption,description,message,updated_time,likes,type,source&limit=5&icon_size=16&access_token=EAAAAUaZA8jlABAN4YJlK74l4J8owwURYMZC8e8WeCAkXqA9ZAQDCHGG2PceWwLovbbMIlZBxt4Q5qBMAivVVjkF14kDf5g1MZCLoYft6oroKvPLXYdJ7EHarOBeO6aRqSWCRdyCHg3jAB1PFwT3CfGxgIEnPhDBP0rGDJhrVZCX0I5cAvFqRvX&until=1507137301&__paging_token=enc_AdC5rYFHi3iPMZCEr2vcygQQQ0EvR9hqbFkL2xbAhcykJ6k0aMZBO7C9Ck5hP8pZBKHGFKQFHtSUlaUZBSnoVG273W1OMbWb6szv1fZAcCU1OQWA1jgZDZD';
			    var utilLoadData =  $('#paging_next').val();
			    var lastID = $('.load-more').attr('lastID');
				var i = 0;



i=increment(i);
				if ($(window).scrollTop() == $(document).height() - $(window).height() && lastID == 0){
					$.ajax({
						type:'POST',
						url:'loadmore.php',
						data:{ value: utilLoadData,number: numberplus },
						beforeSend:function(html){							
							
						},
						success:function(html){
							
							$('#postList').append(html);
							var utilLoadData2 =  $('#paging_next_2').val();
							$('#paging_next').val(utilLoadData2);
							$('.load-more').show();
						}
					});
				}
		   }
		});
	});


</script>


<script>

// ===== Scroll to Top ==== 
$(window).scroll(function() {
    if ($(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
        $('#return-to-top').fadeIn(200);    // Fade in the arrow
    } else {
        $('#return-to-top').fadeOut(200);   // Else fade out the arrow
    }
});
$('#return-to-top').click(function() {      // When arrow is clicked
    $('body,html').animate({
        scrollTop : 0                       // Scroll to top of body
    }, 500);
});

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
</html>