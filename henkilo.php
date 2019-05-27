<?php

class henkilo{

    private static $virhelista = array(
        - 1 => "Virheellinen tieto",
			0 => "",
			11 => "Etunimi on pakollinen",
			12 => "Etunimi on liian lyhyt!",
			13 => "Etunimi liian pitkä!",
			21 => "Sukunimi on pakollinen",
			22 => "Sukunimi on liian lyhyt!",
			23 => "Sukunimi liian pitkä!",
			24 => "Syntymäaika ei kelvollinen",
			31 => "Syntymäaika on pakollinen",
			32 => "Syntymäaika liian lyhyt!",
			33 => "Syntymäaika liian pitkä!",
			34 => "Sähköposti on pakollinen",
			41 => "Sähköposti on liian lyhyt!",
			42 => "Sähköposti liian pitkä!",
			43 => "Sähköpostimuoto on virheellinen",
			44 => "Ammatti on pakollinen",
			51 => "Ammatti on liian lyhyt",
			52 => "Ammatti liian pitkä!",
			53 => "Harrastuksen ilmoitus liian pitkä!",
			54 => "Harrastuksen ilmoitus liian lyhyt!" ,
            55 => "Ilmoituksessa saa olla vain kirjaimia, välilyöntejä sekä erikoismerkkejä",
			56 => "Sukupuolen ilmoittaminen on pakollista"
	);


    //Attribuutit
    private $etunimi;
    private $sukunimi;
    private $syntymaAika;
    private $sahkoposti;
    private $ammatti;
    private $harrastukset;
    private $sukupuoli;
    private $id;

    //Konstruktorit
    function __construct($etunimi = "", $sukunimi = "", $syntymaAika = "", $sahkoposti = "",
    $ammatti = "",$harrastukset=" ",$sukupuoli=" ", $id = 0)   {
      $this->etunimi = trim ($etunimi);
      $this->sukunimi = trim ($sukunimi);
      $this->syntymaAika = trim ($syntymaAika);
      $this->sahkoposti = trim ($sahkoposti);
      $this->ammatti = trim ($ammatti);
      $this->harrastukset = trim ($harrastukset);
      $this->sukupuoli = trim ($sukupuoli);
      $this->id = $id;
      }

      //Metodit
    public function setEtunimi($etunimi){
        $Onimi = trim ( $etunimi );
		$Onimi = mb_convert_case ( $Onimi, MB_CASE_LOWER, "UTF-8" );
		$Onimi = mb_convert_case ( $Onimi, MB_CASE_TITLE, "UTF-8" );
          $this->etunimi = trim ($etunimi);
      }
    public function getEtunimi(){
          return $this->etunimi;
      }
    //Tässä määritellään syöttökentän merkkien pituus min ja max merkkejä
    public function checkEtunimi($required = true, $min=2, $max=50){
          if ($required == false && strlen ($this->etunimi)==0){
              return 0;
          }
          if ($required ==true && strlen($this->etunimi)==0){
              return 11;
          }
          if (strlen ($this->etunimi) < $min){
             return 12;
          }
          if(strlen ($this->etunimi) > $max){
            return 13;
          }
           return 0;

            }

    public function setSukunimi($sukunimi){
        $Onimi = trim ( $sukunimi );
		$Onimi = mb_convert_case ( $Onimi, MB_CASE_LOWER, "UTF-8" );
		$Onimi = mb_convert_case ( $Onimi, MB_CASE_TITLE, "UTF-8" );
                $this->sukunimi = trim($sukunimi);
            }
    public function getSukunimi(){
        return $this ->sukunimi;
            }
    public function checkSukunimi($required = true, $min=2, $max=50){
          if ($required == false && strlen ($this->sukunimi)==0){
              return 0;
            }
            if ($required ==true && strlen($this->sukunimi)==0){
              return 21;;
            }
             if (strlen ($this->sukunimi) < $min){
            return 22;;
            }
            if(strlen ($this->sukunimi) > $max){
            return 23;;
            }
            return 0;
        }

    public function setSyntymaAika($syntymaAika){
        $this->syntymaAika = trim($syntymaAika);
    }
    public function getSyntymaAika(){
        return $this ->syntymaAika;
    }

    public function checkSyntymaAika($required = true, $min=2, $max=50){
            if (strlen ($this->syntymaAika) < $min){
           return 32;
            }
            if(strlen ($this->syntymaAika) > $max){
           return 33;
            }
             return 0;
            }

     public function setSahkoposti($sahkoposti){
        $this->sahkoposti = trim($sahkoposti);
    }
    public function getSahkoposti(){
        return $this ->sahkoposti;
            }
    public function checkSahkoposti($required = true, $min=2, $max=50){
          if ($required == false && strlen ($this->sahkoposti)==0){
              return 0;
            }
            if ($required ==true && strlen($this->sahkoposti)==0){
              return 34;
            }
             if (strlen ($this->sahkoposti) < $min){
           return 41;
            }
            if(strlen ($this->sahkoposti) > $max){
            return 42;
            }
            return 0;
             }

    public function setAmmatti($ammatti){
        $Onimi = trim ( $ammatti );
          $this->ammatti = trim ($ammatti);
      }
    public function getAmmatti(){
          return $this->ammatti;
      }
    //Tässä määritellään syöttökentän merkkien pituus min ja max merkkejä
    public function checkAmmatti($required = true, $min=2, $max=25){
          if ($required == false && strlen ($this->ammatti)==0){
              return 0;
          }
          if ($required ==true && strlen($this->ammatti)==0){
              return 44;
          }
          if (strlen ($this->ammatti) < $min){
              return 51;
          }
          if(strlen ($this->ammatti) > $max){
           return 52;
          }
           return 0;

            }


       public function setHarrastukset($harrastukset){
        $Onimi = trim ( $harrastukset );
          $this->harrastukset = trim ($harrastukset);
      }
    public function getHarrastukset(){
          return $this->harrastukset;
      }
    //Tässä määritellään syöttökentän merkkien pituus min ja max merkkejä
    public function checkHarrastukset($required = true, $min=10, $max=300){
          if ($required == false && strlen ($this->harrastukset)==0){
             return 0;
          }
          if(strlen ($this->harrastukset) > $max){
          return 53;
          }
          if (strlen ($this->harrastukset) < $min){
             return 54;
          }
          if (preg_match ( "/^[a-zöåä0-9\-.,!?]$/i", $this->harrastukset )) {
			return 55;
		  }
           return 0;
          }
     public function setSukupuoli($sukupuoli){
        $Onimi = trim ( $sukupuoli );
          $this->sukupuoli = trim ($sukupuoli);
      }
    public function getSukupuoli(){
          return $this->sukupuoli;
      }

    public function checkSukupuoli(){

          if ($required == false && strlen ($this->sukupuoli)==0){
              return 0;
          }
          if ($required ==true && strlen($this->sukupuoli)==0){
             return 56;
          }

           return 0;

            }
    public function setId($id) {
		$this->id = $id;
	}

	public function getId() {
		return $this->id;
	}

     // Metodilla näytetään virhekoodia vastaava teksti
	public static function getError($virhekoodi) {
		if (isset ( self::$virhelista [$virhekoodi] ))
			return self::$virhelista [$virhekoodi];

		return self::$virhelista [- 1];
	}
}
?>