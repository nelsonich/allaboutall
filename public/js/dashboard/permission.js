$(function () {
    const token = $('meta[name="csrf-token"]').attr('content')
    $('input.permission').on('change', function (e) {
        let that = $(this);

        $.ajax({
            url: `/dashboard/permissions/change-permission`,
            method: 'POST',
            data: {
                '_token': token,
                'role_id': that.data('roleid'),
                'permission_id': that.data('permissionid'),
                'action': that.data('action'),
                'bool': e.target.checked,
            },
            dataType: 'json',
            success: function (res) {
                console.log(res)
            },
            error: function (error) {
                console.log(error)
            }
        });
    });
});
