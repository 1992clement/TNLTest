<?php
namespace App\Service;

use App\Service\Utils;

class EventDataValidator{

  const MANDATORY_EVENT_PROPERTIES = array('id', 'title', 'placeName', 'city', 'startDate', 'endDate', 'startTime');

  /**
  * Checks if data from a json are valid. Throws exception if not.
  * @param stdClass $data
  * @throws \Exception
  * @return boolean
  */
  public function validateJson($data)
  {
    //Check if mandatory properties of an Event are present in Json data.
    if(!$this->checkMandatoryProperties($data))
    {
      throw new \Exception(__FILE__ .' : '. __LINE__ . ' Missing mandatory Property');
    }

    $mandatoryPropertiesToCheck = array(
      'startDate' => Utils::DATE_REGEXP,
      'endDate' => Utils::DATE_REGEXP,
      'startTime' => Utils::TIME_REGEXP
    );

    //Check if mandatory properties have valid format.
    foreach($mandatoryPropertiesToCheck as $propertyName => $regexp)
    {
      if(!preg_match($regexp, $data->$propertyName))
      {
        throw new \Exception(__FILE__ .' : '. __LINE__ . ' Wrong format for ' . $propertyName);
      }
    }

    $optionalPropertiesToCheck = array(
      'eventUrl' => Utils::URL_REGEXP,
      'pictureUrl' => Utils::URL_REGEXP
    );

    //Check if mandatory properties have valid format
    foreach($optionalPropertiesToCheck as $propertyName => $regexp)
    {
      if(!property_exists($data, $propertyName))
      {
        if(!preg_match($regexp, $data->$propertyName))
        {
          throw new \Exception(__FILE__ .' : '. __LINE__ . ' Wrong format for ' . $propertyName);
        }
      }
    }
    return true;
  }

  /**
  * Checks if mandatory properties of an Event are present in Json data.
  * @param stdClass $data
  * @return boolean
  */
  private function checkMandatoryProperties($data)
  {
    foreach(self::MANDATORY_EVENT_PROPERTIES as $mandatoryPropertyName)
    {
      if(!property_exists($data, $mandatoryPropertyName))
      {
        return false;
      }
    }
    return true;
  }
}
