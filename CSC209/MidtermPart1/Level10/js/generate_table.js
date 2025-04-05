/** Initializes the table */
function tableInit() {
  for (let i = 0; i < NROWS; i++) {
    let feature = '[no input]'; // defaults for ease of expansion
    let basic = 'fa-check';
    let pro = 'fa-check';
    if (i < FEATURES.length) {
      feature = FEATURES[i];
    }
    if (i < BASIC.length) {
      basic = BASIC[i];
    }
    if (i < PRO.length) {
      pro = PRO[i];
    }
    addRow(feature, [basic, pro]);
  }
}

/**
 * Adds a row labeled `feature` with marks `cols`
 * @param {String} feature The name of the row's feature (leftmost column)
 * @param {Array} cols A Boolean[][]. If shorter than NCOLS, remaining cols will be populated with checks
 */
function addRow(feature, cols) {
  if (cols.length != NCOLS) {
    console.log(`Expected ${NCOLS} columns, found ${cols.length}!!`);
    console.log(`Filling in remaining cols with default ${CHECK}.`);
  }

  let table = document.getElementById('comparator');
  let row = document.createElement('tr');
  
  let td = document.createElement('td');
  td.textContent = feature;
  row.appendChild(td);

  for (let i = 0; i < NCOLS; i++) {
    let td = document.createElement('td');
    let data = document.createElement('i');
    data.classList.add('fa')
    data.classList.add((i >= cols.length || cols[i]) ? CHECK : REMOVE); // fanciest ternary operator
    td.appendChild(data);
    row.appendChild(td);
  }

  table.appendChild(row);
}