$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#image-ava').click(function() {
        $('#avatar').click();
    });

    $('body').on('change', '#avatar', function(e) {
        e.preventDefault();
        var formData = new FormData();
        formData.append('file', $(this).prop('files')[0]);
        $.ajax({
            type:'POST',
            url: '/upload-avatar',
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            success: res => {
                $('#image-ava').attr('src', res.data.path);
                swal({
                    text: res.data.msg,
                    type: 'success',
                    icon: 'success',
                    button: true
                });
            },
            error: error => {
                console.log(error);
            }
        });
    });
});