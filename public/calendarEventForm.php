<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div id="eventform">
        <h2>Event form</h2>
        <form method="post" action="calendar.php">
            Event Name: <br>
            <input type="text" name="name">
            <br><br>
            Date: <br>
            <input type="text" id="date">
            <br><br>
            Description: <br>
            <textarea name="description" rows=10 cols="70"></textarea>
            <br><br>
            <input type="submit" name="submit" value="Submit">  
        </form>
        </div>
    </body>
</html>
