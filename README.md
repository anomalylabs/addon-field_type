# Addon Field Type

*anomaly.field_type.addon*

#### An addon dropdown field type.

The addon field type provides a dropdown for selecting an installed PyroCMS addon, optionally
restricted to a single addon type.

## Features

- Select any installed addon, or restrict the list to one type
- Two input modes: a plain dropdown or a searchable dropdown
- Restrict themes to admin or standard
- Restrict extensions by provides string
- Custom option handlers for replacing the list entirely
- Values decorate to the addon's presenter, so its namespace, type and slug are available

## Configuration

```php
protected $fields = [
    'addon' => [
        'type'   => 'anomaly.field_type.addon',
        'config' => [
            'type' => 'module',
        ],
    ],
];
```

| Key | Values | Description |
|---|---|---|
| `type` | `field_type`, `extension`, `module`, `plugin`, `theme` | Restrict the list to one addon type. Unset lists every addon. |
| `mode` | `dropdown` (default), `search` | `search` renders a searchable dropdown. |
| `theme_type` | `admin`, `standard` | Only applies when `type` is `theme`. |
| `search` | a provides string | Only applies when `type` is `extension`. |
| `handler` | a callable string or closure | Replaces the option list entirely. See below. |

A `type` outside the list above is ignored and the list is left unrestricted.

### Restricting Extensions

`search` filters extensions by what they provide:

```php
'authenticator' => [
    'type'   => 'anomaly.field_type.addon',
    'config' => [
        'type'   => 'extension',
        'search' => 'anomaly.module.users::authentication.*',
    ],
]
```

### Searchable Mode

```php
'addon' => [
    'type'   => 'anomaly.field_type.addon',
    'config' => [
        'type' => 'module',
        'mode' => 'search',
    ],
]
```

### Custom Handlers

`handler` replaces the option-building logic. It is a code-level option — it cannot be set from the
field configuration form, and closures cannot be stored, so a closure handler must be set from a
form builder.

```php
'addon' => [
    'type'   => 'anomaly.field_type.addon',
    'config' => [
        'handler' => \App\MyAddonOptions::class, // @handle is assumed
    ],
]
```

```php
class MyAddonOptions
{
    public function handle(AddonFieldType $fieldType)
    {
        $fieldType->setOptions(['anomaly.module.example' => 'Example']);
    }
}
```

Handlers are called through the service container, so method injection is supported. See
`docs/en/01.introduction/02.configuration.md` for the full description.

## Accessing Values

The stored value is the addon namespace. Reading it back gives the addon's presenter, which casts
to that namespace:

```twig
{{ entry.addon }}              {# anomaly.module.pages #}
{{ entry.addon.namespace }}    {# anomaly.module.pages #}
{{ entry.addon.type }}         {# module #}
{{ entry.addon.slug }}         {# pages #}
```

`name`, `title` and `description` return **translation keys**, not translated text, so pass them
through `trans`:

```twig
{{ trans(entry.addon.title) }}
{{ trans(entry.addon.description) }}
```

### In PHP

```php
$addon = $entry->addon;

$addon->getNamespace();   // anomaly.module.pages
$addon->getType();        // module
$addon->getSlug();        // pages

trans($addon->getTitle());
```

## Setting Values

Assign the namespace as a string:

```php
$entry->addon = 'anomaly.module.pages';
$entry->save();
```

## Database Structure

The addon field type stores the addon namespace in a **VARCHAR(255)** column.

## Validation

The field type applies no rules of its own. Laravel's rules can be added as usual:

```php
'addon' => [
    'type'  => 'anomaly.field_type.addon',
    'rules' => [
        'required',
    ],
]
```

There is no built-in rule to assert that the selected addon is still installed. The dropdown is
built from the installed addons at render time, but a value stored earlier is not re-checked, so
handle a missing addon where you read it — an uninstalled namespace decorates to `null`.

## Requirements

- Streams Platform ^1.10
- PyroCMS 3.10+

## License

The Addon Field Type is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

## Authors

PyroCMS, Inc. - [https://pyrocms.com](https://pyrocms.com)
Ryan Thompson - [ryan@pyrocms.com](mailto:ryan@pyrocms.com)
