<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CurlsiteController extends Controller
{
    /**
     * Using Http
     *
     * @return response()
     */
    public function index()
    {
        $apiURL = 'https://api.ipify.org?format=json';
  
        $response = Http::get($apiURL);
  
        $statusCode = $response->status();
        $responseBody = json_decode($response->getBody(), true);
  
        dd($responseBody);
    }

    /**
     * Using GuzzleHttp
     *
     * @return response()
     */
    public function posts($id = 1)
    {
        $apiURL = 'https://api.onlinewebtutorblog.com/employees/'.$id;
              
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', $apiURL);
   
        $statusCode = $response->getStatusCode();
        $responseBody = json_decode($response->getBody(), true);
  
        dd($responseBody);
    }

    /**
     * Using GuzzleHttp
     *
     * @return response()
     */
    public function addposts($id = 1)
    {
        //api
        $apiURL = 'https://api.onlinewebtutorblog.com/employees';

        // POST Data
        $postInput = [
            "username" => "doraemon",
            "name" => "Dorarmon",
            "email" => "doraemon@universe.com",
            "gender" => "Male Cat",
            "designation" => "Future Robot with Great functionality",
            "phone_number" => "1234567890",
            "complete_address" => "Japan"
        ];

        // Headers
        $headers = [];

        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', $apiURL, ['form_params' => $postInput, 'headers' => $headers]);

        $responseBody = json_decode($response->getBody(), true);

        echo "Status code: " . $response->getStatusCode(); // status code

        dd($responseBody);
    }
}