<?php

return [
    'show_warnings' => false,
    'public_path' => storage_path('app/public'),
    'convert_entities' => true,
    'options' => [
        'font_dir' => storage_path('fonts'),
        'font_cache' => storage_path('fonts'),
        'temp_dir' => storage_path('temp'),
        'chroot' => realpath(base_path()),
        'allowed_protocols' => ['file://' => 'file://', 'http://' => 'http://', 'https://' => 'https://'],
        'log_output' => false,
        'enable_font_subsetting' => false,
        'pdf_backend' => 'CPDF',
        'default_media_type' => 'screen',
        'default_paper_size' => 'a4',
        'dpi' => 96,
        'enable_php' => false,
        'enable_javascript' => false,
        'enable_remote' => false,
        'font_height_ratio' => 1.1,
        'is_html5_parser_enabled' => true,
        'is_remote_enabled' => false,
    ],
];
