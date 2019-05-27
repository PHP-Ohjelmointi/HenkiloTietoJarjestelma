<!DOCTYPE html>

<html>
<head> 
<meta charset="UTF-8">
<title>Hae henkilöt JSON:lla</title>
<meta name="keywords" content="Henkilo" />
<meta name="author" content="Abdulsatar Qaderzada">
<link rel="stylesheet" type="text/css" href="Tyyli.css">

<!-- Käytä uusinta, näet sen osoitteesta http://code.jquery.com -->
<script
  src="http://code.jquery.com/jquery-2.2.4.js"
  integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
  crossorigin="anonymous"></script>
</head>

<body>
<header>Henkilölistaa JSON: lla</header>

	<nav></nav>

	<article>
        <h2>Hae Henkilö</h2>
		<form action="" method="post">
        <input type="text" id "etunimi" name="etunimi">
			<!-- onclick kertoo, että painikkeen painalluksen käsittelee haeNimella-funktio -->
			<input type="button" id="hae" name="hae" value="Hae">
		</form>
		<br>
		<div style="margin-bottom:0.5cm" id="lista"></div>
		<p>
			<a href="index.php">Etusivulle</a>
		</p>
	</article>

<footer>
        Abdulsatar Qaderzada - Php Web Ohjelmointi
</footer>
	
	<script type="text/javascript">

		$(document).on("ready", function() {
			
			// Kun painiketta id="hae" painetaan
			$("#hae").on("click", function() {
				$.ajax({
					url: "HenkilotJSON.php",  // PHP-sivu, jota haetaan AJAX:lla
					method: "get",
					data: {etunimi: $("etunimi").val()},  // Hakukriteeri on nimi, jonka arvona on lomakekentän id="nimi" arvo
					dataType: "json",
					timeout: 5000
				})
				// AJAX haku onnistui
				.done(function(data) {
					// Tyhjennetään elementti, johon vastaus laitetaan
					$("#lista").html("");

					// Käsitellään vastauksena tullut taulukko
					for(var i = 0; i < data.length; i++) {
						// Lisätään attribuutilla id="lista" elementtiin sisältöä
						$("#lista").append("<p>Etunimi: " + data[i].etunimi +
                        "<br>Sukunimi: " + data[i].sukunimi+
                        "<br>Syntymäaika: " + data[i].syntymaAika+
                        "<br>Sähköposti: " + data[i].sahkoposti +
						"<br>Ammatti: " + data[i].ammatti +
                        "<br>Harrastukset: " + data[i].harrastukset +
						"<br>Sukupuoli: " + data[i].sukupuoli + "</p>");
					}
					// Jos vastauksena ei tullut yhtään riviä eli vastaus oli tyhjä taulukko
					if (data.length == 0) {
						$("#lista").append("<p>Haku ei tuottanut yhtään elokuvaa</p>")
					}
				})
				// AJAX haku ei onnistunut
				.fail(function() {
					$("#lista").html("<p>Listausta ei voida tehdä</p>");
				});
				
			});
		});
	</script>

</body>
</html>
