# Hello!
&nbsp;

---
## This application is written in "JavaScript ES6" and "Php" using "SQL" databases via "OpenServer" and styled using the "Materialize" framework. 
&nbsp;
# **Attention!**
## **The application was tested and worked correctly on the server platform "OpenServer", I cannot guarantee that the application will work on other server platforms. For the most correct operation of the application, it is recommended to follow the steps for testing the application given below!**
&nbsp;
## If you want to test the operation of the application, then you will need:
&nbsp;
### **1. `Download and install the "basic" version of "`[OpenServer] (https://ospanel.io)`" from the official website`;**
### **2. `Create a folder "www" and drag all the files from the folder "Cabinet_on_JavaScript" into it`;**
### **3. `Next, you need to put the "www" folder in the "domains" folder of the "OpenServer" application (click on the tray icon and select "Project folder")`;**
### **4. `After completing all the previous steps, open "OpenServer". Next, go to "Settings", select the "Modules" tab. From the "MySQL / MariaDB" drop-down list, select the latest version of "MySQL" (currently "MySQL-8.0-Win10") and save your changes`;** 
### **5. `Close the settings and click "Run server", then go to the "Advanced" tab and select the "PhpMyAdmin" application - for working with databases`;**
### **6. `Enter your login and password, by default: "root", "" (leave the password field empty)`;**
### **7. `Now you need to create a database, on the left side, click on "New", enter the name "cabinet_on_javascript" and leave the default encoding, click "Create"`;**
### **8. `Select the "created" database and select "Import" on the right side of the upper toolbar, now you need to specify the "SQL" file from the "www" folder, after selecting, scroll to the bottom and press "go". Now you can track registered users and their personal data in "cabinet_on_javascript"`;**
### **9. `Now return to the "OpenServer" application and select the "My projects" tab, select the "www" project from the list. The Cabinet on JavaScript application starts`;**
&nbsp;

## **Finally, you can start testing the application!** 

---

&nbsp;

# 1. Introduction
&nbsp;

---
### "Cabinet on JavaScript" is an application written in "JavaScript ES6" and "Php" that uses the server-side development environment "OpenServer" and the "Materialize" framework to style the application. . It is an opportunity for a user to register in the system or log in and enter his personal account. In his personal account, he can always change his personal data or log out of it.
### This application has a "front-end" and "back-end" part and works through "ajax requests". The operation of the application looks like this: the user enters his data into the form, confirms the entered data, the data is sent to the server in the database, and with further authorization, the user enters his personal account.
### In the personal account for an authorized user, his personal data are loaded from the database and displayed in the appropriate fields. When the user's personal data changes, the updated data is also sent to the server in the database, and when you re-enter your personal account, the new personal data of the user that he changed is loaded.
### Also, the user can log out from the personal account and then the username and password will have to be entered again. This application actively used "cookies" to interact with the personal account, as well as to update its data. 
---
&nbsp;

# 2. Familiarization
&nbsp;

---
### Let's take a look at the architecture of the project.
### The main project folder contains the following files: "cabinet.php" - the main file containing the layout of the user's personal account; "favicon.png" - icon for the application; "index.html" - the main file containing the layout of the application; file "user_cabinet.sql" - contains a table template for the database of registered users.
### The "core" folder contains files for working with the database: "config.php" - contains data for accessing the database; "get_user_data.php" - needed to get the user's personal data from the database; "login.php" - needed to authorize a user when logging in; "signup" - needed to authorize the user during registration; "update_user_data.php" - needed to update user data in the database.
### The "css" folder contains all the application styles: "materialize.css" - styles from the "Materialize" framework; "materialize.min.css" - styles from the "Materialize" framework in minification; "style.css" - general styles for the application.
### The "js" folder contains the files for the "Materialize" framework: "materialize.js" - the main script file for the "Materialize" work; "materialize.min.js" - the same file in minification.
### The "script" folder contains the main files for the application to work: "ajax.js" - a file containing ajax-request common to all; "get_user_data.js" - a file containing the work of the user's personal account; "logout.js" - a file containing the work of logging out of the personal account; "main.js" - a file containing the work of modal windows during authorization; "script.js" - a file containing work for logging and registering a user. 
---
&nbsp;

