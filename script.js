let currentItem1 = 4; 
let currentItem2 = 4; 
let currentItem3 = 4; 

// Función para cargar más películas en la sección 1
document.querySelector('#load-more-1').onclick = () => {
    let boxes1 = [...document.querySelectorAll('.box-container-1 .box-1')];
    for (let i = currentItem1; i < currentItem1 + 4; i++) {
        if (i < boxes1.length) {
            boxes1[i].style.display = 'block'; 
        }
    }
    currentItem1 += 4;
    if (currentItem1 >= boxes1.length) {
        document.querySelector('#load-more-1').style.display = 'none';
    }
    

};



// Función para cargar más películas en la sección 2
document.querySelector('#load-more-2').onclick = () => {
    let boxes2 = [...document.querySelectorAll('.box-container-2 .box-2')];
    for (let i = currentItem2; i < currentItem2 + 4; i++) {
        if (i < boxes2.length) {
            boxes2[i].style.display = 'block'; 
        }
    }
    currentItem2 += 4;
    if (currentItem2 >= boxes2.length) {
        document.querySelector('#load-more-2').style.display = 'none'; 
    }
};

// Función para cargar más películas en la sección 3
document.querySelector('#load-more-3').onclick = () => {
    let boxes3 = [...document.querySelectorAll('.box-container-3 .box-3')];
    for (let i = currentItem3; i < currentItem3 + 4; i++) {
        if (i < boxes3.length) {
            boxes3[i].style.display = 'block'; 
        }
    }
    currentItem3 += 4;
    if (currentItem3 >= boxes3.length) {
        document.querySelector('#load-more-3').style.display = 'none'; 
    }
};
