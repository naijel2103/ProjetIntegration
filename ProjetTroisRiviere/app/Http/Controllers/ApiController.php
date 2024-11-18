<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Fournisseurs;

class ApiController extends Controller
{
    public function getUser(int $neq)
    {
        $sql = 'SELECT * FROM "19385b4e-5503-4330-9e59-f998f5918363" WHERE "NEQ" = \'' . $neq . '\'';
    
        try {
            $response = Http::withoutVerifying()->get(env('API_BASE_URL'), [
                'sql' => $sql,
            ]);
    
            if ($response->successful()) {
                $data = $response->json();
                if (isset($data['result']['records']) && count($data['result']['records']) > 0) {
                    // Extraction de la valeur "Nom de l'intervenant"
                    $nomFournisseur = $data['result']['records'][0]['Nom de l\'intervenant'] ?? null;
                    
                    return response()->json([
                        'nomFournisseur' => $nomFournisseur,
                        'result' => $data['result']
                    ]);
                }
                return response()->json(['error' => 'Aucun enregistrement trouvé.'], 404);
            }
    
            return response()->json([
                'error' => 'Erreur lors de la requête API',
                'status' => $response->status(),
                'message' => $response->body()
            ], $response->status());
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Une exception est survenue lors de la requête API',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    
    
    

    public function getData(int $neq)
    {
        $sql = 'SELECT * FROM /*"19385b4e-5503-4330-9e59-f998f5918363"*/ "32f6ec46-85fd-45e9-945b-965d9235840a"­ WHERE "NEQ" = \'' . $neq . '\'';
        
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
    public function getRegion()
    {
        $sqlGetListeRegion = 'SELECT regadm FROM "19385b4e-5503-4330-9e59-f998f5918363"';
        $ListeRegion=[];
            
        try{
                $response = Http::withoutVerifying()->get(env('API_BASE_URL'), [
                    'sql' => $sqlGetListeRegion,
                ]);

                if ($response->successful()) {
                    
                    $data = json_decode($response->body(), true);

                    if (json_last_error() !== JSON_ERROR_NONE) {
                        echo "Erreur de décodage JSON : " . json_last_error_msg();
                        return;
                    }

                    if (isset($data['result']) && isset($data['result']['records'])) {
                        $records = $data['result']['records'];
                    } else {
                        echo "Erreur : Les enregistrements ne sont pas disponibles.";
                        return;
                    }

                    foreach($records as $element){
                        if (isset($element['regadm'])) {
                            $regions = $element['regadm'];

                            if (preg_match('/(.+)\s\((\d+)\)/', $regions, $matches)) {
                                $nomRegion = trim($matches[1]);
                                $codeRegion = $matches[2];

                            }

                            if (!isset($ListeRegion[$codeRegion])) {
                                $ListeRegion[$codeRegion] = $nomRegion;
                            }
                        }
                    }
                    
                } else {
                    return response()->json([
                        'error' => 'Erreur lors de la requête API',
                        'status' => $response->status(),
                        'message' => $response->body()
                    ], $response->status());
                }

        return $ListeRegion;

        } catch (\Exception $e) {
                return response()->json([
                    'error' => 'Une exception est survenue lors de la requête API des regions',
                    'message' => $e->getMessage(),
                ], 500);
        } 
    }

    public function getVille()
    {
        $sqlGetListeVille = 'SELECT munnom, regadm FROM "19385b4e-5503-4330-9e59-f998f5918363"';
        $ListeVille=[];

        try{
                $response = Http::withoutVerifying()->get(env('API_BASE_URL'), [
                    'sql' => $sqlGetListeVille,
                ]);

                if ($response->successful()) {
                    
                    $data = json_decode($response, true);

                    if (json_last_error() !== JSON_ERROR_NONE) {
                        echo "Erreur de décodage JSON : " . json_last_error_msg();
                        return;
                    }

                    if (isset($data['result']) && isset($data['result']['records'])) {
                        $records = $data['result']['records'];
                    } else {
                        echo "Erreur : Les enregistrements ne sont pas disponibles.";
                        return;
                    }

                    foreach($records as $villes){
                        $nomVille = '';
                        $codeRegion = ''; 

                        foreach ($villes as $cle => $valeur) {
                            if($cle === 'munnom'){
                                $nomVille = $valeur;
                            } elseif ($cle === 'regadm'){
                                if (preg_match('/(.+)\s\((\d+)\)/', $valeur, $matches)) {
                                    $codeRegion = $matches[2];
                                }
                            }
                        }

                        $ListeVille[] = [
                            'nomVille' => $nomVille,
                            'region' => $codeRegion
                        ];
                    }
                    
                } else {
                    return response()->json([
                        'error' => 'Erreur lors de la requête API',
                        'status' => $response->status(),
                        'message' => $response->body()
                    ], $response->status());
                }

        return $ListeVille;

        } catch (\Exception $e) {
                return response()->json([
                    'error' => 'Une exception est survenue lors de la requête API des villes',
                    'message' => $e->getMessage(),
                ], 500);
        }
    }
}
