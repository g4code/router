<?php

namespace G4\Router;

use Aura\Router\Exception;

class Map extends \Aura\Router\Map
{

    protected function getNextAttach()
    {
        /**
         * @todo: Dejan: this method is copy/paste of \Aura\Router\Map::getNextAttach()
         * because there is some assumptions that we don't need, and we are fixing them here
         */
        $key = key($this->attach_routes);
        $val = array_shift($this->attach_routes);

        // which definition form are we using?
        if (is_string($key) && is_string($val)) {
            // short form, named in key
            $spec = [
                'name' => $key,
                'path' => $val,
                'values' => [
//                     'action' => $key, // @todo: Dejan: why assume I need action... stop forcing stuppid MVC on people!!!!!!!!
                ],
            ];
        } elseif (is_int($key) && is_string($val)) {
            // short form, no name
            $spec = [
                'path' => $val,
            ];
        } elseif (is_string($key) && is_array($val)) {
            // long form, named in key
            $spec = $val;
            $spec['name'] = $key;
            // if no action, use key
            if (! isset($spec['values']['action'])) {
//                 $spec['values']['action'] = $key; // @todo: Dejan: ^^ same thing as above!!!
            }
        } elseif (is_int($key) && is_array($val)) {
            // long form, no name
            $spec = $val;
        } else {
            throw new Exception\UnexpectedType("Route spec for '$key' should be a string or array.");
        }

        // unset any path or name prefix on the spec itself
        unset($spec['name_prefix']);
        unset($spec['path_prefix']);

        // now merge with the attach info
        $spec = array_merge_recursive($this->attach_common, $spec);

        // done!
        return $spec;
    }
}
