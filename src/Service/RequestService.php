<?php
//
//namespace App\Service;
//
//use http\Env\Response;
//use Symfony\Component\HttpClient\HttpClient;
//
//class RequestService
//{
//    public function RequestData(): Response
//    {
//        // Obtenir la météo sur 5 jours, toutes les 2 heures
//        $client = HttpClient::create();
//        $response = $client->request(
//            'GET',
//            "https://api.openweathermap.org/data/2.5/forecast?id=" .
//            $_ENV['CITY_TOURS_ID'] .
//            "&appid=" .
//            $_ENV['API_KEY']
//        );
//
//        // Récupération des deux tableaux, intégralités des informations liées au climat et toutes les villes.
//        $content = $response->toArray();
//        $weatherCity = $content['city'];
//        $weatherDatas = $content['list'];
//
//        // Récupération d'un tableau de mesures principales et encode en JSON vers fichier base.
//        $weatherGlobal = [];
//
//        foreach ($weatherDatas as $key => $weatherData)
//        {
//            array_push($weatherGlobal, $weatherData['main']);
//        }
//        $weatherGlobal = Json_encode($weatherGlobal);
//    }
//}
