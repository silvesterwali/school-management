<?php
return [
    'page_format'           => 'A5',
    'page_orientation'      => 'P',
    'page_units'            => 'mm',
    'unicode'               => true,
    'encoding'              => 'UTF-8',
    'font_directory'        => '',
//'image_directory'       => url('assets/img/'),
    'tcpdf_throw_exception' => false,
    'use_fpdi'              => false,
    'use_original_header'   => false,
    'use_original_footer'   => false,
    'pdfa'                  => false, // Options: false, 1, 3

    // See more info at the tcpdf_config.php file in TCPDF (if you do not set this here, TCPDF will use it default)
    // https://raw.githubusercontent.com/tecnickcom/TCPDF/develop/config/tcpdf_config.php

    //    'path_main'           => '', // K_PATH_MAIN
    // 'path_url'              => url('assets/img/'), // K_PATH_URL
    //'header_logo'           => url('assets/img/logo.png'), // PDF_HEADER_LOGO
    'header_logo_width'     => '50', // PDF_HEADER_LOGO_WIDTH
    //    'path_cache'          => '', // K_PATH_CACHE
    //    'blank_image'         => '', // K_BLANK_IMAGE
    'creator'               => 'SabanaCode', // PDF_CREATOR
    'author'                => 'SC', // PDF_AUTHOR
    'header_title'          => 'RAPOR', // PDF_HEADER_TITLE
    'header_string'         => 'SMP SANTO YOSEPH DENPASAR', // PDF_HEADER_STRING
    //    'page_units'          => '', // PDF_UNIT
    'margin_header'         => '5', // PDF_MARGSMIN_HEADER
    'margin_footer'         => '10', // PDF_MARGIN_FOOTER
    'margin_top'            => '5',
    'margin_bottom'         => '5', // PDF_MARGIN_BOTTOM
    'margin_left'           => '5', // PDF_MARGIN_LEFT
    'margin_right'          => '5', // PDF_MARGIN_RIGHT
    //'font_name_main'        => 'aakar', // PDF_FONT_NAME_MAIN
    'font_size_main'        => '12', // PDF_FONT_SIZE_MAIN
    //'font_name_data'        => '11', // PDF_FONT_NAME_DATA
    //    'font_size_data'      => '', // PDF_FONT_SIZE_DATA
    //    'foto_monospaced'     => '', // PDF_FONT_MONOSPACED
    //    'image_scale_ratio'   => '', // PDF_IMAGE_SCALE_RATIO
    //    'head_magnification'  => '', // HEAD_MAGNIFICATION
    //    'cell_height_ratio'   => '', // K_CELL_HEIGHT_RATIO
    //    'title_magnification' => '', // K_TITLE_MAGNIFICATION
    //    'small_ratio'         => '', // K_SMALL_RATIO
    //    'thai_topchars'       => '', // K_THAI_TOPCHARS
    //    'tcpdf_calls_in_html' => '', // K_TCPDF_CALLS_IN_HTML
    //    'timezone'            => '', // K_TIMEZONE
];
