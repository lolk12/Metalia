<?php
namespace app\helpers;


use Yii;
use yii\base\Widget;

/**
 * Menu helper class.
 */
class MenuHelper extends Widget
{

	/**
	 * Creates main menu items depending on the user roles
	 * 
	 * @return string[][]|string[]|string[][][] array of menu items
	 */
	public static function getMainMenuItems()
	{

 		
 		$submenuItemsSail[] = ['label' => Yii::t('app', 'Создать тендер'), 'url' => ['/tender/signup'] ];
        $submenuItemsSail[] = ['label' => Yii::t('app', 'Посмотреть все тендеры'), 'url' => ['/tender/all-tender']];
        $submenuItemsSail[] = ['label' => Yii::t('app', 'Мои тендеры'), 'url' => ['/tender/index']];
        $submenuItemsSail[] = ['label' => Yii::t('app', 'История тендеров'), 'url' => ['/tender/history']];
        $submenuItemsSail[] = ['label' => Yii::t('app', 'Карточка компании'), 'url' => ['/company/index']];

        $menuItems[] = ['label' => Yii::t('app','Торговля'),'url' =>['/admin/#1'], 'items' => $submenuItemsSail,'options'=>['class'=>'dropdown']];

		$submenuItemsAdmin [] = ['label'=> Yii::t('app', 'Управление доступом'), 'url' =>['/admin/#2.1.1'] , 'items'=>[

                ['options'=>['style'=>'padding-left: 20px'],'label'=> Yii::t('app', 'Пользователи'), 'url' =>['/user-management/user/index']],
                ['options'=>['style'=>'padding-left: 20px'],'label' => Yii::t('app', 'Роли'), 'url' => ['/user-management/role/index']],
                ['options'=>['style'=>'padding-left: 20px'],'label' => Yii::t('app', 'Права'), 'url' => ['/user-management/permission/index']],
                ['options'=>['style'=>'padding-left: 20px'],'label' => Yii::t('app', 'Группы прав'), 'url' => ['/user-management/auth-item-group/index']],
                ['options'=>['style'=>'padding-left: 20px'],'label' => Yii::t('app', 'История размищений'), 'url' => ['/user-management/user-visit-log/index']],
            ],


        ];
        $submenuItemsAdmin [] = ['label'=> Yii::t('app', 'Компании'), 'url' =>['/admin/signup']];
        $submenuItemsAdmin [] = ['label'=> Yii::t('app', 'Каталог товаров'), 'url' =>['/tree/index']];
        $submenuItemsAdmin [] = ['label'=> Yii::t('app', 'Новости'), 'url' =>['/blog/index']];
        $submenuItemsAdmin [] = ['label'=> Yii::t('app', 'Верификация'), 'url' =>['#'], 'items'=> [

            ['options'=>['style'=>'padding-left: 20px'],'label'=> Yii::t('app', 'Пользователи'), 'url' =>['/verified-user/index']],
            ['options'=>['style'=>'padding-left: 20px'],'label'=> Yii::t('app', 'Компании'), 'url' =>['/verified-company/index']],
            ['options'=>['style'=>'padding-left: 20px'],'label'=> Yii::t('app', 'Тендеры'), 'url' =>['/verified-tender/index']],


        ]];



        $menuItems[] = ['label' => Yii::t('app', 'Администрирование'),'url' => ['admin/#2'], 'items' => $submenuItemsAdmin];
		 //to display Customer block
//		if (Yii::$app->user->identity->email()) {
//			$menuItems[] = ['label' => Yii::t('app', 'АДМИН'), 'url' => ['admin/add-admin/#3']];
//		}
//
//		// to display Operator block
//		if (Yii::$app->user->can('operator')) {
//			$menuItems[] = ['label' => Yii::t('app', 'Operate'), 'url' => ['/operator/index']];
//		}
//
//		// display Users to admin+ roles
//		if (Yii::$app->user->can('admin')){
//			$menuItems[] = ['label' => Yii::t('app', 'Manage'), 'url' => ['/user/index']];
//		}
//
//		// display Logout to logged in users
//		if (!Yii::$app->user->isGuest) {
//			$menuItems[] = [
//					'label' => Yii::t('app', 'Logout'). ' (' . Yii::$app->user->identity->username . ')',
//					'url' => ['/site/logout'],
//					'linkOptions' => ['data-method' => 'post']
//			];
//		}
//
//		// display Reg and Login pages to guests of the site
//		if (Yii::$app->user->isGuest) {
//			$menuItems[] = ['label' => Yii::t('app', 'Reg'), 'url' => ['/site/signup']];
//			$menuItems[] = ['label' => Yii::t('app', 'Login'), 'url' => ['/site/login']];
//		}
		return $menuItems;
	}

	
	/**
	 * Creates Admin menu
	 * @return string[][]|string[]|string[][][]|string[][][][]|string[][][][][]
	 */
	public static function getAdminMenuItems()
	{
//		$menuItems[] = ['label' => Yii::t('app', 'Main'), 'url' => ['/admin/index']];
		$menuItems[] = ['label' => Yii::t('app', 'UserManagement'), 'url' => ['user/index'], 'items' => [
					['label' => Yii::t('app', 'CreateUser'), 'url' => ['user/create']],
					['label' => Yii::t('app', 'ManageUsers'), 'url' => ['user/view-all']],
			]];
		$menuItems[] = ['label' => Yii::t('app', 'CompanyManagement'), 'url' => ['company/index'], 'items' => [
				['label' => Yii::t('app', 'CreateCompany'), 'url' => ['company/create']],
				['label' => Yii::t('app', 'ManageCompanies'), 'url' => ['company/view-all']],
		]];
		
		return $menuItems;
	}
	
