<!DOCTYPE HTML>

   <html>
    <head>
            <title>TESTING GPS2</title>
    
   
        <script type = "text/javascript">
             var watchID;
             var geoLoc;
         
             function showLocation(position) {
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;
                alert("Latitude : " + latitude + " Longitude: " + longitude);
             }
             
             function errorHandler(err) {
                if(err.code == 1) {
                   alert("Error: Access is denied!");
                } else if( err.code == 2) {
                   alert("Error: Position is unavailable!");
                }
             }
             
             function getLocationUpdate(){
                
                if(navigator.geolocation){
                    
                   // timeout at 60000 milliseconds (60 seconds)
                   var options = {timeout:2000};
                   geoLoc = navigator.geolocation;
                   watchID = geoLoc.watchPosition(showLocation, errorHandler, options);
                } else {
                   alert("Sorry, browser does not support geolocation!");
                }
             }
        </script>
   </head>
   <body>
   
      <form>
         <input type = "button" onclick = "getLocationUpdate();" value = "Watch Update"/>
      </form>
      
   </body>
</html>

<!--navigator.geolocation.getCurrentPosition(function(position) {
        var pos = {
            lat: position.coords.latitude,
            lng: position.coords.longitude
        };
        var marker = new google.maps.Marker({
            position: pos,
            map: map,
            title: 'Your position'
        });
        map.setCenter(pos);
    }, function() {
        //handle location error (i.e. if user disallowed location access manually)
    });-->