# 3. Overview
&nbsp;

---
### Time for a detailed description of the application code.
### Since the work with user authorization is directly related to the server part, it was necessary to create a separate backend part in the "Php" language. It is located in the "core" folder and contains several necessary files for working with the database. Let's take a quick look at these files.
---
&nbsp;

---
### File "config.php" - contains data for accessing the database: "server", "login", "password", "database name".

```

<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cabinet_on_javascript";

```
---
&nbsp;

---
### File "signup.php" - contains the processing of the form submitted by the user during registration.

```

<?php
require_once 'config.php';

$name = trim($_POST['name']);
$pass = trim($_POST['pass']);
$email = trim($_POST['email']);
$birthday = trim($_POST['birthday']);
$sex = trim($_POST['sex']);

if ($name =='' OR $pass=='' OR $email=='' OR $birthday=='' OR $sex ==''){
    echo 2;
    die;
}

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO users (name, email, password, birthday, sex) VALUES ('".$name."', '".$email."', '".$pass."', '".$birthday."', '".$sex."')";

if ($conn->query($sql) === TRUE) {
    echo 1;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

```

### It writes the data of the new user to the "sql" database and stores it.
---
&nbsp;

---
### File "login.php" - contains the processing of the form submitted by the user during logging.

```

<?php
require_once 'config.php';

$email= trim($_POST['email']);
$pass = trim($_POST['pass']);

if ($email =='' OR $pass==''){
    echo 2;
    die;
}

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT name, email FROM users WHERE email='".$email."' and password='".$pass."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    $row = $result->fetch_assoc();
    echo json_encode($row);
} else {
    echo "0";
}
$conn->close();
?>

```

### It checks the data of the registered user in the "sql" database and returns his data.
---
&nbsp;

---
### The file "get_user_data.php" - gets the personal data of a specific user from the server database, sending them to the personal account.

```

<?php
require_once 'config.php';

$email= trim($_POST['email']);

if ($email ==''){
    echo 2;
    die;
}

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM users WHERE email='".$email."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    $row = $result->fetch_assoc();
    echo json_encode($row);
} else {
    echo "0";
}
$conn->close();
?>

```

### To do this, the user's "email" is sent to him.
---
&nbsp;

---
### The file "update_user_data.php" - receives updated user data from the personal account, and updates the database. 

```

<?php
require_once 'config.php';

$email= trim($_POST['email']);
$name= trim($_POST['name']);
$pass= trim($_POST['pass']);
$birthday= trim($_POST['birthday']);
$sex= trim($_POST['sex']);

if ($email ==''){
    echo 2;
    die;
}

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "UPDATE users SET name='".$name."', password='".$pass."', birthday='".$birthday."', sex='".$sex."' WHERE email='".$email."'";

if ($conn->query($sql) === TRUE) {
    echo 1;
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>

```
---
&nbsp;

---
### Let's parse the files from the "script" folder.
### In the "ajax.js" file, an ajax request to the backend server is created. The ajax function takes several parameters: "url" - contains the path to "php" - files for processing the request; "method" - contains a variant of the request method; "functionName" - contains a function that receives a response from the server; "dataArray" - contains an object with user data.

```

function ajax(url, method, functionName, dataArray) {
    let xhttp = new XMLHttpRequest();
    xhttp.open(method, url, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(requestData(dataArray));
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            functionName(this.response);
        }
    }
}

function requestData(dataArr) {
    let out = "";
    for (let key in dataArr) {
        out += `${key}=${dataArr[key]}&`;
    }
    return out;
}

```

