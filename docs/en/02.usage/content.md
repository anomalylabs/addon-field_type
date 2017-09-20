---
title: Usage
---

## Usage[](#usage)

This section will show you how to use the field type via API and in the view layer.


### Setting Values[](#usage/setting-values)

You can set the addon field type value with an addon's namespace:

    $entry->example = "anomaly.module.files"

You can also set the value with an instance of an addon:

    $entry->example = $module;

Lastly you can set the value with an instance of an addon presenter:

    $entry->example = $decorated;


### Basic Output[](#usage/basic-output)

The `value` returned by the field type is either `null` or an instance of the selected addon.

###### Example

    $entry->example->getNamespace(); // anomaly.module.files


### Presenter Output[](#usage/presenter-output)

The addon field type will always return `null` or an instance of the addon. When accessing the field value from a decorated entry model the returned addon instance will be automatically decorated.

###### Example

    $decorated->example->name; // Files Module

###### Twig

    {{ decorated.example.name }} // Files Module
