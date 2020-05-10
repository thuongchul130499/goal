$(document).ready( function (e) {
    $('body').on('click', '.follow', function() {
        let user_id = $(this).data('user-id');
        let type = $(this).data('type');
        $.ajax({
            url: '/users/follow',
            beforeSend: () => {
                $(this).replaceWith(btnLoad());
            },
            data: {
                user_id,
                type
            },
            method: 'post',
            success: (res) => {
                $('#item-user-'+user_id).replaceWith(res);
            }
        });
    });
});