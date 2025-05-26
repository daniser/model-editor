<?php

declare(strict_types=1);

namespace TTBooking\ModelEditor;

// use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use TTBooking\ModelEditor\Contracts\PropertyParser;

class ModelEditorServiceProvider extends ServiceProvider // implements DeferrableProvider
{
    /**
     * All of the singletons that should be registered.
     *
     * @var array<string, class-string>
     */
    public array $singletons = [
        'property-parser' => PropertyParserManager::class,
        'type-handler' => HandlerFactory::class,
    ];

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->registerResources();
        $this->registerComponents();

        if ($this->app->runningInConsole()) {
            $this->offerPublishing();
        }
    }

    /**
     * Register the Model Editor resources.
     */
    protected function registerResources(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'model-editor');
    }

    /**
     * Register Model Editor's Blade components.
     */
    protected function registerComponents(): void
    {
        Blade::componentNamespace('TTBooking\\ModelEditor\\View\\Components', 'model-editor');
    }

    /**
     * Setup the resource publishing groups for Model Editor.
     */
    protected function offerPublishing(): void
    {
        $this->publishes([
            __DIR__.'/../config/model-editor.php' => $this->app->configPath('model-editor.php'),
        ], ['model-editor-config', 'model-editor', 'config']);
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->configure();
        $this->registerServices();
    }

    /**
     * Setup the configuration for Model Editor.
     */
    protected function configure(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/model-editor.php', 'model-editor');
    }

    /**
     * Register Model Editor's services in the container.
     */
    protected function registerServices(): void
    {
        /** @phpstan-ignore-next-line */
        $this->app->singleton('property-parser.driver', static fn ($app) => $app['property-parser']->driver());
        $this->app->alias('property-parser.driver', PropertyParser::class);

        $this->app->when(HandlerFactory::class)->needs('$handlers')->giveConfig('model-editor.type_handlers', []);
        $this->app->alias('type-handler', Contracts\HandlerFactory::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return list<string>
     */
    public function provides(): array
    {
        return [
            'property-parser', 'property-parser.driver', PropertyParser::class,
            'type-handler', Contracts\HandlerFactory::class,
        ];
    }
}
