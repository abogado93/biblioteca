<?php
/*
 * Copyright (c) Nate Brunette.
 * Distributed under the MIT License (http://opensource.org/licenses/MIT)
 */

namespace Tebru\AnnotationReader\Test;

use Doctrine\Common\Annotations\AnnotationReader;
use PHPUnit_Framework_TestCase;
use Psr\SimpleCache\CacheInterface;
use Symfony\Component\Cache\Simple\ArrayCache;
use Tebru\AnnotationReader\AnnotationReaderAdapter;
use Tebru\AnnotationReader\Test\Mock\Annotation\BaseClassAnnotation;

class AnnotationReaderCacheTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var CacheInterface
     */
    private $cache;

    /**
     * @var AnnotationReaderAdapter
     */
    private $reader;

    public function setUp()
    {
        $this->cache = new ArrayCache();
        $this->reader = new AnnotationReaderAdapter(new AnnotationReader(), $this->cache);
    }

    public function testReadClassUsesCache()
    {
        $annotation = new BaseClassAnnotation(['value' => 'foo']);
        $this->cache->set('annotationreader.FooBar', [BaseClassAnnotation::class => $annotation]);
        $result = $this->reader->readClass('Foo\Bar', false)->get(BaseClassAnnotation::class);

        self::assertEquals($annotation, $result);
    }

    public function testReadMethodUsesCache()
    {
        $annotation = new BaseClassAnnotation(['value' => 'foo']);
        $this->cache->set('annotationreader.FooBarfoo', [BaseClassAnnotation::class => $annotation]);
        $result = $this->reader->readMethod('foo', 'Foo\Bar', false, false)->get(BaseClassAnnotation::class);

        self::assertEquals($annotation, $result);
    }

    public function testReadPropertyUsesCache()
    {
        $annotation = new BaseClassAnnotation(['value' => 'foo']);
        $this->cache->set('annotationreader.FooBarfoo', [BaseClassAnnotation::class => $annotation]);
        $result = $this->reader->readProperty('foo', 'Foo\Bar', false, false)->get(BaseClassAnnotation::class);

        self::assertEquals($annotation, $result);
    }
}
