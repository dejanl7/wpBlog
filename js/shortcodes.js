jQuery(document).ready(function($) {
    var active_shortcode;
    var instance;
    var $dialog;
    var $widget;

/*============================================
    MCE Register External Plugin
==============================================*/
    if( typeof tinymce != 'undefined' ){
        tinymce.create('tinymce.plugins.portfolio', {
        init: function(ed, url){
            instance = ed;
               /* elements */
                ed.addButton('portfolio_elements', {
                    type: 'listbox',
                    text: 'Portfolio Elements',
                    icon: false,
                    onselect: function() {
                        active_shortcode = this.value();
                        call_shortcode();
                    },
                    values: [
                        { text: 'Accordion', value: 'accordion' },
                        { text: 'Alert Box', value: 'alert' },
                        { text: 'Button', value: 'button' },
                        { text: 'Icon', value: 'icon' },
                        { text: 'Progressbar', value: 'progressbar' },
                        { text: 'Toggle', value: 'toggle' },
                        { text: 'Tabs', value: 'tabs' },
                    ],
                    onPostRender: function() {
                        ed.my_control = this;
                    }
                }); 
        }
    });
        
        tinymce.PluginManager.add( 'portfolio', tinymce.plugins.portfolio );
    }


/*============================================
    Recognize Shortcode Type and Take all 
    specific fields for that type
==============================================*/
    function call_shortcode(){
        $.ajax({
            url: ajaxurl,
            data: { 
                shortcode: active_shortcode,
                action: 'shortcode_call'
            },
            method: 'POST',
            success: function( response ){
                if( response !== '' ){
                    $dialog = $('.shortcode-shortcode-dialog');
                    if( $dialog.length == 0 ){
                        $('body').append( '<div class="shortcode-shortcode-dialog"></div>' );
                        $dialog = $('.shortcode-shortcode-dialog');
                    }
                    $dialog.html( response );
                    $dialog.dialog({
                        open: function(){
                            $dialog.find('.shortcode-colorpicker').each(function(){
                                $(this).wpColorPicker();
                            });
                            /* MAKE MULTIPLE IMAGES SORTABLE */
                           /* $dialog.find('.shortcode-images-holder').each(function(){
                                var $this = $(this);
                                $this.sortable({
                                stop: function(){
                                        var $field = $this.parent().find('input');
                                        update_images( $this, $field );
                                     }
                                });
                            });*/
                        }
                    });
                }
                else{
                    add_shortcode( '['+active_shortcode+'][/'+active_shortcode+']' );
                }
            }
        });
    }



/*============================================
    Take Value from form and create Shortcode 
    - Click on "Insert" button
==============================================*/
    $(document).on( 'click', '.shortcode-save-options', function(e){
        e.preventDefault();
        var params = [];
        $('.shortcode-options').find('.shortcode-field').each(function(){
            var $this = $(this);
            params.push( $this.attr('name')+'="'+$this.val()+'"' );
        });

        var shortcode = '['+active_shortcode+' '+params.join(' ')+'][/'+active_shortcode+']';
        //alert(shortcode);

        add_shortcode( shortcode );
        $dialog.dialog('close');
    });


/*============================================
    Function for Adding Shortcode
==============================================*/
    function add_shortcode( shortcode ){
        if( instance ){
           instance.execCommand( 'mceInsertContent', 0, shortcode );
        }
        else{
           $widget.find('.shortcode-input').val( shortcode );
        }
    }


/*============================================
    WIDGET - Adding Widget Shortcode
==============================================*/
    $(document).on('change', '.add-widget-shortcode', function(){
        var $this = $(this);
        active_shortcode = $this.val();
        if( active_shortcode != '' ){
            $widget = $this.parents('.widget');
            call_shortcode();
        }
    }) ; 






});