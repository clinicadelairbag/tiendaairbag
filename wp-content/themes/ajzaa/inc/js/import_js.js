
    jQuery(document).ready(function() {
        "use strict";
        jQuery(document).on('change', '#Demo_selector', function() {
            jQuery(".demos_label").hide();
            jQuery(".demos_label."+jQuery(this).val()).show();
        });
        jQuery(document).on('change', '#import_option', function() {
            if(jQuery(this).val()=='content') {
                jQuery("#tr_import_attachments").show();
                jQuery("#tr_delete_menus").hide();
            } else if(jQuery(this).val()=='widgets') {
                jQuery("#tr_import_attachments").hide();
                jQuery("#tr_delete_menus").hide();
            }else if(jQuery(this).val()=='menus') {
                jQuery("#tr_import_attachments").hide();
                jQuery("#tr_delete_menus").show();
            } else if(jQuery(this).val()=='complete_content') {
                jQuery("#tr_import_attachments").show();
                jQuery("#tr_delete_menus").show();
            } else{
                jQuery("#tr_import_attachments").hide();
                jQuery("#tr_delete_menus").hide();
            }
        });
        jQuery(document).on('click', '#import_demo_data', function(e) {
            e.preventDefault();

            if (jQuery( "#import_option" ).val() == "") {
                alert('Please select Import Type.');
                return false;
            }
            if (confirm('Are you sure, you want to import Demo Data now?')) {
                jQuery('.import_load').css('display','block');
                var progressbar = jQuery('#progressbar');
                var import_opt = jQuery( "#import_option" ).val();
                var import_expl = jQuery( "#Demo_selector" ).val();
                var p = 0;

                jQuery('.progress-value').html((0) + '%');
                progressbar.val(0);
                jQuery('.progress-bar-message').html('');
                jQuery('.error-message').html('');
                jQuery('#loading_gif').css({display: "inline"});
                jQuery('#OK_result').css({display: "none"});
                jQuery('#NOK_result').css({display: "none"});
                if(import_opt == 'content'){
                    for(var i = 1; i <= 10; i++){
                        var str;
                        if (i < 10) str = 'demo-file-0'+i+'.xml';
                        else str = 'demo-file-'+i+'.xml';
                        jQuery.ajax({
                            type: 'POST',
                            url: ajaxurl,
                            data: {
                                action: 'ajzaa_dataImport',
                                xml: str,
                                example: import_expl,
                                import_attachments: (jQuery("#import_attachments").is(':checked') ? 1 : 0)
                            },
                            success: function(data, textStatus, XMLHttpRequest){
                                console.log('Success!!' + data );
                                p += 10;
                                jQuery('.progress-value').html((p) + '%');
                                progressbar.val(p);
                                if (p == 90) {
                                    str = 'demo-file-10.xml';
                                    jQuery.ajax({
                                        type: 'POST',
                                        url: ajaxurl,
                                        data: {
                                            action: 'ajzaa_dataImport',
                                            xml: str,
                                            example: import_expl,
                                            import_attachments: (jQuery("#import_attachments").is(':checked') ? 1 : 0)
                                        },
                                        success: function(data, textStatus, XMLHttpRequest){
                                            p+= 10;
                                            jQuery('.progress-value').html((p) + '%');
                                            progressbar.val(p);
                                            jQuery('.progress-bar-message').html('<div class="alert alert-success"><strong>Import is completed</strong></div>');
                                            jQuery('#loading_gif').css({display: "none"});
                                            jQuery('#OK_result').css({display: "inline"});
                                        },
                                        error: function(MLHttpRequest, textStatus, errorThrown){
                                            jQuery('.error-message').html(get_error_from_response(MLHttpRequest));
                                            jQuery('#loading_gif').css({display: "none"});
                                            jQuery('#NOK_result').css({display: "inline"});
                                        }
                                    });
                                }
                            },
                            error: function(MLHttpRequest, textStatus, errorThrown){
                                jQuery('.error-message').html(get_error_from_response(MLHttpRequest));
                                jQuery('#loading_gif').css({display: "none"});
                                jQuery('#NOK_result').css({display: "inline"});
                                console.log('Error!!');
                            }
                        });
                    }
                } else if(import_opt == 'widgets') {
                    jQuery.ajax({
                        type: 'POST',
                        url: ajaxurl,
                        data: {
                            action: 'ajzaa_widgetsImport',
                            example: import_expl
                        },
                        success: function(data, textStatus, XMLHttpRequest){
                            console.log('widgets imported');
                            jQuery('.progress-value').html((100) + '%');
                            progressbar.val(100);
                            jQuery('.progress-bar-message').html('<div class="alert alert-success"><strong>Widgets import is completed</strong></div>');
                            jQuery('#loading_gif').css({display: "none"});
                            jQuery('#OK_result').css({display: "inline"});
                        },
                        error: function(MLHttpRequest, textStatus, errorThrown){
                            jQuery('.error-message').html(get_error_from_response(MLHttpRequest));
                            jQuery('#loading_gif').css({display: "none"});
                            jQuery('#NOK_result').css({display: "inline"});
                        }
                    });
                } else if(import_opt == 'menus') {
                    jQuery.ajax({
                        type: 'POST',
                        url: ajaxurl,
                        data: {
                            action: 'ajzaa_menuImport',
                            example: import_expl,
                            delete_menus: (jQuery("#delete_menus").is(':checked') ? 1 : 0)
                        },
                        success: function(data, textStatus, XMLHttpRequest){
                            console.log('Menus imported' + data );
                            jQuery('.progress-value').html((100) + '%');
                            progressbar.val(100);
                            jQuery('.progress-bar-message').html('<div class="alert alert-success"><strong>Menus import is completed</strong></div>');
                            jQuery('#loading_gif').css({display: "none"});
                            jQuery('#OK_result').css({display: "inline"});
                        },
                        error: function(MLHttpRequest, textStatus, errorThrown){
                            jQuery('.error-message').html(get_error_from_response(MLHttpRequest));
                            jQuery('#loading_gif').css({display: "none"});
                            jQuery('#NOK_result').css({display: "inline"});
                        }
                    });
                } else if(import_opt == 'options'){
                    jQuery.ajax({
                        type: 'POST',
                        url: ajaxurl,
                        data: {
                            action: 'ajzaa_import_options',
                            example: import_expl
                        },
                        success: function(data, textStatus, XMLHttpRequest){
                            console.log('options imported');
                            jQuery('.progress-value').html((100) + '%');
                            progressbar.val(100);
                            jQuery('.progress-bar-message').html('<div class="alert alert-success"><strong>Options import is completed</strong></div>');
                            jQuery('#loading_gif').css({display: "none"});
                            jQuery('#OK_result').css({display: "inline"});
                        },
                        error: function(MLHttpRequest, textStatus, errorThrown){
                            jQuery('.error-message').html(get_error_from_response(MLHttpRequest));
                            jQuery('#loading_gif').css({display: "none"});
                            jQuery('#NOK_result').css({display: "inline"});
                        }
                    });
                } else if(import_opt == 'complete_content'){
                    for(var i=1;i<10;i++){
                        var str;
                        if (i < 10) str = 'demo-file-0'+i+'.xml';
                        else str = 'demo-file-'+i+'.xml';
                        jQuery.ajax({
                            type: 'POST',
                            url: ajaxurl,
                            data: {
                                action: 'ajzaa_dataImport',
                                xml: str,
                                example: import_expl,
                                import_attachments: (jQuery("#import_attachments").is(':checked') ? 1 : 0)
                            },
                            success: function(data, textStatus, XMLHttpRequest){
                                p+= 7;
                                jQuery('.progress-value').html((p) + '%');
                                progressbar.val(p);
                                if (p == 63) {
                                    str = 'demo-file-10.xml';
                                    jQuery.ajax({
                                        type: 'POST',
                                        url: ajaxurl,
                                        data: {
                                            action: 'ajzaa_dataImport',
                                            xml: str,
                                            example: import_expl,
                                            import_attachments: (jQuery("#import_attachments").is(':checked') ? 1 : 0)
                                        },
                                        success: function(data, textStatus, XMLHttpRequest){
                                            p+= 7;
                                            jQuery('.progress-value').html((p) + '%');
                                            progressbar.val(p);
                                            jQuery('.progress-bar-message').append('<div class="alert alert-success">Content imported</div>');
                                            jQuery.ajax({
                                                type: 'POST',
                                                url: ajaxurl,
                                                data: {
                                                    action: 'ajzaa_import_options',
                                                    example: import_expl
                                                },
                                                success: function(data, textStatus, XMLHttpRequest){
                                                    p+= 7;
                                                    jQuery('.progress-value').html((p) + '%');
                                                    progressbar.val(p);
                                                    jQuery('.progress-bar-message').append('<div class="alert alert-success">Options imported</div>');
                                                    console.log('options imported');
                                                    jQuery.ajax({
                                                        type: 'POST',
                                                        url: ajaxurl,
                                                        data: {
                                                            action: 'ajzaa_widgetsImport',
                                                            example: import_expl
                                                        },
                                                        success: function(data, textStatus, XMLHttpRequest){
                                                            p+= 7;
                                                            jQuery('.progress-value').html((p) + '%');
                                                            progressbar.val(p);
                                                            jQuery('.progress-bar-message').append('<div class="alert alert-success">Widgets imported</div>');

                                                            str = 'menus.xml';
                                                            jQuery.ajax({
                                                                type: 'POST',
                                                                url: ajaxurl,
                                                                data: {
                                                                    action: 'ajzaa_menuImport',
                                                                    xml: str,
                                                                    example: import_expl,
                                                                    import_attachments: (jQuery("#import_attachments").is(':checked') ? 1 : 0),
                                                                    delete_menus: (jQuery("#delete_menus").is(':checked') ? 1 : 0)
                                                                },
                                                                success: function(data, textStatus, XMLHttpRequest){
                                                                    p+= 7;
                                                                    jQuery('.progress-value').html((p) + '%');
                                                                    progressbar.val(p);
                                                                    jQuery('.progress-bar-message').append('<div class="alert alert-success">Menus imported</div>');
                                                                    console.log("menu imported");
                                                                    jQuery.ajax({
                                                                        type: 'POST',
                                                                        url: ajaxurl,
                                                                        data: {
                                                                            action: 'ajzaa_otherImport',
                                                                            example: import_expl,
                                                                            delete_menus: (jQuery("#delete_menus").is(':checked') ? 1 : 0)
                                                                        },
                                                                        success: function(data, textStatus, XMLHttpRequest){
                                                                            jQuery('.progress-value').html((100) + '%');
                                                                            progressbar.val(100);
                                                                            jQuery('.progress-bar-message').append('<div class="alert alert-success"><strong>Import is completed.</strong></div>');
                                                                            jQuery('#loading_gif').css({display: "none"});
                                                                            jQuery('#OK_result').css({display: "inline"});
                                                                        },
                                                                        error: function(MLHttpRequest, textStatus, errorThrown){
                                                                            jQuery('.error-message').html(get_error_from_response(MLHttpRequest));
                                                                            jQuery('#loading_gif').css({display: "none"});
                                                                            jQuery('#NOK_result').css({display: "inline"});
                                                                        }
                                                                    });
                                                                },
                                                                error: function(MLHttpRequest, textStatus, errorThrown){
                                                                    jQuery('.error-message').html(get_error_from_response(MLHttpRequest));
                                                                    jQuery('#loading_gif').css({display: "none"});
                                                                    jQuery('#NOK_result').css({display: "inline"});
                                                                }
                                                            });

                                                        },
                                                        error: function(MLHttpRequest, textStatus, errorThrown){
                                                            jQuery('.error-message').html(get_error_from_response(MLHttpRequest));
                                                            jQuery('#loading_gif').css({display: "none"});
                                                            jQuery('#NOK_result').css({display: "inline"});
                                                        }
                                                    });
                                                },
                                                error: function(MLHttpRequest, textStatus, errorThrown){
                                                    jQuery('.error-message').html(get_error_from_response(MLHttpRequest));
                                                    jQuery('#loading_gif').css({display: "none"});
                                                    jQuery('#NOK_result').css({display: "inline"});
                                                }
                                            });
                                        },
                                        error: function(MLHttpRequest, textStatus, errorThrown){
                                            jQuery('.error-message').html(get_error_from_response(MLHttpRequest));
                                            jQuery('#loading_gif').css({display: "none"});
                                            jQuery('#NOK_result').css({display: "inline"});
                                        }
                                    });
                                }
                            },
                            error: function(MLHttpRequest, textStatus, errorThrown){
                                jQuery('.error-message').html(get_error_from_response(MLHttpRequest));
                                jQuery('#loading_gif').css({display: "none"});
                                jQuery('#NOK_result').css({display: "inline"});
                            }
                        });
                    }




                }
            }
            return false;
        });
    });

function get_error_from_response(response){
    var responseText=response.responseText.replace('{','');
    responseText = responseText.replace('}','');
    var trainindIdArray = responseText.split(':');
    responseText=trainindIdArray[trainindIdArray.length-1].replace('"','').replace('"','');
    return responseText;
}