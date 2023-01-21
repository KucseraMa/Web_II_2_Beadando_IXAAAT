<?php
$apiKey = "eae7bc14fa0bbb62b02f6540171dd665";
$cityId = "3050434";
$googleApiUrl = "https://api.openweathermap.org/data/2.5/weather?id=" . $cityId . "&lang=hu&units=metric&APPID=" . $apiKey;

$ch = curl_init();

curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);

curl_close($ch);
$data = json_decode($response);
$currentTime = time();
?>
<h1>Objektum orientált JS</h1>

<p id="city"></p>

<h2>Ingyenes Restful API-t</h2>
<h3><?php echo $data->name; ?></h3>
<div class="time">
    <div><?php echo date("l g:i a", $currentTime); ?></div>
    <div><?php echo date(" Y, F, jS",$currentTime); ?></div>
    <div><?php echo ucwords($data->weather[0]->description); ?></div>
</div>
<div class="weather-forecast">
    <img src="https://openweathermap.org/img/w/<?php echo $data->weather[0]->icon; ?>.png" class="weather-icon" />
     <span ><?php echo $data->main->temp; ?>°C</span>
</div>
<div class="time">
    <div>Páratartalom: <?php echo $data->main->humidity; ?>%</div>
    <div>Szélerősség: <?php echo $data->wind->speed; ?> km/h</div>
</div>

<script>
class Citys {
    constructor(name, population) {
        this.name = name;
        this.population = population;
    }
    population_write() {
        return `${this.name} város lakossága: ${this.population} fő`;
    }
}
let city = new Citys("Budapest", 1700000);
console.log(city);
document.getElementById("city").innerHTML  = city.population_write();

</script>