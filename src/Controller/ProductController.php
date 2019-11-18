<?php

namespace App\Controller;

use App\Form\EditType;
use App\Entity\Product;
use App\Form\ProductType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    /**
     * @Route("/", name="product")
     */
    public function index(Request $request, ObjectManager $manager)
    {
        $produit = new Product();


        $form = $this->createForm(ProductType::class, $produit);


        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {


            $manager->persist($produit);
                    $manager->flush();
                    return $this->redirectToRoute('show');
        }

        $this->addFlash(
            'success',
            "Le produit a bien été ajouté"
        );



     return $this->render('product/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }



     /**
     * @Route("/show/{id}/delete", name = "product_delete")
     * 
     */

    public function delete(Product $produit, ObjectManager $manager)
    {
        $manager->remove($produit);
        $manager->flush();

        $this->addFlash(
            'success',
            "Le produit a bien été supprimé"
        );



        return $this->redirectToRoute("show");
    }





}