<?php
 require_once "henkilo.php";
   session_start();

    if (isset ($_SESSION["henkilo1"])){
        $henkilo= $_SESSION["henkilo1"];
    }else {
        $henkilo = new Henkilo();
	}
	


	unset ($_SESSION ["henkilo1"]);

    setcookie ("henkilo1",$henkilo->getEtunimi(), time() + 60*60*24*30);
    $aika = date ("d.m.Y", time());
    setcookie ("aika", $aika, time ()+60*60*24*30);
?>

<!DOCTYPE html>

<html>
<head>
<meta charset="UTF-8">
<title>Kaikki henkilöt</title>

<meta name="author" content="Abdulsatar Qaderzada">
<link rel="stylesheet" type="text/css" href="Tyyli.css">
</head>

<body>

	<header>Kaikki henkilöt</header>

	<nav>
		<a href="index.php">Etusivu</a>&nbsp;&nbsp;&nbsp; <a
			href="uusihenkilo.php">Uusi henkilö</a>&nbsp;&nbsp;&nbsp; <a
			href="listaahenkilot.php">Listaa henkilöt</a>&nbsp;&nbsp;&nbsp;
	</nav>



	<article>

		<h2>Uuden henkilön tiedot tallennettu</h2>

<?php
	print ("<p>Id: " . $henkilo->getId ()) ;
	print ("<br>Etunimi: <strong>" . $henkilo->getEtunimi ()) ;
	print ("</strong/><br>Sukunimi: <strong>" . $henkilo->getSukunimi ()) ;
	print ("</strong><br>SyntymaAika: <strong>" . $henkilo->getSyntymaAika ()) ;
	print ("</strong/><br>Sähköposti: <strong>" . $henkilo->getSahkoposti ()) ;
	print ("</strong/><br>Ammatti: <strong>" . $henkilo->getAmmatti () ) ;
    print ("</strong/><br>Harrastukset: <strong>" . $henkilo->getHarrastukset ()) ;
	print ("</strong/><br>Sukupuoli: <strong>" . $henkilo->getSukupuoli ()) . "</strong>";
	
?>

<p>Palataan takaisin 5 sekunnin kuluttua takaisin etusivulle.</p>

	</article>

      <footer>
                Abdulsatar Qaderzada - Php Web Ohjelmointi
        </footer>

</body>
</html>
<?php
	// Ohjataan selain etusivulle 5 sekunnin kuluttua. Laitetaan kyslymerkkijonoon lisatty ja nimi.
	header ( "refresh:5; url=index.php?lisatty=kylla&Etunimi&Sukunimi=" . $henkilo->getEtunimi(). $henkilo->getSukunimi());
	exit;
?>

