<?php

namespace RulerZ\Executor\Elasticsearch;

use Elastica\Search;
use Elastica\SearchableInterface;

use RulerZ\Context\ExecutionContext;

trait FilterTrait
{
    abstract protected function execute($target, array $operators, array $parameters);

    /**
     * {@inheritDoc}
     */
    public function filter($target, array $parameters, array $operators, ExecutionContext $context)
    {
        /** @var array $searchQuery */
        $searchQuery = $this->execute($target, $operators, $parameters);

        if ($target instanceof SearchableInterface || $target instanceof Search) {
            return $target->search(['query' => $searchQuery]);
        }

        return $target->find(['query' => $searchQuery]);
    }
}