### Create a new "XMLHttp Request". We specify the request method, request address and asynchrony. We register the request headers. We send the "requestData (dataArray)" function in the parameter, we pass an object with user data.
### The "requestData(dataArr)" function is needed to create a query string with user data and then send it to the server. In the function itself, the usual iteration of the object by keys takes place, and by appending its contents through ampersands ("&") to the "out" variable. When the function is sent to the server, it returns the generated query string.
### Further, after sending the user's data to the server, we write the received response through an anonymous function, and if the request was successful, then we write the result ("functionName") to the function to receive the response.
---
&nbsp;

---
### The file "script.js" contains the code for sending data from the registration form and logging to the server. For convenience, let's divide the code into two parts: "registration" and "logging".
### For the registration block, we receive the "id" button for submitting the form from the page and hang up an event-click with an anonymous function.

```

document.querySelector('#signup-submit').onclick = function (event) {
    event.preventDefault();
    let name = document.querySelector('#signup-name').value;
    let pass = document.querySelector('#signup-pass').value;
    let email = document.querySelector('#signup-email').value;
    let birthday = document.querySelector('#signup-birthday').value;
    let sex = document.querySelectorAll('.sex');
    for (let i = 0; i < sex.length; i++) {
        if (sex[i].checked) {
            sex = sex[i].value;
            break;
        }
    }
    let data = {
        'name': name,
        'pass': pass,
        'email': email,
        'birthday': birthday,
        'sex': sex,
    }
    ajax('core/signup.php', 'POST', signup, data);

    function signup(result) {
        if (result == 2) {
            M.toast({ html: 'Fill in the fields!', classes: 'toast' });
        }
        else if (result == 1) {
            M.toast({ html: 'You have successfully registered!', classes: 'toast' });
            closeModal();
        }
        else {
            M.toast({ html: 'Error! Try to register again!', classes: 'toast' });
        }
    }
}

```

### In the function, we first cancel the default event, and then use the "id" to get the values ​​from the form fields into the variables. Since "sex" has three choices, we find the value selected by the user through the "for" loop and write it to the variable "sex".
### Further, to send data from the form to the server, we need to create an object containing all the previously created variables with user data. We will send this "data" object as a parameter to the ajax function in the "ajax.js" file. So below, after creating the "data" object, we pass the parameters into the ajax request: url-path to the registration file "signup.php"; request method; the "signup" function - which will receive a response; object "data" with user data.
### The "signup" function as a parameter accepts a response from the server and, depending on the received response, displays a pop-up message: 2 - fill in the fields; 1 - success; 0 - registration error. 
---
&nbsp;

---
### We'll do similar things for the logging block.
### We receive the form button by the 'ID ", send a click event to it with an anonymous function. In the function, cancel the default event, and get the values ​​from the logging fields into the variables.

```

document.querySelector('#login-submit').onclick = function (event) {
    event.preventDefault();
    let pass = document.querySelector('#login-pass').value;
    let email = document.querySelector('#login-email').value;

    let data = {
        'pass': pass,
        'email': email,
    }
    ajax('core/login.php', 'POST', login, data);

    function login(result) {
        console.log(result)
        if (result == 2) {
            M.toast({ html: 'Fill in the fields!', classes: 'toast' });
        }
        else if (result == 0) {
            M.toast({ html: 'No such user found!', classes: 'toast' });
        }
        else {
            result = JSON.parse(result);
            let d = new Date();
            d.setTime(d.getTime() + (10 * 60 * 1000));
            let expires = d.toUTCString();
            document.cookie = `email=${result.email}; expires=${expires}; path=/`;
            location.href = "cabinet.php";
        }
    }
}

```

