<?php

namespace Essa\APIToolKit\Generator\Commands;

use Essa\APIToolKit\Generator\Contracts\HasDynamicContentInterface;
use Essa\APIToolKit\Generator\SchemaParsers\UpdateValidationRulesParser;

class UpdateFormRequestGeneratorCommand extends GeneratorCommand implements HasDynamicContentInterface
{
    protected string $type = 'update-request';

    public function getContent(): array
    {
        return [
            '{{updateValidationRules}}' => (new UpdateValidationRulesParser($this->apiGenerationCommandInputs->getSchema()))->parse(),
        ];
    }

    protected function getStubName(): string
    {
        return 'UpdateDummyRequest';
    }
}
