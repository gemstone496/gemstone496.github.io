/**
 * redirects to a specified page
 * @param {String} value the page chapter/number to redirect to
 */
function setPage(value) {
  if (value == null) { return; }
  let ch_pg = value.split("_");
  const url = new URL("./comic.html.php", window.location.href);
  url.searchParams.set("ch", ch_pg[0]);
  url.searchParams.set("pg", ch_pg[1]);
  window.location.href = url;
}