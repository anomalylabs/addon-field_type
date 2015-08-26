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
     * The addon collection.
     *
     * @var AddonCollection
     */
    private $addons;

    /**
     * Create a new AddonFieldTypeModifier
     *
     * @param AddonCollection $addons
     */
    public function __construct(AddonCollection $addons)
    {
        $this->addons = $addons;
    }

    /**
     * Modify the value.
     *
     * @param  $value
     * @return mixed
     */
    public function modify($value)
    {
        if ($value instanceof Addon) {
            return $value->getNamespace();
        }

        return $value;
    }

    /**
     * Restore the value.
     *
     * @param  $value
     * @return null|Addon
     */
    public function restore($value)
    {
        if ($value instanceof Addon) {
            return $value;
        }

        if ($value && $addon = $this->addons->get($value)) {
            return $addon;
        }

        return null;
    }
}
