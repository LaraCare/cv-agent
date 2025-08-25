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

```php
Using the Facade
use LaraCare\CvAgent\Facades\CvSections;

$profile = "IoT Engineer with 2 years of experience, seeking a position in AI";

$content = CvSections::generate('hobbies', $profile, 'en');

dd($content);
```



---

## 🧾 License

This package is open-sourced software licensed under the [MIT license](LICENSE).

