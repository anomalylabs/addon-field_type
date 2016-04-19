# Usage

- [Setting Values](#mutator)
- [Basic Output](#output)
- [Presenter Output](#presenter)

<hr>

<a name="mutator"></a>
## Setting Values

You can set the addon field type value with an addon's namespace.

{{ code('php', '$entry->example = "anomaly.module.files"') }}

You can also set the value with an instance of an addon.

{% code php %}
$entry->example = $module;
{% endcode %}

<hr>

<a name="output"></a>
## Basic Output

The addon field type always returns `null` or an instance of the selected addon.

{% code php %}
echo $entry->example->getNamespace(); // "anomaly.module.files"
{% endcode %}

<hr>

<a name="presenter"></a>
## Presenter Output

When accessing the value from a decorated entry, like one in a view, the addon's presenter is returned instead.

{% code twig %}
{% verbatim %}{{ entry.example.getNamespace() }} {# "anomaly.module.files" #}{% endverbatim %}
{% endcode %}