### Create the" data "object with the user data. Then pass the parameters to the ajax function: path to the file "login.php"; request method ("POST"); function "login" - to process the response from the server; object "data" with user data The "login" function has undergone some changes in comparison with the "signup function".
### We will do logging through cookies, namely, create and save the parameters of the authorized user in the browser. To create a cookie, we need to convert our result received from the server into an object using "JSON.parse()". Then we create a new object "Date "and assign it to the variable" d ". The created object is set the time through the" setTime() "method. Inside" setTime() ", the time is calculated by the formula: current time ("d.getTime()") plus the lifetime in milliseconds (10*60*1000). Next, create a new the "expires" variable, and into it we write the object with the date converted to UTC using the "toUTCString()" method. Now we can create a cookie by using "document.cookie" and writing to it: the key "email" with the value from the object "result"; the "expires" key with the value of the previously created "expires" object; key "path" with value "/".
### Also, after creating a cookie with user data, we need to go to your personal account. To do this, in "location.href" we write the path to the file "cabinet.php".
---
&nbsp;

---
### To clarify the process of the application, you need to briefly explain how cookies work. Cookies are files stored in the user's browser. They are necessary to store user data, for example, data for entering a personal account. Thanks to them, the user can re-enter his personal account without constantly entering his data.
### Cookies are deleted automatically after a certain amount of time, this is necessary for the safety and privacy of the user. Usually, encryption is applied to a cookie, turning it into a random set of characters for security purposes, but in this application, to understand its operation and to demonstrate it clearly, cookie encryption was not applied.
### Now let's look at how logging works using cookies.
---
&nbsp;

---
### The file "cabinet.php" is located in the main project folder. It contains the layout of the user's personal account. But before rendering the page with the user's personal account, the cookie is checked for the presence of: user email; checking the user's email for an empty string.

```

<?php
    //var_dump($_COOKIE);
    if ( !isset($_COOKIE['email']) OR trim($_COOKIE['email']) ==''){
        header("Location: index.html");
        exit; 
    }
?>

```

### If the check fails, in other words, there is no cookie with user data, then the user, when trying to go to his personal account, will be redirected to the authorization page. If a user's cookie is present, the page with the user's personal account will be rendered.
---
&nbsp;

---
### Now let's move on to the work of the user's personal account.
### The first thing to do is, of course, exit your personal account. Leaving the personal account implies that the user will not be able to enter the account again without re-authorization, which means that we will need to get the necessary cookie with the user's data and delete it. This function is performed by the "logout.js" file located in the "script" folder.
### Inside the file, we assign the "logout" button with a click event with an anonymous function. Inside the function, we get the cookie into the "c" variable.

```

document.querySelector('#logout').onclick = function () {
    let c = document.cookie;
    console.log(c);
    let d = new Date();
    d.setTime(d.getTime() - (10 * 60 * 1000));
    let expires = d.toUTCString();
    document.cookie = `${c}; expires=${expires}; path=/`;
    location.reload();
}

```

### Then we do the same cookie creation as the first time, except for a little detail. We will delete the cookie as follows: reducing its lifetime to minus one minute (d.getTime() - (10 * 60 * 1000), which in turn will delete it automatically when you click on the "logout" button.
### At the end of all operations on deleting the cookie, we reload the page ("location.reload()"), and since the cookie storing the user's authorization data was deleted, the user was sent to the re-authorization page. 
---
&nbsp;

---
### The personal account should also be able to change and update user data. To do this, we need to get the data of the authorized user. Let's divide the work of the personal account into two parts: "receiving user data through the browser cookie"; "sending the changed user data to the server".
---
&nbsp;

---
### The "get_user_data.js" file from the "script" folder will receive user data through the browser cookie, send a unique user email via an ajax request to the "get_user_data.php" file and receive a response containing data from a specific user and display it on the personal account page.
### Also, "get_user_data.js" contains functions for sending updated user data to the "update_user_data.js" file, which in turn updates the user database and amends the user data when changing the personal account.
### The work of the "get_user_data.js" file begins with a special function of the "Materialize" framework from the official documentation site. This function is needed to correctly call the calendar when you click on the field with the user's date of birth in the personal account. It fires when the "DOM" of the document is loaded through an event listener.

