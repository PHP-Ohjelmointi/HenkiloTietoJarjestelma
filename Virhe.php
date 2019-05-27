<?php
session_start();

// Jos istunnossa on leffa
unset ( $_SESSION ["henkilo"] );
?>
<!DOCTYPE html>

<html>
<head>
<meta charset="UTF-8">
<title>Virhe</title>
<meta name="author" content="Jaakko Tuominen">
<meta name="author" content="Sirpa Marttila">
<link rel="stylesheet" type="text/css" href="leffa_arkisto.css">
</head>

<body>

	<header>LEFFA-ARKISTO</header>

	<nav>
		<a href="index.php">Etusivu</a>&nbsp;&nbsp;&nbsp; <a
			href="uusiHenkilo.php">Uusi leffa</a>&nbsp;&nbsp;&nbsp; <a
			href="listaaHenkilot.php">Listaa kaikki leffat</a>
	</nav>

	

	<article>
		<h2>Ongelmia</h2>

<?php
if (isset ( $_GET ["virhe"] )) {
	$virhe = $_GET ["virhe"];
	@$sivu = $_GET ["sivu"];
} else {
	$virhe = "Tuntematon virhe";
	$sivu = "Ei tieto";
}

print ("<p><b>$sivu</b>: $virhe</p>") ;
?>

<p>Siirrytään etusivulle 5 sekunnin kuluttua.</p>
	</article>

	<footer>
		Sirpa Marttila<br> Web-ohjelmointi
	</footer>

</body>
</html>

<?php
header ( "refresh:5; url=index.php?virhe=kylla");
exit;
?>