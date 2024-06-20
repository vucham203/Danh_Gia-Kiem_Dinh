function generateReports() {
    fetch('generate_reports.php')
        .then(response => response.json())
        .then(data => {
            const roomStatusTable = document.getElementById('roomStatusTable');
            const roomStatusTbody = roomStatusTable.getElementsByTagName('tbody')[0];
            roomStatusTbody.innerHTML = '';

            const financialReportTable = document.getElementById('financialReportTable');
            const financialReportTbody = financialReportTable.getElementsByTagName('tbody')[0];
            financialReportTbody.innerHTML = '';

            data.roomStatus.forEach(row => {
                const tr = document.createElement('tr');
                tr.innerHTML = `<td>${row.room}</td><td>${row.status}</td>`;
                roomStatusTbody.appendChild(tr);
            });

            data.financialReport.forEach(row => {
                const tr = document.createElement('tr');
                tr.innerHTML = `<td>${row.date}</td><td>${row.type}</td><td>${row.amount}</td>`;
                financialReportTbody.appendChild(tr);
            });
        });
}