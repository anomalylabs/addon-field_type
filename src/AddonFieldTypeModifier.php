<?php namespace Anomaly\AddonFieldType;

use Anomaly\Streams\Platform\Addon\Addon;
use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeModifier;

/**
 * Class AddonFieldTypeModifier
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonFieldType
 */
class AddonFieldTypeModifier extends FieldTypeModifier
{

    /**
     * Modify the value.
     *
     * @param  $value
     * @return mixed
     */
    public function modify($value)
    {
        if ($value instanceof Addon) {
            $value = get_class($value);
        } else {
            $value = null;
        }

        return $value;
    }

    /**
     * Restore the value.
     *
     * @param  $value
     * @return mixed
     */
    public function restore($value)
    {
        if (class_exists($value)) {
            $value = app($value);
        } else {
            $value = null;
        }

        return $value;
    }
}