```

document.addEventListener('DOMContentLoaded', function () {
    let elems = document.querySelectorAll('.datepicker');
    let instances = M.Datepicker.init(elems, {
        "format": "yyyy-mm-dd"
    });
});

```

### Inside the function, an element with a date field is retrieved from the page. Then, an object with the required date output format is passed through the special "Materialize" method.
---
&nbsp;

---
### Now let's look at how to get a user's cookie.
### The "getCookie" function, when called, gets the "email" parameter from the "userEmail" variable. Inside the function, our parameter with the value "email" is placed in the "name" variable and the "=" sign is appended to it. Next, we get the cookies from the browser, but first we need to decode them through the "decodeURIComponent(document.cookie)" method.

```

function getCookie(cname) {
    let name = cname + '=';
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

```

### Now you need to split the received cookies into an array of strings using the "split(';')" method, specifying the separator ";", we get the "co" array. Then we iterate over the array through the "for" loop. In the variable "c" we write each element of the array.
### Below we check with the "while" loop using the "c.charAt(0)" method - while the first character of the array element is equal to "space", then in "c" we write all the characters that follow the first with the "c.substring(1)" method.
### And the last check checks through the "indexOf(name)" method for the presence of the string "email=" at the zero index, if successful, the "substring" method is applied to "c", which specifies the beginning from the length of the "name" variable, which contains our "email=", and up to the length of "c" itself, which ultimately gives us a string containing only the user's email address without the "email=" prefix, for example:

```
"example@gmail.com"
```
### , and not as it was initially when the cookie was received:

```
"email=example@gmail.com"
```

---
&nbsp;

---
### We put the "getCookie (cname)" function into the userEmail variable, passing the "email" string as a parameter.

```

let userEmail = getCookie('email');

```
---
&nbsp;

---
### So, we figured out how to receive the user's email through cookies, now it's time to take on the function that will receive user data by email from the server and substitute it into the input fields we need.
---
&nbsp;

---
### The "getUserData()" function takes the "result" parameter, which contains the server response with the user's data. This response must be converted into an object using the "JSON.parse(result)" method.

```

function getUserData(result) {
    result = JSON.parse(result);
    console.log(result);
    document.querySelector('#signup-name').value = result.name;
    document.querySelector('#signup-pass').value = result.password;
    document.querySelector('#signup-birthday').value = result.birthday;
    let sex = document.querySelectorAll('.sex');
    for (let i = 0; i < sex.length; i++) {
        if (result.sex == sex[i].value) {
            sex[i].setAttribute('checked', 'checked');
        }
    }
    M.updateTextFields();

}

```

### From the resulting object "result", we take and insert the values ​​we need into the corresponding fields obtained by ID from the page.
### For the field with radio buttons, we do several actions: get all radio buttons from the page; iterate over them with the "for" loop; we do a check for gender matching from "result"; if a match is found, then set the "checked" attribute for the radio button.
### At the end of the function, we write a special method from "Materialize" from the documentation of the official site, which is necessary for the correct display of the label for the input fields.
---
&nbsp;

---
### Finally, a request can be sent to the server to retrieve the user's personal data.

```

ajax('core/get_user_data.php', 'POST', getUserData, { "email": userEmail });

```

### To do this, write an ajax request and specify the parameters: path to the "get_user_data.php" file; the "POST" request method; the "getUserData" function - to process the response from the server; an object containing the "email" of the user for which we need to get personal data. 
---
&nbsp;

---
### This completes the work on receiving user data, now let's analyze the work on sending updated user data to the server database.
---
&nbsp;

---
### The "click" event with an anonymous function is hung on the "UPDATE" button in the personal account. Inside the function, the default event of the form is stopped.

