<?php

    $weather = "";

    $error = "";

    if(array_key_exists('city', $_GET)){
        
        $city = str_replace(' ', '',$_GET['city']);
        
        $file_headers = @get_headers("https://www.weather-forecast.com/locations/".$city."/forecasts/latest");
        
        if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
        
            $error = "That city could not be found.";
        
        } else {
        
        $forecastPage = file_get_contents("https://www.weather-forecast.com/locations/".$city."/forecasts/latest");
        
        $pageArray = explode('</h2>(1&ndash;3 days)</span><p class="b-forecast__table-description-content"><span class="phrase">', $forecastPage);
            
        if(sizeof($pageArray) > 1){
        
            $secondPageArray = explode('</span></p></td>', $pageArray[1]);
            
            if(sizeof($secondPageArray) > 1){
        
                $weather = $secondPageArray[0];
                
            } else {
                
                $error = "That city could not be found.";
                
            }
            
            } else {
            
                   $error = "That city could not be found.";
            
                }
        
        }
    }


?>


<!doctype html>

<html lang="en">
    
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      
      <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Weather Scraper</title>
      
    <style type="text/css">
      
        html { 
            background: url(background4.jpg) no-repeat center center fixed; 
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
             background-size: cover;
        }
        
        body {
            
            background: none;
            
        }
        
        .container {
            
            text-align: center;
            margin-top: 150px;
            width: 450px;
            
        }
        
        input {
            
            margin: 20px 0;
            
        }
        
        #weather {
            
            margin-top: 15px;
            
        }
        
      
      </style>

      
  </head>
    
  <body>
      
      <div class="container">
      
        <h1>What's The Weather?</h1>
        <form>
            <div class="form-group">
                <label for="city">Enter the name of a city.</label>
                <input type="text" class="form-control" id="city" name= "city" placeholder="Eg. Hyderabad, Delhi, Mumbai" value = "<?php 
                                                                                                                                   
                                                                                                                                   
                                                                                                if(array_key_exists('city', $_GET)){

                                                                                                echo $_GET['city'];

                                                                                                }  
                                                                                                ?>">
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
          
            <div id = "weather"><?php
                
                if($weather){
                    
                    echo '<div class="alert alert-success" role="alert">'.$weather.'</div>';
                    
                } else if($error){
                    
                    echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
                    
                }
                
                
            ?></div>
      
      </div>
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
          
  </body>
</html>