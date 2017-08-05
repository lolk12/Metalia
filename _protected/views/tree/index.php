<div class="block" style="padding-top: 40px; padding-bottom: 40px;">
    <?php
    use kartik\tree\TreeView;
    use app\models\TreeFolder;
    echo TreeView::widget([
        // single query fetch to render the tree
        // use the Product model you have in the previous step
        'query' => TreeFolder::find()->addOrderBy('root, lft'),
        'headingOptions' => ['label' => 'Categories'],
        'fontAwesome' => false,     // optional
        'isAdmin' => true,         // optional (toggle to enable admin mode)
        'displayValue' => 1,        // initial display value
        'softDelete' => false,       // defaults to true
        'cacheSettings' => [
            'enableCache' => true   // defaults to true
        ]
    ]);

    use kartik\tree\TreeViewInput;
    echo TreeViewInput::widget([
        // single query fetch to render the tree
        'query'             => TreeFolder::find()->addOrderBy('root, lft'),
        'headingOptions'    => ['label' => 'Categories'],
        'name'              => 'kv-product',    // input name
        'value'             => '1,2,3,4,5',         // values selected (comma separated for multiple select)
        'asDropdown'        => false,            // will render the tree input widget as a dropdown.
        'multiple'          => true,            // set to false if you do not need multiple selection
        'fontAwesome'       => true,            // render font awesome icons
        'rootOptions'       => [
            'label' => '<i class="fa fa-tree s"></i>',
            'class'=>'text-success'
        ],                                      // custom root label
        'options'         => ['disabled' => true],
    ]);
    ?>
</div>