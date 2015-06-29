<?php namespace Anomaly\AddonFieldType;

use Anomaly\Streams\Platform\Addon\Addon;
use Anomaly\Streams\Platform\Addon\AddonCollection;
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
            $value = $value->getNamespace();
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
        if ($value && $addons = (new AddonCollection())->merged()) {
            return $addons->get($value);
        }

        return null;
    }
}
