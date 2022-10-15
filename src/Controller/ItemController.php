<?php

namespace App\Controller;

use App\Core\Application;
use App\Core\Controller;
use App\Core\Request;
use App\Model\Item;
use App\Service\TimeRemaining\TimeRemaining;

class ItemController extends Controller{

    public function index() {

        $items = Item::findAll();
        for($i=0; $i<sizeof($items); $i++){
            $items[$i]['status'] = Item::STATUS[$items[$i]['status']];
            $items[$i]['dater'] = new \DateTime($items[$i]['dater']);
            $items[$i]['timeRemaining'] = TimeRemaining::calculate($items[$i]['dater']);
            $items[$i]['active'] = ($items[$i]['timeRemaining'] === TimeRemaining::EXPIRED) ? 'expired' : 'active';
            $items[$i]['isFinished'] = ($items[$i]['status'] == 'Finished') ? 'finished' : "";
        }

        return $this->render('item/index', [
            'items' => $items
            ]);
        
    }

    public function show(Request $request) {
        
        if ($request->isPost()) {

            $id = $request->getBody()['item'];
            $item = Item::findOne(['id' => $id]);

            if($item){
                $item->update($id, 'status', 0);
                Application::$app->response->redirect('/');
            }

        }
        
        Application::$app->response->redirect('/');
    }


}