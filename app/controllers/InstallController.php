<?php

namespace app\controllers;

use Yii;
use yii\easyii\models\InstallForm;
use yii\easyii\models\Photo;
use yii\easyii\models\SeoText;
use yii\easyii\modules\carousel\models\Carousel;
use yii\easyii\modules\catalog;
use yii\easyii\modules\article;
use yii\easyii\modules\faq\models\Faq;
use yii\easyii\modules\file\models\File;
use yii\easyii\modules\gallery;
use yii\easyii\modules\guestbook\models\Guestbook;
use yii\easyii\modules\news\models\News;
use yii\easyii\modules\page\models\Page;
use yii\easyii\modules\text\models\Text;

class InstallController extends \yii\web\Controller
{
    public $layout = 'install';
    public $defaultAction = 'step1';
    public $db;

    public $dbConnected = false;
    public $adminInstalled = false;
    public $shopInstalled = false;

    public function init()
    {
        parent::init();

        $this->db = Yii::$app->db;
        try {
            Yii::$app->db->open();
            $this->dbConnected = true;
            $this->adminInstalled = Yii::$app->getModule('admin')->installed;
            if($this->adminInstalled) {
                $this->shopInstalled = Page::find()->count() > 0 ? true : false;
            }
        }
        catch(\Exception $e){
            $this->dbConnected = false;
        }
    }

    public function actionStep1()
    {
        if($this->adminInstalled){
            return $this->redirect($this->shopInstalled ? ['/'] : ['/install/step3']);
        }
        return $this->render('step1');
    }

    public function actionStep2()
    {
        if($this->adminInstalled){
            return $this->redirect($this->shopInstalled ? ['/'] : ['/install/step3']);
        }
        $this->registerI18n();

        $installForm = new InstallForm();
        $installForm->robot_email = 'noreply@'.Yii::$app->request->serverName;

        Yii::$app->session->setFlash(InstallForm::RETURN_URL_KEY, '/install/step3');

        return $this->render('step2', ['model' => $installForm]);
    }

    public function actionStep3()
    {
        $result = [];
        $result[] = $this->insertTexts();
        $result[] = $this->insertPages();
        $result[] = $this->insertCatalog();
        $result[] = $this->insertNews();
        $result[] = $this->insertArticles();
        $result[] = $this->insertGallery();
        $result[] = $this->insertGuestbook();
        $result[] = $this->insertFaq();
        $result[] = $this->insertCarousel();
        $result[] = $this->insertFiles();

        return $this->render('step3', ['result' => $result]);
    }

    private function registerI18n()
    {
        Yii::$app->i18n->translations['easyii/install'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@easyii/messages',
            'fileMap' => [
                'easyii/install' => 'install.php',
            ]
        ];
    }

    public function insertTexts()
    {
        if(Text::find()->count()){
            return '`<b>' . Text::tableName() . '</b>` table is not empty, skipping...';
        }
        $this->db->createCommand('TRUNCATE TABLE `'.Text::tableName().'`')->query();

        (new Text([
            'text' => 'Welcome on EasyiiCMS demo website',
            'slug' => 'index-welcome-title'
        ]))->save();

        return 'Text data inserted.';
    }

