<?php
namespace Boilerplate\SerializerBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class ModelTestCase extends WebTestCase 
{
    
    protected $serializarionMethod          = "xml";
    protected $systemUnderTestFullClassName = null;
    protected $testedModels                 = array();
    protected $isSerializationTestable      = true;
    protected $isUnserializationTestable    = true;
    protected $serializer;
    
    protected function setup() 
    {
        self::$kernel = self::createKernel();
        self::$kernel->boot();
        $this->serializer = $this->getService("serializer");
    }
    
    /**
     * @test
     * @dataProvider getObjectsAndFeedsObjects
     */
    public function serialization($object, $expectedFeed) 
    {
        if ($this->isSerializationTestable) {
            $serializedJsonFeed = $this->serializer->serialize($object, $this->serializarionMethod);
            $this->assertEquals($expectedFeed, $serializedJsonFeed);
        }
    }
    
    /**
     * @test
     * @dataProvider getObjectsAndFeedsObjects
     */
    public function unserialization($expectedObject, $feed) 
    {
        if ($this->isUnserializationTestable) {
            $unserializedObject = $this->serializer->deserialize($feed, $this->systemUnderTestFullClassName, $this->serializarionMethod);
            $this->assertTrue($unserializedObject instanceof  $this->systemUnderTestFullClassName);
            $this->assertEquals($expectedObject, $unserializedObject);
        }
    }
    
    protected function getTextFeedFromFile($file) 
    {
        $path = $this->getTestFileBasePath();
        $fileName = $path . "/" . $file . "." . $this->serializarionMethod;
        if (is_file($fileName)) {
            return file_get_contents($fileName);
        }
        throw new \RuntimeException($this->serializarionMethod . " File not found : $fileName");
    }
    
    protected function getSourceFeedFromFile($file, $throwException = true) 
    {
        $path = $this->getTestFileBasePath();
        $fileName = $path . "/" . $file;
        if (is_file($fileName)) {
            include($fileName);
            return $object;
        }
        if ($throwException) throw new \RuntimeException("PHP file not found : $fileName");
        return null;
    }

    protected function getPhpVarFromFile($file) 
    {
        return $this->getSourceFeedFromFile($file . ".php");
    }
    
    protected function getService($serviceId) 
    {
        return static::$kernel->getContainer()->get($serviceId);
    }
    
    abstract protected function getTestFileBasePath();
    
    /*****************
     * DATA PROVIDERS
     *****************/
    
    public function getObjectsAndFeedsObjects() 
    {
        $objectsAndJsonFeeds = array();
        foreach ($this->testedModels as $testedModel) {
            $object = $this->getPhpVarFromFile($testedModel);
            $objectsAndJsonFeeds[] = array(
                $object,
                $this->getTextFeedFromFile($testedModel)
            );
        }
        return $objectsAndJsonFeeds;
    }
}
