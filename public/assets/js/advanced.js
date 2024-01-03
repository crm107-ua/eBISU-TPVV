function copyToClipboard(element) {
    var tokenCell = element.closest('tr').querySelector('.token');
    if (tokenCell) {
        var textArea = document.createElement("textarea");
        textArea.value = tokenCell.textContent;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand('copy');
        document.body.removeChild(textArea);
    }
}

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.dropdown-item.option').forEach(function(item) {
        item.addEventListener('click', function() {
            var selectedOption = this.textContent;
            this.closest('.dropdown').querySelector('.dropdown-toggle').textContent = selectedOption;
        });
    });
});