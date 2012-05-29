<?php
namespace Boilerplate\SerializerBundle;

use JMS\SerializerBundle\Annotation\AccessType;
use JMS\SerializerBundle\Annotation\XmlRoot;
use JMS\SerializerBundle\Annotation\Type;
use JMS\SerializerBundle\Annotation\XmlAttribute;
use JMS\SerializerBundle\Annotation\SerializedName;

/**  
 * @AccessType("public_method")
 * @XmlRoot("book")
 */
class Book 
{
    /** 
     * @Type("string") 
     */
    protected $name;
    
    /** 
     * @Type("DateTime") 
     * @XmlAttribute
     * @SerializedName("published-date")
     */
    protected $publishedDate;
    
    /** 
     * @Type("integer")
     * @XmlAttribute
     * @SerializedName("pages") 
     */
    protected $numberOfPages;
    
    function __construct($name = null, $publishedDate = null, $numberOfPages = null) 
    {
        $this->name = $name;
        $this->publishedDate = $publishedDate;
        $this->numberOfPages = $numberOfPages;
    }
    
    public function getName() 
    {
        return $this->name;
    }

    public function setName($name) 
    {
        $this->name = $name;
    }

    public function getPublishedDate() 
    {
        return $this->publishedDate;
    }

    public function setPublishedDate($publishedDate) 
    {
        $this->publishedDate = $publishedDate;
    }

    public function getNumberOfPages() 
    {
        return $this->numberOfPages;
    }

    public function setNumberOfPages($numberOfPages) 
    {
        $this->numberOfPages = $numberOfPages;
    }
}
