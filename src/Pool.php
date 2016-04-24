<?php
declare(strict_types=1);

/*
 * This file is part of PhuninNode.
 *
 ** (c) 2013 - 2015 Cees-Jan Kiewiet
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WyriHaximus\React\ChildProcess\Pool\PhuninNode;

use React\Promise\PromiseInterface;
use WyriHaximus\PhuninNode\Configuration;
use WyriHaximus\PhuninNode\Metric;
use WyriHaximus\PhuninNode\Node;
use WyriHaximus\PhuninNode\PluginInterface;
use WyriHaximus\React\ChildProcess\Pool\Info;
use WyriHaximus\React\ChildProcess\Pool\PoolInfoInterface;
use function React\Promise\resolve;

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
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * {@inheritdoc}
     */
    public function getCategorySlug(): string
    {
        return $this->categorySlug;
    }

    /**
     * {@inheritdoc}
     */
    public function getConfiguration(): PromiseInterface
    {
        if ($this->configuration instanceof Configuration) {
            return resolve($this->configuration);
        }

        $this->configuration = new Configuration();
        $this->configuration->setPair('graph_category', $this->categorySlug);
        $this->configuration->setPair('graph_title', $this->title);
        $this->configuration->setPair('current_size.label', 'Current Pool size');
        $this->configuration->setPair('current_queued_calls.label', 'Current Queued call count');
        $this->configuration->setPair('current_busy.label', 'Current Busy worker count');
        $this->configuration->setPair('current_idle_workers.label', 'Current Idle Workers count');

        return resolve($this->configuration);
    }

    /**
     * {@inheritdoc}
     */
    public function getValues(): PromiseInterface
    {
        $info = $this->pool->info();
        $storage = new \SplObjectStorage();
        $storage->attach(new Metric('current_size', (float)$info[Info::SIZE]));
        $storage->attach(new Metric('current_busy', (float)$info[Info::BUSY]));
        $storage->attach(new Metric('current_queued_calls', (float)$info[Info::CALLS]));
        $storage->attach(new Metric('current_idle_workers', (float)$info[Info::IDLE]));
        return resolve($storage);
    }
}
