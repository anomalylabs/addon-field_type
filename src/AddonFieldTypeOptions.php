<?php namespace Anomaly\AddonFieldType;

use Anomaly\Streams\Platform\Addon\AddonCollection;
use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;
use Anomaly\Streams\Platform\Addon\Module\ModuleCollection;
use Anomaly\Streams\Platform\Addon\Theme\ThemeCollection;

/**
 * Class AddonFieldTypeOptions
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonFieldType
 */
class AddonFieldTypeOptions
{

    /**
     * Handle the options.
     *
     * @param AddonFieldType $fieldType
     */
    public function handle(AddonFieldType $fieldType, AddonCollection $addons)
    {
        // Restrict to type if desired.
        if ($type = array_get($fieldType->getConfig(), 'type')) {
            $addons = $addons->{snake_case(str_plural($type))}();
        }

        // Search extensions if desired.
        if ($addons instanceof ExtensionCollection && $search = array_get($fieldType->getConfig(), 'search')) {
            $addons = $addons->search($search);
        }

        // Enabled only if extension or module.
        if ($addons instanceof ExtensionCollection || $addons instanceof ModuleCollection) {
            $addons = $addons->enabled();
        }

        // Limit to theme type if desired.
        if ($addons instanceof ThemeCollection && $type = array_get($fieldType->getConfig(), 'theme_type')) {
            $addons = $addons->{$type}();
        }

        $fieldType->setOptions($addons->lists('name', 'namespace')->all());
    }
}
