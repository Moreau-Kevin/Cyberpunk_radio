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
        $product->setPrice(40);
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

        $specificProduct= $productRepository->findBy(['Name'=>$name]);
        echo print_r($specificProduct);
        $lenght_of_array=sizeof($products);
        for ($i=0; $i<$lenght_of_array;$i++)
        {
            echo $products[$i]->getName() ," ",$products[$i]->getDescription(), "<br>";
        }
        //var_dump($products);
        echo  "<br>";
        echo  "<br>";
        //echo $products[0]->getName();
        echo  "<br>";
        echo  "<br>";
        return new Response('Check out this great product: ');
    }
    /**
     * Fetch via primary key because {id} is in the route.
     */
    #[Route('/product/{id}', name:'product_show')]
    public function showByPk(Product $product): Response
    {
        return new Response('Check out this great product: '.$product->getName());
    }

    #[Route('/product/edit/{id}', name: 'product_edit')]
    public function update(EntityManagerInterface $entityManager, int $id): Response
    {
        $product = $entityManager->getRepository(Product::class)->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $product->setName('speaker');
        $entityManager->flush();

        return $this->redirectToRoute('product_show', [
            'id' => $product->getId()
        ]);
    }
    #[Route('/product/delete/{id}', name: 'product_delete')]
    public function delete(EntityManagerInterface $entityManager, int $id): Response
    {
        $product = $entityManager->getRepository(Product::class)->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $entityManager->remove($product);
        $entityManager->flush();

        return new Response('Product delete');
    }

    #[Route('/product/PersonnalQuery/findAllGreaterThanPrice/{minPrice}', name: 'product_findAllGreaterThanPrice')]
    public function findAllGreaterThanPrice(EntityManagerInterface $entityManager, int $minPrice):Response
    {
        $products = $entityManager->getRepository(Product::class)->findAllGreaterThanPrice($minPrice);
        $lenght_of_array=sizeof($products);
        echo print_r($products);
        echo "<br>";
        echo "<br>";
        while($element = current($products)) {
            echo key($products)."\n";
            next($products);
        }
        echo "<br>";
        echo "<br>";
        foreach($products[0] as $secondkey => $SecondValue)
        {
            echo $secondkey;
            echo " ";
        }
        echo "<br>";
        echo "<br>";
        foreach($products as $key => $value) 
        {
            foreach($products[$key] as $secondkey => $SecondValue)
            {
                echo $SecondValue," ";
            }
            echo "<br>";
            echo "<br>";
        }
        return new Response('Check out this great product: ');
    }
}