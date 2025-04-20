/**
 * Redirects to a specified page
 * @param {String} pageNum the page chapter/number to redirect to
 */
function setPage(pageNum) {
  const url = new URL("./comic.html.php", window.location.href);
  url.searchParams.set("pg", pageNum);
  window.location.href = url;
}