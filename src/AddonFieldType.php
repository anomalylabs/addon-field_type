<?php namespace Anomaly\AddonFieldType;

use Anomaly\Streams\Platform\Addon\AddonCollection;
use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;
use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Addon\Theme\ThemeCollection;

/**
 * Class AddonFieldType
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonFieldType
 */
class AddonFieldType extends FieldType
{

    /**
     * The input view.
     *
     * @var string
     */
    protected $inputView = 'anomaly.field_type.addon::input';

    /**
     * The filter view.
     *
     * @var string
     */
    protected $filterView = 'anomaly.field_type.addon::filter';

    /**
     * Get the options.
     *
     * @return array
     */
    public function getOptions()
    {
        // Get all addons.
        $addons = (new AddonCollection())->merged();

        // Restrict to type if desired.
        if ($type = array_get($this->getConfig(), 'type')) {
            $addons = $addons->{snake_case(str_plural($type))}();
        }

        // Search extensions if desired.
        if ($addons instanceof ExtensionCollection && $search = array_get($this->getConfig(), 'search')) {
            $addons = $addons->search($search);
        }

        // Limit to theme type if desired.
        if ($addons instanceof ThemeCollection && $type = array_get($this->getConfig(), 'theme_type')) {
            $addons = $addons->{$type}();
        }

        return array_merge(
            [null => trans($this->getPlaceholder())],
            $addons->lists('name', 'namespace')->all()
        );
    }

    /**
     * Get the placeholder.
     *
     * @return null|string
     */
    public function getPlaceholder()
    {
        return $this->placeholder ?: 'anomaly.field_type.addon::input.placeholder';
    }
}
