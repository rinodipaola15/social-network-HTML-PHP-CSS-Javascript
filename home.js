
function onModalClick(event) 
{
    modalView.classList.add('hidden');
    const div = modalView.querySelector('.div_modal');
    div.innerHTML='';
    document.body.classList.remove('no-scroll');
}

function onClickLike(event) 
{
    const container = event.currentTarget.parentNode;
    const button_like = container.querySelector('.like_button');
    const id_post = button_like.name;
    const formdata = new FormData();
    formdata.append("id_post", id_post);
    const form_data = {method: 'post', body: formdata}; 
    fetch("http://151.97.9.184/dipaola_rino/hw1/lista_like.php", form_data)
        .then((response) => { return response.json();})
        .then((json) => { 
            for(let i=0; i<json.length; i++) {
                const info=json[i];
                const div_utente = document.createElement('div');
                const utente = document.createElement('span');
                const icona = document.createElement('img');
                utente.textContent = info.nome + " " + info.cognome;    
                icona.src = info.immagine_profilo;            
                document.body.classList.add('no-scroll');
                const modalView = document.querySelector('#modal-view');
                const div = modalView.querySelector('.div_modal');
                modalView.style.top = window.pageYOffset + 'px';
                div_utente.appendChild(icona);
                div_utente.appendChild(utente);
                div_utente.classList.add('div_utente');
                div.appendChild(div_utente);
                modalView.appendChild(div);
                modalView.classList.remove('hidden');
                modalView.addEventListener('click', onModalClick);
            }
        });
    
}

function onClickLikeButton(event) {
    const like_button = event.currentTarget;
    const id_post = like_button.name;
    const container = like_button.parentNode;
    const num_like = container.querySelector('.num_like');
    const numero = parseInt(num_like.textContent);

    if(like_button.value=="Like") {
        like_button.setAttribute("value", "Unlike");
        like_button.classList.add('like_verificato');
        num_like.textContent=numero+1;
        const formdata1 = new FormData();
        formdata1.append("id_post", id_post);
        const form_data1 = {method: 'post', body: formdata1}; 
        fetch("http://151.97.9.184/dipaola_rino/hw1/aggiungi_like.php", form_data1);

    }
    else {
        like_button.setAttribute("value", "Like");
        like_button.classList.remove('like_verificato');
        num_like.textContent=numero-1;
        const formdata2 = new FormData();
        formdata2.append("id_post", id_post);
        const form_data2 = {method: 'post', body: formdata2}; 
        fetch("http://151.97.9.184/dipaola_rino/hw1/rimuovi_like.php", form_data2);
    }

      
}

function onJson(json) 
{
    console.log('JSON ricevuto');
    const section = document.querySelector('#post');
    for(let i=0; i<json.length; i++) {
        const post=json[i];
        
        const icona = document.createElement('img');
        icona.src = post.immagine_profilo;
        const autore = document.createElement('span');
        autore.textContent = post.nome + " " + post.cognome;
        const data = document.createElement('span');
        data.textContent = post.data_e_ora;
        const div_titolo = document.createElement('div');
        const titolo = document.createElement('span');
        titolo.textContent = post.titolo;
        const immagine = document.createElement('img');
        immagine.src = post.url_immagine;
        const div_img = document.createElement('div');
        const container = document.createElement('div');

        icona.classList.add('icona');
        div_img.classList.add('div_img');
        autore.classList.add('autore');
        data.classList.add('data');
        titolo.classList.add('titolo');
        div_titolo.classList.add('div_titolo');
        container.classList.add('container');


        const like_button = document.createElement('input');
        like_button.setAttribute("type", "submit");
        const id_post = post.id;
        const formdata = new FormData();
        formdata.append("id_post", id_post);
        const form_data = {method: 'post', body: formdata}; 
        fetch("http://151.97.9.184/dipaola_rino/hw1/controllo_like.php", form_data)
        .then((response) => { return response.json();})
        .then((json) => { 
            if(json==0) {
                like_button.setAttribute("value", "Like");
            }
            else {
                like_button.setAttribute("value", "Unlike"); 
                like_button.classList.add('like_verificato'); 
            }
        });
        like_button.setAttribute("name", id_post);
        like_button.classList.add('like_button'); 
                
        
        const num_like = document.createElement('span');
        const formdata1 = new FormData();
        formdata1.append("id_post", id_post);
        const form_data1 = {method: 'post', body: formdata1};
        fetch("http://151.97.9.184/dipaola_rino/hw1/conteggio_like.php", form_data1)
        .then((response) => { return response.json();})
        .then((json_likes) => {
            num_like.textContent = parseInt(json_likes);
        });
        
       num_like.classList.add('num_like');
       num_like.addEventListener('click', onClickLike);
       like_button.addEventListener('click', onClickLikeButton);
        
        container.appendChild(icona);
        container.appendChild(autore);
        container.appendChild(data);
        div_titolo.appendChild(titolo);
        container.appendChild(div_titolo);        
        div_img.appendChild(immagine);
        container.appendChild(div_img);
        container.appendChild(like_button);
        container.appendChild(num_like);
        section.appendChild(container);
        
    }
}

function onResponse(response) 
{
    console.log('Risposta ricevuta');
    return response.json();
}

function visualizza_post() {
    const data = {method: 'post'};  
    fetch("http://151.97.9.184/dipaola_rino/hw1/carica_post.php", data).then(onResponse).then(onJson);
}



const modalView = document.querySelector('#modal-view');
visualizza_post();