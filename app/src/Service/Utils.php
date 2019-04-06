<?php

namespace App\Service;

use Psr\Log\LoggerInterface;

class Utils {

  //regexp vérifiant une string de format dd-mm-yyyy
  const DATE_REGEXP = "#^[0123][0-9]-[0123][0-9]-[0-9]{4}$#";

  //regexp vérifiant une string de format hh:mm:ss
  const TIME_REGEXP = "#^[012][0-9]:[0-5][0-9]:[0-9]{2}$#";

  //regexp vérifiant la plupart des formats d'url http et https.
  const URL_REGEXP = "#(https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|www\.[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9]+\.[^\s]{2,}|www\.[a-zA-Z0-9]+\.[^\s]{2,})
#";

  private $logger;

  public function __construct(LoggerInterface $logger)
  {
    $this->logger = $logger;
  }

  /**
  * Récupère le json depis une url distante en utilisant curl.
  * @param string $json_url
  * @return string $rawdata
  */
  public function getJsonFromUrl(string $json_url) : string
  {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $json_url);
    $this->logger->info('Utils service : getJsonFromUrl() : start retrieving data...');
    $rawdata = curl_exec($ch);
    curl_close($ch);
    $this->logger->info('Utils service : getJsonFromUrl() : finished retrieving data');

    return $rawdata;
  }


}
