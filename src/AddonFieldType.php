<?php namespace Anomaly\AddonFieldType;

use Anomaly\Streams\Platform\Addon\Addon;
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
        $options = [];

        foreach ($this->getTypeOptions() as $type) {
            if ($type instanceof Addon) {
                $options[$type->getNamespace()] = $type;
            }
        }

        return $options;
    }

    /**
     * Get options from the collection.
     *
     * @return array
     */
    protected function getTypeOptions()
    {
        $type = array_get($this->config, 'type');

        switch ($type) {
            case 'field_type':
                $collection = 'Anomaly\Streams\Platform\Addon\FieldType\FieldTypeCollection';
                break;

            default:
                $collection = 'Anomaly\Streams\Platform\Addon\FieldType\FieldTypeCollection';
                break;
        }

        return app($collection)->all();
    }
}
