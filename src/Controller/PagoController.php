<?php

namespace App\Controller;

use App\Entity\Pago;
use App\Form\PagoType;
use App\Form\PagoEditAdminType;
use App\Repository\PagoRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/pago")
 */
class PagoController extends AbstractController
{
    /**
     * @Route("/", name="pago_index", methods={"GET"})
     */
    public function index(PagoRepository $pagoRepository): Response
    {
        $pagos = "";
        $user = $this->getUser();
        if ($user->hasRole ('ROLE_ADMIN')) {
            $pagos = $pagoRepository->findAll();
        }else{
            $pagos = $pagoRepository->findBy(['userCreator' => $user]);
        }

        return $this->render('pago/index.html.twig', [
            'pagos' => $pagos,
        ]);
    }

    /**
     * @Route("/new", name="pago_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $pago = new Pago();
        $pago->setUserCreator($this->getUser());
        $form = $this->createForm(PagoType::class, $pago);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->formarYSetaerNombreDeArchivo($form, $pago);
            $pago->setCreatedAt(new DateTime('now'));
            //dd($pago);
            $entityManager->persist($pago);
            $entityManager->flush();

            return $this->redirectToRoute('pago_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pago/new.html.twig', [
            'pago' => $pago,
            'form' => $form,
        ]);
    }

    public function formarYSetaerNombreDeArchivo($form, Pago $pago)
    {
        $nombreDeComprobante = $form->get('nombreDeComprobante')->getData();
        if ($nombreDeComprobante) {
            $originalFilenameMono = pathinfo($nombreDeComprobante->getClientOriginalName(), PATHINFO_FILENAME);
            $fechaActual = new DateTime('now');
            $newFilenameMono = 'comp_' . $fechaActual->format('d_m_Y_H_i_s') . '.' .$nombreDeComprobante->guessExtension();
            
            try {
                $nombreDeComprobante->move(
                    $this->getParameter('constancias_pago_directory'),//constancias_pago_directory configurado en el services.yarm
                    $newFilenameMono
                );
                $pago->setNombreDeComprobante($newFilenameMono);
            } catch (FileException $e) {
                $this->addFlash('danger', 'Ocurrió un error inesperado al cargar el archivo');
                // ... handle exception if something happens during file upload
            }
        }
    } 
    /**
     * @Route("/{id}", name="pago_show", methods={"GET"})
     */
    public function show(Pago $pago): Response
    {
        return $this->render('pago/show.html.twig', [
            'pago' => $pago,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="pago_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Pago $pago, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PagoType::class, $pago);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->formarYSetaerNombreDeArchivo($form, $pago);

            $pago->setUserUpdater($this->getUser());
            $pago->setCreatedAt(new DateTime('now'));
            $entityManager->flush();

            return $this->redirectToRoute('pago_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pago/edit.html.twig', [
            'pago' => $pago,
            'form' => $form,
        ]);
    }
/**
     * @Route("/{id}/edit_admin", name="pago_edit_admin", methods={"GET", "POST"})
     */
    public function editAdmin(Request $request, Pago $pago, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PagoEditAdminType::class, $pago);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if($form->get('causaDeRechazo')->getData() == null || $pago->getEstado() != 'Rechazado'){
                $pago->setCausaDeRechazo('');    
            }
            $pago->setUserUpdater($this->getUser());
            $pago->setCreatedAt(new DateTime('now'));
            $entityManager->flush();

            return $this->redirectToRoute('pago_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pago/edit.html.twig', [
            'pago' => $pago,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="pago_delete", methods={"POST"})
     */
    public function delete(Request $request, Pago $pago, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pago->getId(), $request->request->get('_token'))) {
            $entityManager->remove($pago);
            $entityManager->flush();
        }

        return $this->redirectToRoute('pago_index', [], Response::HTTP_SEE_OTHER);
    }
}
