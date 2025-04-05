function tableInit() {
  for (let i = 0; i < NROWS; i++) {
    let feature = 'Sample text'; // defaults for ease of expansion
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
    addRow(feature, basic, pro);
  }
}

function addRow(feature, basic, pro) {
  let table = document.getElementById('comparator');
  let rowStr = ROW.replaceAll('FEATURENAME', feature).replaceAll('CHECKCROSSBASIC', basic).replaceAll('CHECKCROSSPRO', pro);
  table.innerHTML += rowStr;
}