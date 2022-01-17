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

