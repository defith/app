document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('uploadForm');
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(form);
        fetch('upload.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert(data.error);
                return;
            }
            alert('Fichier uploadé avec succès !');
        });
    });

    document.getElementById('loadGraph').addEventListener('click', function() {
        fetch('upload.php')
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert(data.error);
                return;
            }

            const ctx = document.getElementById('myChart').getContext('2d');
            const labels = Object.keys(data.totals);
            const values = Object.values(data.totals);
            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total des quantités par produit',
                        data: values,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                }
            });
        });
    });
});
