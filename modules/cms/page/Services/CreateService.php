<?php


namespace CMS\Page\Services;


use Illuminate\Support\Facades\Artisan;

class CreateService
{
    public static function create($url=null){
        Artisan::call("sitemap:generate");
        //CreateService::indexing("update",$url);

    }
    public static function remove($url=null){
        Artisan::call("sitemap:generate");
        //CreateService::indexing("delete",$url);


    }

    public static function indexing($status,$url=null){
        include_once  base_path().'/vendor/autoload.php';
        $client = new \Google_Client();
        $client->setAuthConfig("hidi-804b3c8e4b02.json");
        $client->setConfig( 'base_path', 'https://indexing.googleapis.com' );
        $client->addScope( 'https://www.googleapis.com/auth/indexing' );

        $url_input=[$url];

        /*$posts = ArticleRepository::get();
        foreach ($posts as $post) {
            $url_input[]=$post->url."/";
        }
        $pages = PageRepository::get();
        foreach ($pages as $page) {
            if(!isset($page->post_meta_array["meta_index"]) || $page->post_meta_array["meta_index"]=="index" ){
                $url_input[]=$page->url."/";

            }
        }
        $products = ProductRepository::getPublished();
        foreach ($products as $product) {
            $url_input[]=$product->url."/";
        }
        $categories = CategoryRepository::get();
        foreach ($categories as $category) {
            $url_input[]=$category->url."/";
        }*/

        if($url){
            $action=$status;
            // Batch request.
            $client->setUseBatch( true );
            // init google batch and set root URL.
            $service = new \Google_Service_Indexing( $client );
            $batch   = new \Google_Http_Batch( $client, false, 'https://indexing.googleapis.com' );
            foreach ( $url_input as $i => $url ) {
                $post_body = new \Google_Service_Indexing_UrlNotification();
                if ( $action === 'getstatus' ) {
                    $request_part = $service->urlNotifications->getMetadata( [ 'url' => $url ] ); // phpcs:ignore
                } else {
                    $post_body->setType( $action === 'update' ? 'URL_UPDATED' : 'URL_DELETED' );
                    $post_body->setUrl( $url );
                    $request_part = $service->urlNotifications->publish( $post_body ); // phpcs:ignore
                }
                $batch->add( $request_part, 'url-' . $i );
            }

            $results   = $batch->execute();
        }

    }
}
