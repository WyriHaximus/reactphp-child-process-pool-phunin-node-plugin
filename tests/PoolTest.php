<?php

namespace WyriHaximus\React\Tests\ChildProcess\Pool\PhuninNode;

use Phake;
use WyriHaximus\PhuninNode\Tests\Plugins\AbstractPluginTest;
use WyriHaximus\React\ChildProcess\Pool\PhuninNode\Pool;
use WyriHaximus\React\ChildProcess\Pool\PoolInfoInterface;

class PoolTest extends AbstractPluginTest
{
    public function setUp()
    {
        $pool = Phake::mock(PoolInfoInterface::class);
        Phake::when($pool)->info()->thenReturn([
            'size'          => 1,
            'queued_calls'  => 2,
            'idle_workers'  => 3,
        ]);
        $this->plugin = new Pool($pool, 'a', 'b', 'c');

        parent::setUp();

        $this->node->addPlugin($this->plugin);
    }
}
