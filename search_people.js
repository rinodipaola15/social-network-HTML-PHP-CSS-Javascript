

function onJsonUsers(json)  
{

    console.log('JSON ricevuto');
    const section = document.querySelector('section#search');
    section.innerHTML='';
    for(let i=0; i<json.length; i++) {
        const info=json[i];
        const div1 = document.createElement('div');
        const div2 = document.createElement('div');
        const div3 = document.createElement('div');
        const nome = document.createElement('span');
        const cognome = document.createElement('span');
        const stringa_user = document.createElement('span');
        stringa_user.textContent='Username: ';
        const username = document.createElement('span');
        div2.classList.add('corsivo');
        div3.classList.add('regolazione_immagine');
        const img = document.createElement('img');
        nome.textContent = info.nome;
        const spazio = document.createElement('span');
        spazio.textContent = ' ';
        cognome.textContent = info.cognome;
        username.textContent = info.nome_utente;
        img.src = info.immagine_profilo;
        const container = document.createElement('div');
        div1.appendChild(nome);
        div1.appendChild(spazio);
        div1.appendChild(cognome);
        container.appendChild(div1);
        div2.appendChild(stringa_user);
        div2.appendChild(username);
        container.appendChild(div2);
        div3.appendChild(img);
        container.appendChild(div3);
        const follow_button = document.createElement('input');
        follow_button.classList.add('follow_button');
        follow_button.setAttribute("type", "submit");

        const formdata = new FormData();
        formdata.append("param1", username.textContent);
        const form_data = {method: 'post', body: formdata}; 
        fetch("http://151.97.9.184/dipaola_rino/hw1/verifica_username.php", form_data)
        .then((response) => { return response.json();})
        .then((json) => { 
            controllo=json; 
            if(controllo==1) 
                follow_button.setAttribute("value", "Segui già");
            else
                follow_button.setAttribute("value", "Segui");
        });
                
        follow_button.setAttribute("name", username.textContent);
        container.appendChild(follow_button);
        container.classList.add('container');
        section.appendChild(container);
        follow_button.addEventListener('click', onClickFollow);
    }
}

function onResponseUsers(response) 

{
    console.log('Risposta ricevuta');
    return response.json();
}

function onClickUsers(event) {  
    const form_data = {method: 'post'};
    fetch("http://151.97.9.184/dipaola_rino/hw1/do_search_all_users.php", form_data).then(onResponseUsers).then(onJsonUsers);
    event.preventDefault();
}

function onJson(json)   
{
    console.log('JSON ricevuto');
    const section = document.querySelector('section#search');
    section.innerHTML='';
    for(let i=0; i<json.length; i++) {
        const info=json[i];
        const div1 = document.createElement('div');
        const div2 = document.createElement('div');
        const div3 = document.createElement('div');
        const nome = document.createElement('span');
        const cognome = document.createElement('span');
        const stringa_user = document.createElement('span');
        stringa_user.textContent='Username: ';
        const username = document.createElement('span');
        div2.classList.add('corsivo');
        div3.classList.add('regolazione_immagine')
        const img = document.createElement('img');
        nome.textContent = info.nome;
        const spazio = document.createElement('span');
        spazio.textContent = ' ';
        cognome.textContent = info.cognome;
        username.textContent = info.nome_utente;
        img.src = info.immagine_profilo;

        const container = document.createElement('div');

        div1.appendChild(nome);
        div1.appendChild(spazio);
        div1.appendChild(cognome);
        container.appendChild(div1);
        div2.appendChild(stringa_user);
        div2.appendChild(username);
        container.appendChild(div2);
        div3.appendChild(img);
        container.appendChild(div3);
        const follow_button = document.createElement('input');
        follow_button.setAttribute("type", "submit");

        const formdata = new FormData();
        formdata.append("param1", username.textContent);
        const form_data = {method: 'post', body: formdata}; 
        fetch("http://151.97.9.184/dipaola_rino/hw1/verifica_username.php", form_data)
        .then((response) => { return response.json();})
        .then((json) => { 
            controllo=json; 
            if(controllo==1) 
                follow_button.setAttribute("value", "Segui già");
            else
                follow_button.setAttribute("value", "Segui");
        });
                
        follow_button.setAttribute("name", username.textContent);
        follow_button.classList.add('follow_button');
        container.appendChild(follow_button);
        container.classList.add('container');
        section.appendChild(container);
        follow_button.addEventListener('click', onClickFollow);
    }
}

function onResponse(response)   
{
    console.log('Risposta ricevuta');
    return response.json();
}

function onClick(event) {   

    const testo=form.testo;
    if((testo.value.length)==0) 
    {
        alert("Inserimento non valido.");
        event.preventDefault();
    }
    else
    {     
        const form_data = {method: 'post', body: new FormData(form)};
        fetch("http://151.97.9.184/dipaola_rino/hw1/do_search_people.php", form_data).then(onResponse).then(onJson);
        event.preventDefault();
    }
}

function onClickFollow(event)   
{
    const f_button = event.currentTarget;
    const username = event.currentTarget.name;
    if(f_button.value=="Segui") {
        const formdata = new FormData();
        formdata.append("param1", username);
        const form_data = {method: 'post', body: formdata};
        fetch("http://151.97.9.184/dipaola_rino/hw1/follow_people.php", form_data)
        .then((response) => { 
            console.log('Risposta ricevuta');
            return response.json();})
        .then((json) => {
            console.log('JSON ricevuto');
            if(json=="1")
                f_button.setAttribute("value", "Segui già");
        });
    }
    else {
        const formdata = new FormData();
        formdata.append("param1", username);
        const form_data = {method: 'post', body: formdata};
        fetch("http://151.97.9.184/dipaola_rino/hw1/unfollow_people.php", form_data);
        f_button.setAttribute("value", "Segui");
    }
}



var controllo;
const form = document.forms['nome_form'];
form.addEventListener('submit', onClick);
const all_users = document.querySelector('#all_users');
all_users.addEventListener('click', onClickUsers);