<?php
    try{
        require_once"HenkiloPDO.php";
        $kantakasittely = new henkiloPDO();

        if(isset($_get["etunimi"])){
            $tulos = $kantakasittely->haeHenkilot ($_get ["etunimi"]);

            print (json_encode ($tulos));
        }

        else {
            $tulos = $kantakasittely->kaikkiHenkilot();

            print json_encode($tulos);
        }
    }catch (Exception $error){
        
    }
?>