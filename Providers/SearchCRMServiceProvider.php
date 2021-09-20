<?php

namespace Modules\SearchCRM\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\BaseCore\Contracts\Services\CompositeurThemeContract;
use Modules\BaseCore\Contracts\Views\MobileMenuBarContract;
use Modules\BaseCore\Contracts\Views\TopBarContract;
use Modules\BaseCore\Entities\TypeView;
use Modules\SearchCRM\Contracts\SearchContract;
use Modules\SearchCRM\Services\SearchCRM;

class SearchCRMServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected string $moduleName = 'SearchCRM';

    /**
     * @var string $moduleNameLower
     */
    protected string $moduleNameLower = 'searchcrm';

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        $this->registerConfig();
        $this->registerViews();

        app()->bind(SearchContract::class, SearchCRM::class);
    }

    public function register(){
        if(config('searchcrm.display_header_active', true)) {
            app(CompositeurThemeContract::class)
                ->setViews(TopBarContract::class, [
                    'searchcrm::search-header' => new TypeView(TypeView::TYPE_LIVEWIRE, 'searchcrm::search-header')
                ]);
        }
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig(): void
    {
        $this->publishes([
            module_path($this->moduleName, 'Config/config.php') => config_path($this->moduleNameLower . '.php'),
        ], 'config');

        $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/config.php'), $this->moduleNameLower
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews(): void
    {
        $viewPath = resource_path('views/modules/' . $this->moduleNameLower);

        $sourcePath = module_path($this->moduleName, 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', $this->moduleNameLower . '-module-views']);

        $this->loadViewsFrom($sourcePath, $this->moduleNameLower);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (\Config::get('view.paths') as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }
        return $paths;
    }
}
