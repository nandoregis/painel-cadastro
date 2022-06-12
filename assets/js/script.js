// var day = new Date(2022, 6, 0);


// Mes: 0 a 11, sendo 0 Janeiro e 11 Dezembro
// Ano: No padrão yyyy (4 dígitos)

// function total_dias_mes(ano, mes) {
//     let date = new Date(ano, mes + 1, 0);
//     return date.getDate();
// }

// console.log( total_dias_mes(2022, 5));

// para pegar o mês correto tem que adicionar 1


// abre um confirm antes de deletar algo
var deletar = document.querySelectorAll('.deletar-tela');

deletar.forEach(arr => {
    arr.addEventListener('click', (e)=> {
        let ver = confirm('Você deseja deletar?');
        if(!ver) {
            e.preventDefault();
        }
    });
});


// mensagem de alerta para remover
const divMsg = document.querySelector('.message');

if(divMsg != null){
    setTimeout(()=> {
        divMsg.remove();
    }, 3000);
}

// menu bars 

const menuBars = document.getElementById('menu-bars');
const menuLat = document.querySelector('.box-menu-lateral');
const main = document.querySelector('.main');

var menuHide = sessionStorage.getItem('menu-lateral');
if(menuHide) {
    // esconde o menu lateral
   menuLat.classList.add('menu-hide');
   main.classList.add('event-w100');
   divMsg.classList.add('event-w100');
}

menuBars.addEventListener('click', eventoMenuBars);

function eventoMenuBars() {

    menuLat.classList.toggle('menu-hide');
    main.classList.toggle('event-w100');
    divMsg.classList.toggle('event-w100');
    
    // menu escondido
    if(menuLat.classList.contains('menu-hide')) {
        sessionStorage.setItem('menu-lateral', true);
    }else {
        sessionStorage.removeItem('menu-lateral');
    }

}