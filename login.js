function validazione(event)
{
    div_nascosto = document.querySelector('main form div');
    if(form.username.value.length == 0 || 
       form.password.value.length == 0)
    {
        div_nascosto.classList.remove('hidden');
        event.preventDefault();
    }
    else {
        div_nascosto.classList.add('hidden');
    }
}

const form = document.forms['nome_form'];
form.addEventListener('submit', validazione);