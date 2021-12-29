require('./bootstrap');
require('./plausible');

window.addEventListener('search-updated', event => {
    plausible("search",{ props: { searchword: event.detail.searchWord } });
    // alert('Searched for : ' + event.detail.searchWord);
})

window.addEventListener('search-city', event => {
    plausible("search",{ props: { searchcity: event.detail.searchCity } });
    // alert('Searched in City: ' + event.detail.searchCity);
})