    public function insertPages()
    {
        if(Page::find()->count()){
            return '`<b>' . Page::tableName() . '</b>` table is not empty, skipping...';
        }
        $this->db->createCommand('TRUNCATE TABLE `'.Page::tableName().'`')->query();

        $page1 = new Page([
            'title' => 'Index',
            'text' => '<p><strong>All elements are live-editable, switch on Live Edit button to see this feature.</strong>&nbsp;</p><p>Dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.&nbsp;Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
            'slug' => 'page-index'
        ]);
        $page1->save();
        $this->attachSeo($page1, '', 'EasyiiCMS demo', 'yii2, easyii, admin');

        $page2 = new Page([
            'title' => 'Shop',
            'text' => '',
            'slug' => 'page-shop'
        ]);
        $page2->save();
        $this->attachSeo($page2, 'Shop categories', 'Extended shop title');

        $page3 = new Page([
            'title' => 'Shop search',
            'text' => '',
            'slug' => 'page-shop-search'
        ]);
        $page3->save();
        $this->attachSeo($page3, 'Shop search results', 'Extended shop search title');

        $page4 = new Page([
            'title' => 'Shopping cart',
            'text' => '',
            'slug' => 'page-shopcart'
        ]);
        $page4->save();
        $this->attachSeo($page4, 'Shopping cart H1', 'Extended shopping cart title');

        $page5 = new Page([
            'title' => 'Order created',
            'text' => '<p>Your order successfully created. Our manager will contact you as soon as possible.</p>',
            'slug' => 'page-shopcart-success'
        ]);
        $page5->save();
        $this->attachSeo($page5, 'Success', 'Extended order success title');

        $page6 = new Page([
            'title' => 'News',
            'text' => '',
            'slug' => 'page-news'
        ]);
        $page6->save();
        $this->attachSeo($page6, 'News H1', 'Extended news title');

        $page7 = new Page([
            'title' => 'Articles',
            'text' => '',
            'slug' => 'page-articles'
        ]);
        $page7->save();
        $this->attachSeo($page7, 'Articles H1', 'Extended articles title');

        $page8 = new Page([
            'title' => 'Gallery',
            'text' => '',
            'slug' => 'page-gallery'
        ]);
        $page8->save();
        $this->attachSeo($page8, 'Photo gallery', 'Extended gallery title');

        $page9 = new Page([
            'title' => 'Guestbook',
            'text' => '',
            'slug' => 'page-guestbook'
        ]);
        $page9->save();
        $this->attachSeo($page9, 'Guestbook H1', 'Extended guestbook title');

        $page10 = new Page([
            'title' => 'FAQ',
            'text' => '',
            'slug' => 'page-faq'
        ]);
        $page10->save();
        $this->attachSeo($page10, 'Frequently Asked Question', 'Extended faq title');

        $page11 = new Page([
            'title' => 'Contact',
            'text' => '<p><strong>Address</strong>: Dominican republic, Santo Domingo, Some street 123</p><p><strong>ZIP</strong>: 123456</p><p><strong>Phone</strong>: +1 234 56-78</p><p><strong>E-mail</strong>: demo@example.com</p>',
            'slug' => 'page-contact'
        ]);
        $page11->save();
        $this->attachSeo($page11, 'Contact us', 'Extended contact title');

        return 'Page data inserted.';
    }

