<?php
    require_once "henkilo.php";

    class henkiloPDO {
       
        private $db;
        private $lkm;

        function __construct($dsn ="mysql:host=localhost;dbname=henkilot" ,
         $user="root", $password="salainen"){
             //Otetaan yhteys tietokantaan
             $this->db = new PDO ($dsn, $user, $password);

             //Mahdollisten virheiden jäljitys kehityksen aikana
             $this->db->setAttribute (PDO:: ATTR_ERRMODE, PDO::ERRMODE_WARNING);

             //MySQL injektion esto
             $this->db->setAttribute (PDO::ATTR_EMULATE_PREPARES, false);

             //Tulosrivien määrä
             $this->lkm =0;
         }

         //Seuraava metodi palauttaa tulosrivien lukumäärän
         function getLkm(){
             return $this->lkm;
         }

         public function kaikkiHenkilot(){
             $sql = "SELECT id, etunimi, sukunimi, syntymaaika, sahkoposti,
              ammatti, harrastukset, sukupuoli FROM henkilo";

              //Valmistellaan sql-lause
               if (! $stmt = $this->db->prepare ( $sql )){
                   $virhe = $this->db->errorInfo();

                   throw new PDOException ( $virhe [2],  $virhe [1] );
               }

               //Ajetaan lauseke
               if (! $stmt-> execute ()){
                   $virhe = $stmt->errorInfo ();

                   throw new PDOException ( $virhe [2], $virhe [1]);
               }

               //Käsitellään hakulausekkeiden tuloksia
               $tulos = array ();

               //Pyydetään haun tuloksia jokainen rivi kerrallaan
               while ($row = $stmt->fetchObject()){
                   $henkilo = new Henkilo();

                   $henkilo->setId ($row->id);
                   $henkilo->setEtunimi (utf8_encode($row->etunimi));
                   $henkilo->setSukunimi(utf8_decode($row->sukunimi));
                   $henkilo->setSyntymaAika($row->syntymaaika);
                   $henkilo->setSahkoposti(utf8_decode($row->sahkoposti));
                   $henkilo->setAmmatti(utf8_decode($row->ammatti));
                   $henkilo->setHarrastukset(utf8_decode($row->harrastukset));
                   $henkilo->setSukupuoli($row->sukupuoli);

                    $tulos [] = $henkilo;
               }
               $this->lkm = $stmt->rowCount ();

               return $tulos;
         }

         public function haeHenkilot($etunimi){
             $sql = "SELECT id, etunimi, sukunimi, syntymaaika, sahkoposti, ammatti, 
             harrastukset, sukupuoli FROM henkilo WHERE etunimi like :etunimi";

             if(! $stmt = $this-> db->prepare ($sql)){
                 $virhe = $this->errorInfo();
                 
                 throw new PDOException ($virhe [2], $virhe [1]);
             }
             //Seuraavaksi sidotaan parametrit
             $ni = "%" . utf8_decode ($etunimi) . "%";
             $stmt->bindValue (":etunimi", $ni,PDP::PARAM_STR);

             //Lausekkeen ajo
             if(! $stmt->execute()){
                 $virhe = $stmt->errorInfo();

                 if ($virhe [0] == "HY093"){
                     $virhe [2] == "Invalid parameter";
                 }
                 throw new PDOException ($virhe [2], $virhe [1]);
             }
             $tulos = array();

             while ($row = $stmt->fetchObject()){
                 $henkilo = new Henkilo ();

                 $henkilo->setId ($row->id);
                 $henkilo->setEtunimi (utf8_encode($row->etunimi));
                 $henkilo->setSukunimi(utf8_decode($row->sukunimi));
                 $henkilo->setSyntymaAika($row->syntymaAika);
                 $henkilo->setSahkoposti(utf8_decode($row->sahkoposti));
                 $henkilo->setAmmatti(utf8_decode($row->ammatti));
                 $henkilo->setHarrastukset(utf8_decode($row->harrastukset));
                 $henkilo->setSukupuoli($row->sukupuoli);

                 $tulos [] = $henkilo;
             }

             $this->lkm = $stmt->rowCount();

             return $tulos;
         }

         function lisaaHenkilo($henkilo){
             $sql = "INSERT INTO henkilo(etunimi, sukunimi, syntymaaika, sahkoposti, ammatti, harrastukset, sukupuoli) 
             VALUES (:etunimi,:sukunimi,:syntymaaika,:sahkoposti,:ammatti,:harrastukset,:sukupuoli)";
            
            if (! $stmt = $this->db->prepare ($sql)){
                $virhe = $this->db->errorInfo ();

                throw new PDOException ($virhe [2], $virhe[1]);
            }

            $stmt->bindValue(":etunimi", utf8_decode($henkilo->getEtunimi() ), PDO::PARAM_STR);
            $stmt->bindVAlue(":sukunimi", utf8_decode($henkilo->getSukunimi()), PDO::PARAM_STR);
            
            $stmt->bindValue(":syntymaaika", ($henkilo->getSyntymaAika() ), PDO::PARAM_STR);
            $stmt->bindVAlue(":sahkoposti", utf8_decode($henkilo->getSahkoposti()),PDO::PARAM_STR);
            
            $stmt->bindValue(":ammatti", utf8_decode($henkilo->getAmmatti() ), PDO::PARAM_STR);
            $stmt->bindVAlue(":harrastukset", utf8_decode($henkilo->getHarrastukset()),PDO::PARAM_STR);
            
            $stmt->bindValue(":sukupuoli",($henkilo->getSukupuoli() ), PDO::PARAM_STR);
   
            $this->db->beginTransaction();

            //Suoritetaan tietokannan insert-lausele 
            if(! $stmt->execute()){
                $virhe= $stmt->errorInfo();

                if($virhe [0] == "HY093"){
                   $virhe [2] = "Invalid parameter";
                }
                $this->db->rollBack();

                throw new PDOException ($virhe [2], $virhe [1]);
            }
            $id = $this-> db->lastInsertId();

            $this ->db->commit();

            return $id;

        }


    }
?>