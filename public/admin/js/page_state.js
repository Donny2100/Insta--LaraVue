(function ($) {
    'use strict';

    $(document).on("click", ".state_edit", function () {
        let state_id = $(this).attr('data-id');
        let state_name = $(this).attr('data-name');
        let state_slug = $(this).attr('data-slug');
        let country_id = $(this).attr('data-country');

        $('#submit_add_state').hide();
        $('#submit_edit_state').show();
        $('#add_state_method').val('PUT');
        $('#state_id').val(state_id);
        $('#state_name').val(state_name);
        $('#state_slug').val(state_slug);
        $('#country_id').val(country_id);

        $('#modal_add_state').modal('show');
    });

    $(document).on("click", ".state_delete", function () {
        if (confirm('Are you sure? The state that deleted can not restore!')) {
            $(this).parent().submit();
        }
    });

    $('#btn_add_state').click(function () {
        $('#state_id').val(null);
        $('#state_name').val(null);
        $('#state_slug').val(null);
        $('#country_id').val(null);

        $('#submit_add_state').show();
        $('#submit_edit_state').hide();
        $('#add_state_method').val('POST');
        $('#modal_add_state').modal('show');
    });

    $('#state_name').keyup(function () {
        let state_name = $(this).val();
        let slug = toSlug(state_name);
        $('#state_slug').val(slug);
    });

    $(document).on("change", ".state_status", function () {
        let state_id = $(this).attr('data-id');
        let status = $(this).is(':checked');

        let data_resp = callAPI({
            url: getUrlAPI('/state/status', 'api'),
            method: "put",
            body: {
                "state_id": state_id,
                "status": status ? 1 : 0
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
    });
})(jQuery);
