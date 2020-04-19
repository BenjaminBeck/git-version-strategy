<?php

namespace Emileperron\GitVersionStrategyBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Emileperron\GitVersionStrategyBundle\DependencyInjection\EmileperronGitVersionStrategyExtension;

class EmileperronGitVersionStrategyBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new EmileperronGitVersionStrategyExtension();
    }
}
