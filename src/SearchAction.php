<?php

namespace Spatie\SchemaOrg;

/**
 * The act of searching for an object.\n\nRelated actions:\n\n* [[FindAction]]:
 * SearchAction generally leads to a FindAction, but not necessarily.
 *
 * @see http://schema.org/SearchAction
 */
class SearchAction extends Action
{
    /**
     * A sub property of instrument. The query used on this action.
     *
     * @param string $query
     *
     * @return static
     *
     * @see http://schema.org/query
     */
    public function query($query)
    {
        return $this->setProperty('query', $query);
    }

}
