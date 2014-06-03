<?php 

function zee_option_element( $name, $attr_option, $type, $shortcode ){
    
    $option_element = null;

    if( !isset($attr_option['value']) ) $attr_option['value']='';
    
    (isset($attr_option['desc']) && !empty($attr_option['desc'])) ? $desc = '<p class="description">'.$attr_option['desc'].'</p>' : $desc = '';

    switch( $attr_option['type'] ){
        
        case 'radio':

        $option_element .= '<div class="label"><strong>'.$attr_option['title'].': </strong></div><div class="content">';
        foreach( $attr_option['opt'] as $val => $title ){

            (isset($attr_option['def']) && !empty($attr_option['def'])) ? $def = $attr_option['def'] : $def = '';

            $option_element .= '
            <label for="shortcode-option-'.$shortcode.'-'.$name.'-'.$val.'">'.$title.'</label>
            <input class="attr" type="radio" data-attrname="'.$name.'" name="'.$shortcode.'-'.$name.'" value="'.$val.'" id="shortcode-option-'.$shortcode.'-'.$name.'-'.$val.'"'. ( $val == $def ? ' checked="checked"':'').'>';
        }
        
        $option_element .= $desc . '</div>';
        
        break;
        
        case 'checkbox':
        
        $option_element .= '<div class="label"><label for="' . $name . '"><strong>' . $attr_option['title'] . ': </strong></label></div>    <div class="content"> <input type="checkbox" class="' . $name . '" id="' . $name . '" />'. $desc. '</div> ';
        
        break;  

        case 'select':
        
        $option_element .= '
        <div class="label"><label for="'.$name.'"><strong>'.$attr_option['title'].': </strong></label></div>
        
        <div class="content"><select id="'.$name.'">';
        $values = $attr_option['values'];
        foreach( $values as $index=>$value ){
            $option_element .= '<option value="'.$index.'">'.$value.'</option>';
        }
        $option_element .= '</select>' . $desc . '</div>';
        
        break;  

        case 'icon':
        case 'class':
        
        $option_element .= '
        <div class="label"><label for="'.$name.'"><strong>'.$attr_option['title'].': </strong></label></div>
        
        <div class="content"><select id="'.$name.'">';
        $values = $attr_option['values'];
        $option_element .= '<option value=""> -None- </option>';
        foreach( $values as $index=>$value ){
            $option_element .= '<option value="'.$value.'">'.$value.'</option>';
        }
        $option_element .= '</select>' . $desc . '</div>';
        
        break;
        
        case 'icons':
        
        $option_element .= '

        <div class="icon-option">';
        $values = $attr_option['values'];
        foreach( $values as $value ){
            $option_element .= '<i class="'.$value.'"></i>';
        }
        $option_element .= $desc . '</div>';
        
        break;
        
        case 'custom':


        if( $name == 'progressbar' ){
            $option_element .= '
            <div class="shortcode-dynamic-items" id="options-item" data-name="item">

                <div class="shortcode-dynamic-item">

                    <div class="label">
                        <label><strong>Style:  </strong> eg. Danger</label>
                    </div>

                    <div class="content">
                        <select id="style" class="shortcode-dynamic-item-style dynamic">
                        <option value=""> None </option>    
                        <option value="progress-bar-success"> Success </option>
                        <option value="progress-bar-warning"> Warning </option>
                        <option value="progress-bar-info"> Info </option>   
                        <option value="progress-bar-danger"> Danger </option>               
                        </select>
                    </div>




                    <div class="label">
                    <label><strong> Width: </strong> eg. 70%</label>
                    </div>

                    <div class="content">
                    <input id="width" class="shortcode-dynamic-item-width" type="text">
                    </div>  

                    <div class="label">
                    <label><strong> Min value: </strong> eg. 0</label>
                    </div>

                    <div class="content">
                    
                    <input class="shortcode-dynamic-item-min" type="text" value="" />
                    </div>

                    <div class="label">
                    <label><strong> Max value: </strong> eg. 100</label>
                    </div>

                    <div class="content">
                    <input id="max" class="shortcode-dynamic-item-max" type="text">
                    </div>              

                    <div class="label">
                    <label><strong> Default value: </strong> eg. 70</label>
                    </div>

                    <div class="content">
                    <input id="default" class="shortcode-dynamic-item-default" type="text">
                    </div>  

                    <div class="label">
                    <label><strong> Content: </strong> eg. wordpress</label>
                    </div>

                    <div class="content">
                    <input id="content" class="shortcode-dynamic-item-text" type="text">
                    </div>  


                </div>
            </div>

            <a href="#" class="btn yellow remove-list-item">'.__('Remove', ZEETEXTDOMAIN ). '</a> 
            <a href="#" class="btn yellow add-list-item">'.__('Add', ZEETEXTDOMAIN ).'</a>';
            
        } 

        elseif( $name == 'social' ){
            $option_element .= '
            <div class="shortcode-dynamic-items" id="options-item" data-name="item">

                <div class="shortcode-dynamic-item">

                    <div class="label">
                        <label><strong>Select Media: </strong></label>
                    </div>

                    <div class="content">
                        <select id="media" class="shortcode-dynamic-item-media dynamic">
                        <option value="facebook">Facebook</option>  
                        <option value="twitter">Twitter</option>
                        <option value="gplus">Google Plus</option>
                        <option value="flickr">Flickr</option>  
                        <option value="pintrest">Pintrest</option>
                        <option value="linkedin">Linkedin</option>  
                        <option value="youtube">Youtube</option>
                        <option value="skype">Skype</option>
                        <option value="github">Github</option>  
                        <option value="dribbble">Dribbble</option>
                        <option value="instagram">Instagram</option>                    
                        </select>
                    </div>




                    <div class="label">
                    <label><strong> Url: </strong></label>
                    </div>

                    <div class="content">
                    <input id="url" class="shortcode-dynamic-item-url" type="text">
                    </div>  

                </div>
            </div>

            <a href="#" class="btn yellow remove-list-item">'.__('Remove', ZEETEXTDOMAIN ). '</a> 
            <a href="#" class="btn yellow add-list-item">'.__('Add', ZEETEXTDOMAIN ).'</a>';
            
        } 


        elseif( $name == 'column' ){
            $option_element .= '
            <div class="shortcode-dynamic-items" id="options-item" data-name="item">

            <div class="shortcode-dynamic-item">

            <div class="label"><label><strong>Column Size: </strong></label></div>
            <div class="content">
            <select name="" class="shortcode-dynamic-item-size dynamic">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
            </select>
            </div>


            <div class="label"><label><strong> Content: </strong></label></div>
            <div class="content"><textarea class="shortcode-dynamic-item-text" type="text" name="" /></textarea></div>
            </div>
            </div>
            <a href="#" class="btn yellow remove-list-item">'.__('Remove Column', ZEETEXTDOMAIN ). '</a> <a href="#" class="btn yellow add-list-item">'.__('Add Column', ZEETEXTDOMAIN ).'</a>';
            
        } 
        

        
        elseif( $name == 'image' ){
            $option_element .= '
            <div class="shortcode-dynamic-item" id="options-item" data-name="image-upload">
            <div class="label"><label><strong> '.$attr_option['title'].' </strong></label></div>
            <div class="content">

            <input type="hidden" id="options-item"  />
            <img class="redux-opts-screenshot" id="image_url" src="" />
            <a data-update="Select File" data-choose="Choose a File" href="javascript:void(0);"class="redux-opts-upload button-secondary" rel-id="">' . __('Upload', ZEETEXTDOMAIN) . '</a>
            <a href="javascript:void(0);" class="redux-opts-upload-remove" style="display: none;">' . __('Remove Upload', ZEETEXTDOMAIN) . '</a>';

            if(!empty($desc)) $option_element .= $desc;

            $option_element .='
            </div>
            </div>';
        }
        
    
        
        elseif( $type == 'checkbox' ){
            $option_element .= '<div class="label"><label for="' . $name . '"><strong>' . $attr_option['title'] . ': </strong></label></div>    <div class="content"> <input type="checkbox" class="' . $name . '" id="' . $name . '" />' . $desc . '</div> ';
        } 
        
        
        break;
        
        case 'textarea':
        $option_element .= '
        <div class="label"><label for="shortcode-option-'.$name.'"><strong>'.$attr_option['title'].': </strong></label></div>
        <div class="content"><textarea data-attrname="'.$name.'">'.$attr_option['value'].'</textarea> ' . $desc . '</div>';
        break;

        case 'color':
        $option_element .= '
        <div class="label"><label for="shortcode-option-'.$name.'"><strong>'.$attr_option['title'].': </strong></label></div>
        <div class="content"><input class="attr" type="color" data-attrname="'.$name.'" value="'.$attr_option['value'].'" />' . $desc . '</div>';
        break;

        case 'text':
        default:
        $option_element .= '
        <div class="label"><label for="shortcode-option-'.$name.'"><strong>'.$attr_option['title'].': </strong></label></div>
        <div class="content"><input class="attr" type="text" data-attrname="'.$name.'" value="'.$attr_option['value'].'" />' . $desc . '</div>';
        break;
    }
    
    $option_element .= '<div class="clear"></div>';

    return $option_element;
}

