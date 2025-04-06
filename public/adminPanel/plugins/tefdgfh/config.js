/**
 * @license Copyright (c) 2003-2021, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
    config.extraPlugins = 'wordcount,notification';

};

    /*jQuery(".cke_button__image").click(function (){
        console.log(1)
        setTimeout(function (){
            jQuery("a.content_open_media").click(function(){

                jQuery(this).trigger("openMedia")
            })
        },100)

    })*/

CKEDITOR.on( 'dialogDefinition', function( ev ) {
    // Take the dialog name and its definition from the event data.
    var dialogName = ev.data.name;
    var dialogDefinition = ev.data.definition;
    // Check if the definition is from the dialog window you are interested in (the "Link" dialog window).
    if ( dialogName == 'image' ) {
        // Get a reference to the "Link Info" tab.
        var infoTab = dialogDefinition.getContents( 'info' );

        // Set the default value for the URL field.
        var buttonField = infoTab.get( "browse" );
        buttonField[ 'class' ] = 'content_open_media';
        var urlField = infoTab.get("txtUrl");
        setTimeout(function (){
            jQuery("a.content_open_media").click(function(){
                console.log(1)
                jQuery(this).trigger("openMedia")
            })
        },100)
        urlField[ 'class' ] = 'content_media_url';
    }
});
