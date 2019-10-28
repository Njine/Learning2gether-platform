<?php

namespace App\Controller;

use App\Entity\Language;
use App\Entity\LearningModule;
use App\Entity\LearningModuleTranslation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;



class PortalController extends AbstractController
{
    /**
     * @Route("/{_locale}/portal", name="app_portal")
     */
    public function index()
    {
        $language = $this->getDoctrine()->getRepository(Language::class)->find(1);
        $modules = $this->getDoctrine()->getRepository(LearningModule::class)->findBy(['isPublished' => true]);
        return $this->render('portal/index.html.twig', [
            'controller_name' => 'PortalController',
            'language' => $language,
            'modules' => $modules,
        ]);
    }
}
