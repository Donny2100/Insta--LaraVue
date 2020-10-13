(function ($) {
    if (findGetParameter('country_id')) {
        callAPI({
            url: getUrlAPI('/state/country/' + findGetParameter('country_id'), 'api'),
            method: "get",
        }).then(res => {
            if (res.code === 200) {
                $('#city__state_id').val(null);
                $.each($('#city__state_id option'), function(i, opt) {
                    opt.remove();
                });

                $('#city__state_id').append('<option value="">-- Select a state --</option>');

                res.data.forEach(function(state) {
                    $('#city__state_id').append('<option value="' + state.id + '">' + state.name + '</option>');
                });

                if (findGetParameter('state_id')) {
                    $('#city__state_id').val(findGetParameter('state_id'));
                }

                callAPI({
                    url: getUrlAPI('/cities/state/' + findGetParameter('state_id'), 'api'),
                    method: "get",
                }).then(res => {
                    $('#select_city_id').val(null);
                    $.each($('#select_city_id option'), function(i, opt) {
                        opt.remove();
                    });

                    $('#select_city_id').append('<option value="">-- Select a city --</option>');

                    res.data.forEach(function(city) {
                        console.log(city);
                        $('#select_city_id').append('<option value="' + city.id + '">' + city.name + '</option>');
                    });

                    if (findGetParameter('city_id')) {
                        $('#select_city_id').val(findGetParameter('city_id'));
                    }
                });
            } else {
                console.log(res);
                notify('It was not possible to fetch States!', 'error');
            }
        });
    }


    $(document).on("change", "#select_country_id", function () {
        let country_id = $('#select_country_id').val();

        if (country_id) {
            callAPI({
                url: getUrlAPI('/state/country/' + country_id, 'api'),
                method: "get",
            }).then(res => {
                if (res.code === 200) {
                    $('#city__state_id').val(null);
                    $.each($('#city__state_id option'), function(i, opt) {
                        opt.remove();
                    });

                    $('#city__state_id').append('<option value="">-- Select a state --</option>');

                    res.data.forEach(function(state) {
                        $('#city__state_id').append('<option value="' + state.id + '">' + state.name + '</option>');
                    });


                } else {
                    console.log(res);
                    notify('It was not possible to fetch States!', 'error');
                }
            });
        }
    });

    $(document).on("change", "#city__state_id", function () {
        let state_id = $('#city__state_id').val();

        console.log(state_id);
        if (state_id) {
            callAPI({
                url: getUrlAPI('/cities/state/' + state_id, 'api'),
                method: "get",
            }).then(res => {
                if (res.code === 200) {
                    $('#select_city_id').val(null);
                    $.each($('#select_city_id option'), function(i, opt) {
                        opt.remove();
                    });

                    $('#select_city_id').append('<option value="">-- Select a city --</option>');

                    console.log(res.data);
                    res.data.forEach(function(city) {
                        $('#select_city_id').append('<option value="' + city.id + '">' + city.name + '</option>');
                    });


                } else {
                    console.log(res);
                    notify('It was not possible to fetch Cities!', 'error');
                }
            });
        }
    });

})(jQuery);


$(document).on("click", ".place_delete", function () {
    if (confirm('Are you sure? The place that deleted can not restore!'))
        $(this).parent().submit();
});

$(document).on("change", ".place_status", function () {
    let place_id = $(this).attr('data-id');
    let status = $(this).is(':checked');
    updateStatusPlace(place_id, status);
});

$(document).on("click", ".place_approve", function () {
    let place_id = $(this).attr('data-id');
    if (confirm('Are you sure?')) {
        updateStatusPlace(place_id, 1);
        location.reload();
    }
});

function updateStatusPlace(place_id, status) {
    let data_resp = callAPI({
        url: getUrlAPI('/places/status', 'api'),
        method: "put",
        body: {
            "place_id": place_id,
            "status": status
        }
    });
    data_resp.then(res => {
        if (res.code === 200) {
            notify(res.message);
        } else {
            console.log(res);
            notify('Error!', 'error');
        }
    });
}

function findGetParameter(parameterName) {
    var result = null,
        tmp = [];
    location.search
        .substr(1)
        .split("&")
        .forEach(function (item) {
          tmp = item.split("=");
          if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
        });
    return result;
}
