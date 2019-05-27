<!DOCTYPE html>

<html>
<head>
<meta charset="UTF-8">
<title>Kaikki henkilöt</title>
<meta name="keywords" content="Henkilo" />
<meta name="author" content="Abdulsatar Qaderzada">
<link rel="stylesheet" type="text/css" href="Tyyli.css">
</head>

<body>
    <header>Henkilöt</header>
    <nav>
        <a href="index.php">Etusivu</a>&nbsp;&nbsp;&nbsp; <a
            href="uusihenkilo.php">Uusi henkilö</a>&nbsp;&nbsp;&nbsp; Listaa
        henkilöt&nbsp;&nbsp;&nbsp;
    </nav>
<article>
        <h2>Kaikki henkilöt</h2>
 </article>
<?php
try {
    require_once "henkiloPDO.php";

    $kantakasittely = new henkiloPDO ();
    $rivit = $kantakasittely->kaikkiHenkilot ();

    foreach ( $rivit as $henkilo ) {
        
		print ("Etunimi:<p> " . $henkilo->getEtunimi ());
        print ("</p>Sukunimi:<p> " . $henkilo->getSukunimi ());
        print ("</p>Syntymaaika:<p> " . $henkilo->getSyntymaAika ());
        print ("</p>Sähköposti:<p> " . $henkilo->getSahkoposti ()) ;
        print ("</p>Ammatti:<p> " . $henkilo->getAmmatti ()) ;
        print ("</p>Harrastukset:<p> " . $henkilo->getHarrastukset ()) ;
        print ("</p>Sukupuoli:<p> " . $henkilo->getSukupuoli() . "</p><br>") ;
      }
      
} catch (Exception $error) {
    header ("location: virhe.php?sivu=Listaus&virhe=" . $error ->getMessage());
    exit();
}
?>

     <footer>
        Abdulsatar Qaderzada - Php Web Ohjelmointi
    </footer>
</body>
</html>
