<?php

namespace Controllers;
use Model\Activity;
use Model\Category;
use Model\Content;
use Model\Day;
use Model\Event;
use Model\Hour;
use Model\News;
use Model\Area;
use Model\Speaker;
use Model\Member;
use Model\Tools;
use Model\Material;
use Model\Article;
use MVC\Router;

class PagesController {
    public static function index(Router $router) {
        $contents = Content::order('id', 'ASC');
        $content_formatted = [];
        foreach($contents as $content) {
            
            if($content->id === "1") {
                $content_formatted['Description'][] = $content;
            }

            if($content->id === "2") {
                $content_formatted['About_us'][] = $content;
            }
        }
        
        $newss = News::order('id', 'ASC');
        $news_formatted = [];
        //debuguear($content_formatted);
        foreach($newss as $new) {
            if($new->id !== null && $new->category_id === "1") {
                $news_formatted['NewsCapture'][] = $new;
            }
        }
        //debuguear($news_formatted);

        $router->render('paginas/home/home', [
            'title' => 'Inicio',
            'contents' => $content_formatted,
            'news' => $news_formatted
        ]);
    }


    public static function peopleDevelopment(Router $router) {
        $members = Member::all();
        foreach ($members as $member) {
          $member->area = Area::find($member->area_id);
        }
        // Obtener cantidad de miembros
        $innovacion = Member::total('area_id', 1);
        $marketing = Member::total('area_id', 2);
        $peopleDevelopment = Member::total('area_id', 3);
        $invCientifica = Member::total('area_id', 4);


        $router->render('paginas/people/people-development', [
            'title' => 'Inicio',
            'members' => $members,
            'innovacion' => $innovacion,
            'marketing' => $marketing,
            'peopleDevelopment' => $peopleDevelopment,
            'invCientifica' => $invCientifica,
        ]);
    }

    public static function marketing(Router $router) {

        $events = Event::all();
    
        $activities = Activity::order('id', 'ASC');

        $events_formatted = [];
        $content_formatted = [];
        $formattedDate = [];

        foreach($events as $event) {
            $event->category = Category::find($event->category_id);
            $event->speaker = Speaker::find($event->speaker_id);
            $originalDate = $event->date;
            $date = date_create_from_format('Y-m-d', $originalDate);
            $formattedDate = date_format($date, 'd-m-Y');
            if($event->category_id === "1") {
                $events_formatted['conferences'][] = $event;
            }

            if($event->category_id === "2") {
                $events_formatted['workshops'][] = $event;
            }
        }
        //debuguear($formattedDate);

        foreach($activities as $activity) {
                
            if($activity->id !== null) {
                $content_formatted['activityCapture'][] = $activity;
            }
        }
        //debuguear($activity);

        // Speakers
        $speakers = Speaker::all();

        $router->render('paginas/marketing/marketing', [
            'title' => 'Marketing',
            'events' => $events_formatted,
            'speakers' => $speakers,
            'activities' => $activities,
            'activity' => $content_formatted,
            'formattedDate' => $formattedDate
        ]);

    }

    public static function error(Router $router) {
        $router->render('paginas/error', [
            'title' => 'Página no encontrada'
        ]);
    }

    public static function investigationCientific(Router $router) {
      $materials = Material::all();
      $articles = Article::all();
      $router->render('paginas/investigation/investigation-Cientific', [
          'title' => 'Investigación Científica',
          'materials' => $materials,
          'articles' => $articles,
      ]);
    }

    public static function innovation(Router $router) {
        $newss = News::order('id', 'ASC');
        $news_formatted = [];

        $tools = Tools::order('id', 'ASC');
        $tools_formated = [];
        //debuguear($content_formatted);
        foreach($newss as $new) {
            if($new->id !== null && $new->category_id === "2") {
                $news_formatted['NewsCapture'][] = $new;
            }
        }
        foreach($tools as $tool) {
            if($tool->id !== null) {
                $tools_formated['ToolsCapture'][] = $tool;
            }
        }
        //debuguear($tools_formated);

        $router->render('paginas/innovation/innovation', [
            'title' => 'Innovación',
            'news' => $news_formatted,
            'tools' => $tools_formated
        ]);

    }
}
