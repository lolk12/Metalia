<?php
/**
 * Created by PhpStorm.
 * User: Алеша
 * Date: 19.07.2017
 * Time: 14:14
 */
use app\assets\AppAssetTender;
use app\assets\AppAssetMenu;

AppAssetTender::register($this);
AppAssetMenu::register($this);
?>

<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="row indent">
            <div class="col-md-8">
                <ul class="catalog" id="catalog_id_0"></ul>
            </div>
            <div class="col-md-4">
                <input type="text" name="nameCatalog" placeholder="Название">
                <button class="sendCatalog">Добавить</button>
            </div>
            <div class="col-md-4">
                <button class="deleteCatalog">Удалить</button>
            </div>
        </div>
    </div>
    <div class="col-md-1"></div>
</div>