```

document.querySelector('#signup-submit').onclick = function (event) {
    event.preventDefault();
    let sex = document.querySelectorAll('.sex');
    for (let i = 0; i < sex.length; i++) {
        if (sex[i].checked) {
            sex = sex[i].value;
            break;
        }
    }
    let updateData = {
        "email": userEmail,
        "name": document.querySelector('#signup-name').value,
        "pass": document.querySelector('#signup-pass').value,
        "birthday": document.querySelector('#signup-birthday').value,
        "sex": sex
    }
    ajax('core/update_user_data.php', 'POST', updateUserData, updateData);
}

```

### Next, we get all the radio buttons for gender selection, iterate over them with the "for" loop and check each button for the "checked" attribute, if the condition has passed, then put the selected value in the "sex" variable and stop the cycle.
### Then we create an object in which we put: the "email" key and the value of the "userEmail" variable; the key "name" and the value from the field "name"; the "pass" key and the value from the "pass" field; the key "birthday" and the value from the field "birthday"; the "sex" key and the value selected by the radio-button.
### After the performed operations, we send an ajax-request with the following parameters: path to the "update_user_data.php" file; the "POST" request method; function "updateUserData" - to receive a response from the server; object "updateData" - with updated user data.
### The "updateUserData" function receives as a parameter a response from the server, which is checked by the condition for equality with "1" ("success"), if the condition is true, then through the special "toast" method from "Materialize", a message about successful data changes, if the condition is incorrect, then an error message is displayed. 
---
&nbsp;

---
### Now let's look at how the "main.js" file works.
### In the file "main.js" - modal authorization windows are working. At the beginning there is the already familiar "Materialize" code, which is necessary for the calendar to work in the "date of birth" item when registering a user.

```

document.addEventListener('DOMContentLoaded', function () {
    let elems = document.querySelectorAll('.datepicker');
    let instances = M.Datepicker.init(elems, {
        "format": "yyyy-mm-dd"
    });
});

```

### Below is how modal windows work. A click event with the "showModal" function is assigned to the "login" and "sign up" buttons.

```

document.querySelectorAll('.modal-show').forEach(function (element) {
    element.onclick = showModal;
});

```

### By default, all modals are assigned the "hide" class - hiding them from the page, it is the "showModal" function that shows a specific modal window, depending on the button pressed, removing this class.
---
&nbsp;

---
### The "showModal" function gets into the "modalId" variable the data-attribute of the pressed button: "# login-in" or "# sign-up".

```

function showModal() {
    let modalId = this.dataset.modal;
    document.querySelector(modalId).classList.remove('hide');
    document.onkeydown = function (event) {
        if (event.keyCode == 27) closeModal();
    }
}

```

### Now we actually have the ID of the button we need, and in order to show it on the page for a specific modal window, we just need to get it by its ID equal to the "modalID" variable and remove its "hide" class.
### We will also hang up the event for closing the modal window when pressing the "Esc" key. We hang the "onkeydown ()" event with an anonymous function on the document. Inside the function, we check for the condition: if the pressed key is equal to "Esc", then we execute the "closeModal" function that closes the modal window.
---
&nbsp;

---
### In addition to the main work on opening and closing the modal window, the "showModal()" function contains actions for changing the background image when clicking on the "login" or "sign up" buttons. This is done in the following way.
### First, we get all the children of the "authorization-block" block into the "mainImg" variable. Then two conditions follow: for the "login" button; for the "sign up" button.

```

let mainImg = document.querySelector('.authorization-block').children;
    if (modalId == "#sign-up") {
        for (let i = 0; i < mainImg.length; i++) {
            if (mainImg[i].classList.contains('authorization-block__registration')) {
                mainImg[i].classList.remove('_hide');
            }
            else {
                mainImg[i].classList.add('_hide');
            }
        }
    }
    else if (modalId == "#login-in") {
        for (let i = 0; i < mainImg.length; i++) {
            if (mainImg[i].classList.contains('authorization-block__login')) {
                mainImg[i].classList.remove('_hide');
            }
            else {
                mainImg[i].classList.add('_hide');
            }
        }
    }

```

