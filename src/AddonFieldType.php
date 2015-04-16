<?php namespace Anomaly\AddonFieldType;

use Anomaly\Streams\Platform\Addon\AddonCollection;
use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;
use Anomaly\Streams\Platform\Addon\FieldType\FieldType;

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
     * Get the options.
     *
     * @return array
     */
    public function getOptions()
    {
        $type = ucfirst(camel_case(str_singular(array_get($this->getConfig(), 'type'))));

        /* @var AddonCollection $addons */
        $addons = app('Anomaly\Streams\Platform\Addon\\' . $type . '\\' . $type . 'Collection');

        if ($addons instanceof ExtensionCollection && $search = array_get($this->getConfig(), 'search')) {
            $addons = $addons->search($search);
        }

        return array_merge(
            [null => trans($this->getPlaceholder())],
            $addons->lists('name', 'namespace')
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
