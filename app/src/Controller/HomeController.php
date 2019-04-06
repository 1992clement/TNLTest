<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use App\Business\HomeBusinessService;
use Psr\Log\LoggerInterface;

class HomeController extends AbstractController{
  /**
  * Récupération des données json depuis l'url, validation, puis insertion en BDD.
  * @Route("/", name="home")
  */
  public function index(HomeBusinessService $businessService, LoggerInterface $logger){

    try {
      $businessService->handleIndexBusiness();

      return new Response($this->render('base.html.twig'));
    }
    catch(\Exception $e)
    {
      $logger->error("Erreur : " . $e->getMessage());
      return new Response("Une erreur est survenue.");
    }
  }
}
