<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class WeatherController extends AbstractController
{
    /**
     * @return Response
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     * @Route("/", name="weather")
     */
    public function index(): Response
    {
        // Obtenir la météo sur 5 jours, toutes les 2 heures
        $client = HttpClient::create();
        $response = $client->request(
            'GET',
            "https://api.openweathermap.org/data/2.5/forecast?id=" .
            $_ENV['CITY_ID'] .
            "&appid=" .
            $_ENV['API_KEY']
        );

        // Récupération des deux tableaux, intégralités des informations liées au climat et toutes les villes.
        $content = $response->toArray();
        $weatherCity = $content['city'];
        $weatherData = $content['list'];

        // Récupération d'un tableau de mesures principales et encode en JSON vers fichier base.
        $weatherGlobal = [];

        foreach ($weatherData as $data) {
            $weatherGlobal[] = $data['main'];
        }
        $weatherGlobal = Json_encode($weatherGlobal);

        return $this->render('weather/index.html.twig', [
            'weatherCity' => $weatherCity,
            'weatherGlobal' => $weatherGlobal
        ]);
    }
}
