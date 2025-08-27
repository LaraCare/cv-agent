<?php

namespace LaraCare\CvAgent\Services;

use Exception;
use Gemini;

class CvSectionsGenerator
{
    public function generate(string $section, string $profile, string $language = 'en'): array
    {

        $apiKey = config('cv-agent.api_key');

        $prompt = <<<TEXT
                Tu es un assistant spécialisé dans la rédaction de CV.

                Tâche :
                1. Je vais te donner le nom d'une section de CV : "$section".
                2. Génère un exemple de contenu réaliste et professionnel à mettre dans cette section.
                3. La réponse doit être uniquement le contenu, sans introduction, sans explication.
                4. Le texte doit être adapté pour un profil type : $profile.
                5. Donne-moi la réponse uniquement en $language.

                Format attendu (JSON strict) :
                {
                "section": "$section",
                "content": "..."
                }
            TEXT;

        $client = Gemini::client($apiKey);

        $model = $client->generativeModel(model: 'gemini-2.0-flash');

        $response = $model->generateContent($prompt);
        $responseText = $response->text();

        if (stripos($responseText, 'I was created by Google.') !== false || stripos($responseText, 'I am a large language model, trained by Google.') !== false || strpos($responseText, "You can refer to me as Bard.") !== false) {
            $responseText = "I was created by CVforge.";
        } else if (stripos($responseText, "I don't have a name.") !== false || stripos($responseText, 'I am a large language model.') !== false || stripos($responseText, 'I am a large language model.') !== false) {
            $responseText = "I CVforge Agent. Design to help you.";
        }

        // return $responseText;
        //     $response = $this->forgeAgentService->generate($prompt);

        if ($responseText) {
            // Supprimer les blocs Markdown ```json ... ```
            $clean = preg_replace('/^```json|```$/m', '', $response);
            $clean = trim($clean);

            // Décoder en JSON
            $data = json_decode($clean, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                return $data;
            }

            throw new Exception("Invalid JSON returned: " . $response);

        }
        /* $prompt = <<<TEXT
             Tu es un assistant spécialisé dans la rédaction de CV.

             Tâche :
             1. L’utilisateur fournit une section : "$section".
             2. Génère un exemple de contenu pour cette section, adapté au profil : "$profile".
             3. Réponds uniquement en JSON strict, sans ``` ni explications :

             {
             "section": "$section",
             "content": "..."
             }

             Langue : $language
         TEXT;

                     // Ici tu appelles ton service Gemini / OpenAI / API custom
                     $response = app('forgeAgentService')->generate($prompt);*/

        /*if ($response) {
            $clean = preg_replace('/^```json|```$/m', '', $response);
            $clean = trim($clean);

            $data = json_decode($clean, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                return $data;
            }

            throw new Exception("Invalid JSON returned: " . $response);
        }*/

        throw new Exception("No response from AI service");
    }

}