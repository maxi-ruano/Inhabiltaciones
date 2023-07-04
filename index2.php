
<?php



/* 8426307 -> LE ,
   3398796 -> LC ,



*/




 function get_token(){

    $curl = curl_init();
    $params = "username=WSINHABILITACIONESLIC&password=TEST1234";

    curl_setopt_array($curl, array(
             CURLOPT_URL => 'https://tcaba2-pre.dgai.com.ar/ws-inhabilitaciones-rest/auth/getToken?'.$params,
             CURLOPT_RETURNTRANSFER => true,
             CURLOPT_ENCODING => '',
             CURLOPT_MAXREDIRS => 10,
             CURLOPT_TIMEOUT => 0,
             CURLOPT_HEADER => true,
             CURLINFO_HEADER_OUT => true,
             CURLOPT_FOLLOWLOCATION => true,
             CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
             CURLOPT_CUSTOMREQUEST => 'POST',
            
             CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Accept: */*'
             ),
   ));

   $response = curl_exec($curl);



   curl_close($curl);

   $clean = trim($response);

 
   $clippedResponse=substr($clean,232 , -154);




   return $clippedResponse;

   }

   function get_inhabilitacion($token){
      
   $DNI= 'DNI';
   $LE = 'LE';
   $LC='LC';
   $numDoc =  34905183;
   
   
$query = '
{
 "numeroDocumento": '.$numDoc.',
   "tipoDocumento": " '.$DNI.'"
 }';


    $curl = curl_init();

    curl_setopt_array($curl, array(
             CURLOPT_URL => 'https://tcaba2-pre.dgai.com.ar/ws-inhabilitaciones-rest/scoringPersona',
             CURLOPT_RETURNTRANSFER => true,
             CURLOPT_ENCODING => '',
             CURLOPT_MAXREDIRS => 10,
             CURLOPT_TIMEOUT => 0,
             CURLOPT_FOLLOWLOCATION => true,
             CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
             CURLOPT_CUSTOMREQUEST => 'POST',
             CURLOPT_POSTFIELDS => $query,
             CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer '.$token,
             ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);

    
    $array = json_decode($response,TRUE);

    return $array;

   
    
   }



    $token = get_token();



   


     $res = get_inhabilitacion($token);





var_dump($res["persona"][0]);


foreach($res['persona'] as $persona) {

  
 if($persona["inhabilitado"] == "SI") {

   echo "Persona inhabilitada ";

 } else if ($persona["inhabilitado"] == "NO"){

   echo "Persona no esta inhabilitada ";

 } 





 }





















?>
