function onJson(json) 
{
    console.log('JSON ricevuto');
    var_globale=json;
    if(var_globale==1) 
    {
        console.log("Nome utente non disponibile.")
    }
    else 
    {
        console.log("Nome utente disponibile.")
    }
}

function onResponse(response) 
{
    console.log('Risposta ricevuta');
    return response.json();
}

function validazione_username(event)
{
    const form_data = {method: 'post', body: new FormData(form)};
    fetch("http://151.97.9.184/dipaola_rino/hw1/controllo_nome_utente.php", form_data).then(onResponse).then(onJson);
}

function validazione(event)
{
    const div1 = document.querySelector('#div1');
    const div2 = document.querySelector('#div2');
    const div3 = document.querySelector('#div3');
    const div4 = document.querySelector('#div4');
    if(form.nome.value.length == 0 ||
       form.cognome.value.length == 0 ||
       form.email.value.length == 0 ||
       form.username.value.length == 0 ||
       form.password.value.length == 0 ||
       form.conferma_password.value.length == 0)       
    {
        div1.classList.remove('hidden');
        div2.classList.add('hidden');
        div3.classList.add('hidden');
        div4.classList.add('hidden');
        event.preventDefault();
    }
    else
    {
        div1.classList.add('hidden');
        if(var_globale==1)
        {
            div2.classList.remove('hidden');
            event.preventDefault();
            form.username.classList.add('bordo');
        }
        else {
            form.username.classList.remove('bordo');
            div2.classList.add('hidden');
        }
        if(form.email.value.indexOf('@')==-1)
        {
            div3.classList.remove('hidden');
            event.preventDefault();
            form.email.classList.add('bordo');
        }
        else {
            form.email.classList.remove('bordo');
            div3.classList.add('hidden');
        }
        if(form.password.value!==form.conferma_password.value)
        {
            div4.classList.remove('hidden');
            event.preventDefault();
            form.password.classList.add('bordo');
            form.conferma_password.classList.add('bordo');
        }
        else {
            div4.classList.add('hidden');
        }
    }
        
}

var var_globale;
const form = document.forms['nome_form'];
form.username.addEventListener('blur', validazione_username);
form.addEventListener('submit', validazione);