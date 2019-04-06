<?php
namespace App\Business;

use App\Entity\Event;
use App\Service\Utils;
use App\Service\EventDataValidator;
use Doctrine\Common\Persistence\ObjectManager;
use Psr\Log\LoggerInterface;

class HomeBusinessService{

  private $utilsService;
  private $em;
  private $logger;
  private $validator;

  public function __construct(
    Utils $utilsService,
    ObjectManager $em,
    LoggerInterface $logger,
    EventDataValidator $validator)
  {
    $this->utilsService = $utilsService;
    $this->em = $em;
    $this->logger = $logger;
    $this->validator = $validator;
  }

  /**
  * Handles all business mechanics from HomeController::index() to keep controller lightweight.
  */
  public function handleIndexBusiness()
  {
    // Get json data
    try {
      $data = $this->utilsService->getJsonFromUrl('https://neos.lu/Get-Json.json');
    }
    catch (\Exception $e) {
      throw new \Exception(__FILE__ .' : '. __LINE__ . 'Une erreur est survenue lors de la réception des données json | ' . $e->getMessage());
    }

    // Decode json data
    try {
      $data = json_decode($data);
    }
    catch(\Exception $e)
    {
      throw new \Exception(__FILE__ .' : '. __LINE__ . 'Une erreur est survenue lors du decodage du json recupere | ' . $e->getMessage());
    }

    foreach($data as $jsonEvent)
    {
      // Validate data from json: mandatory fields, and urls and date formats.
      // Could be done directly in entity class with annotations, but done here to have something to catch for the sake of the test.
      // Catched in controller
      $this->validator->validateJson($jsonEvent);

      // Init Event and persist
      try {
        $event = new Event();
        $event->initEntityFromJson($jsonEvent);
        $this->em->persist($event);
      }
      catch(DBALException $e){
          throw new \Exception(__FILE__ .' : '. __LINE__ . ' Une erreur est survenue lors de la persistence de l\'entity Event
                                | Object_id : ' . $jsonEvent->id . ' | Erreur : ' . $e->getMessage());
      }
      catch(\Exception $e)
      {
        throw new \Exception(__FILE__ .' : '. __LINE__ . ' Une erreur est survenue lors de l\'initialisation de l\'entity Event
                              | Object_id : ' . $jsonEvent->id . ' | Erreur : ' . $e->getMessage());
      }
    }

    // Insert data in DB
    try {
      $this->em->flush();
    }
    catch (\Exception $e)
    {
      throw new \Exception(__FILE__ .' : '. __LINE__ . ' Une erreur est survenue lors de l\'insertion des donnees en BDD | ' . $e->getMessage());
    }

  }
}
