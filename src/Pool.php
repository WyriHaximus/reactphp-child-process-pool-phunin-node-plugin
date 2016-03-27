<?php

/*
 * This file is part of PhuninNode.
 *
 ** (c) 2013 - 2015 Cees-Jan Kiewiet
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WyriHaximus\React\ChildProcess\Pool\PhuninNode;

use WyriHaximus\PhuninNode\Configuration;
use WyriHaximus\PhuninNode\Node;
use WyriHaximus\PhuninNode\PluginInterface;
use WyriHaximus\PhuninNode\Value;
use WyriHaximus\React\ChildProcess\Pool\Info;
use WyriHaximus\React\ChildProcess\Pool\PoolInfoInterface;

/**
 * Class MemoryUsage
 * @package WyriHaximus\PhuninNode\Plugins
 */
class Pool implements PluginInterface
{
    /**
     * @var PoolInfoInterface
     */
    protected $pool;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $slug;

    /**
     * @var string
     */
    protected $categorySlug;

    /**
     * @var Node
     */
    private $node;

    /**
     * Cached configuration state
     *
     * @var Configuration
     */
    private $configuration;

    /**
     * Pool constructor.
     * @param PoolInfoInterface $pool
     * @param string $slug
     * @param string $categorySlug
     * @param string $title
     */
    public function __construct(PoolInfoInterface $pool, $title, $slug, $categorySlug)
    {
        $this->pool = $pool;
        $this->title = $title;
        $this->slug = $slug;
        $this->categorySlug = $categorySlug;
    }

    /**
     * {@inheritdoc}
     */
    public function setNode(Node $node)
    {
        $this->node = $node;
    }

    /**
     * {@inheritdoc}
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * {@inheritdoc}
     */
    public function getCategorySlug()
    {
        return $this->categorySlug;
    }

    /**
     * {@inheritdoc}
     */
    public function getConfiguration()
    {
        if ($this->configuration instanceof Configuration) {
            return \React\Promise\resolve($this->configuration);
        }

        $this->configuration = new Configuration();
        $this->configuration->setPair('graph_category',             $this->categorySlug);
        $this->configuration->setPair('graph_title',                $this->title);
        $this->configuration->setPair('current_size.label',         'Current Pool size');
        $this->configuration->setPair('current_queued_calls.label', 'Current Queued call count');
        $this->configuration->setPair('current_busy.label',         'Current Busy worker count');
        $this->configuration->setPair('current_idle_workers.label', 'Current Idle Workers count');

        return \React\Promise\resolve($this->configuration);
    }

    /**
     * {@inheritdoc}
     */
    public function getValues()
    {
        $info = $this->pool->info();
        $storage = new \SplObjectStorage();
        $storage->attach(new Value('current_size',         $info[Info::SIZE]));
        $storage->attach(new Value('current_busy',         $info[Info::BUSY]));
        $storage->attach(new Value('current_queued_calls', $info[Info::CALLS]));
        $storage->attach(new Value('current_idle_workers', $info[Info::IDLE]));
        return \React\Promise\resolve($storage);
    }
}
