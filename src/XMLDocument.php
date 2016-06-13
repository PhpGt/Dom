<?php

namespace phpgt\dom;

class XMLDocument extends Document
{
use LiveProperty, ParentNode;

    public function __construct($document)
    {
        parent::__construct($document);
        if (!($document instanceof \DOMDocument)) {
            $this->loadXML($document);
        }
    }

}
