<?php

if(!isset($_POST["cityName"])){
    $_POST["cityName"] = "Paris";
}
$url = 'https://api.openweathermap.org/data/2.5/weather?q='.$_POST["cityName"].'&lang=fr&units=metric&APPID=6bc960c3834a3c720dc085628f3384a9';
$request = @get_headers($url);
$statusReq = $request[0];
if(strpos($statusReq, "404")) {
    $find=false;
}
else {
    $find=true;
    $json = file_get_contents($url);
    $response = json_decode($json);
}


?>
<!Doctype html>
<html>
    <head>
        <title>Decalog project</title>
        <link rel="stylesheet" href="bootstrap.min.css">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div>
            <form method="post" onchange="submit()" class="form-group">
                <input type="text" name="cityName" placeholder="City Name" value="<?php echo $_POST["cityName"] ?>" class="form-text text-muted <?php if ($find) echo 'form-control is-valid'; else echo 'form-control is-invalid'; ?>">
                <p class="invalid-feedback">The city doesn't exist</p>
                <input class="justify-content-center btn btn-primary" type="submit" name="submit">
            </form>
            <section class="card text-white bg-primary mb-3">
                <p>City Name: <?php if($find) echo $response->name?></p>
                <p>Météo: <?php if($find) echo $response->weather[0]->description?></p>
                <p>Température miniaml: <?php if($find) echo $response->main->temp_min?></p>
                <p>Température maximal: <?php if($find) echo $response->main->temp_max?></p>
                <p>Ressenti: <?php if($find) echo $response->main->feels_like?></p>
                <p>Humidité: <?php if($find) echo $response->main->humidity?></p>
            </section>
        </div>
    </body>

</html>