    public function insertCatalog()
    {
        if(catalog\models\Category::find()->count()){
            return '`<b>' . catalog\models\Category::tableName() . '</b>` table is not empty, skipping...';
        }
        $this->db->createCommand('TRUNCATE TABLE `'.catalog\models\Category::tableName().'`')->query();

        $fields = [
            [
                'name' => 'brand',
                'title' => 'Brand',
                'type' => 'select',
                'options' => ['Samsung', 'Apple', 'Nokia']
            ],
            [
                'name' => 'storage',
                'title' => 'Storage',
                'type' => 'string',
                'options' => ''
            ],
            [
                'name' => 'touchscreen',
                'title' => 'Touchscreen',
                'type' => 'boolean',
                'options' => ''
            ],
            [
                'name' => 'cpu',
                'title' => 'CPU cores',
                'type' => 'select',
                'options' => ['1', '2', '4', '8']
            ],
            [
                'name' => 'features',
                'title' => 'Features',
                'type' => 'checkbox',
                'options' => ['Wi-fi', '4G', 'GPS']
            ],
            [
                'name' => 'color',
                'title' => 'Color',
                'type' => 'checkbox',
                'options' => ['White', 'Black', 'Red', 'Blue']
            ],
        ];

        $root = new catalog\models\Category([
            'title' => 'Gadgets',
            'fields' => $fields,
        ]);
        $root->makeRoot();

        $cat1 = new catalog\models\Category([
            'title' => 'Smartphones',
            'fields' => $fields,
        ]);
        $cat1->appendTo($root);
        $this->attachSeo($cat1, 'Smartphones H1', 'Extended smartphones title');

        $cat2 = new catalog\models\Category([
            'title' => 'Tablets',
            'fields' => $fields,
        ]);
        $cat2->appendTo($root);
        $this->attachSeo($cat2, 'Tablets H1', 'Extended tablets title');

        if(catalog\models\Item::find()->count()){
            return '`<b>' . catalog\models\Item::tableName() . '</b>` table is not empty, skipping...';
        }
        $time = time();

        $item1 = new catalog\models\Item([
            'category_id' => $cat1->primaryKey,
            'title' => 'Nokia 3310',
            'description' => '<h3>The legend</h3><p>The Nokia 3310 is a GSMmobile phone announced on September 1, 2000, and released in the fourth quarter of the year, replacing the popular Nokia 3210. The phone sold extremely well, being one of the most successful phones with 126 million units sold worldwide.&nbsp;The phone has since received a cult status and is still widely acclaimed today.</p><p>The 3310 was developed at the Copenhagen Nokia site in Denmark. It is a compact and sturdy phone featuring an 84 × 48 pixel pure monochrome display. It has a lighter 115 g battery variant which has fewer features; for example the 133 g battery version has the start-up image of two hands touching while the 115 g version does not. It is a slightly rounded rectangular unit that is typically held in the palm of a hand, with the buttons operated with the thumb. The blue button is the main button for selecting options, with "C" button as a "back" or "undo" button. Up and down buttons are used for navigation purposes. The on/off/profile button is a stiff black button located on the top of the phone.</p>',
            'available' => 5,
            'discount' => 0,
            'price' => 100,
            'data' => [
                'brand' => 'Nokia',
                'storage' => '1',
                'touchscreen' => '0',
                'cpu' => 1,
                'color' => ['White', 'Red', 'Blue']
            ],
            'image' => '/uploads/catalog/3310.jpg',
            'time' => $time
        ]);
        $item1->save();
        $this->attachPhotos($item1, ['/uploads/photos/3310-1.jpg', '/uploads/photos/3310-2.jpg']);
        $this->attachSeo($item1, 'Nokia 3310');

        $item2 = new catalog\models\Item([
            'category_id' => $cat1->primaryKey,
            'title' => 'Galaxy S6',
            'description' => '<h3>Next is beautifully crafted</h3><p>With their slim, seamless, full metal and glass construction, the sleek, ultra thin edged Galaxy S6 and unique, dual curved Galaxy S6 edge are crafted from the finest materials.</p><p>And while they may be the thinnest smartphones we`ve ever created, when it comes to cutting-edge technology and flagship Galaxy experience, these 5.1" QHD Super AMOLED smartphones are certainly no lightweights.</p>',
            'available' => 1,
            'discount' => 10,
            'price' => 1000,
            'data' => [
                'brand' => 'Samsung',
                'storage' => '32',
                'touchscreen' => '1',
                'cpu' => 8,
                'features' => ['Wi-fi', 'GPS']
            ],
            'image' => '/uploads/catalog/galaxy.jpg',
            'time' => $time - 86400
        ]);
        $item2->save();
        $this->attachPhotos($item2, ['/uploads/photos/galaxy-1.jpg', '/uploads/photos/galaxy-2.jpg', '/uploads/photos/galaxy-3.jpg', '/uploads/photos/galaxy-4.jpg']);
        $this->attachSeo($item2, 'Samsung Galaxy S6');

        $item3 = new catalog\models\Item([
            'category_id' => $cat1->primaryKey,
            'title' => 'Iphone 6',
            'description' => '<h3>Next is beautifully crafted</h3><p>With their slim, seamless, full metal and glass construction, the sleek, ultra thin edged Galaxy S6 and unique, dual curved Galaxy S6 edge are crafted from the finest materials.</p><p>And while they may be the thinnest smartphones we`ve ever created, when it comes to cutting-edge technology and flagship Galaxy experience, these 5.1" QHD Super AMOLED smartphones are certainly no lightweights.</p>',
            'available' => 0,
            'discount' => 10,
            'price' => 1100,
            'data' => [
                'brand' => 'Apple',
                'storage' => '64',
                'touchscreen' => '1',
                'cpu' => 4,
                'features' => ['Wi-fi', '4G', 'GPS']
            ],
            'image' => '/uploads/catalog/iphone.jpg',
            'time' => $time - 86400 * 2
        ]);
        $item3->save();
        $this->attachPhotos($item3, ['/uploads/photos/iphone-1.jpg', '/uploads/photos/iphone-2.jpg', '/uploads/photos/iphone-3.jpg', '/uploads/photos/iphone-4.jpg']);
        $this->attachSeo($item3, 'Apple Iphone 6');

        return 'Catalog data inserted.';
    }

    public function insertNews()
    {
        if (News::find()->count()) {
            return '`<b>' . News::tableName() . '</b>` table is not empty, skipping...';
        }
        $this->db->createCommand('TRUNCATE TABLE `' . News::tableName() . '`')->query();

        $time = time();

        $news1 = new News([
            'title' => 'First news title',
            'image' => '/uploads/news/news-1.jpg',
            'short' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt molliti',
            'text' => '<p><strong>Sed ut perspiciatis</strong>, unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo. nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit, amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt, ut labore et dolore magnam aliquam quaerat voluptatem.&nbsp;</p><ul><li>item 1</li><li>item 2</li><li>item 3</li></ul><p>ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? quis autem vel eum iure reprehenderit, qui in ea voluptate velit esse, quam nihil molestiae consequatur, vel illum, qui dolorem eum fugiat, quo voluptas nulla pariatur?</p>',
            'tagNames' => 'php, yii2, jquery',
            'time' => $time
        ]);
        $news1->save();
        $this->attachPhotos($news1, ['/uploads/photos/news-1-1.jpg', '/uploads/photos/news-1-2.jpg', '/uploads/photos/news-1-3.jpg', '/uploads/photos/news-1-4.jpg']);
        $this->attachSeo($news1, 'First news H1');

        $news2 = new News([
            'title' => 'Second news title',
            'image' => '/uploads/news/news-2.jpg',
            'short' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip',
            'text' => '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p><ol> <li>Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. </li><li>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</li></ol>',
            'tagNames' => 'yii2, jquery, html',
            'time' => $time - 86400
        ]);
        $news2->save();
        $this->attachSeo($news2, 'Second news H1');

        $news3 = new News([
            'title' => 'Third news title',
            'image' => '/uploads/news/news-3.jpg',
            'short' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt molliti',
            'text' => '<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</p>',
            'time' => $time - 86400 * 2
        ]);
        $news3->save();
        $this->attachSeo($news3, 'Third news H1');

        return 'News data inserted.';
    }

