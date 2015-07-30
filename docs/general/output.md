# Output

This field type returns the addon instance as a value. You may access the object as normal.

**Examples:**

    // Twig usage
    {{ entry.example.namespace }} or {{ trans(entry.example.name) }}
    
    // API usage
    $entry->example->getNamespace(); or trans($entry->example->getName());
