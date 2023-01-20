// Check buttons with Absolute position
let checkAbsoluteButtons = document.getElementsByClassName('checkAbsoluteButton');

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

// Check buttons with Relative position
let checkRelativeButtons = document.getElementsByClassName('checkRelativeButton');

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

// Check buttons: Specific case of Checklist
let checkChecklistButtons = document.getElementsByClassName('checkChecklistButton');

for (let i = 0; i < checkChecklistButtons.length; i++) {
    checkChecklistButtons[i].addEventListener('click', checkChecklistItem);
}

function checkChecklistItem(e) {
    e.preventDefault();

    const checkLink = e.currentTarget;
    const link = checkLink.href;
    try {
        fetch(link)
            .then(res => res.json())
            .then(data => {
                const checkIcon = checkLink.firstElementChild;
                const checkList = checkLink.parentElement.firstElementChild;
                if (data.isChecked) {
                    checkIcon.classList.remove("bi-circle");
                    checkIcon.classList.add("bi-check-circle");
                    checkList.classList.remove("is-not-checked-checklist");
                    checkList.classList.add("is-checked-checklist");
                } else {
                    checkIcon.classList.remove("bi-check-circle");
                    checkIcon.classList.add("bi-circle");
                    checkIcon.classList.remove("is-checked-checklist");
                    checkList.classList.add("is-not-checked-checklist");
                }
            });
    } catch (err) {
        alert('Action non valide !');
    }
}