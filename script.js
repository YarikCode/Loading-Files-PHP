let file_input = document.getElementById('chose_input');
let file_name = document.querySelector('.header_title');
let form = document.querySelector('.form');
let file_container = document.querySelector('.container');

document.addEventListener('DOMContentLoaded', () => {
    SendRequestForOutPut();
});

file_input.addEventListener('change', () => {
    file_name.innerHTML = file_input.files[0].name;
});

form.addEventListener('submit', (event) => {
    event.preventDefault();
    const form_data = new FormData(form);
    SendRequest(form_data);
});

function SendRequest(body){
    let XML = new XMLHttpRequest();
    XML.open('POST', './server.php');
    XML.send(body);
    XML.addEventListener('load', () => {
        if(XML.status == 200){
            console.log(XML.response);
        }
    });
}

function SendRequestForOutPut() {
    const XML = new XMLHttpRequest();
    XML.open('GET', './server.php?load=true');
    XML.send();
    XML.addEventListener('load', () => {
        file_container.innerHTML += XML.response;
    });
}