	/**
	 * Creates Operator menu
	 * @return string[][]|string[]|string[][][]|string[][][][]|string[][][][][]
	 */
	public static function getOperatorMenuItems()
	{		
		$menuItems[] = ['label' => Yii::t('app', 'Main'), 'url' => ['/operator/index']];
		$menuItems[] = ['label' => Yii::t('app', 'GoodsCatalog'), 'url' => ['goods/index'], 'items' => [
				['label' => Yii::t('app', 'CreateGoods'), 'url' => ['goods/create']],
				['label' => Yii::t('app', 'ManageGoods'), 'url' => ['goods/view-all']],
		]];
		$menuItems[] = ['label' => Yii::t('app', 'NewsManagement'), 'url' => ['/news/index'], 'items' => [
				['label' => Yii::t('app', 'CreateNews'), 'url' => ['/news/create']],
				['label' => Yii::t('app', 'ManageNews'), 'url' => ['/news/view-all']],
		]];
		return $menuItems;
	}
	
	/**
	 * Creates Buyer menu
	 * @return string[][]|string[]|string[][][]|string[][][][]|string[][][][][]
	 */
	public static function getCustomerMenuItems()
	{
		$menuItems[] = ['label' => Yii::t('app', 'Main'), 'url' => ['/customer/index']];
		
// 		Tender Menu
		if (Yii::$app->user->can('seller')) {
			$submenuItems[] = ['label' => Yii::t('app', 'CreateTender'), 'url' => ['tender/create']];
			$submenuItems[] = ['label' => Yii::t('app', 'MyTenders'), 'url' => ['tender/my-tenders']];
		}		
		$submenuItems[] = ['label' => Yii::t('app', 'AllTenders'), 'url' => ['tender/active-tenders']];
		$submenuItems[] = ['label' => Yii::t('app', 'TenderHistory'), 'url' => ['tender/tender-history']];
		
		$menuItems[] = ['label' => Yii::t('app', 'Tenders'), 'url' => ['/tender/index'], 'items' => $submenuItems];
		
// 		Order Menu
//		$submenuItems1[] = ['label' => Yii::t('app', 'OpenOrders'), 'url' => ['/customer/index']];
//		$submenuItems1[] = ['label' => Yii::t('app', 'OrderHistory'), 'url' => ['/customer/index']];
//		$menuItems[] = ['label' => Yii::t('app', 'Orders'), 'url' => ['/customer/index'], 'items' => $submenuItems1];
		
// 		Raiting manu
//		$menuItems[] = ['label' => Yii::t('app', 'Raiting'), 'url' => ['/customer/index']];
		
		return $menuItems;
	}
	
}