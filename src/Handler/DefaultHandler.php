<?php namespace Anomaly\AddonFieldType\Handler;

use Anomaly\AddonFieldType\AddonFieldType;
use Anomaly\Streams\Platform\Addon\AddonCollection;
use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;

class DefaultHandler
{

    /**
     * Handle the options.
     *
     * @param AddonFieldType $fieldType
     */
    public function handle(AddonFieldType $fieldType, AddonCollection $addons)
    {
        $type = null;

        // Restrict to type if desired.
        if (in_array($configured = $fieldType->config('type'), (array)config('streams::addons.types'))) {
            $addons = $addons->{$type = snake_case(str_plural($configured))}();
        }

        // Search extensions if desired.
        if ($addons instanceof ExtensionCollection && $search = $fieldType->config('search')) {
            $addons = $addons->search($search);
        }

        // Enabled only if extension or module.
        if (in_array($type, ['modules', 'extensions']) && $fieldType->config('enabled', true) == true) {
            $addons = $addons->enabled();
        }

        // Installed only if extension or module.
        if (in_array($type, ['modules', 'extensions']) && $fieldType->config('installed', true) == true) {
            $addons = $addons->installed();
        }

        // Limit to theme type if desired.
        if ($type === 'themes' && in_array($theme = $fieldType->config('theme_type'), ['admin', 'standard'])) {
            $addons = $addons->{$theme}();
        }

        $fieldType->setOptions($addons->pluck('title', 'namespace')->all());
    }
}
