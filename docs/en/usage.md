# Usage

- [API Usage](#api)
- [Twig Usage](#twig)

<hr>

<a name="api"></a>
## API Usage

### Setting The Value

You can set the addon field type value with an addon's namespace.

{{ code('php', '$entry->example = "anomaly.module.files"') }}

Or you can set the value with the instance of an addon.

{% code php %}
$entry->example = $collection->get("anomaly.module.files");
{% endcode %}

### Using The Value

The addon field type always returns `null` or an instance of an addon.

{% code php %}
echo $entry->example->getNamespace(); // "anomaly.module.files"
{% endcode %}

<hr>

<a name="twig"></a>
## Twig Usage

You can use the field type's value in Twig similar to how it's used via the API.

{{ code('php', '{{ entry.example.namespace }} // "anomaly.module.files"') }}

**Remember:** you can literally call public methods too.

{{ code('php', '{{ entry.example.getNamespace("test") }} // "anomaly.module.files::test"') }}
