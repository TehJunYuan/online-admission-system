<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Status of Application</title>
    </head>
    <body>
        <p>{{ 'Good Day,' }}</p>
        <p>{{ 'Status is updated for applicant with : '}}</p>
        <h3>--Applicant Information--</h3>
        <table border="0">
            <tr>
                <td>Applicant Name</td>
                <td>:</td>
                <th style="text-align: left;">{{$data['name']}}</th>
            </tr>
            <tr>
                <td>Status</td>
                <td>:</td>
                <th style="text-align: left;">{{$data['status']}} <a href="http://admission.southern.edu.my/application-progress">admmission Southern University College</a></th>
            </tr>
        </table>
        <p>{{ 'Thank you.' }}</p>
        <br>
        <p>{{ 'Best Regards,' }}</p>
        <p>{{ 'Southern University College' }}</p>
        <strong><b><h3>{{ '***THIS IS AN AUTO GENERATED EMAIL NOTIFICATION. PLEASE DO NOT REPLY. ***' }}</h3></b></strong>
    </body>
</html>
