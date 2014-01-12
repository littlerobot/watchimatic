<?php

namespace LittleRobot\Watchimatic\RecommendationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Wubs\Trakt\Trakt;

class DefaultController extends Controller
{
    public function recommendAction()
    {
        $this->container->get('little_robot_trakt_api_wrapper.client');
        $username = $this->container->getParameter('little_robot_trakt_api_wrapper.username');
        $password = sha1($this->container->getParameter('little_robot_trakt_api_wrapper.password'));
        $recommendations = Trakt::post('recommendations/shows')
//        $res = Trakt::post('account/settings')
                ->setParams(array('username' => $username, 'password' => $password))
//                ->run()
        ;
//        file_put_contents('recommendations.shows', json_encode($res));
        $recommendations = json_decode(file_get_contents('recommendations.shows'));
        return $this->render('LittleRobotWatchimaticStaticBundle::tv.html.twig', array(
            'title' => 'Recommended TV',
            'shows' => $recommendations,
        ));
    }
}
