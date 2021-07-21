$(function() {
    const token = $('meta[name="csrf-token"]').attr('content')
    $('input.permission').on('change', function(e) {
        let that = $(this);

        $.ajax({
            url: `/dashboard/permissions/change-permission`,
            method: 'PUT',
            data: {
                '_token': token,
                'role_id': that.data('roleid'),
                'permission_id': that.data('permissionid'),
                'action': that.data('action'),
                'bool': e.target.checked,
            },
            dataType: 'json',
        }).done(function() {
            console.log('Success');
        }).fail(function(msg) {
            console.log(msg);
        });
    });
});