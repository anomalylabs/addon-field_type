# Addon Field Type

*anomaly.field_type.addon*

#### An addon relation field type.

The addon field type provides an HTML select input with options from an optional collection of addons.

## Configuration

- `type` - the addon type to relate to

The type configuration is optional and will default to showing all types.  

#### Example

	config => [
	    'type' => 'field_type'
	]
