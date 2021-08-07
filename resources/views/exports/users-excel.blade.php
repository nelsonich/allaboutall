<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Info</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th style="width: 15px;">
                    <strong>Id #</strong>
                </th>
                <th style="width: 15px;">
                    <strong>Name</strong>
                </th>
                <th style="width: 30px;">
                    <strong>Email</strong>
                </th>
                <th style="width: 15px;">
                    <strong>Role</strong>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $key => $user)
                <tr>
                    <td style="text-align: left">{{ $key + 1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>