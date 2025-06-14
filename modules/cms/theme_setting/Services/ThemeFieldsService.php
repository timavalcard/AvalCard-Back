<?php


namespace CMS\ThemeSetting\Services;


class ThemeFieldsService
{


    public static  function fields()
    {
        return [
            "mainSetting"=>[
                "persian_name"=>"تنظیمات اصلی",
                "items"=>[
                    "site_logo"=>[
                        "persian_name"=>"لوگو سایت",
                        "fields"=>function($value=null){
                            return [
                                self::image($value["logo"]?? "",true,"logo","site_logo","عکس لوگو"),
                            ];
                        },


                        "options"=>[
                            "repeatable"=>false
                        ]
                    ],
                    "site_name"=>[
                        "persian_name"=>"نام سایت",
                        "fields"=>function($value=null){
                            return [
                                self::input($value,true,"site_name","site_name","نام سایت را وارد کنید"),
                            ];
                        },


                        "options"=>[
                            "repeatable"=>false
                        ]
                    ],
                    "site_des"=>[
                        "persian_name"=>"توضیحات سایت",
                        "fields"=>function($value=null){
                            return [
                                self::textarea($value,true,"site_description","site_des","توضیحات سایت را وارد کنید"),
                            ];
                        },


                        "options"=>[
                            "repeatable"=>false
                        ]
                    ],

                ]
            ],
            "homepage"=>[
                "persian_name"=>"صفحه اصلی",
                "items"=>[
                    "slider"=>[
                        "persian_name"=>"اسلایدر",
                        "fields"=>function($value=null){
                            return [
                                self::image($value,true,"slider_image","slider","عکس اسلایدر"),
                                self::input($value,true,"slider_link","slider","لینک را وارد کنید"),
                            ];
                        },


                        "options"=>[
                            "repeatable"=>true
                        ]
                    ],
                    "mobile_slider"=>[
                        "persian_name"=>"اسلایدر موبایل",
                        "fields"=>function($value=null){
                            return [
                                self::image($value,true,"slider_image","mobile_slider","عکس اسلایدر"),
                                self::input($value,true,"slider_link","mobile_slider","لینک را وارد کنید"),
                            ];
                        },


                        "options"=>[
                            "repeatable"=>true
                        ]
                    ],


                ]
            ]

        ];

    }



    public static function image($value=null,$group=true,$id,$parentId,$btnText="عکس")
    {
        if($value && isset($value[$id])){
            $value=$value[$id];
        }
        $group==true ? $nameIsArray="[]" : $nameIsArray="";
        $name=$parentId."[".$id."]".$nameIsArray;
        return [
            "id"=>$id,
            "html"=>" <input type='hidden' class='admin-media-frame-input' name='$name' value='$value'>
                                                <button class='open-admin-media-frame btn-blue btn-sm'>$btnText</button>
                                                <img src='".asset(store_image_link($value))."' class='admin-media-frame-img' width='200' height='200'>

"
        ];
    }

    public static function input($value=null,$group=false,$id,$parentId,$placeholder="",$type="text")
    {
        if($value && isset($value[$id])){
            $value=$value[$id];
        }
        $group==true ? $nameIsArray="[]" : $nameIsArray="";
        $name=$parentId."[".$id."]".$nameIsArray;

        return [
            "id"=>$id,
            "html"=>"<input type='$type' name='$name' placeholder='$placeholder' value='$value'>"
        ];
    }

    public static function textarea($value=null,$group=false,$id,$parentId,$placeholder="")
    {
        if($value && isset($value[$id])){
            $value=$value[$id];
        }
        $group==true ? $nameIsArray="[]" : $nameIsArray="";
        $name=$parentId."[".$id."]".$nameIsArray;

        return [
            "html"=>"<textarea  name='$name' placeholder='$placeholder'>$value</textarea>"
        ];
    }
}

