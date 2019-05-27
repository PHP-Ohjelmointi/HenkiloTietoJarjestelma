<!DOCTYPE html>
 
<html>
<head>
<meta charset="UTF-8">
<title>Kaikki leffat</title>
<meta name="keywords" content="Henkilo" />
<meta name="author" content="Abdulsatar Qaderzada">
<link rel="stylesheet" type="text/css" href="Tyyli.css">

<!-- Käytä uusinta, näet sen osoitteesta http://code.jquery.com -->
<script
<script
  src="http://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous"></script>
</head>

<body>
	<header>Henkilölista JSON:lla</header>

	<nav></nav>

	<article>
		<h2>Kaikki Henkilöt</h2>

		<div id="lista"></div>
		<p>
			<a href="index.php">Etusivulle</a>
		</p>

	</article>

	<footer>
        Abdulsatar Qaderzada - Php Web Ohjelmointi
    </footer>
	
	<script type="text/javascript">

		$(document).on("ready", function() {
		
			$.ajax({
                url: "HenkilotJSON.php",  // PHP-sivu, jota haetaan AJAX:lla
                method: "get",
				dataType: "json",
                timeout: 5000
            })
			.done(function(data) {
				// Tyhjennetään elementti, johon vastaus laitetaan (id="lista")
				$("#lista").html("");

				// Käsitellään taulukko, 
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
            })
			.fail(function() {
 			    $("#lista").html("<p>Listausta ei voida tehdä</p>");
			});
			
		});
	</script>
</body>
</html>
