<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    public function getData(int $neq)
    {
        $sql = urlencode("SELECT * FROM \"32f6ec46-85fd-45e9-945b-965d9235840a\" WHERE \"NEQ\" = '$neq'");
        
        $response = Http::get(env('API_BASE_URL'), [
            'sql' => $sql,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            return response()->json($data);
        } else {
            return abort($response->status(), 'Erreur lors de la requête API');
        }
    }
}
