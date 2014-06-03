<?php
#-----------------------------------------------------------------
# Columns
#-----------------------------------------------------------------

$zee_shortcodes = array();



//Basic
$zee_shortcodes['header_1'] = array( 
    'type'=>'heading', 
    'title'=>__('Basic', ZEETEXTDOMAIN)
    );





//container
$zee_shortcodes['zee_container'] = array( 
    'type'=>'simple', 
    'title'=>__('Container', ZEETEXTDOMAIN),
    'attr'=>array(

        'class'=>array(

            'type'=>'class',
            'title'=>__('Select the color class', ZEETEXTDOMAIN),
            'values'=>$color_classes,

            ),

        'id'=>array(
            'type'=>'text', 
            'title'=>__('Select the ID', ZEETEXTDOMAIN)
            ),
        )
    );



$zee_shortcodes['zee_divider'] = array( 
    'type'=>'radios', 
    'title'=>__('Divider', ZEETEXTDOMAIN), 
    'attr'=>array(
        'size'=>array(
            'type'=>'select', 
            'title'=> __('Divider Size', ZEETEXTDOMAIN), 
            'values'=>array(
                'divider-default'   =>'Default',
                'divider-lg'        =>'Large',
                'divider-md'        =>'Medium',
                'divider-sm'        =>'Small',
                'divider-xs'        =>'Extra Small',
                )
            ),
        ) 

    );




//Dropcap
$zee_shortcodes['zee_dropcap'] = array( 
    'type'=>'simple', 
    'title'=>__('Dropcap', ZEETEXTDOMAIN ),
    );








//Columns
$zee_shortcodes['header_2'] = array( 
    'type'=>'heading', 
    'title'=>__('Columns', ZEETEXTDOMAIN)
    );




// columns
$zee_shortcodes['zee_columns'] = array( 
    'type'=>'dynamic', 
    'title'=>__('Columns', ZEETEXTDOMAIN ), 
    'attr'=>array(
        'column'=>array('type'=>'custom')
        )
    );


//blocknumber
$zee_shortcodes['zee_blocknumber'] = array( 
    'type'=>'simple', 
    'title'=>__('Blocknumber', ZEETEXTDOMAIN ),
    'attr'=>array(
        
        'number'=>array(
            'type'=>'text', 
            'title'=>__('Number. eg. 01,II,A',ZEETEXTDOMAIN)
            ),
        
        'color'=>array(
            'type'=>'text', 
            'title'=>__('Number Color. eg. #fff',ZEETEXTDOMAIN)
            ),
        'background'=>array(
            'type'=>'text', 
            'title'=>__('Background Color. eg. #000',ZEETEXTDOMAIN)
            ),

        'borderradius'=>array(
            'type'=>'text', 
            'title'=>__('Type Border Radius. eg. 4px, 100%',ZEETEXTDOMAIN)
            ),

        )
    );



//Elements
$zee_shortcodes['header_3'] = array( 
    'type'=>'heading', 
    'title'=>__('Elements', ZEETEXTDOMAIN)
    );




//Button
$zee_shortcodes['zee_button'] = array( 
    'type'=>'radios', 
    'title'=>__('Button', ZEETEXTDOMAIN), 
    'attr'=>array(

        'size'=>array(
            'type'=>'select', 
            'title'=> __('Button Size', ZEETEXTDOMAIN), 
            'values'=>array(
                ''=>'Default',
                'xlg'=>'Extra Large',
                'lg'=>'Large',
                'sm'=>'Medium',
                'xs'    =>'Small',
                )
            ),


        'type'=>array(
            'type'=>'select', 
            'title'=> __('Button Type', ZEETEXTDOMAIN), 
            'values'=>array(
                'default'=>'Default',
                'primary'=>'Primary',
                'success'=>'Success',
                'info'  =>'Info',
                'warning'=>'Warning',
                'danger'=>'Danger',
                'link'=>'Link',
                )
            ),

        'url'=>array(
            'type'=>'text', 
            'title'=>__('Link URL', ZEETEXTDOMAIN)
            ),
        'text'=>array(
            'type'=>'text', 
            'title'=>__('Text', ZEETEXTDOMAIN)
            ),

        'icon'=>array(
            'type'=>'icon', 
            'title'=>__('Select Icon', ZEETEXTDOMAIN),
            'values'=> $fontawesome_icons,

            ),

        ) 

    );

