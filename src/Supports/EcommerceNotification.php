<?php

namespace ArchiElite\EcommerceNotification\Supports;

use ArchiElite\NotificationPlus\Facades\NotificationPlus;
use Botble\Base\Supports\TwigCompiler;
use Botble\Ecommerce\Supports\TwigExtension;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class EcommerceNotification
{
    protected array $variables = [];

    public function __construct()
    {
        $this->variables = [
            'now' => Carbon::now(),
            'site_name' => theme_option('seo_title') ?: theme_option('site_title') ?: config('app.name'),
            'site_url' => request()->getHost(),
        ];
    }

    public static function make(): self
    {
        return new self();
    }

    public function sendNotifyToDriversUsing(string $key, string $message, array $customVariables = []): void
    {
        $twigCompiler = new TwigCompiler();
        $twigCompiler->addExtension(new TwigExtension());

        $data = [];

        if (! empty($customVariables)) {
            $this->variables = array_merge($this->variables, $customVariables);
        }

        $message = $twigCompiler->compile($message, $this->variables);

        $this->variables['subject'] = $message;

        foreach (NotificationPlus::getAvailableDrivers() as $driver) {
            $driver = NotificationPlus::driver($driver);
            $name = $driver->getShortName();

            if (File::exists($path = __DIR__ . "/../../resources/templates/$name/$key.tpl")) {
                $content = File::get($path);
                if ($content) {
                    $content = $twigCompiler->compile($content, $this->variables);
                    $data = json_decode($content, true);

                    if (! $data) {
                        $message = $content;
                    }
                }
            }

            $driver->send($message, (array) $data);
        }
    }
}
