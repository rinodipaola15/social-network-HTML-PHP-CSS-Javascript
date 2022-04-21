
var opzione;

function onJson(json) 
{
    let opzione;
    const select = document.querySelector('select');
    for(let i=0; i<select.options.length; i++) {
        if(select.options[i].selected)
            opzione = select.options[i];
    }
    
    if(opzione.value=="Spotify") {
        console.log('JSON ricevuto');
        const results=json.artists.items;
        let num_results = results.length;
        if(num_results==0)
            alert("Nessun risultato.");
        if(num_results>10)
            num_results=10;
        const library = document.querySelector('#artist-view');
        library.innerHTML = '';
        for(let i=0; i<num_results; i++) {
            const item=results[i];
            const name=item.name;
            const followers=item.followers.total;
            const genres=item.genres;
            const generi_musicali = document.createElement('div');
            generi_musicali.textContent = "Genere: " + genres;
            const image=item.images;
            if((image.length)>0) {
                image_url=image[0].url;
            }
            const artist = document.createElement('div');
            artist.classList.add('artist');
            img = document.createElement('img');
            img.src = image_url;
            const caption = document.createElement('span');
            const num_followers = document.createElement('span');
            caption.textContent = name;
            num_followers.textContent = followers;
            const stringa_follower = document.createElement('span');
            stringa_follower.textContent = 'Follower:';
            artist.appendChild(img);
            artist.appendChild(caption);
            artist.appendChild(stringa_follower);
            artist.appendChild(num_followers);
            artist.appendChild(generi_musicali);
            library.appendChild(artist);
            img.addEventListener('click', onThumbnailClick);
            modalView.addEventListener('click', onModalClick);
        }
    }


    if(opzione.value=="Giphy") {
        console.log('JSON ricevuto');        
        const library = document.querySelector('#artist-view');
        library.innerHTML = '';
        const results = json.data;
        let num_results = results.length;
        if(num_results==0)
            alert("Nessun risultato.");
        if(num_results > 10)
            num_results = 10;
        for(let i=0; i<num_results; i++)
        {
            const file_data = results[i];
            const title = file_data.title;
            let selected_image = file_data.images.downsized_medium.url;
            const gif = document.createElement('div');
            gif.classList.add('artist');
            const img = document.createElement('img');
            img.src = selected_image;
            const caption = document.createElement('span');
            caption.textContent = title;
            gif.appendChild(img);
            gif.appendChild(caption);
            library.appendChild(gif);
            img.addEventListener('click', onThumbnailClick);
            modalView.addEventListener('click', onModalClick);
        }
    }


    if(opzione.value=="OpenMovieDatabase") {
        console.log('JSON ricevuto');        
        const library = document.querySelector('#artist-view');
        library.innerHTML = '';
        const results = json.Search;
        let num_results = results.length;
        if(num_results==0)
            alert("Nessun risultato.");
        if(num_results > 10)
            num_results = 10;
        for(let i=0; i<num_results; i++)
        {
            const file_data = results[i];
            const title = file_data.Title;
            const anno = file_data.Year;
            let selected_image = file_data.Poster;
            const film = document.createElement('div');
            film.classList.add('artist');
            const img = document.createElement('img');
            img.src = selected_image;
            const caption = document.createElement('span');
            caption.textContent = title;
            anno_pubblicazione = document.createElement('div');
            anno_pubblicazione.textContent = "Anno: " + anno;
            film.appendChild(img);
            film.appendChild(caption);
            film.appendChild(anno_pubblicazione);
            library.appendChild(film);
            img.addEventListener('click', onThumbnailClick);
            modalView.addEventListener('click', onModalClick);
        }
       
    }

    if(opzione.value=="Jikan") {
        console.log('JSON ricevuto');        
        const library = document.querySelector('#artist-view');
        library.innerHTML = '';
        const results = json.results;
        let num_results = results.length;
        if(num_results==0)
            alert("Nessun risultato.");
        if(num_results > 10)
            num_results = 10;
        for(let i=0; i<num_results; i++)
        {
            const file_data = results[i];
            const title = file_data.title;
            const episodi = document.createElement('div');
            const descrizione = document.createElement('div');
            episodi.textContent = "Episodi: " + file_data.episodes;
            descrizione.textContent = "Trama: " + file_data.synopsis;
            let selected_image = file_data.image_url;
            const anime = document.createElement('div');
            anime.classList.add('artist');
            const img = document.createElement('img');
            img.src = selected_image;
            const caption = document.createElement('span');
            caption.textContent = title;
            anime.appendChild(img);
            anime.appendChild(caption);
            anime.appendChild(episodi);
            anime.appendChild(descrizione);
            library.appendChild(anime);
            img.addEventListener('click', onThumbnailClick);
            modalView.addEventListener('click', onModalClick);
        }
        
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
        fetch("http://151.97.9.184/dipaola_rino/hw1/do_search_content.php", form_data).then(onResponse).then(onJson);
        event.preventDefault();
    }
}

function onThumbnailClick(event) 
{
    const image = document.createElement('img');
    image.src = event.currentTarget.src;
    document.body.classList.add('no-scroll');
    modalView.style.top = window.pageYOffset + 'px';
    modalView.appendChild(image);
    modalView.classList.remove('hidden');
    const img_selected = event.currentTarget;
    url_img = img_selected.src;
    const invio = document.querySelector('p.hidden');
    invio.classList.remove('hidden');
}

function onModalClick(event) 
{
    const avviso_pubblicazione = document.querySelector('#avviso_pubblicazione');
    avviso_pubblicazione.classList.add('hidden');
    modalView.classList.add('hidden');
    const input1 = document.querySelector('#cerca_contenuto');
    const input2 = document.querySelector('#barra_testo');
    input1.value="";
    input2.value="";
    const invio = document.querySelector('p#title');
    invio.classList.add('hidden');
    modalView.innerHTML='';
    document.body.classList.remove('no-scroll');
}

function invioDati(event) 
{
    if(hidden_form.titolo.value==0) {
        alert("Inserimento non valido");
        event.preventDefault();
    }
    else 
    {
        const avviso_pubblicazione = document.querySelector('#avviso_pubblicazione');
        avviso_pubblicazione.classList.remove('hidden');
        event.preventDefault();
        const var_input = hidden_form.titolo.value;
        const formdata = new FormData();
        formdata.append("param1", url_img);
        formdata.append("param2", var_input);
        const form_data = {method: 'post', body: formdata};        
        fetch("http://151.97.9.184/dipaola_rino/hw1/server_post.php", form_data);
    }
}

var url_img;
const form = document.forms['nome_form'];
form.addEventListener('submit', onClick);
const modalView = document.querySelector('#modal-view');
const hidden_form = document.forms['hidden_form'];
hidden_form.addEventListener('submit', invioDati);