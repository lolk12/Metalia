<?php
/**
 * Created by PhpStorm.
 * User: Алеша
 * Date: 19.07.2017
 * Time: 14:08
 */

namespace app\controllers;

use yii\web\Controller;
use app\models\TreeMenu;

class MenuController extends Controller
{
    public $layout = 'admin';

    public function actionIndex(){
        return $this->render('index');
    }

    public function actionGetData(){
        $treeMenu = new TreeMenu();

        $data = $treeMenu->find()
            ->Where(['status' => $treeMenu::STATUS_NEW])
            ->all();
        $dataPull = [];
        foreach ($data as $key){
            $mass = [
                [
                    'id' => $key['id'],
                    'parent' => $key['parent'],
                    'name' => $key['name'],
                ]
            ];
            $dataPull = array_merge($dataPull, $mass);
        }

        return json_encode($dataPull);
    }

    public function actionUpdate(){
        $treeMenu = new TreeMenu();

        if(\Yii::$app->user->identity->superadmin){
            $treeMenu->parent = $_POST['parent'];
            $treeMenu->name = $_POST['name'];
            $treeMenu->status = $treeMenu::STATUS_NEW;
            if($treeMenu->save()){
                return $treeMenu->id;
            }
        }
        return $this->redirect('/admin/index');


    }

    public function actionDelete(){
        $treeMenu = new TreeMenu();

        if(\Yii::$app->user->identity->superadmin){
            $connection = \Yii::$app->db;

            $id = $_POST['id'];

            $connection->createCommand()->update('tree_menu', ['status' => $treeMenu::STATUS_DELETED], "id = $id")->execute();
            $connection->createCommand()->update('tree_menu', ['status' => $treeMenu::STATUS_DELETED], "parent = $id")->execute();
            return true;
        }
    }
}