(function() {
    const speakersInput = document.querySelector('#speakers');

    if(speakersInput) {
        let speakers = [];
        let speakersFiltered = [];

        const listSpeakers = document.querySelector('#list-speakers')
        const hiddenSpeaker = document.querySelector('[name="speaker_id"]')

        obtainSpeakers();

        speakersInput.addEventListener('input', searchSpeakers)

        if(hiddenSpeaker.value) {
            (async () => {
                const speaker = await obtainSpeaker(hiddenSpeaker.value)
                const {first_name, last_name} = speaker

                //Insertar en el HTML
                const speakerDOM = document.createElement('LI')
                speakerDOM.classList.add('list-speakers__speaker', 'list-speakers__speaker--selected')
                speakerDOM.textContent = `${first_name} ${last_name}`

                listSpeakers.appendChild(speakerDOM)
            })()
        }

        async function obtainSpeakers() {
            const url = `/api/speakers`;
            const answer = await fetch (url);
            const result = await answer.json();

            formattingSpeakers(result);
        }

        async function obtainSpeaker(id) {
            const url = `/api/speaker?id=${id}`;
            const answer = await fetch(url)
            const result = await answer.json()
            return result;
        }

        function formattingSpeakers(arraySpeakers = []) {
            speakers = arraySpeakers.map( speaker => {
                return {
                    name: `${speaker.first_name.trim()} ${speaker.last_name.trim()}`,
                    id: speaker.id
                }
            })
        }

        function searchSpeakers(e) {
            const search = e.target.value;

            if(search.length > 3) {                
                const expresion = new RegExp(search, "i");
                speakersFiltered = speakers.filter(speaker => {
                    if(speaker.name.toLowerCase().search(expresion) != -1) {
                        return speaker;
                    }
                })
            }else {
                speakersFiltered = []
            }

            showSpeakers();
        }

        function showSpeakers() {
            
            while(listSpeakers.firstChild) {
                listSpeakers.removeChild(listSpeakers.firstChild)
            }

            if(speakersFiltered.length > 0) {
                speakersFiltered.forEach(speaker => {
                    const speakerHTML = document.createElement('LI');
                    speakerHTML.classList.add('list-speakers__speaker')
                    speakerHTML.textContent = speaker.name;
                    speakerHTML.dataset.speakerId = speaker.id;
                    speakerHTML.onclick = selectSpeaker
    
                    //Añadir al dom
                    listSpeakers.appendChild(speakerHTML)
                })
            } else {
                const noResults = document.createElement('P')
                noResults.classList.add('list-speakers__no-result')
                noResults.textContent = 'No hay resultados para tu búsqueda'

                listSpeakers.appendChild(noResults)
            }
        }

        function selectSpeaker(e) {
            const speaker = e.target;

            //remover la clase previa
            const previousSpeaker = document.querySelector('.list-speakers__speaker--selected')
            if(previousSpeaker) {
                previousSpeaker.classList.remove('list-speakers__speaker--selected')
            }

            speaker.classList.add('list-speakers__speaker--selected')

            hiddenSpeaker.value = speaker.dataset.speakerId
        }
    }
})();