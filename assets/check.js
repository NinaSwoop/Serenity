let checkAbsoluteButtons = document.getElementsByClassName('checkAbsoluteButton')

for (let i = 0; i < checkAbsoluteButtons.length; i++) {
    checkAbsoluteButtons[i].addEventListener('click', checkAbsoluteItem);
}

function checkAbsoluteItem(e) {
    e.preventDefault();

    const checkLink = e.currentTarget;
    const link = checkLink.href;
    try {
        fetch(link)
            .then(res => res.json())
            .then(data => {
                const checkIcon = checkLink.firstElementChild;
                if (data.isChecked) {
                    checkIcon.classList.remove("absolue-circle");
                    checkIcon.classList.remove("bi-circle");
                    checkIcon.classList.add("absolue-check-circle");
                    checkIcon.classList.add("bi-check-circle");
                } else {
                    checkIcon.classList.remove("absolue-check-circle");
                    checkIcon.classList.remove("bi-check-circle");
                    checkIcon.classList.add("absolue-circle");
                    checkIcon.classList.add("bi-circle");
                }
            });
    } catch (err) {
        alert('Action non valide !');
    }
}

let checkRelativeButtons = document.getElementsByClassName('checkRelativeButton')

for (let i = 0; i < checkRelativeButtons.length; i++) {
    checkRelativeButtons[i].addEventListener('click', checkRelativeItem);
}

function checkRelativeItem(e) {
    e.preventDefault();

    const checkLink = e.currentTarget;
    const link = checkLink.href;
    try {
        fetch(link)
            .then(res => res.json())
            .then(data => {
                const checkIcon = checkLink.firstElementChild;
                if (data.isChecked) {
                    checkIcon.classList.remove("bi-circle");
                    checkIcon.classList.add("bi-check-circle");
                } else {
                    checkIcon.classList.remove("bi-check-circle");
                    checkIcon.classList.add("bi-circle");
                }
            });
    } catch (err) {
        alert('Action non valide !');
    }
}