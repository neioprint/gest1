<?php
    $to = "neioprint@gmail.com";
    $subject = "HTML email";
    $message = "
    <html>
        <head>
            <title>HTML email</title>
        </head>

        <body>
            <p>A table as email</p>
            <table>
                <tr>
                    <th>Firstname</th>
                    <th>Lastname</th>
                </tr>
                <tr>
                    <td>Fname</td>
                    <td>Sname</td>
                </tr>
            </table>
        </body>
    </html>
    ";
    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\b";
    $headers .= 'From: name' . "\r\n";
    mail($to, $subject, $message, $headers);
?>