# Addon Field Type

*anomaly.field_type.addon*

#### An addon dropdown field type.

The addon field type provides a specialized dropdown input for selecting PyroCMS addons with filtering capabilities.

## Features

- Select from installed addons in the system
- Filter by addon type (module, field_type, extension, etc.)
- Support for multiple selection modes (dropdown, search, tags)
- Custom option handlers for different filtering strategies
- Integration with the addon collection system
- Automatic addon loading and validation
- Database storage optimization

## Configuration

### Basic Configuration

```php
protected $fields = [
    'addon' => [
        'type'   => 'anomaly.field_type.addon',
        'config' => [
            'type' => 'module' // Filter to only modules
        ]
    ]
];
```

### Filter by Addon Type

```php
// Select only modules
'module' => [
    'type'   => 'anomaly.field_type.addon',
    'config' => [
        'type' => 'module'
    ]
]

// Select only field types
'field_type' => [
    'type'   => 'anomaly.field_type.addon',
    'config' => [
        'type' => 'field_type'
    ]
]

// Select only extensions
'extension' => [
    'type'   => 'anomaly.field_type.addon',
    'config' => [
        'type' => 'extension'
    ]
]

// Select only plugins
'plugin' => [
    'type'   => 'anomaly.field_type.addon',
    'config' => [
        'type' => 'plugin'
    ]
]

// Select only themes
'theme' => [
    'type'   => 'anomaly.field_type.addon',
    'config' => [
        'type' => 'theme'
    ]
]
```

### Display Modes

```php
// Dropdown mode (default)
'addon' => [
    'type'   => 'anomaly.field_type.addon',
    'config' => [
        'mode' => 'dropdown'
    ]
]

// Search mode (with autocomplete)
'addon' => [
    'type'   => 'anomaly.field_type.addon',
    'config' => [
        'mode' => 'search'
    ]
]

// Tags mode (for visual distinction)
'addon' => [
    'type'   => 'anomaly.field_type.addon',
    'config' => [
        'mode' => 'tags'
    ]
]
```

### Custom Handler

```php
'addon' => [
    'type'   => 'anomaly.field_type.addon',
    'config' => [
        'handler' => \App\MyCustomAddonHandler::class
    ]
]
```

## Usage Examples

### Select Module Addon

```php
protected $fields = [
    'featured_module' => [
        'type'   => 'anomaly.field_type.addon',
        'config' => [
            'type' => 'module',
            'mode' => 'search'
        ]
    ]
];
```

### Select Field Type

```php
protected $fields = [
    'custom_field' => [
        'type'   => 'anomaly.field_type.addon',
        'config' => [
            'type' => 'field_type'
        ]
    ]
];
```

### Select Theme with Search

```php
protected $fields = [
    'theme_override' => [
        'type'   => 'anomaly.field_type.addon',
        'config' => [
            'type' => 'theme',
            'mode' => 'search'
        ]
    ]
];
```

## Accessing Values

### In Twig Templates

```twig
{# Get addon namespace #}
{{ entry.addon }}

{# Get addon object #}
{{ entry.getAddon().getName() }}
{{ entry.getAddon().getTitle() }}
{{ entry.getAddon().getDescription() }}

{# Check if specific addon #}
{% if entry.addon == 'anomaly.module.pages' %}
    <p>This is the Pages module</p>
{% endif %}
```

### In PHP

```php
$entry = $model->find(1);

// Get addon namespace (string)
$namespace = $entry->addon;

// Get addon object
$addon = $entry->getAddon();

// Access addon properties
$name = $addon->getName();
$title = $addon->getTitle();
$description = $addon->getDescription();
$type = $addon->getType();

// Get the addon instance
$instance = app($namespace);
```

## Setting Values

### In Forms

```php
$form = $builder->make('example.module.test');
$form->on('saving', function(FormBuilder $builder) {
    $entry = $builder->getFormEntry();
    $entry->addon = 'anomaly.module.pages';
});
```

### Direct Assignment

```php
$entry->addon = 'anomaly.module.users';
$entry->save();
```

## Database Structure

The addon field type stores the addon namespace as:
- **VARCHAR(255)** - The addon namespace (e.g., "anomaly.module.pages")

## Validation

### Required Field

```php
'addon' => [
    'type'  => 'anomaly.field_type.addon',
    'rules' => [
        'required'
    ]
]
```

### Addon Exists

```php
'addon' => [
    'type'   => 'anomaly.field_type.addon',
    'config' => [
        'type' => 'module'
    ],
    'rules' => [
        'required',
        'addon_exists:module'
    ]
]
```

## Common Use Cases

### Select Parent Module

```php
'parent_module' => [
    'type'   => 'anomaly.field_type.addon',
    'config' => [
        'type' => 'module',
        'mode' => 'search'
    ]
]
```

### Select Field Type for Custom Fields

```php
'field_type' => [
    'type'   => 'anomaly.field_type.addon',
    'config' => [
        'type' => 'field_type'
    ]
]
```

### Select Extension for Integration

```php
'payment_extension' => [
    'type'   => 'anomaly.field_type.addon',
    'config' => [
        'type' => 'extension',
        'mode' => 'dropdown'
    ]
]
```

### Select Theme Override

```php
'custom_theme' => [
    'type'   => 'anomaly.field_type.addon',
    'config' => [
        'type' => 'theme',
        'mode' => 'search'
    ]
]
```

## Best Practices

1. **Filter by Type**: Always specify the addon type to limit options
2. **Use Search Mode**: For systems with many addons, use search mode for better UX
3. **Validate Existence**: Ensure selected addons are installed and enabled
4. **Cache Results**: Consider caching addon lists for performance
5. **Document Requirements**: Clearly document which addons are required
6. **Handle Missing Addons**: Gracefully handle cases where selected addons are uninstalled
7. **Namespace Consistency**: Always store and retrieve using full addon namespaces

## Requirements

- Streams Platform ^1.10
- PyroCMS 3.10+

## License

The Addon Field Type is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

## Authors

PyroCMS, Inc. - [https://pyrocms.com](https://pyrocms.com)
Ryan Thompson - [ryan@pyrocms.com](mailto:ryan@pyrocms.com)
