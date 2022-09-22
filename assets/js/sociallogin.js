
  var googleUser = {};
  var startApp = function() {
    gapi.load('auth2', function(){
      // Retrieve the singleton for the GoogleAuth library and set up the client.
      auth2 = gapi.auth2.init({
        client_id: '75514213433-tf6hts4rufmnjlaiefmcjo1ok96jn94n.apps.googleusercontent.com',
        cookiepolicy: 'single_host_origin',
        // Request scopes in addition to 'profile' and 'email'
        //scope: 'additional_scope'
      });
      attachSignin(document.getElementById('customBtn'));
    });
  };

  function attachSignin(element) {
    //console.log(element.id);
    auth2.attachClickHandler(element, {},
        function(googleUser) {

          var profileid=googleUser.getBasicProfile().getId();
          var fullname=googleUser.getBasicProfile().getName();
          var firstname=googleUser.getBasicProfile().getGivenName();
          var lastname=googleUser.getBasicProfile().getFamilyName();
          var profileurl=googleUser.getBasicProfile().getImageUrl();
          var email=googleUser.getBasicProfile().getEmail();
          var auth='Google';

           $.post(base_url + 'user/dashboard/is_validsocial_login',{'profileid':profileid,'fullname':fullname,'firstname':firstname,'lastname':lastname,'profileurl':profileurl,'email':email,'auth':auth},function(data){
                    var obj=jQuery.parseJSON(data);
                    if(obj.result=='yes')
                    {
                        window.location.reload();                         
                    }
                    else if(obj.result=='no')
                    {
                       //showNotification('bg-pink', obj.status, 'top', 'center', 'animated zoomIn', 'animated zoomOut');
                       
                    }
                    else
                    {
                        window.location.reload();        
                    }
          });
          
        }, function(error) {

          //showNotification('bg-pink', JSON.stringify(error, undefined, 2), 'top', 'center', 'animated zoomIn', 'animated zoomOut');
          
        });
  }
  

  //fb ------------
window.fbAsyncInit = function() {
    // FB JavaScript SDK configuration and setup
    FB.init({
      appId      : '1653361411366191', // FB App ID
      cookie     : true,  // enable cookies to allow the server to access the session
      xfbml      : true,  // parse social plugins on this page
      version    : 'v2.8' // use graph api version 2.8
    });
    
    // Check whether the user already logged in
    // FB.getLoginStatus(function(response) {
    //     if (response.status === 'connected') {
    //         //display user data
    //         getFbUserData();
    //     }
    // });
};

// Load the JavaScript SDK asynchronously
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

// Facebook login with JavaScript SDK
function fbLogin() {
    FB.login(function (response) {
        if (response.authResponse) {
            // Get and display the user profile data
            getFbUserData();
        } else {
           
           alert('User cancelled login or did not fully authorize'); 
        }
    }, {scope: 'email'});
}

// Fetch the user profile data from facebook
function getFbUserData(){
    FB.api('/me', {locale: 'en_US', fields: 'id,name,first_name,last_name,email,link,gender,locale,picture'},
    function (response) {

          var profileid=response.id;
          var fullname=response.name;
          var firstname=response.first_name;
          var lastname=response.last_name;
          var profileurl=response.picture.data.url;
          var email=response.email;
          var auth='Facebook';

           $.post('http://brinejobs.com/home/seekar_login',{'profileid':profileid,'fullname':fullname,'firstname':firstname,'lastname':lastname,'profileurl':profileurl,'email':email,'auth':auth},function(data){
                    var obj=jQuery.parseJSON(data);
                    if(obj.result=='yes')
                    {
                        window.location.href='http://brinejobs.com/seekar';                         
                    }
                    else if(obj.result=='no')
                    {
                        //showNotification('bg-pink', obj.status, 'top', 'center', 'animated zoomIn', 'animated zoomOut');
                       
                    }
                    else
                    {
                       window.location.href='http://brinejobs.com/home';
                    }
          });

        
    });
}


  


