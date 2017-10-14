<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title>SanXeHot Input Interface</title>
</head>
<body>
  <div id="fb-root"></div>
  <script>

  var app_id = '1624732407577268';
  var app_scope = 'public_profile,email,user_likes,user_posts,publish_actions,user_photos,manage_pages,publish_pages,read_page_mailboxes,pages_show_list,pages_manage_cta,pages_manage_instant_articles,ads_management,ads_read,user_managed_groups';
  var app_uri = 'http://localhost/graph-api/sanxehot';

  (function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));


  window.fbAsyncInit = function() {
    FB.init({
      appId      : app_id,
      cookie     : true,  // enable cookies to allow the server to access
      // the session
      xfbml      : true,  // parse social plugins on this page
      version    : 'v2.10' // use graph api version 2.8
    });

    // Now that we've initialized the JavaScript SDK, we call
    // FB.getLoginStatus().  This function gets the state of the
    // person visiting this page and can return one of three states to
    // the callback you provide.  They can be:
    //
    // 1. Logged into your app ('connected')
    // 2. Logged into Facebook, but not your app ('not_authorized')
    // 3. Not logged into Facebook and can't tell if they are logged into
    //    your app or not.
    //
    // These three cases are handled in the callback function.

    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });

  };



  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.

      alert('đã login lalala ');
      var token = response.authResponse.accessToken;
      var timeleft = response.authResponse.expiresIn;
      var unknown = response.authResponse.signedRequest;
      var userid = response.authResponse.userID;

      document.getElementById('status').innerHTML = 'connected';
      document.getElementById('1').innerHTML = 'token ' + token;
      document.getElementById('2').innerHTML = 'timeleft ' + timeleft;
      document.getElementById('3').innerHTML = 'unknown ' + unknown;
      document.getElementById('4').innerHTML = 'id ' + userid;

      document.getElementById('user_submit1').setAttribute('value', userid);
      document.getElementById('user_submit2').setAttribute('value', token);
      document.getElementById('user_submit3').setAttribute('value', timeleft);


    } else {
      // The person is not logged into your app or we are unable to tell.
      document.getElementById('status').innerHTML = 'Please log ' +
      'into this app.';
      alert('Chưa đăng nhập');
    }
  }


  function RequestLoginFB() {
    window.location = 'http://graph.facebook.com/oauth/authorize?client_id=' + app_id + '&scope=' + app_scope + '&redirect_uri=' + app_uri;
  }


  function test() {
    var body = 'Reading JS SDK documentation';
    FB.api('/me/feed?access_token='+ token, 'post', {'message': body}, function(response) {
      if (!response || response.error) {
        alert('Error occured' + response.error);
      } else {
        alert('Post ID: ' + response.id);
      }
    }
  );
}
function test2() {
  /* make the API call */
  FB.api(
    "/102504673757552so/photos?access_token="+'EAACZC6awggg0BAPbhSZC7jUb0HsM6JfhZCIr7coCukNHH9cI6gf0Auj2iNIt3nZA8vU5KbnAVIXdWeOG2KeVZCaf9ojz94WsZBJ61KWOgyjvnEVqF9VUKgq0FG3Agbqzla1X9xahhw4qKQSZAgU8ZBHQYALJRSNscUnSaDFZA49MZBaG0EOVzujLnI2nIHU60gyAPqbzaK63Ew1gZDZD',
    "POST",
    {
      "url": "https://static.techtalk.vn/wp-content/uploads/2016/05/techtalk-Ubuntu-is-a-operating-system1.jpg",
      'caption': 'mình đang test api ahihi'
    },

    function (response) {
      if (response && !response.error) {
        alert('đã post bài ' + response.id + ' ' + response.post_id);
      }
      else {
        alert('có lỗi khi post bài ' + response.error);
      }
    }
  );
}

function submitform(){
  document.forms["user_submitform"].submit();
}
</script>
<p id="status">status</p>
<p id="1">token</p>
<p id="2">timeleft</p>
<p id="3">other</p>
<p id="4">id</p>
<p id="abc">testing</p>

<input type="button" value="ĐĂNG NHẬP" onclick="RequestLoginFB()"/>
<input type="button" value="Post bài" onclick="test()"/>
<input type="button" value="submit" onclick="submitform()"/>

<form name='user_submitform' target="_blank" action="config.php" method="get" hidden="true">
  <input id="user_submit1" type="text" name="user_id" value="">
  <input id="user_submit2" type="text" name="user_token" value="">
  <input id="user_submit3" type="text" name="user_expire" value="">
  <!-- <input id="user_submit4" type="text" name="user_currenttime" value=""> -->
  <input type="submit" value="submit đi">
</form>
<!-- <div class="fb-comments" data-href="http://localhost/fb" data-numposts="2"></div>
<div class="fb-page" data-href="https://www.facebook.com/nuhulacoffee" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/nuhulacoffee" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/nuhulacoffee">Nuhula Coffee</a></blockquote></div> -->
</body>
</html>
