# Usage

- [Setting Values](#mutator)
- [Basic Output](#output)
- [Presenter Output](#presenter)

<hr>

<a name="mutator"></a>
## Setting Values

You can set the addon field type value with an addon's namespace.

    $entry->example = "anomaly.module.files"

You can also set the value with an instance of an addon.

    $entry->example = $module;

<hr>

<a name="output"></a>
## Basic Output

The addon field type always returns `null` or an instance of the selected addon.

    $entry->example->getNamespace(); // anomaly.module.files

<hr>

<a name="presenter"></a>
## Presenter Output

When accessing the value from a decorated entry, like one in a view, the addon's presenter is returned instead.

    {% verbatim %}{{ entry.example.getNamespace() }} {# "anomaly.module.files" #}{% endverbatim %}

**Remember:** You can access presenter and object methods in valuated strings like table columns too.

    protected $columns = [
        "entry.addon.namespace"
    ];