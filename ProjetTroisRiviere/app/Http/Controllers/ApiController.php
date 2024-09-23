<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    public function getData(int $neq)
    {
        $sql = 'SELECT * FROM "32f6ec46-85fd-45e9-945b-965d9235840a" WHERE "NEQ" = \'' . $neq . '\'';
        
        try{
            $response = Http::withoutVerifying()->get(env('API_BASE_URL'), [
                'sql' => $sql,
            ]);

            if ($response->successful()) {
                
                $data = $response->json();
                $nbrCategorie = isset($data['result']['records']) ? count($data['result']['records']) : 0;

                return response()->json($data);
            } else {
                return response()->json([
                    'error' => 'Erreur lors de la requête API',
                    'status' => $response->status(),
                    'message' => $response->body()
                ], $response->status());
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Une exception est survenue lors de la requête API',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
