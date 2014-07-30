<?php

/**
 * This file is part of gush-block
 *
 * (c) Aaron Scherer <aequasi@gmail.com>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE
 */

namespace Bldr\Block\Gush\Call;

use Bldr\Call\AbstractCall;

abstract class AbstractGushCall extends AbstractCall
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'gush';
    }
}
 