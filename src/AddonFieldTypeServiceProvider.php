<?php

namespace Anomaly\AddonFieldType;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;

/**
 * Class AddonFieldTypeServiceProvider
 *
 * @link   http://pyrocms.com/
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AddonFieldTypeServiceProvider extends AddonServiceProvider implements DeferrableProvider
{

    /**
     * Return the provided services.
     */
    public function provides()
    {
        return [AddonFieldType::class, 'anomaly.field_type.addon'];
    }
}
