## CvAgent

🚀 CvAgent is a Laravel package that automatically generates tailored CV (resume) section content using Artificial Intelligence (AI).
It helps you quickly build professional resumes by generating coherent and personalized examples based on a user’s profile.


## 📦 Installation

Install the package via Composer:

```bash
composer require laracare/cv-agent
```

## ⚙️ Configuration

Publish the configuration file:

```bash
php artisan vendor:publish --provider="LaraCare\CvAgent\Providers\CvAgentProvider" --tag=config
```

This will create:

```bash
config/cv-agent.php
```

Inside, you can configure:

- your AI provider’s API keys,

- default parameters (language, model, etc.).


## 🚀 Usage

Using the Facade

```php

use LaraCare\CvAgent\Facades\CvSections;

$profile = "IoT Engineer with 2 years of experience, seeking a position in AI";

$content = CvSections::generate('hobbies', $profile, 'en');

dd($content);
```

#### Expected Output

```json
{
  "section": "hobbies",
  "content": "Passionate about developing open-source IoT projects, photography, and long-distance cycling."
}
```

## 📂 Package Structure

```bash
cv-agent/
├── config/
│   └── cv-agent.php          # Package configuration
├── src/
│   ├── Facades/
│   │   └── CvSections.php    # Facade for quick access
│   ├── Providers/
│   │   └── CvAgentProvider.php # Service Provider
│   └── CvAgent.php           # Main class
├── composer.json
└── README.md
```

## 🧩 Example Integration in a Controller

```php
use LaraCare\CvAgent\Facades\CvSections;

class ResumeController extends Controller
{
    public function generate()
    {
        $profile = "IoT Engineer with 2 years of experience, seeking AI position";
        return response()->json(
            CvSections::generate("skills", $profile, "en")
        );
    }
}
```

## 🔑 Extensibility

- Add your own CV sections

- Switch AI models in config/cv-agent.php

- Support multiple languages (en, fr, etc.)

## 🤝 Contributing

Pull Requests are welcome!
Fork the project, create your feature branch, then:
```bash
git checkout -b feature/amazing-feature
git commit -m 'Add amazing feature'
git push origin feature/amazing-feature
```



---

## 🧾 License

This package is open-sourced software licensed under the [MIT license](LICENSE).

