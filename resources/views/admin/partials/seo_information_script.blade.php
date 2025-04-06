<script>
    CKEDITOR.instances["contents"].on('change', function() {
        update_readability()
    })
    jQuery("input,textarea").keyup(update_readability)
    function update_readability(){
        var data=CKEDITOR.instances['contents'].getData();
        var notHTMlData=CKEDITOR.instances['contents'].editable().getText();
        var keyword=jQuery("#keyword").val();
        var title=jQuery("input[name='title']").val();
        var meta_description=jQuery("textarea[name='meta_description']").val();
        var slug=jQuery("input[name='slug']").val();
        var wordCount=jQuery("span#cke_wordcount_contents").text().split("Words: ")[1];
        var tenPercentOfContentWordCountNumber=percentage(10,wordCount);
        var keyWordRepeatCount=notHTMlData.split(keyword).length-1;
        var contentDocument=CKEDITOR.instances['contents'].document
        var contentDocumentLinks=contentDocument.find("a")
        var contentDocumentImage=contentDocument.find("img")
        var contentDocumentHeadings=contentDocument.find("h1,h2,h3,h4,h5,h6,h7")
        var contentDocumentVideo=contentDocument.find("video")
        var contentDocumentTableContent=contentDocument.find("p#main-toc")
        var internalLinks=0
        var externalLinks=0
        var DoFollowexternalLinks=0
        var imagesCount=contentDocumentImage.$.length;
        var imagesAltKeyWordCount=0;
        var headingsKeyWordCount=0;
        var videosCount=contentDocumentVideo.$.length;
        if(keyword){
            if(title.includes(keyword)){
                jQuery("span#Keyword-title").text("بله!")
                jQuery("span#Keyword-title").addClass("success")
            } else{
                jQuery("span#Keyword-title").text("خیر!")
                jQuery("span#Keyword-title").removeClass("success")
            }

            if(meta_description.includes(keyword)){
                jQuery("span#Keyword-description").text("بله!")
                jQuery("span#Keyword-description").text("بله!").addClass("success")
            } else{
                jQuery("span#Keyword-description").removeClass("success")
            }
            if(title.startsWith(keyword)){
                jQuery("span#title-start").text("بله!");
                jQuery("span#title-start").addClass("success")

            } else{
                jQuery("span#title-start").text("خیر!")
                jQuery("span#title-start").removeClass("success")
            }

            if(slug.includes(keyword)){
                jQuery("span#Keyword-url").text("بله!");
                jQuery("span#Keyword-url").addClass("success")
                var keyWordRepeatURLCount=slug.split(keyword).length-1;
                if(keyWordRepeatURLCount>=0){
                    jQuery("span#Keyword-url-number").text(keyWordRepeatURLCount);
                    jQuery("span#Keyword-url-number").addClass("success")
                }
            } else{
                jQuery("span#Keyword-url").text("خیر!")
                jQuery("span#Keyword-url").removeClass("success")
            }

            if(tenPercentOfContentWordCountNumber){
                var tenPercentOfContent=getWordStr(notHTMlData,tenPercentOfContentWordCountNumber)

                if(tenPercentOfContent.includes(keyword)){
                    jQuery("span#Keyword-first").text("بله!")
                    jQuery("span#Keyword-first").addClass("success")
                } else{
                    jQuery("span#Keyword-first").text("خیر!")
                    jQuery("span#Keyword-first").removeClass("success")
                }
            }

            contentDocumentImage.$.forEach(function(item){
                if(item.alt.includes(keyword)){
                    imagesAltKeyWordCount++;
                }
            })
            if(imagesAltKeyWordCount > 0){
                jQuery("span#keyword-image").text(`${imagesAltKeyWordCount} times`)
                jQuery("span#keyword-image").addClass("success")
            } else{
                jQuery("span#keyword-image").text("خیر!")
                jQuery("span#keyword-image").removeClass("success")
            }

            contentDocumentHeadings.$.forEach(function(item){
                if(item.textContent.includes(keyword)){
                    headingsKeyWordCount++;
                }
            })
            if(headingsKeyWordCount > 0){
                jQuery("span#Keyword-head").text(`${headingsKeyWordCount} times`)
                jQuery("span#Keyword-head").addClass("success")
            } else{
                jQuery("span#Keyword-head").text("خیر!")
                jQuery("span#Keyword-head").removeClass("success")
            }


            if(keyWordRepeatCount > 1){
                jQuery("span#keyword-number").text(`${keyWordRepeatCount} times`);
                if(keyWordRepeatCount > 10){
                    jQuery("span#keyword-number").addClass("success")
                } else{
                    jQuery("span#keyword-number").removeClass("success")
                }

                jQuery("span#Keyword-density").text(((keyWordRepeatCount/wordCount)*100).toFixed(3));
                if(((keyWordRepeatCount/wordCount)*100).toFixed(3) >= 1){
                    jQuery("span#Keyword-density").addClass("success")

                } else{
                    jQuery("span#Keyword-density").removeClass("success")
                }

            }
            else{
                jQuery("span#keyword-number").text(`0`);
                jQuery("span#keyword-number").removeClass("success")
                jQuery("span#Keyword-density").text(`0`);
                jQuery("span#Keyword-density").removeClass("success")
            }




        }


        if(slug.length > 0){
            jQuery("span#URL-characters").text(`${slug.length}`)
            jQuery("span#URL-characters").addClass("success")
        }
        else{
            jQuery("span#URL-characters").text(`0`)
            jQuery("span#URL-characters").removeClass("success")
        }
        if(wordCount > 0){
            jQuery("span#content-Word").text(`${wordCount}`)
            jQuery("span#content-Word").addClass("success")
        }
        else{
            jQuery("span#content-Word").text(`0`)
            jQuery("span#content-Word").removeClass("success")
        }
        if(/\d/.test(title)){
            jQuery("span#number-title").text(`بله!`)
            jQuery("span#number-title").addClass("success")
        } else{
            jQuery("span#number-title").text(`خیر!`)
            jQuery("span#number-title").removeClass("success")
        }



        // external links check
        contentDocumentLinks.$.forEach(function (item){
            if(isExternal(item.href)){
                externalLinks++;
                if(!jQuery(item).attr("rel") || jQuery(item).attr("rel")=="dofollow" ){
                    DoFollowexternalLinks++;
                }
            } else{
                internalLinks++
            }
        })
        if(externalLinks > 0){
            jQuery("span#External-link").text(`${externalLinks} times`)
            jQuery("span#External-link").addClass("success")
        } else{
            jQuery("span#External-link").text(`خیر!`)
            jQuery("span#External-link").removeClass("success")
        }
        if(DoFollowexternalLinks > 0){
            jQuery("span#external-DoFollow").text(`${DoFollowexternalLinks} times`)
            jQuery("span#external-DoFollow").addClass("success")
        } else{
            jQuery("span#external-DoFollow").text(`خیر!`)
            jQuery("span#external-DoFollow").removeClass("success")
        }

        if(internalLinks > 0){
            jQuery("span#enternal-link").text(`${externalLinks} times`)
            jQuery("span#enternal-link").addClass("success")
        } else{
            jQuery("span#enternal-link").text(`خیر!`)
            jQuery("span#enternal-link").removeClass("success")
        }

        // image and videos check
        if(imagesCount > 0 || videosCount > 0){
            jQuery("span#photos-video").text(`${imagesCount} images and ${videosCount} videos`)
            jQuery("span#photos-video").addClass("success")
        } else{
            jQuery("span#photos-video").removeClass("success")
        }

        if(contentDocumentTableContent.$.length > 0){
            jQuery("span#have-table-content").text(`بله!`)
            jQuery("span#have-table-content").addClass("success")
        } else{
            jQuery("span#have-table-content").text(`خیر!`)
            jQuery("span#have-table-content").removeClass("success")
        }

    }
    jQuery(document).ready(function (){
        setTimeout(function (){
            update_readability()
        },1000)

    })
    function percentage(partialValue, totalValue) {
        var num=Math.round(((partialValue/ 100) * totalValue))
        if(num<=0) num=totalValue;
        return num;
    }

    function getWordStr(str,word) {
        return str.split(/\s+/).slice(0,word).join(" ");
    }
    var checkDomain = function(url) {
        if ( url.indexOf('//') === 0 ) { url = location.protocol + url; }
        return url.toLowerCase().replace(/([a-z])?:\/\//,'$1').split('/')[0];
    };

    var isExternal = function(url) {
        return ( ( url.indexOf(':') > -1 || url.indexOf('//') > -1 ) && checkDomain(location.href) !== checkDomain(url) );
    };

    jQuery("section.content form.w-100").submit(function (){
        var contentDocument=CKEDITOR.instances['contents'].document
        var contentDocumentHeadings=contentDocument.find("h1,h2,h3,h4,h5,h6,h7")
        if(contentDocumentHeadings.$.length>0){
            var range = CKEDITOR.instances['contents'].createRange();
            range.moveToPosition( range.root, CKEDITOR.POSITION_AFTER_START );
            CKEDITOR.instances['contents'].getSelection().selectRanges( [ range ] );

            jQuery("div#cke_contents .cke_button__toc").click()
        }

    })
    jQuery("input,textarea").keyup(function (){
        var length=jQuery(this).data("length");
        var that=this;
        if(length){
            var length_span=jQuery(`#${length}`).text(jQuery(this).val().length)
        }
    })
</script>
