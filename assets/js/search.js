const inputSearch = document.querySelector("[placeholder='Search']");
const autocomplete = document.getElementById("autocomplete");
const searchBTN = document.getElementById('searchBTN');
const xhrurl = autocomplete.dataset.xhrurl;
let id_movie = "";
inputSearch.addEventListener(
    "keyup",
    (e) => {
        const inputText = e.target.value;
        console.log(` voilà la suite ${inputText} `);
        fetch(xhrurl+"?resultat=" + inputText)
            .then((reponse) => {
                return reponse.json();

            })
            .then((json) => {
                console.dir(json);
                affichage(json);
            })
    }

)

function affichage(json) {
    if (json.length !== 0) {
        autocomplete.innerHTML = "";
        let retour = "";
        json.forEach(element => {
            retour += `<div onclick = "validComplete('${element.title}','${element.id_movie}')"> ${element.title}</div>`;
        });
        autocomplete.innerHTML = retour;
    }else{
        autocomplete.innerHTML = "On a pas trouvé alors cherche ailleurs";
    }
}
function validComplete(value,id){
    console.log(value);
   inputSearch.value = value;
   autocomplete.innerHTML = "";
   retour = "";
   id_movie = id;
}
searchBTN.addEventListener("click",()=>{
    if(id_movie !== ""){
        console.dir(id_movie)
        location.href = searchBTN.dataset.xhrurl+"?id_movie="+id_movie;
    }
})