### In both conditions, the elements of the "authorization-block" block are iterated by the "for" loop. There are three blocks in total: "reception", "registration" and "login". The cycle contains additional conditions: if the block contains a class with "registration" or "login", then this block is shown on the page by removing the special "_hide" class, and the rest are hidden by adding the "_hide" class to them.
---
&nbsp;

--- 
### The "closeModal" function gets all the modals and assigns the "hide" class to each — hiding them from the page.

```

function closeModal() {
    document.querySelectorAll('.modal-wrap').forEach(function (element) {
        element.classList.add('hide');

    });
    document.onkeydown = null;
}

```

### It also resets the "Esc" key event after closing the modal window.
---
&nbsp;

---
### Like the "showModal()" function, the "closeModal()" function has a background image to work with.

```

let mainImg = document.querySelector('.authorization-block').children;
    for (let i = 0; i < mainImg.length; i++) {
        if (mainImg[i].classList.contains('authorization-block__reception')) {
            mainImg[i].classList.remove('_hide');
        }
        else {
            mainImg[i].classList.add('_hide');
        }
    }

```

### When the modal window is closed, all "authorization-block" blocks will be hidden except for the "reception" block using the "_hide" special class.
---
&nbsp;

--- 
### The base is ready, now modal windows open when you click on the authorization buttons and close when you press the "Esc" key. Now let's take a look at closing modal windows when clicked outside of modal windows and closing when clicking the close button.
---
&nbsp;

---
### Closing the window when the button is pressed is easy to implement.

```

document.querySelectorAll('.modal-project-close').forEach(function (element) {
    element.onclick = closeModal;
});

```

### The button with the ".modal-project-close" class is hung with the "closeModal()" function of closing the modal window, already familiar to us.
---
&nbsp;

---
### Closing a window when you click outside of that window, on the other hand, is more difficult.
### First, we get all the modal windows and send them click events with the "closeModal()" function. Now the window will close when you click outside of it.

```

document.querySelectorAll('.modal-wrap').forEach(function (element) {
    element.onclick = closeModal;
});

```

### But it will also close when you click on it.
### To prevent this from happening, we specify for the "# login-in .modal-project" and "# sign-up .modal-project" blocks to stop the execution of the event ("event.stopPropagation ()").

```

document.querySelector('#login-in .modal-project').onclick = function (event) {
    event.stopPropagation();
}

document.querySelector('#sign-up .modal-project').onclick = function (event) {
    event.stopPropagation();
}

```

### Now on the parent ".modal-wrap" there is an event with the closing of the window, and for its heirs, blocks with a form, this event is absent - allowing us to correctly close the modal when clicking outside of it.
---
&nbsp;

---
### It remains to disassemble the slider with the terms of use.
### Let's analyze how it works. The item "read rules" is available only when registering a user, he can read them, agree with the rules and register, or disagree, then the registration option will be unavailable for him.
### The slider itself consists of two blocks: a block with a registration form; block with rules of use. The slider will show the block with rules when you click on "Read Rules" and hide it and return to the block with the form.
### Both blocks are clipped using the CSS property: "overflow: hidden". By changing the "margin-left" property, the boxes will move each other and become visible to the user.
---
&nbsp;

---
### Now let's analyze its scripts.
### In order to show the rules, a click event with an anonymous function is hung on a span with the "read-rules" class.

```

document.querySelector('.read-rules').onclick = function () {
     if (window.innerWidth <= 420) {
        document.querySelector('.form-slider').style.marginLeft = '-255px';
    }
    else if (window.innerWidth > 420) {
        document.querySelector('.form-slider').style.marginLeft = '-345px';
    }
}

```