    public function insertArticles()
    {
        if(article\models\Category::find()->count()){
            return '`<b>' . article\models\Category::tableName() . '</b>` table is not empty, skipping...';
        }
        $this->db->createCommand('TRUNCATE TABLE `'.article\models\Category::tableName().'`')->query();

        $root1 = new article\models\Category([
            'title' => 'Articles category 1',
            'order_num' => 2
        ]);
        $root1->makeRoot();
        $this->attachSeo($root1, 'Articles category 1 H1', 'Extended category 1 title');

        $root2 = new article\models\Category([
            'title' => 'Articles category 2',
            'order_num' => 1
        ]);
        $root2->makeRoot();

        $subcat1 = new article\models\Category([
            'title' => 'Subcategory 1',
            'order_num' => 1
        ]);
        $subcat1->appendTo($root2);
        $this->attachSeo($subcat1, 'Subcategory 1 H1', 'Extended subcategory 1 title');

        $subcat2 = new article\models\Category([
            'title' => 'Subcategory 1',
            'order_num' => 1
        ]);
        $subcat2->appendTo($root2);
        $this->attachSeo($subcat2, 'Subcategory 2 H1', 'Extended subcategory 2 title');

        if (article\models\Item::find()->count()) {
            return '`<b>' . article\models\Item::tableName() . '</b>` table is not empty, skipping...';
        }
        $this->db->createCommand('TRUNCATE TABLE `' . article\models\Item::tableName() . '`')->query();

        $time = time();

        $article1 = new article\models\Item([
            'category_id' => $root1->primaryKey,
            'title' => 'First article title',
            'image' => '/uploads/article/article-1.jpg',
            'short' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt molliti',
            'text' => '<p><strong>Sed ut perspiciatis</strong>, unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo. nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit, amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt, ut labore et dolore magnam aliquam quaerat voluptatem.&nbsp;</p><ul><li>item 1</li><li>item 2</li><li>item 3</li></ul><p>ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? quis autem vel eum iure reprehenderit, qui in ea voluptate velit esse, quam nihil molestiae consequatur, vel illum, qui dolorem eum fugiat, quo voluptas nulla pariatur?</p>',
            'tagNames' => 'php, css, bootstrap',
            'time' => $time
        ]);
        $article1->save();
        $this->attachPhotos($article1, ['/uploads/photos/article-1-1.jpg', '/uploads/photos/article-1-2.jpg', '/uploads/photos/article-1-3.jpg', '/uploads/photos/news-1-4.jpg']);
        $this->attachSeo($article1, 'First article H1');

        $article2 = new article\models\Item([
            'category_id' => $root1->primaryKey,
            'title' => 'Second article title',
            'image' => '/uploads/article/article-2.jpg',
            'short' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip',
            'text' => '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p><ol> <li>Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. </li><li>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</li></ol>',
            'tagNames' => 'yii2, jquery, ajax',
            'time' => $time - 86400
        ]);
        $article2->save();
        $this->attachSeo($article2, 'Second article H1');

        $article3 = new article\models\Item([
            'category_id' => $root1->primaryKey,
            'title' => 'Third article title',
            'image' => '/uploads/article/article-3.jpg',
            'short' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt molliti',
            'text' => '<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</p>',
            'time' => $time - 86400 * 2
        ]);
        $article3->save();
        $this->attachSeo($article3, 'Third article H1');

        return 'Articles data inserted.';
    }

