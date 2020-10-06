  
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Weather</title>
</head>
<body>

    <form method="POST">
        <div class="form-group">
            <label for="city">City</label>
            <input type="text" name="city" class="form-control" id="city" placeholder="Type a city" required>
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
    

    
<?php
  $results = array();
    if (isset($_POST['city']) && $_POST['city']!="") {
        $city = $_POST['city'];
        unset($_POST);
        $key = "510eb7be47904818b8a174646202809";
        $url = "http://api.weatherapi.com/v1/current.json?key=".$key."&q=".$city;
 
        $client = curl_init($url);
        curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
        $response = curl_exec($client);
 
        $result = json_decode($response,true);
        array_push($results, $result);

    echo "
        <table class='table'>
            <thead>
                <tr>
                    <th scope='col'>#</th>
                    <th scope='col'>Name, Region</th>
                    <th scope='col'>Country</th>
                    <th scope='col'>Date & Time</th>
                    <th scope='col'>Current Temperature</th>
                    <th scope='col'>Weather Condition</th>
                </tr>
            </thead>
            <tbody>";
        
    foreach ($results as $item) {
        echo "
            <tr>
                <th scope='row'>1</th>
                      <td>".$item['location']['name'].", ".$item['location']['region']."</td>
                      <td>".$item['location']['country']."</td>
                      <td>".$item['location']['localtime']."</td>
                      <td>".$item['current']['temp_c']." C</td>
                      <td class='row'>
                        <img src=".$item['current']['condition']['icon']." alt='".$item['current']['condition']['text']."' class='col-3' />
                        <p class='col-9'>".$item['current']['condition']['text']."</p>
                      </td>
            </tr>";
    }
    
    
    echo "
        </tbody>
    </table>";
}
?>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
 
</body>
    
</html> 
  