<?php

  $output = "";
  $error = "";
  $city = "";

  if($_GET){

    function clean($string) {
       $string = str_replace(' ', '', $string); // Remove all spaces. A dash char will be added by the weather-forecast api

       return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }

    // get user city input
    if(!$_GET["city"]){
      $error = "Please insert a valid city.";
    }else {
      // check if city contains space and change to dash char
      $city = clean($_GET["city"]);
      // construct weather-forecast.com url for particular city eg.
      // https://www.weather-forecast.com/locations/Abu-Dhabi/forecasts/latest
      $url = "https://www.weather-forecast.com/locations/".$city."/forecasts/latest";
      // check if url exists
      $url_headers = @get_headers($url);
      $exists = true;
      if(!$url_headers || $url_headers[0] == 'HTTP/1.1 404 Not Found') {
          $exists = false;
      }
      if($exists){
        // execute file_get_contents
        $data = file_get_contents($url);
        // find element <p class="b-forecast__table-description-content"></p> and extract data
        $tr_regex = '"<p class=\"b-forecast__table-description-content\"><span class=\"phrase\">(.*?)</span></p>"i';
        preg_match($tr_regex, $data, $match);
        if(!$match){
          $error = "There was an error, please try again.";
        } else {
          $output = '<div class="alert alert-success" role="alert"><p><strong>City: '.$city.'</strong></p>'.$match[1].'</div>';
        }
      } else {
        $error = "There was an error, please try again.";
      }
    }
    if($error != ""){
      $error = '<div class="alert alert-danger" role="alert">'.$error.'</div>';
    }
  }

  include("header.php");
  include("body.php");
  include("footer.php");
?>
