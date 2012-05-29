<?php
namespace Boilerplate\SerializerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Boilerplate\SerializerBundle\Book;

class BookController extends Controller
{
    
    public function indexAction($id, $_format)
    {
        $book = new Book("Symfony 2 cookbook (id : $id)", new \DateTime("now"), 13);
        return new Response($this->get("serializer")->serialize($book, $_format));
    }
}
