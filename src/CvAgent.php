<?php

namespace LaraCare\CvAgent;

class CvAgent
{
    public function generateSection(string $section, string $profile, string $lang = 'en')
    {
        // Ici tu appelles ton AI Service interne
        return [
            'section' => $section,
            'content' => "Generated example for $section in $lang based on $profile"
        ];
    }
}