// alert
$zee_shortcodes['zee_alert'] = array( 
    'type'=>'simple', 
    'title'=>__('Alert', ZEETEXTDOMAIN ),
    'attr'=>array(
        'close'=>array(
            'type'=>'select', 
            'title'=> __('Show Close Button', ZEETEXTDOMAIN), 
            'values'=>  array( 'no'=>'No', 'yes'=>'Yes' )
            ),  
        'type'=>array(
            'type'=>'select', 
            'title'=> __('Alert Type', ZEETEXTDOMAIN), 
            'values'=>  array( 'none'=>'None', 'success'=>'Success', 'info'=>'Info', 'warning'=>'Warning', 'danger'=>'Danger' )
            ),  
        'title'=>array(
            'type'=>'text', 
            'title'=> __('Alert Title', ZEETEXTDOMAIN)
            ),
        ) 

    );

// progressbar
$zee_shortcodes['zee_progressbar'] = array( 
    'type'=>'dynamic', 
    'title'=>__('Progress Bars', ZEETEXTDOMAIN ), 
    'attr'=>array(
        'progressbar'=>array('type'=>'custom')
        )
    );


//block
$zee_shortcodes['zee_block'] = array( 
    'type'=>'simple', 
    'title'=>__('Block', ZEETEXTDOMAIN ),
    'attr'=>array(
        'background'=>array(
            'type'=>'text', 
            'title'=>__('Background Color. eg. #000',ZEETEXTDOMAIN)
            ),
        
        'color'=>array(
            'type'=>'text', 
            'title'=>__('Text Color. eg. #fff',ZEETEXTDOMAIN)
            ),

        'borderradius'=>array(
            'type'=>'text', 
            'title'=>__('Type Border Radius. eg. 4px, 100%',ZEETEXTDOMAIN)
            ),

        'padding'=>array(
            'type'=>'text', 
            'title'=>__('Block Padding. eg. 15px',ZEETEXTDOMAIN)
            ),

        )
    );


//Icon
$zee_shortcodes['zee_icon'] = array( 
    'type'=>'regular', 
    'title'=>__('Icon', ZEETEXTDOMAIN), 
    'attr'=>array(
            'size'=>array(
                'type'=>'select', 
                'title'=> __('Select size', ZEETEXTDOMAIN),

                'values'=>array(
                'icon-large'  =>__('Large Icon', ZEETEXTDOMAIN),
                'icon-2x'     =>__('2x Large Icon', ZEETEXTDOMAIN),
                'icon-3x'     =>__('3x Large Icon', ZEETEXTDOMAIN),
                'icon-4x'     =>__('4x Large Icon', ZEETEXTDOMAIN)
                )
            ),
        'icons' => array(
            'type'=>'icons', 
            'title'=>'Icon', 
            'values'=> $fontawesome_icons
            )

        ) 

    );





//Post Types
$zee_shortcodes['header_4'] = array( 
    'type'=>'heading', 
    'title'=>__('Post Types', ZEETEXTDOMAIN)
    );


//faq
$zee_shortcodes['zee_faq'] = array( 
    'type'=>'radios', 
    'title'=>__('Faq', ZEETEXTDOMAIN), 
    );


$terms = array(__('All categories', ZEETEXTDOMAIN));
foreach(get_terms('cat_pricing', 'orderby=count&hide_empty=0') as $term ){

    $terms[$term->term_id] = $term->name;
} 

//pricing
$zee_shortcodes['zee_pricing'] = array( 
    'type'=>'radios', 
    'title'=>__('Pricing table', ZEETEXTDOMAIN), 
    'attr'=>array(

        'category'=>array(
            'type'=>'select', 
            'title'=> __('Category', ZEETEXTDOMAIN), 
            'values'=> $terms
            ),
        ) 

    );


