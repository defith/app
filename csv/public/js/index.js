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

