<?php

namespace App\Listener\Doctrine;

use App\Doctrine\Mapping\Event\Adapter\ODM;
use App\Doctrine\Mapping\Event\Adapter\ORM;
use Doctrine\Common\EventArgs;
use Gedmo\Exception\InvalidArgumentException;

final class TimestampableListener extends \Gedmo\Timestampable\TimestampableListener
{
    protected function getEventAdapter(EventArgs $args)
    {
        $class = get_class($args);
        if (preg_match('@Doctrine\\\([^\\\]+)@', $class, $m) && in_array($m[1], ['ODM', 'ORM'], true)) {
            if (!isset($this->adapters[$m[1]])) {
                $adapterClass = ORM::class;
                if (!\class_exists($adapterClass)) {
                    $adapterClass = 'Gedmo\\Mapping\\Event\\Adapter\\'.$m[1];
                }
                $this->adapters[$m[1]] = new $adapterClass();
            }
            $this->adapters[$m[1]]->setEventArgs($args);

            return $this->adapters[$m[1]];
        }

        throw new InvalidArgumentException('Event mapper does not support event arg class: '.$class);
    }
}