    public function insertGallery()
    {
        if (gallery\models\Category::find()->count()) {
            return '`<b>' . gallery\models\Category::tableName() . '</b>` table is not empty, skipping...';
        }
        $this->db->createCommand('TRUNCATE TABLE `' . gallery\models\Category::tableName() . '`')->query();

        $album1 = new gallery\models\Category([
            'title' => 'Album 1',
            'image' => '/uploads/gallery/album-1.jpg',
            'order_num' => 2
        ]);
        $album1->makeRoot();
        $this->attachSeo($album1, 'Album 1 H1', 'Extended Album 1 title');
        $this->attachPhotos($album1, [
            '/uploads/photos/album-1-9.jpg',
            '/uploads/photos/album-1-8.jpg',
            '/uploads/photos/album-1-7.jpg',
            '/uploads/photos/album-1-6.jpg',
            '/uploads/photos/album-1-5.jpg',
            '/uploads/photos/album-1-4.jpg',
            '/uploads/photos/album-1-3.jpg',
            '/uploads/photos/album-1-2.jpg',
            '/uploads/photos/album-1-1.jpg'
        ]);

        $album2 = new gallery\models\Category([
            'title' => 'Album 2',
            'image' => '/uploads/gallery/album-2.jpg',
            'order_num' => 1
        ]);
        $album2->makeRoot();
        $this->attachSeo($album2, 'Album 2 H1', 'Extended Album 2 title');

        return 'Gallery data inserted.';
    }

    public function insertGuestbook()
    {
        if(Guestbook::find()->count()){
            return '`<b>' . Guestbook::tableName() . '</b>` table is not empty, skipping...';
        }
        $this->db->createCommand('TRUNCATE TABLE `'.Guestbook::tableName().'`')->query();

        $time = time();

        $post1 = new Guestbook([
            'name' => 'First user',
            'text' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.'
        ]);
        $post1->time = $time;
        $post1->save();

        $post2 = new Guestbook([
            'name' => 'Second user',
            'text' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
        ]);
        $post2->time = $time - 86400;
        $post2->answer = 'Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.';
        $post2->save();
        $post2->new = 0;
        $post2->update();

        $post3 = new Guestbook([
            'name' => 'Third user',
            'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'
        ]);
        $post3->time = $time - 86400*2;
        $post3->save();

        return 'Guestbook data inserted.';
    }

    public function insertFaq()
    {
        if(Faq::find()->count()){
            return '`<b>' . Faq::tableName() . '</b>` table is not empty, skipping...';
        }
        $this->db->createCommand('TRUNCATE TABLE `'.Faq::tableName().'`')->query();

        (new Faq([
            'question' => 'Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it?',
            'answer' => 'But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure'
        ]))->save();

        (new Faq([
            'question' => 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum?',
            'answer' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta <a href="http://easyiicms.com/">sunt explicabo</a>.'
        ]))->save();

        (new Faq([
            'question' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'answer' => 't enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.'
        ]))->save();

        return 'Faq data inserted.';
    }

    public function insertCarousel()
    {
        if(Carousel::find()->count()){
            return '`<b>' . Carousel::tableName() . '</b>` table is not empty, skipping...';
        }
        $this->db->createCommand('TRUNCATE TABLE `'.Carousel::tableName().'`')->query();

        (new Carousel([
            'image' => '/uploads/carousel/1.jpg',
            'title' => 'Ut enim ad minim veniam, quis nostrud exercitation',
            'text' => 'Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.',
        ]))->save();

        (new Carousel([
            'image' => '/uploads/carousel/2.jpg',
            'title' => 'Sed do eiusmod tempor incididunt ut labore et',
            'text' => 'Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.',
        ]))->save();

        (new Carousel([
            'image' => '/uploads/carousel/3.jpg',
            'title' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
            'text' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.',
        ]))->save();


        return 'Carousel data inserted.';
    }

    public function insertFiles()
    {
        if(File::find()->count()){
            return '`<b>' . File::tableName() . '</b>` table is not empty, skipping...';
        }
        $this->db->createCommand('TRUNCATE TABLE `'.File::tableName().'`')->query();

        (new File([
            'title' => 'Price list',
            'file' => '/uploads/files/example.csv',
            'size' => 104
        ]))->save();

        return 'File data inserted.';
    }

    private function attachPhotos($model, $files){
        $class = get_class($model);
        foreach($files as $file) {
            (new Photo([
                'class' => $class,
                'item_id' => $model->primaryKey,
                'image' => $file
            ]))->save();
        }
    }

    private function attachSeo($model, $h1 = '', $title = '', $description = '', $keywords = ''){
        $class = get_class($model);
        (new SeoText([
            'class' => $class,
            'item_id' => $model->primaryKey,
            'h1' => $h1,
            'title' => $title,
            'description' => $description,
            'keywords' => $keywords
        ]))->save();
    }
}