### Then conditions are applied depending on the width of the user's browser window: if the width of the browser is less than or equal to "420px" - then the "form-slider" block is assigned "marginLeft" equal to "-255px"; if the browser width is greater than "420px", then the "form-slider" block is assigned "marginLeft" equal to "-345px".
### These conditions are necessary for the correct display of the slider on the mobile version.
---
&nbsp;

--- 
### To return to the form, a click event with an anonymous function is hung on the paragraph with the "read-rules-back" class.

```

document.querySelector('.read-rules-back').onclick = function () {
    document.querySelector('.form-slider').style.marginLeft = '0';
}

```

### Inside the function, the "form-slider" block is assigned the "margin-left" CSS property with a value of "0".
---
&nbsp;

--- 
### If you, using a mobile device, went to the conditions tab, and in the process of reading the conditions, decided to change the screen orientation by turning your device to a vertical or horizontal position, you would notice that the entire text block began to display incorrectly. The fact is that when the browser window is dynamically resized, the slider block does not adjust the "marginLeft" property left after the "onclick" event was applied. In this regard, the block with the terms of use does not exit with the value that should be in the "onclick" event, because the "onclick" event works once and only when it is clicked. To fix this, I wrote a little code with certain conditions.
### So, on the browser window, we hang an event listener with the "resize" property - it will monitor the size of the browser window. Every time the window is resized, we will run the "sliderWork()" function.

```

window.addEventListener('resize', function() {
  sliderWork();
});

```

### In the "sliderWork()" function, we get the "form-slider" block itself.
### In order to display the slider with conditions correctly when changing the width of the browser window, you need to get the current "marginLeft" and assign a new one, depending on the size of the browser window. But we will only change the "marginLeft" that does not match the mobile or desktop version.

```

function sliderWork (){
    let slider = document.querySelector('.form-slider');
    
    if (window.innerWidth <= 420) {
        if (slider.style.marginLeft == '-345px') {
            slider.style.marginLeft = '-255px';
        }
    }
    else if (window.innerWidth > 420) {
        if (slider.style.marginLeft == '-255px') {
            slider.style.marginLeft = '-345px';
        }
    }
}

```

### So, let's analyze the conditions: if the window width is less than or equal to "420px" - then we check the "marginLeft" property, if it is equal to "-345px" ("desktop version"), then we change "marginLeft" to "-255px" (" mobile version"); if the window width is greater than "420px" - then we check the "marginLeft" property, if it is equal to "-255px" ("mobile version"), then we change "marginLeft" to "-345px" ("desktop version");
### This completes the slider's work. The last thing to consider is the agreement to the terms of use.
---
&nbsp;

---
### The "onchange" event with an anonymous function is hung on the checkbox with the "agree-rules" class.

```

document.querySelector('#agree-rules').onchange = function () {
    if (this.checked) {
        document.querySelector('#signup-submit').classList.remove('disabled');
    }
    else {
        document.querySelector('#signup-submit').classList.add('disabled');
    }
}

```

### Inside the function, a simple check for "checked" is performed: if the item is selected, the "disabled" class is removed from the registration button - making it active; if the item is not selected, the "disabled" class is assigned to the registration button, making it inactive.
### The "disabled" class from "Materialize" allows you to disable the interaction with the button, you just need to remove it to make the button active again.
---
&nbsp;

# 4. Conclusion
&nbsp;

---
### Another application using "sql" databases that is structurally easy to implement, but has many pitfalls. What did I encounter while developing? As usual: errors in requests, incorrectly spelled names of variables, initially incorrectly written server side. It is very difficult to write ajax requests where your backend is lame. What can I say, the backend is not my strong point, there is still a lot to learn in this environment, but it's always nice to see the result of my torment! I liked working with "cookies", now I have an understanding of server administration. Good experience, useful knowledge, a working application - the time was well spent!
---
&nbsp;

# ___Thank you for your time!___ 