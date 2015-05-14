<?php

namespace EgitimBundle\Controller;

use EgitimBundle\Entity\Ogrenciler;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EgitimBundle:Default:index.html.twig');
    }

    public function ogrenciEkleAction(Request $request)
    {

        /**
         * POST ile gelen verileri değişkenlere atayalım.
         */
        $ad     = $request->request->get('ad');

        $soyad  = $request->request->get('soyad');

        $gonder = $request->request->get('gonder');

        /**
         * Gönder butonuna basıldıysa.
         */
        if($gonder == "kaydet")
        {
            $em = $this->getDoctrine()->getManager();

            $yeni_ogrenci = new Ogrenciler();
            $yeni_ogrenci ->setAd($ad);
            $yeni_ogrenci ->setSoyad($soyad);

            /**
             * Enter'a bas.
             */
            $em->persist($yeni_ogrenci);
            $em->flush();
        }


        return $this->redirect($this->generateUrl('listele'));

    }


    public function listeleAction()
    {
        $em = $this->getDoctrine()->getManager();

        /**
         *  select * from ogrenciler
         */
        $ogrenciler = $em ->getRepository('EgitimBundle:Ogrenciler')->findAll();


        return $this->render('EgitimBundle:Default:listele.html.twig',array('ogrenciler'=>$ogrenciler));
    }

    public function duzenleFormAction($id)
    {
        /**
         * Gelen id'deki kullanıcının verilerini ekrana form içierisinden baas.
         */
        $em = $this->getDoctrine()->getManager();

        /**
         *  select * from ogrenciler where id = id
         */
        $ogrenciler = $em ->getRepository('EgitimBundle:Ogrenciler')->findBy(array('id'=>$id));

        return $this->render('EgitimBundle:Default:duzenle.html.twig',array('ogrenciler'=>$ogrenciler));
    }

    public function guncelleAction(Request $request)
    {

        /**
         * Gelen id'deki kullanıcının verilerini ekrana form içierisinden baas.
         */
        $em = $this->getDoctrine()->getManager();

        /**
         * POST ile gelen verileri değişkenlere atayalım.
         */
        $id     = $request->request->get('id');

        $ad     = $request->request->get('ad');

        $soyad  = $request->request->get('soyad');

        $gonder = $request->request->get('gonder');


        if($gonder == "kaydet")
        {
            $em = $this->getDoctrine()->getManager();

            /**
             * entitty içerisindeki class'ları çağır ve bu classlarla veritabanına veri yükleme düzenleme güncelleme silme işlemler için hazırlık yap.
             * Id bazlı arama.
             */
            $yeni_ogrenci = $em->getRepository('EgitimBundle:Ogrenciler')->find($id);

            $yeni_ogrenci ->setAd($ad);
            $yeni_ogrenci ->setSoyad($soyad);
            $em->flush();

        }


        return $this->redirect($this->generateUrl('listele'));
    }

    public function silAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $kisi = $em->getRepository('EgitimBundle:Ogrenciler')->find($id);

        $em->remove($kisi);
        $em->flush();

        return $this->redirect($this->generateUrl('listele'));
    }
}
