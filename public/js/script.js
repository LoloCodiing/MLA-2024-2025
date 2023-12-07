var originalData;

function handleFile(e) {
  var files = e.target.files;
  var i, f;
  for (i = 0; i != files.length; ++i) {
    f = files[i];
    var reader = new FileReader();
    var name = f.name;
    reader.onload = function (e) {
      var data = e.target.result;
      var workbook = XLSX.read(data, { type: "binary" });
      var sheet_name = workbook.SheetNames[0];
      var sheet = workbook.Sheets[sheet_name];
      originalData = XLSX.utils.sheet_to_json(sheet, { header: 1 });
      displayData(originalData);
    };
    reader.readAsBinaryString(f);
  }
}

function displayData(data) {
  var table = document.getElementById("table");
  table.innerHTML = "";
  var thead = table.createTHead();
  var row = thead.insertRow();
  for (var i = 0; i < data[0].length; i++) {
    var th = document.createElement("th");
    th.innerHTML = data[0][i];
    row.appendChild(th);
  }
  for (var i = 1; i < data.length; i++) {
    var row = table.insertRow();
    for (var j = 0; j < data[i].length; j++) {
      var cell = row.insertCell(j);
      cell.innerHTML = data[i][j];
      cell.addEventListener("dblclick", function () {
        var value = this.innerHTML;
        this.innerHTML =
          '<input type="text" value="' +
          value +
          '" onblur="updateCellValue(this)">';
        this.firstChild.focus();
      });
    }
  }
}

function updateCellValue(input) {
  var value = input.value;
  input.parentNode.innerHTML = value;
}

function downloadExcel() {
  var modifiedData = getModifiedData();
  var ws = XLSX.utils.aoa_to_sheet(modifiedData);
  var wb = XLSX.utils.book_new();
  XLSX.utils.book_append_sheet(wb, ws, "Sheet1");
  var wbout = XLSX.write(wb, { bookType: "xlsx", type: "binary" });
  function s2ab(s) {
    var buf = new ArrayBuffer(s.length);
    var view = new Uint8Array(buf);
    for (var i = 0; i != s.length; ++i) view[i] = s.charCodeAt(i) & 0xff;
    return buf;
  }
  saveAs(
    new Blob([s2ab(wbout)], { type: "application/octet-stream" }),
    "modified_excel_file.xlsx"
  );
}

function getModifiedData() {
  var modifiedData = [];
  var tableRows = document.getElementById("table").rows;
  for (var i = 0; i < tableRows.length; i++) {
    var rowData = [];
    var tableCells = tableRows[i].cells;
    for (var j = 0; j < tableCells.length; j++) {
      rowData.push(tableCells[j].innerText);
    }
    modifiedData.push(rowData);
  }
  return modifiedData;
}

document.getElementById("input").addEventListener("change", handleFile, false);