<?php
namespace Boilerplate\SerializerBundle\Tests;

class BookTest extends ModelTestCase 
{
    protected $serializarionMethod          = "xml";
    protected $systemUnderTestFullClassName = "Boilerplate\SerializerBundle\Book";
    protected $testedModels                 = array("regular");
    
    protected function getTestFileBasePath() 
    {
        return dirname(__FILE__) . "/../Resources/tests/model/book";
    }
}
