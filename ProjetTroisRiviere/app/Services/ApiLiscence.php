<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class ApiLiscence{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = 'https://donneesquebec.ca/recherche/api/action/datastore_search_sql?sql=';
    }

    public function getData($laRequete)
    {
        $reponse = Http::get("{$this->baseUrl}/{$laRequete}");

        if ($response->successful()) {
            $listeLiscence = $response->json();
        }

        throw new \Exception("Error fetching data from API");

        return view('liscenceView', ['listeLiscence' => $listeLiscence]);
    }
}
?>