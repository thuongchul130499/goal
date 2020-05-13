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
            url: '/upload-image',
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

    $('.view-more').click( function() {
        const $this = $(this);
        let link = $this.data('next-link');
        let nextPage = link.slice(link, -1) + (parseInt(link.slice(-1)) + 1);
        let appendTo = $this.data('append-to');
        $.get(link).then(res => {
            if (res) {
                $(appendTo).append(res);
                $this.data('next-link', nextPage);
                return ;
            }

            swal({
                title: 'Đã hết dữ liệu',
                type: 'warning',
                icon: 'warning'
            });
        })
    });

    var mainSliders = document.getElementsByClassName('task-noUi');

    for (let item of mainSliders) {
        let value = $(item).data('progress');
        noUiSlider.create(item, {
            start: value,
            connect: 'lower',
            tooltips: [true],
            step: 0.5,
            range: {
                'min': 0,
                'max': 100
            }
        }).on('end', (value, handle) => {
            let id = $(item).data('task-id');
            const goal_id = window.location.pathname.slice(-1);
            $.ajax({
                url: '/tasks/' + id,
                method: 'put',
                data: {
                    progress: value[0],
                    goal_id: goal_id
                },
                dataType: 'json',
                success: function(res) {
                    swal({
                        title: res.data.message,
                        icon: 'success',
                        type: 'success'
                    }).then( e => {
                        let percent = res.data.goal.progress;
                        $('.progress-task-'+ id).html(`${value} %`);
                        $('#input-task-' + id).val(value);
                        updateMain(res.data);
                    });
                },
                error: function(e) {
                    console.log(e)
                }
            });
        });
    };

    $('body').on('change', '.progress-task', function() {
        const id = $(this).data('id');
        let value = $(this).val();
        let slider = document.getElementById('slider-task-' + id);
        slider.noUiSlider.set(value);
        $('.progress-task-'+ id).html(`${value} %`);
    });

    $('.edit-desc').click( function(e) {
        e.preventDefault();
        $(this).closest('.parent').find('.to-none').toggleClass('d-none');
    });

    $('.delete-task').click(function (e) {
        e.preventDefault();
        const id = $(this).data('id');
        swal({
            title: 'Xác nhận',
            content: 'Bạn chắc muốn xóa điểm then chốt này?',
            dangerMode: true,
            buttons: true,
            icon: 'error'
        }).then ( e =>{
            if(e){
                $.ajax({
                    url: '/tasks/' + id,
                    method: 'delete',
                    dataTye: 'json',
                    success: function (res) {
                        swal({
                            title: res.data.message,
                            icon: 'success',
                            type: 'success'
                        }).then( e => {
                            $('#row-task-'+ id).remove();
                            updateMain(res.data);
                        });
                    }
                });
            }
        })
    });

    $('body').on('click', 'a.page-link', function(e) {
        let href = $(this).attr('href');
        const ele = getEleToAppend(href);
        $('.loader.user-table').removeClass('hide');
        $.post(href).then( async res => {
            $('div#user-pagination').html(res.links);
            $('tbody#user-table').html(res.view);
            $('.loader.user-table').addClass('hide');
        });
        e.preventDefault();
    });
});

function updateMain(data) {
    let sliderMain = document.getElementById('main-progress');
    sliderMain.noUiSlider.set(data.goal.progress);
    $('.total-main').html(`${data.goal.progress} %`);
    $('#input-main').val(data.goal.progress);
    $('#mainStatus').replaceWith(data.statusMain);
}

function getEleToAppend (string) {
    let str = (string || document.location.search).replace(/(^\?)/,'').split("&").map(function(n){return n = n.split("="),this[n[0]] = n[1],this}.bind({}))[0];
    
    return str[Object.keys(str)[0]];
}
