<?php

namespace App\Controller;

use App\Core\Application;
use App\Core\Controller;
use App\Core\Request;
use App\Model\Item;
use App\Service\TimeRemaining\TimeRemaining;

class HomeController extends Controller{

    public function index() {

        $item = new Item();
        // $searchedItem = Item::findOne(['id' => '1']);
        $items = Item::findAllActive();
        for($i=0; $i<sizeof($items); $i++){
            $items[$i]['status'] = Item::STATUS[$items[$i]['status']];
            $items[$i]['dater'] = new \DateTime($items[$i]['dater']);
            $items[$i]['timeRemaining'] = TimeRemaining::calculate($items[$i]['dater']);
            $items[$i]['active'] = ($items[$i]['timeRemaining'] === TimeRemaining::EXPIRED) ? 'expired' : 'active';
        }

        return $this->render('home', [
            'item' => $item,
            'items' => $items
            ]);

    }


    public function create(Request $request) {
        
        $item = new Item();

        if ($request->isPost()) {
            
            $item->loadData($request->getBody());
            if ($item->validate()) {

                // because the date it's send as a string we should reassigned it as a date
     
                $item->save();

                Application::$app->response->redirect('/');

            }
            
            return $this->render('home', [
                'item' => $item
                ]);
        }

    }

}