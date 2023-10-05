//////////////////////////////////////////////////////////////////////////
// GESTION DE LA PAGINATION
//////////////////////////////////////////////////////////////////////////
// Fonction pour appliquer la pagination
function applyPagination(idPrefix) {
    const rowsPerPage = 5;
    const tbody = document.getElementById(idPrefix + "csv-tbody");
    if (!tbody) {
        console.log(`Les éléments ${idPrefix}csv-tbody n'ont pas été trouvés.`);
        return;
    }
    const rows = Array.from(tbody.querySelectorAll("tr"));
    const pagination = document.getElementById(idPrefix + "pagination");

    // Vider la pagination existante
    pagination.innerHTML = "";

    // Calculer le nombre total de pages
    const totalPages = Math.ceil(rows.length / rowsPerPage);

    // Initialiser la pagination
    for (let i = 1; i <= totalPages; i++) {
        const li = document.createElement("li");
        li.classList.add("page-item");

        const a = document.createElement("a");
        a.classList.add("page-link");
        a.textContent = i;

        a.addEventListener("click", function (e) {
            e.preventDefault();
            showPage(i);
        });

        li.appendChild(a);
        pagination.appendChild(li);
    }

    // Fonction pour afficher une page spécifique
    function showPage(page) {
        const start = (page - 1) * rowsPerPage;
        const end = start + rowsPerPage;

        // Cacher toutes les lignes
        rows.forEach(row => row.style.display = "none");

        // Afficher les lignes pour la page actuelle
        for (let i = start; i < end; i++) {
            if (rows[i]) {
                rows[i].style.display = "";
            }
        }
    }

    // Afficher la première page par défaut
    showPage(1);
}

document.addEventListener("DOMContentLoaded", function () {
    applyPagination("first-");
    applyPagination("second-");
});



document.getElementById('btn3').addEventListener('shown.bs.collapse', function () {
    applyPagination();
});

//////////////////////////////////////////////////////////////////////////
// GESTION DE LA DROP ZONE
//////////////////////////////////////////////////////////////////////////
document.addEventListener('DOMContentLoaded', function () {
    const dropZone = document.getElementById('drop_zone');
    const hiddenFileInput = document.getElementById('hiddenFileInput');
    const fileForm = document.getElementById('fileForm');

    dropZone.addEventListener('dragover', function (e) {
        e.preventDefault();
        e.stopPropagation();
    });

    dropZone.addEventListener('dragleave', function () {
        dropZone.style.border = '2px dashed #bbb';
    });

    dropZone.addEventListener('drop', function (e) {
        e.preventDefault();
        e.stopPropagation();
        dropZone.style.border = '2px dashed #bbb';

        hiddenFileInput.files = e.dataTransfer.files;

        if (e.dataTransfer.files[0].type === 'text/csv') {
            fileForm.submit();
        } else {
            hiddenFileInput.value = '';
            fileForm.submit();
        }
    });
});

//////////////////////////////////////////////////////////////////////////
// GESTION DE L'ACCORDEON
//////////////////////////////////////////////////////////////////////////
document.addEventListener("DOMContentLoaded", function () {
    const contenu2 = document.querySelector('#contenu2 .accordion-body');
    const contenu3 = document.querySelector('#contenu3 .accordion-body');
    const contenu4 = document.querySelector('#contenu4 .accordion-body'); // Nouvelle ligne pour la section 4

    // Ferme toutes les sections d'abord
    var myCollapse1 = new bootstrap.Collapse(document.getElementById('contenu1'), {
        toggle: false
    });
    var myCollapse2 = new bootstrap.Collapse(document.getElementById('contenu2'), {
        toggle: false
    });
    var myCollapse3 = new bootstrap.Collapse(document.getElementById('contenu3'), {
        toggle: false
    });
    var myCollapse4 = new bootstrap.Collapse(document.getElementById('contenu4'), {
        toggle: false
    });

    myCollapse1.hide();
    myCollapse2.hide();
    myCollapse3.hide();
    myCollapse4.hide();

    if (contenu3 && contenu3.innerHTML.trim() !== '') {
        myCollapse3.show();
        // Met à jour le statut des boutons
        document.getElementById('btn3').classList.remove('collapsed');
        document.getElementById('btn3').setAttribute('aria-expanded', 'true');
    } else if (contenu2 && contenu2.innerHTML.trim() !== '') {
        myCollapse2.show();
        // Met à jour le statut des boutons
        document.getElementById('btn2').classList.remove('collapsed');
        document.getElementById('btn2').setAttribute('aria-expanded', 'true');
    } else if (contenu4 && contenu4.innerHTML.trim() !== '') {
        myCollapse4.show();
        // Met à jour le statut des boutons pour la section 4
        document.getElementById('btn4').classList.remove('collapsed');
        document.getElementById('btn4').setAttribute('aria-expanded', 'true');
    } else {
        myCollapse1.show();
        // Met à jour le statut des boutons
        document.getElementById('btn1').classList.remove('collapsed');
        document.getElementById('btn1').setAttribute('aria-expanded', 'true');
    }

    // Mettre à jour la pagination lors de l'ouverture de la section 3
    document.getElementById('btn3').addEventListener('shown.bs.collapse', function () {
        applyPagination();
    });
});

//////////////////////////////////////////////////////////////////////////
// GESTION DE L'EMAIL
//////////////////////////////////////////////////////////////////////////
document.addEventListener("DOMContentLoaded", function () {
    const sendMailForm = document.getElementById('sendMailForm');
    const submitLink = document.getElementById('submitLink');
    // Écoute du clic sur le lien
    submitLink.addEventListener('click', function (event) {
        event.preventDefault(); // Empêche le comportement par défaut du lien
        sendMailForm.submit(); // Soumet le formulaire
    });
});