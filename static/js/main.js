function copy(id) {
    let copyText = document.getElementById(id);

    let range = document.createRange();
    let selection = document.getSelection();
    range.selectNodeContents(copyText);
    selection.removeAllRanges();
    selection.addRange(range);

    document.execCommand("Copy");
    selection.removeAllRanges();
}