$terms = array(__('All categories', ZEETEXTDOMAIN));
foreach(get_terms('cat_service', 'orderby=count&hide_empty=0') as $term ){

    $terms[$term->term_id] = $term->name;
} 


// service
$zee_shortcodes['zee_service'] = array( 
    'type'=>'radios', 
    'title'=>__('Service', ZEETEXTDOMAIN),
    'attr'=>array(

        'category'=>array(
            'type'=>'select', 
            'title'=> __('Category', ZEETEXTDOMAIN), 
            'values'=> $terms
            ),

        'number'=>array(
            'type'=>'test', 
            'title'=> __('Number of Items', ZEETEXTDOMAIN),
            'value'=>'3',
            ),

        'column'=>array(
            'type'=>'select', 
            'title'=> __('Number of Column', ZEETEXTDOMAIN),
            'values'=>array(
                '1'=>'1',
                '2'=>'2',
                '3'=>'3',
                '4'=>'4',
                )
            ),

        ),

    );



$terms = array(__('All categories', ZEETEXTDOMAIN));
foreach(get_terms('cat_tabs', 'orderby=count&hide_empty=0') as $term ){


    $terms[$term->term_id] = $term->name;
} 

// tab
$zee_shortcodes['zee_tab'] = array( 
    'type'=>'radios', 
    'title'=>__('Tab', ZEETEXTDOMAIN), 
    'attr'=>array(

        'category'=>array(
            'type'=>'select', 
            'title'=> __('Category', ZEETEXTDOMAIN), 
            'values'=> $terms
            ),
        ) 

    );

$terms = array(__('All categories', ZEETEXTDOMAIN));
foreach(get_terms('cat_accordions', 'orderby=count&hide_empty=0') as $term ){

    $terms[$term->term_id] = $term->name;
} 

// accordion
$zee_shortcodes['zee_accordion'] = array( 
    'type'=>'radios', 
    'title'=>__('Accordion', ZEETEXTDOMAIN), 
    'attr'=>array(
        'category'=>array(
            'type'=>'select', 
            'title'=> __('Category', ZEETEXTDOMAIN), 
            'values'=> $terms
            ),
        ) 

    );

// portfolio
$zee_shortcodes['zee_portfolio'] = array( 
    'type'=>'radios', 
    'title'=>__('Portfolio', ZEETEXTDOMAIN ),
    'attr'=>array(
        'column'=>array(
            'type'=>'select', 
            'title'=> __('Column Number', ZEETEXTDOMAIN), 
            'values'=>array(
                '2'=>'2',
                '3'=>'3',
                '4'=>'4',
                '5'=>'5',
                '6'=>'6',
                )
            ),
        ) 
    );

// recent works
$zee_shortcodes['zee_recent_works'] = array( 
    'type'=>'radios', 
    'title'=>__('Recent Works', ZEETEXTDOMAIN ),
    'attr'=>array(
        'title'=>array(
            'type'=>'text', 
            'title'=> __('Title', ZEETEXTDOMAIN),
            'value'=>'',
            ),
         'description'=>array(
            'type'=>'textarea', 
            'title'=> __('Description', ZEETEXTDOMAIN),
            'value'=>'',
            ),

        'slides'=>array(
            'type'=>'text', 
            'title'=> __('Items per Slide', ZEETEXTDOMAIN),
            'value'=>'2',
            ),
        ),
    );



// Team
$zee_shortcodes['zee_team'] = array( 
    'type'=>'radios', 
    'title'=>__('Team', ZEETEXTDOMAIN ),
    );

// testimonial
$zee_shortcodes['zee_testimonial'] = array( 
    'type'=>'radios', 
    'title'=>__('Testimonial', ZEETEXTDOMAIN ),
    'attr'=>array(
        'count'=>array(
            'type'=>'text', 
            'title'=>__('Count. eg. 2',ZEETEXTDOMAIN),
            'value'=>'2'
            ),
        )
    );


