$(document).ready(function () {
    $('.edit-post').click(function () {

        var postid = this.id;

        $.ajax({
            url: "post-and-get/ajax/post.php",
            cache: false,
            dataType: "json",
            type: "POST",
            data: {
                post: postid,
                option: 'GETPOSTBYID'
            },
            success: function (post) {

                $.ajax({
                    url: "post-and-get/ajax/member.php",
                    cache: false,
                    dataType: "json",
                    type: "POST",
                    data: {
                        member: post.member,
                        option: 'GETMEMBER'
                    },
                    success: function (member) {

                        $.ajax({
                            url: "post-and-get/ajax/post-photos.php",
                            cache: false,
                            dataType: "json",
                            type: "POST",
                            data: {
                                id: post.id,
                                option: 'GETPOSTPHOTOS'
                            },
                            success: function (result) {
                                if (result == '') {
                                    return true;
                                } else {
                                    $(function () {
                                        $('#gallery1').imagesGrid({
                                            images: result
                                        });
                                        var html1 = '';
                                        html1 += '<i class="fa fa-times-circle remove-post-image-' + post.id + '" id="remove-post-image"></i>';

                                        $('#remove-circle-' + post.id).append(html1);

                                    });
                                }
                            }
                        });

                        var html = '';

                        html += '<div class="news-feed-form">';
                        html += '<form action="post-and-get/post.php" method="post" id="edit-post-form">';
                        html += '<div class="author-thumb">';
                        html += '<img src="../upload/member/' + member.profilePicture + '" alt="author" class="avatar">';
                        html += '</div>';
                        html += '<div class="form-group with-icon label-floating">';
                        html += '<label class="control-label">Share what you are thinking here...</label>';
                        html += '<textarea class="form-control" placeholder="" name="description">' + post.description + '</textarea>';

                        html += '<div class="flipScrollableArea hidden" id="image-list-edit" style="/*! height: 112px; */ /*! width: 100%; */">';
                        html += '<div class="flipScrollableAreaWrap">';
                        html += '<div class="flipScrollableAreaBody" style="height: 112px;">';
                        html += '<div class="flipScrollableAreaContent">';
                        html += '<div class="flipScrollableAreaContent1">';
                        html += '</div>';
                        html += '<span class="_uploadouterbox_edit">';
                        html += '<div class="_m _6a">';
                        html += '<a class="_uploadbox" rel="ignore">';
                        html += '<div class="_upload">';
                        html += '<input multiple="" name="upload-other-images" title="Choose a file to upload" data-testid="add-more-photos" display="inline-block" type="file" class="_uploadinput _outlinenone" id="add-more-photos">';
                        html += '</div>';
                        html += '</a>';
                        html += '</div>';
                        html += '</span>';
                        html += '</div>';
                        html += '</div>';
                        html += '</div>';
                        html += '<div class="flipScrollableAreaTrack invisible_elem" style="opacity: 0;">';
                        html += '<div class="flipScrollableAreaGripper hidden_elem"></div>';
                        html += '</div>';
                        html += '</div>';





                        html += '</div>';
                        html += '<div class="panel panel-default panel-post">';
                        html += '<div class="panel-heading">';
                        html += '<ul class="header-dropdown">';
                        html += '<li id="remove-circle-' + post.id + '">';

                        html += '</li>';
                        html += '</ul>';
                        html += '</div>';
                        html += '<div class="panel-body">';
                        html += '<div id="gallery1"></div>';
                        html += '</div>';
                        html += '</div>';
                        html += '<div class="add-options-message">';
                        html += '<a href="#" class="options-message" data-toggle="tooltip" data-placement="top"   data-original-title="ADD PHOTOS">';
                        html += '<svg class="olymp-camera-icon" data-toggle="modal" data-target="#update-header-photo"><use xlink:href="svg-icons/sprites/icons.svg#olymp-camera-icon"></use></svg>';
                        html += '<div class="_upload">';
                        html += '<input  name="post-image" display="inline" role="button" tabindex="0" data-testid="media-tab" type="file" class="_uploadinput _outlinenone" id="upload_first_image_edit">';
                        html += '<input type="hidden" id="upload-post-image" name="upload-post-image" >';
                        html += '</div>';
                        html += '</a>';
                        html += '<a href="#" class="options-message" data-toggle="tooltip" data-placement="top"   data-original-title="TAG YOUR FRIENDS">';
                        html += '<svg class="olymp-computer-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-computer-icon"></use></svg>';
                        html += '</a>';
                        html += '<a href="#" class="options-message" data-toggle="tooltip" data-placement="top"   data-original-title="ADD LOCATION">';
                        html += '<svg class="olymp-small-pin-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-small-pin-icon"></use></svg>';
                        html += '</a>';
                        html += '<input type="hidden" value ="' + post.id + '" id="id" name="id" />';
                        html += '<input type="submit" name="edit-post" class="btn btn-primary btn-md-2 edit-post" value="Save" />';
                        html += '</div>';
                        html += '</form>';
                        html += '</div>';

                        $('#edit-post-section').empty();
                        $('#edit-post-section').append(html);

                    }
                });

            }
        });
    });


});


