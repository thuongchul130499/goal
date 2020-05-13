$(document).ready(function (e) {
    $('body').on('click', '.follow', function () {
        let user_id = $(this).data('user-id');
        let type = $(this).data('type');
        const vue = $(this).data('req');
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
                if (!vue) {
                    $('#item-user-' + user_id).replaceWith(res);
                    return;
                };
                if (type === 'follow') {
                    btn = `
                        <button data-user-id="${user_id}" data-req="${true}" data-type="unfollow" class="btn btn-outline-danger has-icon btn-sm follow">
                            Bỏ theo dõi
                        </button>
                    `;
                    $('.count-follower').html(parseInt($('.count-follower').html()) + 1);
                } else {
                    btn = `
                        <button data-user-id="${user_id}" data-req="${true}" data-type="follow" class="btn btn-success has-icon btn-sm follow">
                            <i class="mdi mdi-account-plus-outline"></i>Theo dõi
                        </button>
                    `;
                    $('.count-follower').html(parseInt($('.count-follower').html()) - 1);
                }
                $('.btn.btn-outline-primary.btn-xs#load').replaceWith(btn);
            }
        });
    });
});