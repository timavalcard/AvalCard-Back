<div class="readability-items">
    <input type="text"
           placeholder="کلمه کلیدی را وارد کنید"
           id="keyword"
           value="{{ $keyword??null }}"
           name="keyword"
           class="mb-2"
    >

    <div id="accordion">
        <div class="card">
            <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                    <a class="btn" data-toggle="collapse" href="#Basic" role="button" aria-expanded="true" aria-controls="collapseExample">
                        سئو اولیه

                    </a>
                    <a class="btn collapsed" data-toggle="collapse" href="#Additional" role="button" aria-expanded="true" aria-controls="collapseExample">
                        اضافی
                    </a>
                    <a class="btn collapsed" data-toggle="collapse" href="#title-Readability" role="button" aria-expanded="true" aria-controls="collapseExample">
                        خوانایی عنوان

                    </a>
                    <a class="btn collapsed" data-toggle="collapse" href="#Content-Readability" role="button" aria-expanded="true" aria-controls="collapseExample">
                        خوانایی محتوا

                    </a>

                </h5>
            </div>

            <div id="Basic" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                    <p>
                        کلمه کلیدی در عنوان:

                        <span id="Keyword-title"  class="readability-item-value">خیر!</span>
                    </p>
                    <p>

                        کلمه کلیدی در توضیحات متا:
                        <span  id="Keyword-description" class="readability-item-value">خیر!</span>
                    </p>
                    <p>
                        کلمه کلیدی در URL:
                        <span id="Keyword-url" class="readability-item-value">خیر!</span>
                    </p>
                    <p>
                        کلمه کلیدی در 10% اول متن صفحه:
                        <span id="Keyword-first"  class="readability-item-value">خیر!</span>
                    </p>
                    <p>

                        تعداد کلمات کلیدی استفاده شده در محتوا:
                        <span id="keyword-number"  class="readability-item-value">0</span>
                    </p>
                    <p>
                        تعداد کلمات محتوا:
                        <span id="content-Word"  class="readability-item-value">0</span>
                    </p>
                </div>
            </div>
            <div id="Additional" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                    <p>
                        کلید واژه در هدینگ ها:

                        <span id="Keyword-head"  class="readability-item-value">خیر!</span>
                    </p>
                    <p>
                        کلمه کلیدی در عنوان تصاویر  :
                        <span id="keyword-image"  class="readability-item-value">خیر!</span>
                    </p>
                    <p>
                        چگالی کلمه کلیدی:

                        <span id="Keyword-density"  class="readability-item-value">خیر!</span>
                    </p>
                    <p>

                        تعداد کلمات کلیدی استفاده شده در URL:
                        <span id="Keyword-url-number"  class="readability-item-value">0</span>
                    </p>
                    <p>
                        طول کاراکترهای URL:

                        <span id="URL-characters"  class="readability-item-value">0</span>
                    </p>
                    <p>
                        لینک خارجی داده شده؟
                        <span id="External-link"  class="readability-item-value">خیر!</span>
                    </p>
                    <p>
                        پیوند دادن به منابع دیگر در وب سایت شما:
                        <span id="enternal-link"  class="readability-item-value">خیر!</span>
                    </p>
                    <p>
                        حداقل یک پیوند خارجی با DoFollow در محتوای شما یافت می شود:
                        <span id="external-DoFollow"  class="readability-item-value">خیر!</span>
                    </p>

                </div>
            </div>
            <div id="title-Readability" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                    <p>

                        کلید واژه  مورد استفاده در ابتدای عنوان متا؟
                        <span id="title-start"  class="readability-item-value">خیر!</span>
                    </p>

                    <p>
                        کلمه کلیدی در عنوان:

                        <span id="Keyword-title"  class="readability-item-value">خیر!</span>
                    </p>
                    <p>
                        استفاده از عدد در عنوان :
                        <span id="number-title"  class="readability-item-value">خیر!</span>
                    </p>
                </div>
            </div>
            <div id="Content-Readability" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                    <p>
                        عکس ها و فیلم های استفاده شده در مقاله؟

                        <span id="photos-video"  class="readability-item-value">خیر!</span>
                    </p>
                    <p>
                        آیا table of content  دارد؟

                        <span id="have-table-content"  class="readability-item-value">خیر!</span>
                    </p>
                    <p>
                        از پاراگراف های کوتاه استفاده شده ؟
                        <span id="short-paraghraph"  class="readability-item-value success">yes!</span>
                    </p>
                </div>
            </div>
        </div>

    </div>





</div>
