$(document).ready(function () {

    $('#join-group-btn').click(function () {

        var member, group;
        member = $(this).attr('member-id');
        group = $(this).attr('group-id');

        $.ajax({
            url: "post-and-get/ajax/join-group.php",
            type: "POST",
            data: {
                member: member,
                group: group,
                option: 'JOINGROUP'
            },
            dataType: 'json',
            success: function (mess) {
                $('#join-block').addClass('hidden');
                $('#request-cancel-block').removeClass('hidden');
                location.reload();
            }
        });
    });

    $('#cancel-request-btn').click(function () {

        var row_id;
        row_id = $(this).attr('row-id');

        $.ajax({
            url: "post-and-get/ajax/join-group.php",
            type: "POST",
            data: {
                row: row_id,
                option: 'CANCELREQUEST'
            },
            dataType: 'json',
            success: function (mess) {
                $('#request-cancel-block').addClass('hidden');
                $('#join-block').removeClass('hidden');
                location.reload();
            }
        });
    });

    $('.approve-request').click(function () {
        
        var row = $(this).attr('row_id');

        $.ajax({
            url: "post-and-get/ajax/join-group.php",
            type: "POST",
            data: {
                row: row,
                option: 'APPROVEREQUEST'
            },
            dataType: 'json',
            success: function (mess) {
                $('.request-to-join-' + mess.member).addClass('hidden');
                $('#request-to-join-' + mess.member).addClass('hidden');
                
                $('#accepted-request-' + mess.member).removeClass('hidden');
                $('.accepted-request-' + mess.member).removeClass('hidden');

                var count = $('#member-request-count').text();
                $('#member-request-count').text(count - 1);
            }
        });
    });

    $('.decline-request').click(function () {

        var row_id;
        row_id = $(this).attr('row_id');

        $.ajax({
            url: "post-and-get/ajax/join-group.php",
            type: "POST",
            data: {
                row: row_id,
                option: 'DECLINEREQUEST'
            },
            dataType: 'json',
            success: function (mess) {
                location.reload();
            }
        });
    });

    $('#leave-group').click(function () {
        var member, group;
        member = $(this).attr('member-id');
        group = $(this).attr('group-id');

        swal({
            title: "Are you sure?",
            text: "You will not be able to recover!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, Leave from group!",
            closeOnConfirm: false
        }, function () {

            $.ajax({
                url: "post-and-get/ajax/join-group.php",
                type: "POST",
                data: {
                    member: member,
                    group: group,
                    option: 'LEAVEGROUP'
                },
                dataType: 'json',
                success: function (mess) {
                    location.reload();
                }
            });
        });
    });

    $('.leave-group').click(function () {

        var member, group;
        member = $(this).attr('member-id');
        group = $(this).attr('group-id');

        swal({
            title: "Are you sure?",
            text: "You will not be able to recover!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, Leave from group!",
            closeOnConfirm: false
        }, function () {

            $.ajax({
                url: "post-and-get/ajax/join-group.php",
                type: "POST",
                data: {
                    member: member,
                    group: group,
                    option: 'LEAVEGROUP'
                },
                dataType: 'json',
                success: function (mess) {
                    location.reload();
                }
            });
        });
    });

    $('#member-name').keyup(function (e) {
        if (e.which != 38) {
            if (e.which != 40) {
                if (e.which != 13) {
                    var keyword = $('.member-name').val();
                    var member = $('.member-name').attr('member-id');
                    if (keyword == '') {
                        $('#member-name-list-append').empty();
                    }
                    $.ajax({
                        type: 'POST',
                        url: 'post-and-get/ajax/member.php',
                        dataType: "json",
                        data: {
                            keyword: keyword,
                            member: member,
                            option: 'FINDFRIENDS'
                        },
                        success: function (result) {

                            var html = '';
                            $.each(result, function (key) {
                                if (key < 8) {
                                    if (key === 0) {
//                                    html += '<li id="c' + this.id + '" class="name">' + this.name + '</li>';
//                                        html += '<li id="c' + this.id + '" class="name selected">' + this.first_name + ' ' + this.last_name + '</li>';
                                        html += '<div class="col-md-12 search-items search-items1 member" id="c' + this.id + '" data-selectable="" data-value="' + this.first_name + ' ' + this.last_name + '">';
                                        html += '<div class="col-xs-2 author-thumb"><img src="../upload/member/' + this.profile_picture + '" alt="avatar">';
                                        html += '</div>';
                                        html += '<div class="col-xs-9 notification-event">';
                                        html += '<span class="h6 notification-friend">' + this.first_name + ' ' + this.last_name + '</span><br />';
                                        html += '<span class="chat-message-item">4 Friends in Common</span>';
                                        html += '</div>';
                                        html += '<span class="col-xs-1 notification-icon">';
                                        html += '<svg class="olymp-happy-face-icon">';
                                        html += '<use xlink:href="icons/icons.svg#olymp-happy-face-icon"></use>';
                                        html += '</svg>';
                                        html += '</span>';
                                        html += '</div>';
                                    } else {
//                                        html += '<li id="c' + this.id + '" class="name">' + this.name + '</li>';
                                        html += '<div class="col-md-12 search-items  search-items1 member" id="c' + this.id + '" data-selectable="" data-value="' + this.first_name + ' ' + this.last_name + '">';
                                        html += '<div class="col-xs-2 author-thumb"><img src="../upload/member/' + this.profile_picture + '" alt="avatar">';
                                        html += '</div>';
                                        html += '<div class="col-xs-9 notification-event">';
                                        html += '<span class="h6 notification-friend">' + this.first_name + ' ' + this.last_name + '</span><br />';
                                        html += '<span class="chat-message-item">4 Friends in Common</span>';
                                        html += '</div>';
                                        html += '<span class="col-xs-1 notification-icon">';
                                        html += '<svg class="olymp-happy-face-icon">';
                                        html += '<use xlink:href="icons/icons.svg#olymp-happy-face-icon"></use>';
                                        html += '</svg>';
                                        html += '</span>';
                                        html += '</div>';
                                    }
                                }
                            });
                            $('#member-name-list-append').empty();
                            $('#member-name-list-append').append(html);
                        }
                    });
                }
            }
        }
    });

    $('#member-name-list-append').on('click', '.member', function () {

        var memberId = this.id;
        var member = $(this).attr('data-value');

        $('#mem-id').val(memberId.replace("c", ""));
        $('#member-name').val(member);
        $('#member-name-list-append').empty();

        $('#member-name').change(function () {
            $('#mem-id').val("");
        });
    });
    $('#member-name-list-append').on('mouseover', '.member', function () {
        var memberId = this.id;
        var member = $(this).attr('data-value');
        $('#mem-id').val(memberId.replace("c", ""));
        $('#member-name').val(member);
        $('#member-name').change(function () {
            $('#mem-id').val("");
        });
    });

    $('#member-name').keydown(function (e) {

        var $selected = $('div .selected'), $div = $('div.member');
        if (e.keyCode == 40) {
            var res = $selected.removeClass('selected').next().addClass('selected');
            if ($selected.next().length == 0) {
                $div.eq(0).addClass('selected');
            }
            if (res) {
                var member = $('div .selected').attr('data-value');
                $('#member-name').val(member);
            }

        } else if (e.keyCode === 38) {
            var res = $selected.removeClass('selected').prev().addClass('selected');
            if ($selected.prev().length == 0) {
                $div.eq(-1).addClass('selected');
            }
            if (res) {
                var member = $('div .selected').attr('data-value');
                $('#member-name').val(member);
            }

        } else if (e.which === 13) {
            e.preventDefault();
            var selected = $('.selected').attr("id");
            var memberId = selected.replace("c", "");
            $('#mem-id').val(memberId);
            $('#member-name').attr('attempt', 1);
            var membername = $('div .selected').attr('data-value');
            $('#member-name').val(membername);
            $('#member-name-list-append').empty();
            window.location.replace('profile.php?id=' + memberId);
            $('#member-name').change(function (e) {
                $('#member-name').attr('attempt', 0);
            });
        }
    });
    $('#member-name').change(function () {
        if ($('#member').attr('attempt') != 1) {
            $('#mem-id').val("");
        }

    });

    $('.add-members').click(function () {
        var member, group, added_by;
        member = $('#mem-id').val();
        added_by = $(this).attr('member-id');
        group = $(this).attr('group-id');

        $.ajax({
            url: "post-and-get/ajax/join-group.php",
            type: "POST",
            data: {
                member: member,
                group: group,
                option: 'CHECKMEMBEREXIST'
            },
            dataType: 'json',
            success: function (result) {
                if (result == false) {
                    $.ajax({
                        url: "post-and-get/ajax/join-group.php",
                        type: "POST",
                        data: {
                            member: member,
                            group: group,
                            option: 'CHECKINVITED'
                        },
                        dataType: 'json',
                        success: function (result1) {
                            if (result1 == false) {
                                $.ajax({
                                    url: "post-and-get/ajax/join-group.php",
                                    type: "POST",
                                    data: {
                                        addedBy: added_by,
                                        member: member,
                                        group: group,
                                        option: 'ADDMEMBER'
                                    },
                                    dataType: 'json',
                                    success: function (mess) {
                                        $('#new-member-name').text(mess)
                                        $('#add-member').modal('hide');
                                        $('#add-member-success-msg').modal('show');
                                        $('#mem-id').val('');
                                    }
                                });
                            } else {
                                $('#already-invited').modal('show');
                            }
                        }
                    });
                } else {
                    $('#already-a-member').modal('show');
                }
            }
        });
    });
    $('.done-btn').click(function () {
        $('#add-member-success-msg').modal('hide');
    });
    $('.close-btn').click(function () {
        $('.close-modal').modal('hide');
    });
});


