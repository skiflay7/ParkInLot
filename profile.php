<?php
require('SQLconnect.php');
session_start();

if ($_SESSION['active'] == true){

    echo "<!DOCTYPE = html>\n";
    echo "<html>\n";
    echo "  <head>\n";
    echo "      <title>{$_SESSION['name']}'s Profile</title>\n";
    echo "      <link rel = 'stylesheet' type = 'text/css' href = 'style.css'>\n";
    echo "  </head>\n";
    echo "  <body>\n";
    include('nav.php');

    echo "      <form method = 'POST'>\n";
    echo "          <h3>Update your Profile {$_SESSION['name']}!</h3>\n";
    echo "          <h4>Updating your username will cuase chats to be deleted.\n";
    echo "          <h5> Name: <input type = 'text' name = 'updateName' placeholder = {$_SESSION['name']}></input></h5>\n";
    echo "          <h5> Email: <input type = 'email' name = 'updateEmail' placeholder = {$_SESSION['email']}></input></h5>\n";
    echo "          <h5> UserName: <input type = 'text' name = 'updateUserName' placeholder = {$_SESSION['username']}></input></h5>\n";
    echo "          <button class = 'update' type = 'submit'>Update Profile</button>\n";
    //echo "          <p id = 'UpdateError'>Error Test</p>\n";
    echo "      </form>\n";

    $updateName = $_POST['updateName'];
    $updateEmail = $_POST['updateEmail'];
    $updateUserName = $_POST['updateUserName'];

    //echo "updateName = $updateName and updateEmail = $updateEmail and updateUserName = $updateUserName\n";

    if (empty($_POST['updateName']) and empty($_POST['updateEmail']) and empty($_POST['updateUserName'])){

        //echo "Nothing to Update\n";
    }

        if (!empty($_POST['updateName'])){

            //echo "update name is set\n";
            $sql = "update Users set user_fname = '{$_POST['updateName']}' where user_name = '{$_SESSION['username']}'";
            //echo $sql;

            $db->query($sql);
            
            //echo "Name has been updated to {$_POST['updateName']}\n<br><br>";
            //echo "session name: {$_SESSION['name']}\n";
            
            $_SESSION['name'] = $_POST['updateName'];

            header('Location: profile.php');
            echo "Name has been updated to {$_POST['updateName']}\n<br><br>";
            
            //echo "session name: {$_SESSION['name']}\n";
        }


        if (!empty($_POST['updateEmail'])){

            //echo "update email is set\n";
            $sql = "update Users set user_email = '{$_POST['updateEmail']}' where user_name = '{$_SESSION['username']}'";
            //echo $sql;

            $db->query($sql);

            //echo "Email has been updated to {$_POST['updateEmail']}\n<br><br>";

            $_SESSION['email'] = $_POST['updateEmail'];
            header('Location: profile.php');
            echo "Email has been updated to {$_POST['updateEmail']}\n<br><br>";

        }


        if (!empty($_POST['updateUserName'])){

            //echo "session username= {$_SESSION['username']}\n";
            //echo "update username is set\n";
            $sql = "update Users set user_name = '{$_POST['updateUserName']}' where user_name = '{$_SESSION['username']}'";
            //echo "sql statement: $sql\n";
            $db->query($sql);

            //echo "Username has been updated to {$_POST['updateUserName']}\n<br><br>";
            //header('Location: profile.php');

            $_SESSION['username'] = $_POST['updateUserName'];
            header('Location: profile.php');
            echo "Username has been updated to {$_POST['updateUserName']}\n<br><br>";
        }






    echo "      <div class = 'updatePassword'>\n";
    echo "          <button class = 'accordion'>Change Password</button>\n";
    echo "              <div class = 'panel'>\n";
    echo "                  <form method = 'POST'>\n";
    echo "                      <h5>Current Password: <input type = 'password' name = 'current_password'></input>\n";
    echo "                      <h5>New Password: <input type = 'password' name = 'new_password'></input>\n";
    echo "                      <h5>Confirm Password: <input type = 'password' name = 'confirm_password'></input><br>\n"; 
    echo "                      <br>\n";
    echo "                      <button class = 'update' type = 'submit'>Update Password</button>\n";
    echo "                  </form>\n";
    echo "              </div>\n";
    echo "      </div>\n";

    //echo "currentPassword = {$_POST['current_password']} and newpassword = {$_POST['new_password']} and confirm_password = {$_POST['confirm_password']}\n";


    if (!empty($_POST['current_password']) and !empty($_POST['new_password']) and !empty($_POST['confirm_password'])){

        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];
    
    //echo "currentPassword = {$_POST['current_password']} and newpassword = {$_POST['new_password']} and confirm_password = {$_POST['confirm_password']}\n";

        if ($new_password == $confirm_password){

            echo "passwords matched\n";
            $sql = "select * from Users where user_name = '{$_SESSION['username']}'";
            //echo $sql;

            if ($res = $db->query($sql)){

                //echo "sql statement query successfull\n";
                $row = $res->FETCH_ASSOC();

                $currentPassword = $row['user_password'];
                echo "current password: $currentPassword\n";
                
                if ($currentPassword == $current_password){

                    echo "echo password matched sql password\n";
                    $sql = "update Users set user_password = '$new_password' where user_name = '{$_SESSION['username']}'";
                    $db->query($sql);
                    //echo "sql: $sql";
                    header('Location: profile.php');
                    echo "password has been updated\n";
                }
                else{

                    echo "Sorry, your current password is incorrect\n";
                }
            }
        }
        else{

            echo "passwords did not match\n";
        }
    }



    echo "              <script>\n";
	echo "					var acc = document.getElementsByClassName('accordion');\n";
	echo "					var i;\n";
	
	echo "					for (i = 0; i < acc.length; i++){\n";
	echo "						acc[i].addEventListener('click', function(){\n";
	echo "/*Toggle between adding and removing the 'active' class, to highlight the button that controls the panel*/\n";
	echo "							this.classList.toggle('active');\n";
	echo "/*Toggle between hiding and showing the active panel */\n";
	echo "							var panel = this.nextElementSibling;\n";
	echo "							if (panel.style.display === 'block'){\n";
	echo "								panel.style.display = 'none';\n";
	echo "							}\n";
	echo "							else{\n";
	echo "								panel.style.display = 'block';\n";
	echo "							}\n";
	echo "						});\n";
	echo "					}\n";
    echo "              </script>\n";

    echo "      <br><br><br>\n";



    echo "      <div class = 'delete_account'>\n";
    echo "          <button class = 'delete_btn' onclick = 'deleteAccount()'>Delete Account</button>\n";
    echo "          <p id = 'delete_check'></p>\n";
    echo "      </div>\n";

    echo "<script>\n";
    echo "  function deleteAccount(){\n";
    echo "      var txt;\n";
    echo "      var r = confirm('Are you sure you want to delete your account?');\n";
    echo "      if (r == true){\n";
    $sql = "Delete from Users where user_email = '{$_SESSION['email']}';";
    //$db->query($sql);//////////////////////////////////////////////////////////////////////////////////////////////////////////
    //echo "          txt = $sql;\n";
    //echo "          txt = 'name = {$_SESSION['email']}';\n";
    echo "          txt = 'Account deleted';\n";
    echo "      }\n";
    echo "      else{\n";
    echo "          txt = 'Account deletion aborted';\n";
    echo "      }\n";
    echo "      document.getElementById('delete_check').innerHTML = txt;\n";
    echo "  }\n";
    echo "</script>\n";



    //echo "      </form>\n";
    
    echo "  </body>\n";
    echo "</html>\n";
}
else{

    header('Location: login.php');
}


?>