# Configuration

- [Basic Configuration](#basic)
- [Extra Configuration](#extra)
- [Option Handlers](#handlers)

<hr>

Below is the full configuration available with defaults.

{% code php %}
protected $fields = [
    "example" => [
        "type"   => "anomaly.field_type.addon",
        "config" => [
            "default_value" => null,
            "type"          => null,
            "search"        => null,
            "theme_type"    => null,
            "handler"       => "Anomaly\AddonFieldType\Handler\DefaultHandler@handle"
        ]
    ]
];
{% endcode %}

<hr>

<a name="basic"></a>
## Basic Configuration

### Default Value

{{ code('php', '"default_type" => false') }}

The `default_value` is a core option. This field type accepts any module namespace like `anomaly.module.example`.

### Addon Type

{{ code('php', '"type" => "modules"') }}

Specify the type of addons to display in the dropdown. Valid options are `module`, `theme`, `plugin`, `extension`, or `field_type`. The default value is `null` which displays all addon types.

<hr>

<a name="extra"></a>
## Extra Configuration

### Search Extensions

{{ code('php', '"search" => "anomaly.module.files::adapter.*"') }}

The extension search argument will search and return only extensions with a provision string that matches your search.

For example, an extension with {{ code('php', 'protected $provides = "anomaly.module.files::adapter.local";') }} *would* be included in the options.

This is helpful for allowing users to pick an extension specifically built for an addon. Like a disk adapter for the Files module.

### Theme Type

{{ code('php', '"theme_type" => "admin"') }}

The theme type argument will restrict what type of themes are returned. Valid options are `admin` or `standard`.

<hr>

<a name="handlers"></a>
## Option Handlers

Option handlers are responsible for setting the available options on the field type. You can define your own option handler to add your own logic to available dropdown options.

### Defining Custom Handlers

Custom handlers can be defined as a callable string.

{{ code('php', '"handler" => "App/Example/MyOptions@handle"') }}

You can also define custom handlers as a closure.

<div class="alert alert-info">
    <strong>Remember:</strong> Closures can not be stored in the database so you need to define closures in the form builder.
</div>

{% code php %}
protected $fields = [
    "example" => [
        "config" => [
            "handler" => function (AddonFieldType $fieldType, ExampleModule $module) {
                $fieldtype->setOptions(
                    [
                        "anomaly.module.example" => $module->getName()
                    ]
                );
            }
        ]
    ]
];
{% endcode %}

### Building Custom Handlers

Building custom option handlers could not be easier. Simply create the class with the method you defined in the config option.

{{ code('php', '"handler" => "App/Example/MyOptions@handle"') }}

The callable string is called via Laravel's service container. The {{ code('php', '$fieldType') }} is passed as an argument.

<div class="alert alert-primary">
<strong>Note:</strong> Because handlers are called through Laravel's service container, you can automatically inject dependencies into the construct and method.
</div>

{% code php %}
class MyOptions
{
    public function handle(AddonFieldType $fieldType)
    {
        $fieldtype->setOptions(
            [
                "anomaly.module.example" => 'Example'
            ]
        );
    }
}
{% endcode %}
