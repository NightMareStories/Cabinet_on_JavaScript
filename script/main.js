document.addEventListener('DOMContentLoaded', function () {
    let elems = document.querySelectorAll('.datepicker');
    let instances = M.Datepicker.init(elems, {
        "format": "yyyy-mm-dd"
    });
});

document.querySelectorAll('.modal-show').forEach(function (element) {
    element.onclick = showModal;
});

document.querySelectorAll('.modal-project-close').forEach(function (element) {
    element.onclick = closeModal;
});

document.querySelectorAll('.modal-wrap').forEach(function (element) {
    element.onclick = closeModal;
});

function showModal() {
    let modalId = this.dataset.modal;
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

    document.querySelector(modalId).classList.remove('hide');
    document.onkeydown = function (event) {
        if (event.keyCode == 27) closeModal();
    }
}

function closeModal() {
    document.querySelectorAll('.modal-wrap').forEach(function (element) {
        let mainImg = document.querySelector('.authorization-block').children;
        for (let i = 0; i < mainImg.length; i++) {
            if (mainImg[i].classList.contains('authorization-block__reception')) {
                mainImg[i].classList.remove('_hide');
            }
            else {
                mainImg[i].classList.add('_hide');
            }
        }
        element.classList.add('hide');
    });
    document.onkeydown = null;
}

document.querySelector('#login-in .modal-project').onclick = function (event) {
    event.stopPropagation();
}

document.querySelector('#sign-up .modal-project').onclick = function (event) {
    event.stopPropagation();
}

window.addEventListener('resize', function () {
    sliderWork();
});

function sliderWork() {
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

document.querySelector('.read-rules').onclick = function () {
    if (window.innerWidth <= 420) {
        document.querySelector('.form-slider').style.marginLeft = '-255px';
    }
    else if (window.innerWidth > 420) {
        document.querySelector('.form-slider').style.marginLeft = '-345px';
    }
}

document.querySelector('.read-rules-back').onclick = function () {
    document.querySelector('.form-slider').style.marginLeft = '0';
}

document.querySelector('#agree-rules').onchange = function () {
    if (this.checked) {
        document.querySelector('#signup-submit').classList.remove('disabled');
    }
    else {
        document.querySelector('#signup-submit').classList.add('disabled');
    }
}