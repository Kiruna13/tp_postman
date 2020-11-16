<?php


namespace App;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class Httpclient
{
    /*
     * Requête http qui prend en parametre les valeurs du formulaire.
     */
    public function UseRequest($client,$method,$url,$token)
    {
        $response = $client->request($method, $url, [
            'headers' => [
                'token' => $token,
            ],
        ]);

        return $response;
    }
}