<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use CMS\Article\Repositories\ArticleRepository;
use CMS\Category\Repositories\CategoryRepository;
use CMS\Page\Repository\PageRepository;
use CMS\Product\Repository\ProductRepository;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapIndex;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $sitemap = Sitemap::create();

        $posts = ArticleRepository::get();
        foreach ($posts as $post) {
            $sitemap->add($post->url."/");
        }
        $sitemap->writeToFile(base_path('../public_html/public/post-sitemap.xml'));

        /*$posts = ArticleRepository::get_by_type(false);
        foreach ($posts as $post) {
            $sitemap->add($post->url);
        }
        $sitemap->writeToFile(public_path('public/news-sitemap.xml'));*/


        $sitemap = Sitemap::create();

        $pages = PageRepository::get();
        foreach ($pages as $page) {
            if(!isset($page->post_meta_array["meta_index"]) || $page->post_meta_array["meta_index"]=="index" ){
                $sitemap->add($page->url."/");

            }
        }
        $sitemap->writeToFile(base_path('../public_html/public/page-sitemap.xml'));


        $sitemap = Sitemap::create();

        $products = ProductRepository::getPublished();
        foreach ($products as $product) {
            if($product->product_type == "gift_cart"){
                $sitemap->add("https://avalcard.com/gift-cart/".$product->slug."/");
            }elseif($product->product_type == "buy_product"){
                $sitemap->add("https://avalcard.com/buy-deliver-iran/".$product->slug."/");
            }elseif($product->product_type == "inter_payment"){
                $sitemap->add("https://avalcard.com/foreign-payment/".$product->slug."/");
            }else{
            $sitemap->add($product->url."/");

            }
        }
        $sitemap->writeToFile(base_path('../public_html/public/product-sitemap.xml'));
        $sitemap = Sitemap::create();
        /*$categories = CategoryRepository::get();
        foreach ($categories as $category) {
            $sitemap->add($category->url."/");
        }
        $sitemap->writeToFile(public_path('category-sitemap.xml'));*/

        $sitemap = SitemapIndex::create();
        $sitemap->add("https://avalcard.com/post-sitemap.xml");
        $sitemap->add("https://avalcard.com/page-sitemap.xml");
        $sitemap->add("https://avalcard.com/product-sitemap.xml");
        //$sitemap->add("https://admin.avalcard.com/category-sitemap.xml");
        $sitemap->writeToFile(base_path('../public_html/public/sitemap_index.xml'));
    }
}
