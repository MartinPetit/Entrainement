<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ShowController extends AbstractController
{
    /**
     * @Route("/show", name="show")
     */
    public function show(ProductRepository $repo)
    {
        $product = $repo->findAll();

        return $this->render('show/index.html.twig', [
            'product' => $product
        ]);
    }



     /**
     * @Route("/show/{id}/edit", name = "product_edit", methods={"GET","POST"})
     * 
     */

    public function edit(Product $produit, Request $request, ObjectManager $manager)
    {


        $form = $this->createForm(ProductType::class, $produit);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $manager->flush();


            return $this->redirectToRoute('show');
        }

        $this->addFlash(
            'success',
            "Le produit a bien été modifié"
        );

        return $this->render('show/edit.html.twig', [
            'form' => $form->createView(),
            'produit' => $produit
        ]);


}
}
