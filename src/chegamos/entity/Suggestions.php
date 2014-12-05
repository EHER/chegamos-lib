<?php

namespace chegamos\entity;

class Suggestions
{
    private $suggestions = array();

    public function __construct($data = null)
    {
        $this->setSuggestions($data);
    }

    public function __toString()
    {
        $suggestions = "";
        if (is_array($this->getSuggestions())) {
            foreach ($this->getSuggestions() as $suggestion) {
                $suggestions .= '<a href="'.ROOT_URL;
                $suggestions .= 'places/search?q='.$suggestion.'">';
                $suggestions .= $suggestion.'</a> ';
            }
        }

        return $suggestions;
    }

    public function setSuggestions($suggestions)
    {
        $this->suggestions = $suggestions;
    }

    public function getSuggestions()
    {
        return $this->suggestions;
    }
}
