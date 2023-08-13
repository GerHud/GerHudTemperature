<!DOCTYPE html>
<html lang="de" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>GH Temperatur</title>
  <link rel="icon" href="icon.png">
  <link rel="stylesheet" href="style.css">
  <meta http-equiv="refresh" content="60">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <link rel="apple-touch-icon" href="icon.png">

  <style>
    .head {
      <?php
      $pooljson = 'pool.json';
      $poolcontent = file_get_contents($pooljson);
      $pooldata = json_decode($poolcontent, true);
      $poolcolor = $pooldata["color"];

      $indoorjson = 'indoor.json';
      $indoorcontent = file_get_contents($indoorjson);
      $indoordata = json_decode($indoorcontent, true);
      $indoorcolor = $indoordata["color"];

      $outjson = 'outdoor.json';
      $outcontent = file_get_contents($outjson);
      $outdata = json_decode($outcontent, true);
      $outcolor = $outdata["color"];
      echo "background: linear-gradient(to right, " . $outcolor . " 25%, " . $poolcolor . " 75%);";
      ?>
    }
  </style>

  <script>
    // Erkennen des System-Dark-Mode
    const prefersDarkMode = window.matchMedia("(prefers-color-scheme: dark)").matches;

    // Hinzufügen einer CSS-Klasse basierend auf dem erkannten Dark-Mode
    if (prefersDarkMode) {
      document.documentElement.classList.add('dark-mode');
    }
  </script>
</head>
<body>
<?php
$outtemp = $outdata["temperature"];
$outtemp_rounded = round($outtemp, 0);
$outtime = $outdata["time"];

$indoortemp = $indoordata["temperature"];
$indoortemp_rounded = round($indoortemp, 0);
$indoortime = $indoordata["time"];

$pooltemp = $pooldata["temperature"];
$pooltemp_rounded = round($pooltemp, 0);
$pooltime = $pooldata["time"];
?>

<div class="head">
  <?php
  echo "<div><h1 class='title'>$outtemp_rounded</h1><br><h2>Au&szlig;en: $outtime</h2></div>";
  echo "<div><h1 class='title'>$indoortemp_rounded</h1><br><h2>Innen: $indoortime</h2></div>";
  echo "<div><h1 class='title'>$pooltemp_rounded</h1><br><h2>Pool: $pooltime</h2></div>";
  ?>
</div>
<div class="main">

  <?php
  $outF = ($outtemp * 1.8) + 32;
  $poolF = ($pooltemp * 1.8) + 32;
  $indoorF = ($indoortemp * 1.8) + 32;

  $outK = $outtemp + 273.15;
  $poolK = $pooltemp + 273.15;
  $indoorK = $indoortemp + 273.15;

  echo "<div class='more'>
        <div>
          <h1>Au&szlig;entemperatur:</h1>
          <h2>$outK K</h2>
          <h2>$outtemp &deg;C</h2>
          <h2>$outF &deg;F</h2>
        </div>

        <div>
          <h1>Innentemperatur:</h1>
          <h2>$indoorK K</h2>
          <h2>$indoortemp &deg;C</h2>
          <h2>$indoorF &deg;F</h2>
        </div>

        <div>
          <h1>Pooltemperatur:</h1>
          <h2>$poolK K</h2>
          <h2>$pooltemp &deg;C</h2>
          <h2>$poolF &deg;F</h2>
        </div>
    </div>";
  echo "<div class='refreshbox'><button class='refresh' onClick='window.location.reload();'>Refresh</button></div>";
  ?>
</body>
</html>
