<?php
 require_once "henkilo.php";

	session_start ();

  if (isset ( $_POST ["talleta"]))
  {
  
    $henkilo = new Henkilo ( $_POST ["etunimi"], $_POST ["sukunimi"], $_POST ["syntymaAika"],$_POST ["sahkoposti"], $_POST ["ammatti"], $_POST ["harrastukset"], $_POST["sukupuoli"]);
    
    

    $_SESSION["henkilo1"] = $henkilo;


	$etunimiVirhe = $henkilo->checkEtunimi ();
    $sukunimiVirhe = $henkilo->checkSukunimi ();
	$syntymaAikaVirhe = $henkilo->checkSyntymaAika ();
	$sahkopostiVirhe = $henkilo->checkSahkoposti ();
	$ammattiVirhe = $henkilo->checkAmmatti ();
    $harrastuksetVirhe = $henkilo->checkHarrastukset (false);
	$sukupuoliVirhe = $henkilo->checkSukupuoli ();


    if ($etunimiVirhe == 0 && $sukunimiVirhe == 0 && $syntymaAikaVirhe == 0 && $sahkopostiVirhe == 0
     && $ammattiVirhe == 0 && $harrastuksetVirhe == 0 && $sukupuoliVirhe == 0) {

        try {
			require_once "henkiloPDO.php";
			
			$kantakasittely = new henkiloPDO ();
			
			$id = $kantakasittely->lisaaHenkilo ( $henkilo );
			
			// Muutetaan istunnossa olevan olion id lisäykseltä saaduksi id:ksi
			$_SESSION ["henkilo1"]->setId ( $id );
		}catch ( Exception $error ) {
			session_write_close ();
			header ( "location: virhe.php?sivu=" . urlencode ( "Lisäys" ) . "&virhe=" . $error->getMessage () );
			exit ();
        }

		session_write_close ();
		header ( "location: naytaHenkilot.php" );
		exit ();
	}
}
  
	else if (isset ( $_POST ["peruuta"])){

	// Jos poistetaan vain lomake istunnosta
	unset ( $_SESSION ["henkilo1"] );
	}

	else {
		if (isset ( $_SESSION ["henkilo1"])){
        $henkilo = $_SESSION ["henkilo1"];



    $etunimiVirhe = $henkilo->checkEtunimi ();
    $sukunimiVirhe = $henkilo->checkSukunimi ();
	$syntymaAikaVirhe = $henkilo->checkSyntymaAika ();
	$sahkopostiVirhe = $henkilo->checkSahkoposti ();
	$ammattiVirhe = $henkilo->checkAmmatti ();
    $harrastuksetVirhe = $henkilo->checkHarrastukset (false);
	$sukupuoliVirhe = $henkilo->checkSukupuoli ();
    }

    else {
        $henkilo = new Henkilo ();

       $etunimiVirhe = 0;
	   $sukunimiVirhe = 0;
	   $syntymaAikaVirhe = 0;
	   $sahkopostiVirhe = 0;
	   $ammattiVirhe = 0;
       $harrastuksetVirhe = 0;
	   $sukupuoliVirhe = 0;
    }
}
?>
<!DOCTYPE html>
<html>
 <head>
 <meta charset="UTF-8">
 <title>Uusi henkilo</title>
<meta name="author" content="Abdulsatar Qaderzada">
<link rel="stylesheet" type="text/css" href="Tyyli.css">
</head>
<body>
        <header>Henkilötieto Rekisteri</header>
<nav>
		<a href="index.php">Etusivu</a>&nbsp;&nbsp;&nbsp; Uusi
		henkilo&nbsp;&nbsp;&nbsp; <a href="listaaHenkilot.php">Listaa henkilöt</a>&nbsp;&nbsp;&nbsp;
</nav>
<article>
     <h2>Uusi Henkilö</h2>
		<form action="uusihenkilo.php" method="post">

    <p>
	    <label>Etunimi</label> <input type="text" name="etunimi" size="30"
		value="<?php print(htmlentities($henkilo->getEtunimi(), ENT_QUOTES, "UTF-8"));?>">
    <?php
    print ("<span class='pun'>" . $henkilo->getError ( $etunimiVirhe ) . "</span>") ;
    ?>
    </p>

    <p>
	    <label>Sukunimi</label> <input type="text" name="sukunimi" size="30"
		value="<?php print(htmlentities($henkilo->getSukunimi(), ENT_QUOTES, "UTF-8"));?>">
    <?php
    print ("<span class='pun'>" . $henkilo->getError ( $sukunimiVirhe ) . "</span>") ;
    ?>
    </p>

    <p>
	    <label>Syntymäaika</label> <input type="text" name="syntymaAika" size="30"
		value="<?php print(htmlentities($henkilo->getSyntymaAika(), ENT_QUOTES, "UTF-8"));?>">
    <?php
    print ("<span class='pun'>" . $henkilo->getError ( $syntymaAikaVirhe ) . "</span>") ;
    ?>
    </p>

    <p>
	    <label>Sähköposti</label> <input type="text" name="sahkoposti" size="30"
		value="<?php print(htmlentities($henkilo->getSahkoposti(), ENT_QUOTES, "UTF-8"));?>">
    <?php
    print ("<span class='pun'>" . $henkilo->getError ( $sahkopostiVirhe ) . "</span>") ;
    ?>
    </p>

    <p>
	    <label>Ammatti</label> <input type="text" name="ammatti" size="30"
		value="<?php print(htmlentities($henkilo->getAmmatti(), ENT_QUOTES, "UTF-8"));?>">
    <?php
    print ("<span class='pun'>" . $henkilo->getError ( $ammattiVirhe ) . "</span>") ;
    ?>
    </p>

     <p>
	    <label>Harrastukset</label> <textarea rows="5" cols="40" name="harrastukset"><?php print(htmlentities($henkilo->getHarrastukset(), ENT_QUOTES, "UTF-8"));?></textarea>
    <?php
    print ("<span class='pun'>" . $henkilo->getError ( $harrastuksetVirhe ) . "</span>") ;
    ?>
    </p>

     <p>
	    <label>Sukupuoli</label>
        <input type="radio" name="sukupuoli" value="Mies">Mies
        <input type="radio" name="sukupuoli" value="Nainen">Nainen
    <?php
    print ("<span class='pun'>" . $henkilo->getError (  $sukupuoliVirhe ) . "</span>") ;
    ?>
    </p>
        
              
                <label>&nbsp;&nbsp;</label>
                
                <input type="submit" name="talleta" value="Tallenna" >
            
                <input type="submit" name="peruuta" value="Peruuta" >
             
		
            
    </form>
</article>

    <footer>
		Abdulsatar Qaderzada - Php Web Ohjelmointi
	</footer>
</body>
</html>