$(document).ready(function () {

    $('#find-member').keyup(function (e) {

        if (e.which != 38) {
            if (e.which != 40) {
                if (e.which != 13) {
                    var keyword = $(this).val();
                    if (keyword == '') {
                        $('#name-list-append').empty();
                    }
                    $.ajax({
                        type: 'POST',
                        url: 'post-and-get/ajax/member.php',
                        dataType: "json",
                        data: {keyword: keyword, option: 'FINDMEMBER'},
                        success: function (result) {

                            var html = '';
                            $.each(result, function (key) {
                                if (key < 8) {
                                    var img = '';
                                    var propic = this.profile_picture;

                                    if (this.profile_picture) {
                                        if (this.facebook_id && propic.substring(0, 5) === "https") {

                                            img = '<img alt="profile picture" src="' + this.profile_picture + '" >';
                                        } else if (this.google_id && propic.substring(0, 5) === "https") {

                                            img = '<img alt="profile picture" src="' + this.profile_picture + '" >';
                                        } else {

                                            img = '<img alt="profile picture" src="upload/member/' + this.profile_picture + '">';
                                        }
                                    } else {
                                        img = '<img alt="profile picture" src="upload/member/member.png">';
                                    }

                                    if (key === 0) {
//                                    html += '<li id="c' + this.id + '" class="name">' + this.name + '</li>';
//                                        html += '<li id="c' + this.id + '" class="name selected">' + this.first_name + ' ' + this.last_name + '</li>';
                                        html += '<a href="member/profile.php?id=' + this.id + '">';
                                        html += '<div class="col-md-12 search-items member" id="c' + this.id + '" data-selectable="" data-value="' + this.first_name + ' ' + this.last_name + '">';
                                        html += '<div class="col-xs-2 author-thumb">';
                                        html += img;
                                        html += '</div>';
                                        html += '<div class="col-xs-10 notification-event">';
                                        html += '<span class="h6 notification-friend">' + this.first_name + ' ' + this.last_name + '</span>';
//                                        html += '<span class="chat-message-item">4 Friends in Common</span>';
                                        html += '</div>';
                                        html += '</div>';
                                        html += '</a>';
                                    } else {
//                                        html += '<li id="c' + this.id + '" class="name">' + this.name + '</li>';
                                        html += '<a href="member/profile.php?id=' + this.id + '">';
                                        html += '<div class="col-md-12 search-items member" id="c' + this.id + '" data-selectable="" data-value="' + this.first_name + ' ' + this.last_name + '">';
                                        html += '<div class="col-xs-2 author-thumb">' + img;
                                        html += '</div>';
                                        html += '<div class="col-xs-10 notification-event">';
                                        html += '<span class="h6 notification-friend">' + this.first_name + ' ' + this.last_name + '</span>';
//                                        html += '<span class="chat-message-item">4 Friends in Common</span>';
                                        html += '</div>';
                                        html += '</div>';
                                        html += '</a>';
                                    }
                                }
                            });
                            $('#name-list-append').empty();
                            $('#name-list-append').append(html);
                        }
                    });
                }
            }
        }
    });
    $('body').on('click', function (e) {
        $('#name-list-append').empty();
    });
    $('#name-list-append').on('click', '.member', function () {

        var memberId = this.id;
        var member = $(this).attr('data-value');
        $('#member-id').val(memberId.replace("c", ""));
        $('#find-member').val(member);
        $('#name-list-append').empty();
        $('#find-member').change(function () {
            $('#member-id').val("");
        });
    });
//    $('#name-list-append').on('mouseover', '.member', function () {
//        var memberId = this.id;
//        var member = $(this).attr('data-value');
//        $('#member-id').val(memberId.replace("c", ""));
//        $('#find-member').val(member);
//        $('#find-member').change(function () {
//            $('#member-id').val("");
//        });
//    });
    $('#find-member').keyup(function (e) {

        var $selected = $('div .selected'), $div = $('div.member');
        if (e.keyCode == 40) {
            var res = $selected.removeClass('selected').next().addClass('selected');
            if ($selected.next().length == 0) {
                $div.eq(0).addClass('selected');
            }
            if (res) {
                var member = $('div .selected').attr('data-value');
                $('#find-member').val(member);
            }

        } else if (e.keyCode === 38) {
            var res = $selected.removeClass('selected').prev().addClass('selected');
            if ($selected.prev().length == 0) {
                $div.eq(-1).addClass('selected');
            }
            if (res) {
                var member = $('div .selected').attr('data-value');
                $('#find-member').val(member);
            }

        } else if (e.which === 13) {
            e.preventDefault();
            var selected = $('.selected').attr("id");
            var memberId = selected.replace("c", "");
            $('#member-id').val(memberId);
            $('#find-member').attr('attempt', 1);
            var membername = $('div .selected').attr('data-value');
            $('#find-member').val(membername);
            $('#name-list-append').empty();
            window.location.replace('profile.php?id=' + memberId);
            $('#find-member').change(function (e) {
                $('#find-member').attr('attempt', 0);
            });
        }
    });
    $('#find-member').change(function () {
        if ($('#member').attr('attempt') != 1) {
            $('#member-id').val("");
        }

    });
});
