jQuery(document).ready(function ($) {


    //---------------footer background script-----------
    jQuery('#ajzaa_upload_footer_btn').click(function () {
        wp.media.editor.send.attachment = function (props, attachment) {
            jQuery('#ajzaa_footer_bg_img_path').val(attachment.url);
        }
        wp.media.editor.open(this);

        return false;
    });
    //---------------logo script-----------
    jQuery('#ajzaa_upload_btn').click(function () {
        wp.media.editor.send.attachment = function (props, attachment) {
            jQuery('#ajzaa_logo_path').val(attachment.url);
        }
        wp.media.editor.open(this);

        return false;
    });


    //------single background post script-----
    jQuery('#ajzaa_upload_single_post').click(function () {
        wp.media.editor.send.attachment = function (props, attachment) {
            jQuery('#ajzaa_bg_single_post_path').val(attachment.url);
        }
        wp.media.editor.open(this);
        return false;
    });
    //-------------------------------------
    $('.post-type-post #video_type').change(function () {
        var optionSelected = $(this).find("option:selected");
        var valueSelected = optionSelected.val();
        if (valueSelected == 'youtube') {
            $('#ajzaa_vimeo_id').parent().hide();
            $('#ajzaa_video_webm').parent().hide();
            $('#ajzaa_video_mp4').parent().hide();
            $('#ajzaa_video_ogv').parent().hide();
            $('#ajzaa_youtube_link').parent().show();
        } else if (valueSelected == 'vimeo') {
            $('#ajzaa_youtube_link').parent().hide();
            $('#ajzaa_video_webm').parent().hide();
            $('#ajzaa_video_mp4').parent().hide();
            $('#ajzaa_video_ogv').parent().hide();
            $('#ajzaa_vimeo_id').parent().show();
        } else {
            $('#ajzaa_vimeo_id').parent().hide();
            $('#ajzaa_video_webm').parent().show();
            $('#ajzaa_video_mp4').parent().show();
            $('#ajzaa_video_ogv').parent().show();
            $('#ajzaa_youtube_link').parent().hide();
        }

    });
    var optionSelected = $('.post-type-post #video_type').find("option:selected");
    var valueSelected = optionSelected.val();
    if (valueSelected == 'youtube') {
        $('#ajzaa_vimeo_id').parent().hide();
        $('#ajzaa_video_webm').parent().hide();
        $('#ajzaa_video_mp4').parent().hide();
        $('#ajzaa_video_ogv').parent().hide();
        $('#ajzaa_youtube_link').parent().show();
    } else if (valueSelected == 'vimeo') {
        $('#ajzaa_youtube_link').parent().hide();
        $('#ajzaa_video_webm').parent().hide();
        $('#ajzaa_video_mp4').parent().hide();
        $('#ajzaa_video_ogv').parent().hide();
        $('#ajzaa_vimeo_id').parent().show();
    } else {
        $('#ajzaa_vimeo_id').parent().hide();
        $('#ajzaa_video_webm').parent().show();
        $('#ajzaa_video_mp4').parent().show();
        $('#ajzaa_video_ogv').parent().show();
        $('#ajzaa_youtube_link').parent().hide();
    }

    $('.post-type-post #post-formats-select .post-format').change(function () {
        var postformavalueSelected = $(this).val();
        if (postformavalueSelected != 'gallery') {
            $('#ajzaa_meta_box_multiple_image').hide();
        } else {
            $('#ajzaa_meta_box_multiple_image').show();
        }
        if (postformavalueSelected != 'video') {
            $('#my-custom-fields').hide();
        } else {
            $('#my-custom-fields').show();
        }
        if (postformavalueSelected != 'audio') {
            $('#my-custom-fields-audio').hide();
        } else {
            $('#my-custom-fields-audio').show();
        }
    });

    $('.post-type-portfolio #post-formats-select .post-format').change(function () {
        var postformavalueSelected = $(this).val();
        if (postformavalueSelected != 'gallery') {
            $('#ajzaa_meta_box_multiple_image').hide();
        } else {
            $('#ajzaa_meta_box_multiple_image').show();
        }
        if (postformavalueSelected != 'video') {
            $('#custom-fields-video').hide();
        } else {
            $('#custom-fields-video').show();
        }
        if (postformavalueSelected != 'audio') {
            $('#custom-fields-audio').hide();
        } else {
            $('#custom-fields-audio').show();
        }
    });

    $(".post-type-post #post-formats-select input[type='radio']:checked").each(function () {
        //var optionSelected = $(this).find("checked");
        var postformavalueSelected = $(this).val();

        //alert(postformavalueSelected);
        if (postformavalueSelected != 'gallery') {
            $('#ajzaa_meta_box_multiple_image').hide();
        } else {
            $('#ajzaa_meta_box_multiple_image').show();
        }
        if (postformavalueSelected != 'video') {
            $('#my-custom-fields').hide();
        } else {
            $('#my-custom-fields').show();
        }
        if (postformavalueSelected != 'audio') {
            $('#my-custom-fields-audio').hide();
        } else {
            $('#my-custom-fields-audio').show();
        }
    });


    $(".post-type-portfolio #post-formats-select input[type='radio']:checked").each(function () {
        //var optionSelected = $(this).find("checked");
        var postformavalueSelected = $(this).val();
        //alert(postformavalueSelected);
        if (postformavalueSelected != 'gallery') {
            $('#ajzaa_meta_box_multiple_image').hide();
        } else {
            $('#ajzaa_meta_box_multiple_image').show();
        }
        if (postformavalueSelected != 'video') {
            $('#custom-fields-video').hide();
        } else {
            $('#custom-fields-video').show();
        }
        if (postformavalueSelected != 'audio') {
            $('#custom-fields-audio').hide();
        } else {
            $('#custom-fields-audio').show();
        }
    });

    // Creating and Adding Dynamic Form Elements.
    var addButton = $('.add_button'); //Add button selector
    var datanumber;
    var output;
    var wrapper = $('.socialmedia_wrapper'); //Input field wrapper
    var x = 0; //Initial field counter is 1
    $(addButton).click(function () { //Once add button is clicked
        datanumber = $('.socialmedia_wrapper div:last-child').find('input').data('number');
        if (datanumber != undefined) {
            x = datanumber;
        }
        x++;
        output = '<div class="social_media">';
        output += '<select name="social_icon[icon' + x + ']">';
        output += '<option value="-1" selected disabled>Select social media icon</option>';
        output += '<option value="fa-facebook">&#xf09a; facebook</option>';
        output += '<option value="fa-flickr">&#xf16e; flickr</option>';
        output += '<option value="fa-google-plus">&#xf0d5; google-plus</option>';
        output += '<option value="fa-instagram">&#xf16d; instagram</option>';
        output += '<option value="fa-linkedin">&#xf0e1; linkedin</option>';
        output += '<option value="fa-twitter">&#xf099; twitter</option>';
        output += '<option value="fa-vimeo">&#xf27d; vimeo</option>';
        output += '<option value="fa-whatsapp">&#xf232; whatsapp</option>';
        output += '<option value="fa-youtube">&#xf167; youtube</option>';
        output += '</select>';
        output += '<input type="text" name="socialmedia_name[media' + x + ']" placeholder="Your social media link" data-number="' + x + '" value="">';
        output += '<a href="javascript:void(0);" class="remove_button" title="Remove socialmedia">';
        output += '<button type="button" class="button bg_delete_button">delete</button>';
        output += '</a>';
        output += '</div>';

        $(wrapper).append(output); // Add field html
    });
    $(wrapper).on('click', '.remove_button', function (e) { //Once remove button is clicked
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--;
    });

    var $upload_button = jQuery('.wd-gallery-upload');


    var ajzaa_font_family = "";
    var ajzaa_font_weight = "";
    var ajzaa_font_subsets = "";


    $("#tabs-2 select.font_familly").change(function () {
        ajzaa_font_family = $(this).find(":selected").val();

        $("#wd-google-fonts-css").attr("href", "http://fonts.googleapis.com/css?family=" + ajzaa_font_family + ":" + ajzaa_font_weight + "&subset=" + ajzaa_font_subsets);
        $(this).closest("tbody").find("p").css("font-family", ajzaa_font_family);
        $(this).closest("tbody").find("h2").css("font-family", ajzaa_font_family);
        $(this).closest("tbody").find("ul li").css("font-family", ajzaa_font_family);
    });

    $("#tabs-2 select.font_weight").change(function () {
        ajzaa_font_family = $(this).find(":selected").val();

        $(this).closest("tbody").find("p").css("font-weight", ajzaa_font_family);
        $(this).closest("tbody").find("h2").css("font-weight", ajzaa_font_family);
        $(this).closest("tbody").find("ul li").css("font-weight", ajzaa_font_family);
    });


    $("#tabs-2 select.text_transform").change(function () {
        ajzaa_font_family = $(this).find(":selected").val();

        $(this).closest("tbody").find("p").css("text-transform", ajzaa_font_family);
        $(this).closest("tbody").find("h2").css("text-transform", ajzaa_font_family);
        $(this).closest("tbody").find("ul li").css("text-transform", ajzaa_font_family);
    });

    $("#tabs-2 select.text_size").change(function () {
        ajzaa_font_family = $(this).find(":selected").val();
        $(this).closest("tbody").find("p").css("font-size", ajzaa_font_family + 'px');
        $(this).closest("tbody").find("h2").css("font-size", ajzaa_font_family + 'px');
        $(this).closest("tbody").find("ul li").css("font-size", ajzaa_font_family + 'px');
    });

    $("#tabs-2 select.font_subsets").change(function () {
        ajzaa_font_family = $(this).find(":selected").val();
        $("#wd-google-fonts-css").attr("href", "http://fonts.googleapis.com/css?family=" + ajzaa_font_family + ":" + ajzaa_font_weight + "&subset=" + ajzaa_font_subsets);
    });


    if (wp.media !== undefined) {
        wp.media.customlibEditGallery = {

            frame: function () {

                if (this._frame)
                    return this._frame;

                var selection = this.select();

                this._frame = wp.media({
                    id: 'ajzaa_portfolio-image-gallery',
                    frame: 'post',
                    state: 'gallery-edit',
                    title: wp.media.view.l10n.editGalleryTitle,
                    editing: true,
                    multiple: true,
                    selection: selection
                });

                this._frame.on('update', function () {

                    var controller = wp.media.customlibEditGallery._frame.states.get('gallery-edit');
                    var library = controller.get('library');
                    // Need to get all the attachment ids for gallery
                    var ids = library.pluck('id');

                    $input_gallery_items.val(ids);

                    jQuery.ajax({
                        type: "post",
                        url: ajaxurl,
                        data: "action=ajzaa_gallery_upload_get_images&ids=" + ids,
                        success: function (data) {

                            $thumbs_wrap.empty().html(data);

                        }
                    });

                });

                return this._frame;
            },

            init: function () {

                $upload_button.click(function (event) {

                    $thumbs_wrap = $(this).next();
                    $input_gallery_items = $thumbs_wrap.next();

                    event.preventDefault();
                    wp.media.customlibEditGallery.frame().open();

                });
            },

            // Gets initial gallery-edit images. Function modified from wp.media.gallery.edit
            // in wp-includes/js/media-editor.js.source.html
            select: function () {

                var shortcode = wp.shortcode.next('gallery', '[gallery ids="' + $input_gallery_items.val() + '"]'), defaultPostId = wp.media.gallery.defaults.id, attachments, selection;

                // Bail if we didn't match the shortcode or all of the content.
                if (!shortcode)
                    return;

                // Ignore the rest of the match object.
                shortcode = shortcode.shortcode;

                if (_.isUndefined(shortcode.get('id')) && !_.isUndefined(defaultPostId))
                    shortcode.set('id', defaultPostId);

                attachments = wp.media.gallery.attachments(shortcode);
                selection = new wp.media.model.Selection(attachments.models, {
                    props: attachments.props.toJSON(),
                    multiple: true
                });

                selection.gallery = attachments.gallery;

                // Fetch the query's attachments, and then break ties from the
                // query to allow for sorting.
                selection.more().done(function () {
                    // Break ties with the query.
                    selection.props.set({
                        query: false
                    });
                    selection.unmirror();
                    selection.props.unset('orderby');
                });

                return selection;

            },
        };
    }


    if (wp.media !== undefined) {
        $(wp.media.customlibEditGallery.init);
    }


    /*--------------------------------------*/
    var curent_sreen = '';

    function ajzaa_add_ckeckbox_class() {
        curent_sreen = $("input:radio[name='ajzaa_start_screan']:checked").val();
        $("input[name='ajzaa_start_screan']").parent().removeClass('selected');

        $("input[value='" + curent_sreen + "'][name='ajzaa_start_screan']").parent().addClass('selected');
    }


    $("#tabs").tabs(); //initialize tabs
    $(function () {
        $("#tabs").tabs({
            activate: function (event, ui) {
                var scrollTop = $(window).scrollTop(); // save current scroll position
                window.location.hash = ui.newPanel.attr('id'); // add hash to url
                $(window).scrollTop(scrollTop); // keep scroll at current position
            }
        });
    });
    // reload the form when the checkbox is changed
    ajzaa_add_ckeckbox_class();
    $('.ajzaa_start_screan').click(function (e) {
        if (curent_sreen != $(this).val()) {
            ajzaa_add_ckeckbox_class();
            $(this).closest('form').submit();
        }
    });

    if (typeof wp.media !== 'undefined') {

        var _custom_media = true, _orig_send_attachment = wp.media.editor.send.attachment;

        $('.uploader .button').click(function (e) {
            var send_attachment_bkp = wp.media.editor.send.attachment;
            var button = $(this);
            var id = button.attr('id').replace('_button', '');
            _custom_media = true;
            wp.media.editor.send.attachment = function (props, attachment) {
                if (_custom_media) {
                    $("#" + id).val(attachment.url);
                } else {
                    return _orig_send_attachment.apply(this, [props, attachment]);
                }
                ;
            };

            wp.media.editor.open(button);
            return false;
        });

        $('.add_media').on('click', function () {
            _custom_media = false;
        });

    }

    $('.logo_position').on('change', 'input[name=ajzaa_logo_position]:radio', function (e) {
        var input_value = $(this).attr('id');
        $('.logo_position label').removeClass("label_selected");
        $("." + input_value).addClass("label_selected");
    });
    $('.ajzaa_footer_columns').on('change', 'input[name=ajzaa_footer_columns]:radio', function (e) {
        var input_value = $(this).attr('id');
        $('.ajzaa_footer_columns label').removeClass("label_selected");
        $("." + input_value).addClass("label_selected");
    });

    $('.import-demo-screenshot').on('change', 'input[name=demo_screenshot]:radio', function (e) {
        var input_value = $(this).attr('id');
        if (input_value != "demo-8" && input_value != "demo-9") {
            $('.import-demo-screenshot label').removeClass("label_selected");
            $("." + input_value).addClass("label_selected");
        }
    });
//---------page setting-----------
    $(function () {
        $('#ajzaa_page_title_area_style').change(function () {
            var selected = $(this).find(':selected').text();
            //alert(selected);
            if (selected == 'Standard Style') {
                $(".ajzaa_show_hide.float_left").hide();
            } else {
                $(".ajzaa_show_hide.float_left").show();
            }
            //$('#' + selected).show();
        }).change()
    });
    if($('.layout select option[selected="selected"]').val() == 'Slider') {
        $('.slider_number').addClass('open');
    }
    $('.layout select').on('change', function () {
        if($(this).val() == 'Slider') {
            $('.slider_number').addClass('open');
        } else {
            $('.slider_number').removeClass('open');
        }
    });


    //cookies message show Or Hide
    var checked = 0;
    $('.ajzaa_footer_cookies').on('change' , function() {
        checked++;
        if (checked % 2) {
            $('.cookies-message').addClass('open-cookies-msg');
        } else {
            $('.cookies-message').removeClass('open-cookies-msg');
        }
    });
});
