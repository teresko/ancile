<?php

namespace Ancile;

use Service\Search;

class AccessControl
{

    private $search;

    public function __construct(Search $search)
    {
        $this->search = $search;
    }


    public function isAllowedForAccountId(string $signature, int $accountId)
    {
        $resource = $this->search->getResourceBySignature($signature);
        if ($resource->getId() === null) {
            $resource = $this->search->getResourceByFuzzySignature($signature);
        }

        $roles = $this->search->getInheritedRolesByIdentity($accountId);

        return $resource->matchRolesFrom($roles);

    }
}
