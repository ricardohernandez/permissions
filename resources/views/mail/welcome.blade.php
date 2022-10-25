<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <style>
        p {
            font-size: 14px;
        }

        .signature {
            font-style: italic;
        }
    </style>
</head>
<body>
<table class="table table-sm">
    <thead>
        <tr>
            <th>Name</th>
        </tr>
    </thead>
    <tbody>
    <tr>
        <td> {{ $user["name"]}}</td>
    </tr>
    </tbody>
</table>
</body>
</html>