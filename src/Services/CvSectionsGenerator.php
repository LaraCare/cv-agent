<?php 

namespace LaraCare\CvAgent\Services;

use Exception;

class CvSectionsGenerator
{
    public function generate(string $section, string $profile, string $language = 'en'): array
    {
        $prompt = <<<TEXT
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
                    $response = app('forgeAgentService')->generate($prompt);

                    if ($response) {
                        $clean = preg_replace('/^```json|```$/m', '', $response);
                        $clean = trim($clean);

                        $data = json_decode($clean, true);
                        if (json_last_error() === JSON_ERROR_NONE) {
                            return $data;
                        }

                        throw new Exception("Invalid JSON returned: " . $response);
                    }

                    throw new Exception("No response from AI service");
                }

}