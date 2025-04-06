<?php
return [
    "MediaTypeServices" => [
        "image" => [
            "extensions" => [
                "png", "jpg", "jpeg"
            ],
            "handler" => \CMS\Media\Services\ImageFileService::class
        ],
        "video" => [
            "extensions" =>[
                "avi", "mp4", "mkv"
            ],
            "handler" => \CMS\Media\Services\VideoFileService::class,
        ],
        "zip" => [
            "extensions" => [
                "zip", "rar", "tar"
            ],
            "handler" => \CMS\Media\Services\ZipFileService::class
        ]
    ]
];
