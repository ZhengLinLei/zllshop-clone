window.addEventListener("load", () => {
    let button_change = document.querySelector("button#button_change_money");
    let button_get = document.querySelector("#get_points button");

    if (button_get) {
        button_get.addEventListener("click", () => {
            let body = `code=${code}`;
            button_get.disabled = true;
            fetch('./api/points?type=get', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: body
            })
                .then(response => response.json())
                .then(data => {
                    if (data.response == 200) {
                        let points = parseInt($('#daily_points_num').html());
                        let timer = setInterval(() => {
                            if(points == data.data.points){
                                clearInterval(timer);
                            }else{
                                points = points +1;
                                $('#daily_points_num').html(points);
                            }
                        }, 25);
                        $('#add_points').addClass('d-inline');

                        $('#get_points').html('<div class="text-success font-weight-bold"><i class="fas fa-calendar-check"></i> 今天已签到</div>');
                    } else {
                        button_get.disabled = false;
                        $('#info_get').addClass('text-danger');
                        $('#info_get').removeClass('adv');
                        $('#info_get').html('签到失败');
                    }
                });
        })
    }
    button_change.addEventListener("click", () => {
        let body = `code=${code}`;
        button_change.disabled = true;
        fetch('./api/points?type=change', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: body
        })
            .then(response => response.json())
            .then(data => {
                if (data.response == 200) {
                    $('#change_money').html(`${data.data.rmb}￥ - ${data.data.euro}€`);
                    let points = data.data.points;
                    $('#change_points').html(`-${points}分`);
                    $('#Modal').modal('show');

                    let timer = setInterval(() => {
                        if(points == 0){
                            clearInterval(timer);
                        }else{
                            if(points < 100){
                                points = points -1;
                            }else
                            if(points < 500 && points >= 100){
                                points = points -10;
                            }else
                            if(points < 1500 && points >= 500){
                                points = points -50;
                            }else{
                                points = points -100;
                            }
                            $('#daily_points_num').html(points);
                        }
                    }, 5);
                } else {
                    button_change.disabled = false;
                }
            });
    })
});