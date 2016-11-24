<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Employee Details</title>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="   crossorigin="anonymous"></script>

    <link rel = "stylesheet" type = "text/css"
          href = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>

</head>
<body>

<table>
    <tr>
        <th>EmpId</th>
        <th>Name</th>
        <th>Last</th>
        <th>Skill1</th>
        <th>Skill2</th>
        <th>Skill3</th>
        <th>Skill4</th>
        <th>Skill5</th>
        <th>StackId</th>
        <th>StackNickname</th>
        <th>Created by</th>
        <th>Updated by</th>
    </tr>

    <?php

        //Loop through $employee_details to get employee id, first name,stack id, stack name, lastname, created by, and updated by
        foreach ($employee_details as $emp_data) {

            echo '<tr>';
            echo '<td>' . htmlspecialchars($emp_data->emp_id) . '</td>';
            echo '<td>' . htmlspecialchars($emp_data->first_name) . '</td>';
            echo '<td>' . htmlspecialchars($emp_data->last_name) . '</td>';

            $skills = array();

            //Push skills for each employee in $skills array
            foreach ($employee_skills as $emp_skill) {
                if ( $emp_skill->emp_id === $emp_data->emp_id ) {
                    array_push($skills, $emp_skill->name);
                }
            }

            //Loop through $skills and fill in the skills field
            for ( $i = 0; $i < 5; $i++ ) {
                if ( isset($skills[$i]) ) {
                    echo '<td>' . htmlspecialchars($skills[$i]) . '</td>';
                } else {
                    echo '<td></td>';
                }
            }

            echo '<td>' . htmlspecialchars($emp_data->stack_id) . '</td>';
            echo '<td>' . htmlspecialchars($emp_data->nickname) . '</td>';
            echo '<td>' . htmlspecialchars($emp_data->created_by) . '</td>';
            echo '<td>' . htmlspecialchars($emp_data->updated_by) . '</td>';
            echo '</tr>';

        }
    ?>

</table>
</body>
</html>