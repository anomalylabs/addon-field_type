# Usage

The addon field type returns an addon instance. Remember, that when accessing entry field values in the view that they will be automatically decorated. In this case you will get the addon's presenter when accessing the value.

### Using the value with the API

Since the entry will return the Addon instance as a value, you can do whatever you want. Here are some examples of what that might look like.

```
/* @var Addon $addon */
$addon = $entry->addon;

echo $addon->getPath('composer.json'); // "core/anomaly/example-module/composer.json"

echo trans($addon->getName()); // "Example Addon"
```