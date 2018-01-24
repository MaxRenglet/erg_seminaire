<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Examples</title>
<meta name="description" content="">
<meta name="keywords" content="">
<link href="./CSS/style.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto+Mono:300,400" rel="stylesheet">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<body>
	<header><h1>#Séminaire ERG 2018</h1>
		<div id="slider"></div>
	</header>

<table>
<?php

include('./lib/emoji.php');

include('../lib/config.php');


try
{
	$bdd = new PDO("mysql:host=$servername; dbname=$myDB; port=$port", $username, $password);
	$reponse = $bdd->query('SELECT * FROM erg_seminaire ORDER BY date_d ASC');
	$donnees = $reponse->fetch();
	while ($donnees = $reponse->fetch())
{
	$in = $donnees['message'];
	$out = strlen($in) > 50 ? substr($in,0,100)."..." : $in;

	$time = $donnees['date_d'];
	$date = DateTime::createFromFormat( 'Y-m-d H:i:s', $time, new DateTimeZone( 'America/New_York'));

	$time_display = $date->format( 'H:i:s');
	$time_date = $date->format( 'd/m');
	$time_h = $date->format( 'H');
	$time_m = $date->format( 'i');
	$time_s = $date->format( 's');
	$position = 150+(($time_s + ($time_m*60) + (($time_h*3600)-(10*3600))));

	

?>

<tr style="position: absolute; top:<?php echo $position ?>px">
<td class="date"><?php echo $time_date ?></td>
<td class="temps"><?php echo $time_display ?></td>
<td class="user"><?php echo $donnees['username'] ?></td>
<td class="mood"><?php echo $donnees['mood'] ?> :</td>
<td class="text"><?php echo $out ?></td>
	</tr>
	
	<?php 
};
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}
?>
</table>

<div id="footer">Project by Martin Campillo & Max Renglet</div>
</body>
<script>

var value_top = new Array();
 $('tr').each(function (index, value){
  value_top[index] = parseInt($(this).css('top'));
  if ($(window).width() < 800) {
 $(this).css('top',value_top[index]/0.2);
	};
});



var total_1 = 1;

$("#slider").slider({
	range: "max",
    animate: "slow",
    max: 15,
    min: 0.01,
    step: 0.1,
    value: 1,
    orientation : 'vertical',

    slide: function (event, ui) {
  total_1 = $("#slider").slider("value");
  $('tr').each(function (index, value){
if ($(window).width() > 800) {
  $(this).css('top',value_top[index]/total_1);
};
});
    }
});



	</script>

</html>