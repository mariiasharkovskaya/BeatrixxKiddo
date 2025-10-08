$(function () {
    $('.sidenav').sidenav();
    $('.materialboxed').materialbox();
    $('.parallax').parallax();
    $('.tabs').tabs();
    $('.datepicker').datepicker({
        disableWeekends: true
    });
    $('.tooltipped').tooltip();
    $('.scrollspy').scrollSpy();
});
document.getElementById('cosForm').addEventListener('submit', function (event) {
    event.preventDefault();
    const xValue = document.getElementById('x_value').value;
    const epsilonValue = document.getElementById('eps_value').value;
    fetch('index.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'calculate=1&x_value=' + encodeURIComponent(xValue) + '&eps_value=' + encodeURIComponent(epsilonValue)
    })
        .then(response => response.text())
        .then(data => {
            document.getElementById('blue-card').innerHTML = data;
        })
        .catch(error => console.error('Error:', error));
});