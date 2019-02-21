<?php

namespace Sminnee\Amplitude;

use SilverStripe\TagManager\SnippetProvider;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\View\ArrayData;
use SilverStripe\Security\Member;

/**
 * A snippet provider that lets you add arbitrary HTML
 */
class AmplitudeSnippetProvider implements SnippetProvider
{

    public function getTitle()
    {
        return "Amplitude Analytics";
    }

    public function getParamFields()
    {
        return new FieldList(
            TextField::create("ApiKey", "API Key")
        );
    }

    public function getSummary(array $params)
    {
        return $this->getTitle();
    }

    public function getSnippets(array $params)
    {
        if (empty($params['ApiKey'])) {
            return [];
        }

        $snippet = (new ArrayData($params))->renderWith('AmplitudeSnippetProvider')->raw();

        return [
            'end-head' => $snippet
        ];
    }
}
