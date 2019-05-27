<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Henkilötieto</title>
  <meta name="keywords" content="Henkilo" />
  <meta name="author" content="Abdulsatar Qaderzada">
  <link rel="stylesheet" type="text/css" href="Tyyli.css">
</head>
<body>
    <header>Henkilötieto</header>
    <nav>
        Etusivu &nbsp;&nbsp;&nbsp;<a href="uusihenkilo.php">Uusi henkilö</a>&nbsp;&nbsp;&nbsp;
        <a href="listaahenkilot.php">Listaa kaikki henkilöt</a>&nbsp;&nbsp;&nbsp;
    </nav>

    <article>
        <h2>Tervetuloa käytt&auml;m&auml;&auml;n henkilötieto lomaketta</h2>
        <h2>T&auml;ss&auml; sivustossa voit rekisteröidä omat perustiedot</h2>


     <?php

     if (isset ($GET["lisatty"]) && isset ($GET["etunimi"])){
         print ("<p>Uusi henkilö lisättiin" . $_GET["etunimi"] . ".");
     }
     else if (isset ($_COOKIE["henkilo1"])&& isset($_COOKIE["aika"])){
         print("<p>Äskettäin lisäämäsi henkilö oli " . $_COOKIE["henkilo1"]." " .$_COOKIE["aika"].".</p>");
     }
     ?>
     <h3>JSON Mallit</h3>
<p>
		<a href="ListaaHenkilotJSON.php">Listaa Henkilot (JSON)</a><br>
		<a href="HaeHenkiloJSON.php">Hae Henkilot(JSON)</a>&nbsp;&nbsp;&nbsp;
</p>

   

     </article>
    <footer>
        Abdulsatar Qaderzada - Php Web Ohjelmointi
    </footer>
</body>
</html>
