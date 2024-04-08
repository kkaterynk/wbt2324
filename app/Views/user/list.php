<h1>User list</h1>
<?php
if (sizeof($users) > 0)
{
    foreach ($users as $row)
    {
        echo $row->id . " - ";
        echo $row->name . " - ";
        echo $row->email . " - ";
        echo $row->password . " ";
        echo "<br/>";
    }
} else {
    echo "No user";
}
