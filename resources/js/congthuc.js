window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
window._addCellToRow = function(row, cellValue, type = 'td') {
    let cell = document.createElement(type);
    cell.innerHTML = cellValue;
    row.appendChild(cell);
}

window._addCongThucRow = function(row, congThucData) {
    _addCellToRow(row, congThucData.name);
    _addCellToRow(row, congThucData.desc);
    _addCellToRow(row, congThucData.value);
}
window.parseCongThuc = function(congThucID, showID) {
    axios.post('/cong-thuc/parse-cong-thuc', {
        id: congThucID
    }).then(response => {
        const resData = response.data;
        if (resData.status == 'success') {
            // let displayPosition = document.querySelector('#' + showID);
            let modal = document.querySelector('#info-cong-thuc-modal');
            if (modal !== null) {
                let displayPosition = document.querySelector('#info-cong-thuc-modal-body');
                displayPosition.innerHTML = "";
                const noiDung = document.createElement('div');
                noiDung.classList.add('noi-dung-cong-thuc');

                noiDung.innerHTML = '<div class="row">' +
                    '<div class="col-12 col-md-2" style="text-align:right" ><label>Tên công thức</label></div><div class="col-12 col-md-10"><h5 >' + resData.tenCongThuc + '</h5></div>' +
                    "</div>";

                noiDung.innerHTML += '<div class="row">' +
                    '<div class="col-12 col-md-2" style="text-align:right"><label>Nội dung</label></div><div class="col-12 col-md-10"><h5 >' +
                    resData.noiDung +
                    '</h5></div>' +
                    "</div>";

                displayPosition.appendChild(noiDung);
                const infoTable = document.createElement('table');
                // infoTable.classList.add('table-bordered');
                infoTable.classList.add('table');
                // displayPosition.addElement(infoTable);
                let row = infoTable.insertRow(0);


                // let cell2 = row.createElement("th");
                // let cell3 = row.createElement("th");

                _addCellToRow(row, "Tên", 'th');
                _addCellToRow(row, "Mô tả", 'th');
                _addCellToRow(row, "Giá trị", 'th');

                resData.dataList.forEach(data => {
                    let dataRow = infoTable.insertRow();
                    _addCongThucRow(dataRow, data);
                    // console.log(data);
                });

                displayPosition.appendChild(infoTable);
                let myModal = bootstrap.Modal.getOrCreateInstance(modal);
                myModal.show();
            }


        } else {
            console.log(resData.message);
        }
    })
}

window.parseCongThucKetQua = function(congThucID, ketQuaID) {
    axios.post('/cong-thuc/parse-cong-thuc-ket-qua', {
        idCongThuc: congThucID,
        idKetQua: ketQuaID
    }).then(response => {
        console.log(response.data)
    })
}


window.thuGonSoLe = function(value, soLe = 2) {
    if (parseInt(value) === parseFloat(value)) {
        return value.toLocaleString();
    } else {
        return Number(value).toFixed(soLe);
    }
}