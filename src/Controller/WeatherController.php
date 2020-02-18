<?php

namespace App\Controller;

use phpDocumentor\Reflection\Types\String_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncode;

class WeatherController extends AbstractController
{
    /**
     * @Route("/", name="weather", methods={"GET"})
     */
    public function index(): Response
    {
        // Obtenir la météo sur 5 jours, toutes les 2 heures
        $client = HttpClient::create();
        $response = $client->request(
            'GET',
            "https://api.openweathermap.org/data/2.5/forecast?id=" .
            $_ENV['CITY_TOURS_ID'] .
            "&appid=" .
            $_ENV['API_KEY']
        );

        // Récupération des deux tableaux, intégralités des informations liées au climat et toutes les villes.
        $content = $response->toArray();
        $weatherCity = $content['city'];
        $weatherDatas = $content['list'];

        // Récupération d'un tableau de mesures principales et encode en JSON vers fichier base.
        $weatherGlobal = [];

        foreach ($weatherDatas as $key => $weatherData)
        {
            array_push($weatherGlobal, $weatherData['main']);
        }
        $weatherGlobal = Json_encode($weatherGlobal);

        return $this->render('weather/index.html.twig', [
            'weatherCity' => $weatherCity,
            'weatherGlobal' => $weatherGlobal
        ]);
    }
}
