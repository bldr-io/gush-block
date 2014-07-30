<?php

/**
 * This file is part of gush-block
 *
 * (c) Aaron Scherer <aequasi@gmail.com>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE
 */

namespace Bldr\Block\Gush\Call\Issue;

use Bldr\Block\Gush\Call\AbstractGushCall;

abstract class AbstractIssueCall extends AbstractGushCall
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return parent::getName().':issue';
    }
}
 