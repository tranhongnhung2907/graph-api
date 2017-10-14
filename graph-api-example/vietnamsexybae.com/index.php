<?php
// Include FB config file && User class
require_once 'fbConfig.php';
require_once 'User.php';

	
	include('systems/config.php');
	
    $graph_url = "https://graph.facebook.com/v2.10/1173636692750000/feed?fields=full_picture,from,caption,description,message,updated_time,likes,type,source&limit=".$config['limit']."&access_token=".$config['token']."";
    $feed = json_decode(file_get_contents($graph_url));
	$feed_paging = json_decode(file_get_contents($graph_url));	
	foreach($feed->data as $data)
    {           
                @$content .= '
				
				<div class="col-lg-4" id="'.$data->from->id.'">
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
	
         
                $paging_next .= '
				
					<input type="hidden" id="paging_next" name="paging_next" value="'.substr($feed_paging->paging->next, 358).'"/>
				
                ';	
        


if(isset($accessToken)){
	if(isset($_SESSION['facebook_access_token'])){
		$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
	}else{
		// Put short-lived access token in session
		$_SESSION['facebook_access_token'] = (string) $accessToken;
		
	  	// OAuth 2.0 client handler helps to manage access tokens
		$oAuth2Client = $fb->getOAuth2Client();
		
		// Exchanges a short-lived access token for a long-lived one
		$longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
		$_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
		
		// Set default access token to be used in script
		$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
	}
	
	// Redirect the user back to the same page if url has "code" parameter in query string
	if(isset($_GET['code'])){
		header('Location: ./');
	}
	
	// Getting user facebook profile info
	try {
		$profileRequest = $fb->get('/me?fields=name,first_name,last_name,email,link,gender,locale,picture');
		$fbUserProfile = $profileRequest->getGraphNode()->asArray();
	} catch(FacebookResponseException $e) {
		echo 'Graph returned an error: ' . $e->getMessage();
		session_destroy();
		// Redirect user back to app login page
		header("Location: ./");
		exit;
	} catch(FacebookSDKException $e) {
		echo 'Facebook SDK returned an error: ' . $e->getMessage();
		exit;
	}
	
	// Initialize User class
	$user = new User();
	
	// Insert or update user data to the database
	$fbUserData = array(
		'oauth_provider'=> 'facebook',
		'oauth_uid' 	=> $fbUserProfile['id'],
		'first_name' 	=> $fbUserProfile['first_name'],
		'last_name' 	=> $fbUserProfile['last_name'],
		'email' 		=> $fbUserProfile['email'],
		'gender' 		=> $fbUserProfile['gender'],
		'locale' 		=> $fbUserProfile['locale'],
		'picture' 		=> $fbUserProfile['picture']['url'],
		'link' 			=> $fbUserProfile['link']
	);
	$userData = $user->checkUser($fbUserData);
	
	// Put user data into session
	$_SESSION['userData'] = $userData;
	
	// Get logout url
	$logoutURL = $helper->getLogoutUrl($accessToken, $redirectURL.'logout.php');
	
	// Render facebook profile data
	if(!empty($userData)){
		/* $output  = '<h1>Facebook Profile Details </h1>'; */
		$output .= '<div class="info-left"><img class="circle" src="'.$userData['picture'].'" alt="" aria-label="" role="img"></div><div class="info-right-fb"><h5 class="card-title-fb"><a href="https://facebook.com/' . $userData['oauth_uid'] . '" target="_blank">' . $userData['first_name'].' '.$userData['last_name'] .'</a></h5></div> <div class="pull-right"><a title="Thoát" href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i></a></div>';
        /* $output .= '<br/>Facebook ID : ' . $userData['oauth_uid']; 
        $output .= '<br/>Name : ' . $userData['first_name'].' '.$userData['last_name'];
        $output .= '<br/>Email : ' . $userData['email'];
        $output .= '<br/>Gender : ' . $userData['gender'];
        $output .= '<br/>Locale : ' . $userData['locale'];
        $output .= '<br/>Logged in with : Facebook';
		$output .= '<br/><a href="'.$userData['link'].'" target="_blank">Click to Visit Facebook Page</a>';
        $output .= '<br/>Logout from <a href="'.$logoutURL.'">Facebook</a>';  */
	}else{
		$output = '<h3 style="color:red">Some problem occurred, please try again.</h3>';
	}
	
}else{
	// Get login url
	$loginURL = $helper->getLoginUrl($redirectURL, $fbPermissions);
	
	// Render facebook login button
	$output = '<a href="'.htmlspecialchars($loginURL).'"><img src="images/fblogin-btn.png"></a>';
}
?>

<?php include 'systems/header.php';?>

	<!-- Display login button / Facebook profile information -->
	
	<!--Content-->
    <div class="container">
        <div class="row my-5">    
			<?php echo $content;?>		
        </div>
		
		<?php echo $paging_next;?>
		
		<!-- Load more data -->
		<div class="row my-5" id="postList">    
				
        </div>
		
		<div class="load-more list-item-load" lastID="0" style="display: none;">				
                <img src="img/loading.gif"/>
        </div>
		
		<!--<br/>	
			<div class="text-center" style="margin-left: auto;margin-right:auto;display:block;margin-top: 50px;">
				<button type="submit" class="btn btn-info" id="loadmore" style="width: 300px;">Load More...</button>
			</div> -->
    </div>
	
	<!-- Return to Top -->
	<a href="javascript:" id="return-to-top"><i class="icon-chevron-up"></i></a>
    <!--/.Content-->
	
<?php include 'systems/footer.php';?>