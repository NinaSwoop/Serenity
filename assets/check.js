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
                dynamicProgressBar();
                finishProgressBar();
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
                dynamicProgressBar();
                finishProgressBar();
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
                dynamicProgressBar();
                finishProgressBar();
            });
    } catch (err) {
        alert('Action non valide !');
    }
}

// Dynamic ProgressBar

function dynamicProgressBar() {
    let totalCheckButtons = document.getElementsByClassName('bi')
    let progressBar = document.getElementsByClassName('progress-bar');
    let checkedButtons = document.getElementsByClassName('bi-check-circle')
    let numberCheckedDiv = document.getElementsByClassName('numberChecked');
    let percentOfCheckedBtn = Math.round((checkedButtons.length / totalCheckButtons.length) * 100);

    for (let i = 0; i < progressBar.length; i++) {
        progressBar[i].style.width = percentOfCheckedBtn + '%';
        numberCheckedDiv[i].innerHTML = checkedButtons.length + "/" + totalCheckButtons.length;
    }
}

let modals = document.getElementsByClassName('modal')

// Finish ProgressBar

function finishProgressBar() {
    let totalCheckButtons = document.getElementsByClassName('bi');
    let checkedButtons = document.getElementsByClassName('bi-check-circle');
    let titlebar = document.getElementsByClassName('titlebar');
    let titlefinish = document.getElementsByClassName('titlefinish');
    let buttonfinish = document.getElementsByClassName('finishbutton');

    // Sélectionne les élèment de la modale
    let modals = document.getElementsByClassName('modal');
    let modalBackdrops = document.getElementsByClassName('modal-backdrop');

    for (let i = 0; i < titlebar.length; i++) {
        if (totalCheckButtons.length === checkedButtons.length) {
            titlebar[i].classList.add("text-decoration-line-through");
            titlefinish[i].classList.remove("d-none");
            buttonfinish[i].classList.remove("d-none");
        } else {
            titlebar[i].classList.remove("text-decoration-line-through");
            titlefinish[i].classList.add("d-none");
            buttonfinish[i].classList.add("d-none");
        }
        modals[i].classList.toggle('d-none');
        modalBackdrops[i].classList.toggle('modal-backdrop-initial');
        // Pbm: Fait clignoter le backdrop, et modal plus fonctionnel après premier clique...
    }
}

// let modalBtn = document.getElementsByClassName('modalBtn');

// console.log(modalBtn);
// console.log(modalBtn[0]);

// for (let i = 0; i < modalBtn.length; i++) {
//     modalBtn[i].addEventListener('click', addModalBackdrop);
// }

// function addModalBackdrop() {
//     console.log('Entrée dans la fonction');
//     let modalBackdrops = document.getElementsByClassName('modal-backdrop')

//     for (let i = 0; i < modalBackdrops.length; i++) {
//         modalBackdrops[i].classList.add("modal-backdrop-initial");
//     }
//     console.log('Après fonction dans la fonction');
// }

// Ecouter la fermeture de la modale

// let modals = document.getElementsByClassName('modal')
// modals.addEventListener("hidden.bs.modal", function () {
//     alert("La modale a été fermée");
// });

