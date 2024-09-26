<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Validator\Validator\ValidatorInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product')]
    public function index(): Response
    {
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }


    #[Route('/product/createProduct', name: 'app_create_product')]
    public function createProduct(EntityManagerInterface $entityManager, ValidatorInterface $validator): Response
    {
        $product = new Product();
        $product->setName('mouse');
        $product->setDescription('blablabla');
        $product->setNote(3);
        $errors = $validator->validate($product);
        if (count($errors) > 0) {
            return new Response((string) $errors, 400);
        }
        else
        {
            $entityManager->persist($product);

            // actually executes the queries (i.e. the INSERT query)
            $entityManager->flush();
            return new Response('Saved new product with id '.$product->getId());
        }
    }

    #[Route('/product/searchByName/{name}', name:'product_searchName')]
    public function showSearch (ProductRepository $productRepository,EntityManagerInterface $entityManager, string $name): Response
    {
        $products = $productRepository
        ->findAll();
        if (!$products) {
            throw $this->createNotFoundException(
                'No product found for id '.$name
            );
        }
        $blablabla=implode(" ",$products);
        echo $blablabla;
        return new Response('Check out this great product: ');
    }
    
    #[Route('/product/{id}', name: 'product_show')]
    public function show(ProductRepository $productRepository, int $id): Response
    {
        $product = $productRepository
        ->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        return new Response('Check out this great product: '.$product->getName());

        // or render a template
        // in the template, print things with {{ product.name }}
        // return $this->render('product/show.html.twig', ['product' => $product]);
    }
}
