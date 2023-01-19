let checkButtons = document.getElementsByClassName('checkButton')

for (let i = 0; i < checkButtons.length; i++) {
    checkButtons[i].addEventListener('click', checkItem);
}

function checkItem(e) {
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
